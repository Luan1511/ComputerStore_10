<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PusherController extends Controller
{
    public function index()
    {
        return view('chattings.index');
    }

    public function broadcast(Request $request)
    {
        broadcast(new MessageSent($request->get('message')))->toOthers();

        if (Auth::user()->authority != 1) {
            Message::insert([
                'user_id' => auth()->id(),
                'content' => $request->get('message'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $admin = Admin::where('user_id', auth()->id())->first();
            Message::insert([
                'admin_id' => $admin->id,
                'content' => $request->get('message'),
                'user_id' => $request->get('user_id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return view('chattings.broadcast', ['message' => $request->get('message')]);
    }

    public function receive(Request $request)
    {
        if ($request->get('user_id') != null) {
            $user = User::where('id', $request->get('user_id'))->first();
            return view('chattings.receive', [
                'message' => $request->get('message'),
                'user_img' => $user->img
            ]);
        } else {
            return view('chattings.receive', ['message' => $request->get('message')]);
        }
    }

    public function fetchMessages()
    {
        if (Auth::user()->authority == 1) {
            $messages = Message::with('user')
                ->where('admin_id', auth()->id())
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $messages = Message::with('user', 'admin')
                ->where('user_id', auth()->id())
                ->orderBy('id', 'asc')
                ->get();
        }

        return view('chattings.receive', compact('messages'));
    }

    public function fetchMessagesAdmin_user($user_id)
    {
        $messages = Message::with('user', 'admin')
            ->where('user_id', $user_id)
            ->orderBy('id', 'asc')
            ->get();

        return view('chattings.receive', compact('messages'));
    }
}
