<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateForgottenpasswordrchangeRequest extends Request
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
            case 'PUT': {
                return [
                    'password'  => 'required|min:6',
                    'password2' => 'required|same:password',




                ];
            }
                break;

        }


    }
    public function messages()
    {

        return [
            'password.required' => 'A jelszó mező kitöltése kötelező!',
            'password.min' => 'A jelszónak minimum 6 karakter hosszúnak kell lennie!',
            'password2.required' => 'A jelszó ismét mező kitöltése kötelező!',
            'same' => 'A jelszó és az ismételt jelszó nem eggyeznek meg!',





        ];
    }

    public function response(array $errors)
    {
        foreach ($errors as $oneErr=>$err)
        {
            $onlyErr[]=$err[0];
        }
        $errors=[];
        $errors['errors']=$onlyErr;
        return response()->json(['message' => $errors]);
        //return response()->json(['message' => $errors, 'code' => 422]);

    }
}
