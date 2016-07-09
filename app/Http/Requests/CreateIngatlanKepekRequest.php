<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\utils\Message;

class CreateIngatlanKepekRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST': {
                return [





                ];
            }
            case 'PUT':
                return [



                ];
                break;

        }


    }

    public function messages()
    {

        return [
            'name.required' => Message::dictionary('name.required'),




        ];
    }

    public function response(array $errors)
    {

        return response()->json(['message' => $errors, 'code' => 422], 422);

    }
}
