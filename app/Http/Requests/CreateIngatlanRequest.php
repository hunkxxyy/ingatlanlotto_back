<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\utils\Message;

class CreateIngatlanRequest extends Request
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
                    'sorsjegy_ar'=>'required|integer|min:1',
                    'pos' => 'required',
                    'ingatlan_ar'=>'required|integer|min:1',





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
            //'name.required' => Message::dictionary('name.required'),
            'sorsjegy_ar.required' => 'A sorsjegy árának kitöltése kötelező!',
            'sorsjegy_ar.min' => 'A sorsjegy ára minimum 1 ft. legyen!',
            'ingatlan_ar.min' => 'A ingatlan ára minimum 1 ft. legyen!',




        ];
    }

    public function response(array $errors)
    {$i=0;

        foreach ($errors as $oneErr=>$err)
        {

            $onlyErr[$i]=$err[0];
            $i++;
        }

        return response()->json(['errors'=>$onlyErr, 'http_status'=>422]);

    }
}
