<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateKapcsolatEmailRequest extends Request
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
                    'email'  => 'required|email',
                    'phone'  => 'required',
                    'comments' => 'required',




                ];
            }


        }
    }
    public function messages()
    {

        return [
            'name.required' => 'A név mező kitöltése kötelező!',
            'email.required' => 'A e-mail mező kitöltése kötelező!',
            'phone.required' => 'A telefon mező kitöltése kötelező!',
            'comments.required' => 'Az üzenetnek nincsen tartalma!',
            'email' => 'Az e-mail cím nem jó!',






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
