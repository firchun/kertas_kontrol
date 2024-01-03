<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Events\ChatEvent;
use App\Models\Bimbingan;
use App\Models\chat;
use App\Models\Lapak;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function room($room)
    {
        // Get room
        $room = DB::table('chat_rooms')->where('id', $room)->first();

        // Get users
        $user =  DB::table('chat_room_bimbingans')->where('chat_room_id', $room->id);
        $users = $user->get();

        $id_bimbingan = $user->first()->id_bimbingan;

        // $id_bimbingan = $user->id_bimbingan;
        // dd($users->where('id_user', '!=', Auth::user()->id));

        // $id_user = $user->where('id_user', '!=', Auth::user()->id)->first()->id_user;

        // // dd($id_user);
        // $lapak = Bimbingan::find($id_bimbingan);

        $title = 'Chat Bimbingan : ';

        return view('pages.bimbingan.chat.chat', compact('room', 'users', 'title'));
    }

    public function getChat($room)
    {
        //perlu id_bimbingan agar tidak bertabrakan

        // Join with user
        $chats = DB::table('chats')
            ->join('users', 'users.id', '=', 'chats.id_user')
            ->where('chat_room_id', $room)
            ->select('chats.*', 'users.name as user_name')
            ->orderBy('chats.created_at')
            ->get();

        return response()->json($chats);
    }

    // Send chat
    public function sendChat(Request $request)
    {
        $chat = DB::table('chats')->insert([
            'chat_room_id' => $request->room,
            'id_user' => auth()->user()->id,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        chat::where('chat_room_id', $request->room)
            ->where('id_user', '!=', Auth::user()->id)
            ->update(['is_read' => 1]);

        // Trigger event
        broadcast(new ChatEvent($request->room, $request->message, auth()->user()->id));

        return response()->json($chat);
    }

    public function chat($user, $id_bimbingan)
    {
        // $id_bimbingan = Bimbingan::find($id_bimbingan);
        // $user = $bimbingan->id_user;

        $my_id = auth()->user()->id;
        $target_id = $user;

        $my_room = DB::table('chat_room_bimbingans')->where('id_bimbingan', $id_bimbingan);
        $target_room = clone $my_room;

        // Get my room
        $my_room = $my_room->where('id_user', $my_id)->get()->keyBy('chat_room_id')->toArray();
        // Get target room
        $target_room = $target_room->where('id_user', $target_id)->get()->keyBy('chat_room_id')->toArray();

        // Check room
        $room = array_intersect_key($my_room, $target_room);

        // If room exists
        if ($room) return redirect()->route('chat.room', ['room' => array_keys($room)[0]]);

        // If room doesn't exist
        $uuid = Str::orderedUuid();
        $room = DB::table('chat_rooms')->insert([
            'id' => $uuid,
            'name' => 'generate by system',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Add users to room
        DB::table('chat_room_bimbingans')->insert([
            [
                'chat_room_id' => $uuid,
                'id_user' => $my_id,
                'id_bimbingan' => $id_bimbingan,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'chat_room_id' => $uuid,
                'id_user' => $target_id,
                'id_bimbingan' => $id_bimbingan,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        return redirect()->route('chat.room', ['room' => $uuid]);
    }
}
