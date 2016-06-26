<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\utils\Message;

class CreateUserRequest extends Request
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
                     'name' => 'required',
                     'email'  => 'required|email|unique:users,email',
                     'password'  => 'required|min:6',
                     'password2' => 'required|same:password',




                ];
            }
            case 'PUT':
                return [
                    'name' => 'required',

                    'password'  => 'min:6',
                    'password2' => 'same:password',


                ];
                break;

        }


    }

    public function messages()
    {

        return [
            'name.required' => 'A teljes név mező kitöltése kötelező!',
            'email.required' => 'A e-mail mező kitöltése kötelező!',
            'password.required' => 'A jelszó mező kitöltése kötelező!',
            'password.min' => 'A jelszónak minimum 6 karakter hosszúnak kell lennie!',
            'password2.required' => 'A jelszó ismét mező kitöltése kötelező!',
            'email' => 'Az e-mail cím nem jó!',
            'same' => 'A jelszó és az ismételt jelszó nem eggyeznek meg!',
            'email.unique'=>'Az e-mai cím már regisztrálva van!',





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
