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

        event(new ChatEvent(
            $request->get('message'),
            $user->name
        ));
    }
}
