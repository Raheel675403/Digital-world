<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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

}
