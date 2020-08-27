<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Message;

class MessageController extends Controller
{
    public function index()    {

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

    public function destroy($id)   {

            Message::destroy($id);
            return response()->json(null, 204);
        }
}
