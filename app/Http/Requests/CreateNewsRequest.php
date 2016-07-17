<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateNewsRequest extends Request
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
                    'title'=>'required',
                    'content' => 'required',
                    'datum'=>'required',





                ];
            }
            case 'PUT':
                return [
                    'title'=>'required',
                    'content' => 'required',
                    'datum'=>'required',





                ];
                break;

        }
    }
    public function messages()
    {

        return [
            //'name.required' => Message::dictionary('name.required'),
            'title.required' => 'A cím megadása kötelező!',
            'content.required' => 'A tartalom megadása kötelező!',
            'datum.required' => 'A dátum megadása kötelező!',




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
