<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\videoDetails;
use App\Models\ViewerAccountBalance;
use App\Models\viewerVideoDetail;
use http\Env\Response;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class viewerVideoController extends Controller
{
    public function requestViewVideo()
    {
        if (Auth::check()) {
            $user = auth()->user();

            // Get watched video URLs
            $watchedUrls = viewerVideoDetail::where('user_id', $user->id)->pluck('video_url');

            // Get videos not yet watched
            $videos = videoDetails::whereNotIn('url', $watchedUrls)->get();
            return response()->json([
                'success' => true,
                'message' => 'Data fetched successfully!',
                'data' => $videos
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated.',
                'data' => []
            ], 401);
        }
    }
    public function viewerSaveVideo(Request $request){
        $videoUrl = $request->input('videoUrl');
        $channelName = $request->input('channelName');
        // You can save these details to a database or use them however you need
        DB::table('viewer_video_details')->insert([
            'user_id' => auth()->user()->id,
            'channel_name' => $channelName,
            'video_url' => $videoUrl,
//            'completed_at' => now(),
        ]);
        $data = new ViewerAccountBalance();
        $data->user_id = auth()->user()->id;
        $data->balance  = 10;
        $data->video_url  = $videoUrl;
        $data->timestamps = now();
        if($data->save()){
        return response()->json(['message' => 'Video completion recorded']);
        }else{
            return response()->json(['message' => 'Something want wrong please contact their team']);
        }
    }
    public function viewerVideoHistory(){
        if(Auth::check()){
            $video = ViewerAccountBalance::where('user_id',\auth()->user()->id)->get();
            return view('pages.viewer.view-video-history',compact('video'));
        }
    }

}
