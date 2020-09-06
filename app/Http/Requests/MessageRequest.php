<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
    {
        public function rules()    {
            return [
                'to' => 'required',
                'body' => 'required'
            ];
        }

        public function authorize()    {
            if (auth()->check()) {
                return true;
            }
            else {
                return false;
            }
        }
}
