<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Message;

class MessageController extends Controller
{
    public function index()   {

            $messages = Message::latest()->get();

            return response()->json($messages);
        }

    public function store(MessageRequest $request)    {

            $message = Message::create($request->all());

            return response()->json($message, 201);
        }

     public function show($id)  {

            $message = Message::findOrFail($id);

            return response()->json($message);
        }

    public function update(MessageRequest $request, $id)  {

            $message = Message::findOrFail($id);
            $message->update($request->all());

            return response()->json($message, 200);
        }

    public function destroy($id) {

            Message::destroy($id);
            return response()->json(null, 204);
        }

    public function sendMessage(MessageRequest $request) {
        $message = new Message();
        $message->from = auth()->user()->id;
        $message->from_name = auth()->user()->name;
        $message->fill($request->all());
        $message->save();
        return response()->json(['message' => 'sent'], 201);
        }

        public function lastMessage() {
        $user_id = auth()->user()->id;
        $message = Message::whereTo($user_id)->latest()->limit(1)->get();
        return response()->json($message, 200);
        }

        public function unreadMessages() {
        $user_id = auth()->user()->id;
        $messages = Message::whereTo($user_id)->where('read', '=', 0)->get();
        return response()->json($messages, 200);
        }

        public function checkMessages() {
        $user_id = auth()->user()->id;
        $messages = Message::whereTo($user_id)->where('read', '=', 0)->count();
        return response()->json([
            'unread' => $messages
        ], 200);
        }

        public function getMessage() {
        $user_id = auth()->user()->id;
        $message = Message::whereTo($user_id)->where('read', '=', 0)->first();
        Message::findOrFail($message->id)->update(['read' => true]);
        return response()->json($message, 200);
        }

}
