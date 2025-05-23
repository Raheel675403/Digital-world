<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaserDetail;
use App\Models\User;
use App\Models\videoDetails;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PurchaseController extends Controller
{
    public function index(){
        if(Auth::check()){
            return view('pages.purchaser.purchase-coins');
        }
    }
    public function applyVideo(){
        if(Auth::check()){
            return view('pages.purchaser.apply-video');
        }
    }

    public function requestVideo(Request $request)
    {
        if (Auth::check()) {
            $url = $request->url;
            // Extract video ID
            parse_str(parse_url($url, PHP_URL_QUERY), $query);
            $videoId = $query['v'] ?? null;

            if (!$videoId) {
                return response()->json(['error' => 'Invalid YouTube URL'], 400);
            }

            $apiKey = env('YOUTUBE_API_KEY');

            $response = Http::get("https://www.googleapis.com/youtube/v3/videos", [
                'part' => 'snippet,statistics,contentDetails',
                'id' => $videoId,
                'key' => $apiKey,
            ]);

            $data = $response->json();

            if (empty($data['items'])) {
                return response()->json(['error' => 'Video not found'], 404);
            }

            $video = $data['items'][0];

            return response()->json([
                'status' => 'success',
                'title' => $video['snippet']['title'],
                'channel' => $video['snippet']['channelTitle'],
                'views' => $video['statistics']['viewCount'],
                'like' => $video['statistics']['likeCount'] ?? 0,
                'thumbnail' => $video['snippet']['thumbnails']['medium']['url'],
                'video_id' => $video['id'],
                'embed_url' => "https://www.youtube.com/embed/" . $video['id'],
            ]);
        }
    }
    public function saveRequestVideo(Request $request){
        if(Auth::check()){
            $request->validate([
                'channel_name'=>'required',
               'apply_views'=>'required|integer'
            ]);
            $data = new videoDetails();
            $data->user_id          = auth()->user()->id;
            $data->channel_name     = $request->channel_name;
            $data->previous_views   = $request->previous_views;
            $data->url              = $request->video_url;
            $data->apply_views      = $request->apply_views;
            if($data->apply_views){
                $loginuser          = User::where('id', auth()->id())->first();
                if($loginuser->has_coins > 0){
                    $demond = $request->apply_views;
                    if($demond <= $loginuser->has_coins ){
                        $has_coin = $loginuser->has_coins - $data->apply_views;
                        $loginuser->has_coins = $has_coin;
                        if ($loginuser->save()){
                            if($data->save()){
                                return to_route('dashboard')->with('success','Your request has been successfully applied.Please wait a moment and then check the video.');
                            }
                        }else{
                            return back()->with('error', 'Oops! Something went wrong. Please try again shortly.');
                        }

                    }else{
                        return back()->with('error', 'Oops! You don’t have enough coins to continue. You currently have only ' . $loginuser->has_coins . ' coin(s). Please purchase more coins to enjoy full access!');
                    }
                }else{
                    return back()->with('error', 'Oops! You don’t have enough coins to continue. You currently have only ' . $loginuser->has_coins . ' coin(s). Please purchase more coins to enjoy full access!');
                }
            }
        }
    }
    public function purchaseCoin(Request $request)
    {
        $coinAmount = $request->amount;
        $pricePerCoin = 100; // 10 paisa per coin
        $totalAmount = $coinAmount * $pricePerCoin; // paisa (not rupees)

        if ($totalAmount < 1) {
            return redirect()->back()->with('error', 'Minimum payment must be at least PKR 1 paisa (PKR 1.50).');
        }

        Stripe::setApiKey(config('services.stripe.secret')); // best practice

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'pkr',
                    'product_data' => [
                        'name' => $coinAmount . ' Coins',
                    ],
                    'unit_amount' => $totalAmount, // paisa (e.g., 100 paisa = PKR 1)
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('coin.success') . '?session_id={CHECKOUT_SESSION_ID}&coins=' . $coinAmount,
            'cancel_url' => route('dashboard'),
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        if (!Auth::check()) return redirect('/login');

        Stripe::setApiKey(config('services.stripe.secret'));
        $session = Session::retrieve($request->get('session_id'));
        $amountTotal = $session->amount_total;

        $coins = $amountTotal / 10; // 10 paisa per coin

        $user = auth()->user();
        $purchaseData = new PurchaserDetail();
        $purchaseData->user_id = $user->id;
        $purchaseData->coin = $coins;
        $purchaseData->save();

        $user->has_coins += $coins;
        $user->save();

        return redirect()->route('dashboard')->with('success', "You have purchased {$coins} coins.");
    }



}
