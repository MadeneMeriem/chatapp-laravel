<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // this index will get us all the messages between 2 users :
    public function index(User $user)
    {
        $auth_id = Auth::id();
        $messages = Message::whereIn(
            'sender_id',
            [$auth_id ,$user->id ],)->whereIn(
                'receiver_id',
                [$auth_id,$user->id]
            )->orderBy('created_at')->get();

        return response()->json([
            'success'=>true,
            'data'=>$messages
        ]);
    }


    //function to store new messages
    public function store(Request $request)
    {
        $validated_message = $request->validate([
            'sender_id'=> ['required , exists:users,id'],
            'receiver_id'=> ['required', 'exists:users,id'],
            'message'=> ['required'],
        ]);

        $new_message = Message::create($validated_message);

        return response()->json([
            'success' => true,
            'data' => $new_message,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
