<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ChatController extends Controller
{
    /**
     * @return View
     */
    public function chat()
    {
        return view('chat');
    }

    /**
     * @param Request $request
     */
    public function send(Request $request)
    {
        $user = User::find(Auth::id());

        $this->saveToSession($request);

        event(new ChatEvent(
            $request->message,
            $user->name
        ));
    }

    /**
     * @param Request $request
     */
    public function saveToSession(Request $request)
    {
        session()->put('chat', $request->chat);
    }

    /**
     * @return string
     */
    public function getOldMessage()
    {
        return session('chat');
    }

    /**
     * delete session
     */
    public function deleteSession()
    {
        session()->forget('chat');
    }
}
