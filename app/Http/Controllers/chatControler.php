<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use function Webmozart\Assert\Tests\StaticAnalysis\resource;

class chatControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Show(User $user)
    {
        return view('chat',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getMessage(User $user)
    {
        return Message::query()->where(function ($query) use ($user){
            $query->where('sender_id',auth()->id())
                  ->where('receiver_id' , $user->id)
                ->orWhere('sender_id', $user->id)
                ->where('receiver_id' ,auth()->id());
        })->with(['Sender','receiver'])->orderBy('created_at', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function sendMessage(User $user)
    {
       $message = Message::create([
           'sender_id' => auth()->id(),
           'receiver_id' => $user->id,
           'text' => request('message')
       ]);
       broadcast(new MessageSent($message));
       return response()->json($message);
    }


}
