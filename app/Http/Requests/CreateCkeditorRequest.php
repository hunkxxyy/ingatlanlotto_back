<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateCkeditorRequest extends Request
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
    public function rules()
    {/*,
        'file' => 'image|max:50'*/
        switch ($this->method()) {
            case 'POST': {
                return [


                    'PATH'=>'required'




                ];
            }
            case 'PUT':
                return [



                ];
                break;

        }


    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {

        return [
            'file.max' => 'A file mérete nem lehet nagyobb mint!',




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
