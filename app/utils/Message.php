<?php

namespace App\utils;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public static function getMessage($message,$wordsForTransalate=[]){
        switch ($message){
            case 'notFound':
                return response()->json(['msg'=>['messageId'=>'501','message'=>'A hivatkozási útvonal érvénytelen!']],500);
                break;
            case 'requiredToFill':
                foreach ($errors as $e) {
                    $e[]='hunki';
                }
                return response()->json(['msg'=>['messageId'=>'501','message'=>'A hivatkozási útvonal érvénytelen!','errors'=>$errors]],500);
                break;
            case 'partnerNotFound':
                return response()->json(['msg'=>['messageId'=>'404','message'=>'A keresett partner nem található az adatbázisban!']],404);
                break;
            case 'AddressesNotFound':
                return response()->json(['msg'=>['messageId'=>'404','message'=>'A keresett cím nem található az adatbázisban!']],404);
                break;
            case 'isArchived':
                return response()->json(['msg'=>['messageId'=>'200','message'=>'A keresett '.$wordsForTransalate[0].' arhiválva van!']],200);
                break;
            case 'archivedSucces':
            return response()->json(['msg'=>['messageId'=>'200','message'=>'A  '.$wordsForTransalate[0].' sikeresen arhiválva lett!']],200);
            break;

        }

    }
    public static function dictionary($message){
    switch ($message){
        case 'name.required':
            return 'A név mező kitöltése kötelező!';
            break;
        case 'partner_id.required':
            return 'A PartnerId hiányzik [owner]';
            break;
        case 'address.required':
            return 'A  cím mező kitöltése kötelező!';
            break;
        case 'bankAccountNumber.required':
        return 'A számlaszám megadása kötelező!';
        break;
        case 'city.required':
            return 'A város mező kitöltése kötelező!';
            break;
        case 'postalCode.required':
            return 'Az irányítószám kitöltése kötelező!';
            break;
        case 'telephone.required':
            return 'A telefon  kitöltése kötelező!';
            break;
        case 'partnerType.invalid':
            return 'A Partner tipusa CUSTOMER vagy SUPPLIER lehet csak!';
            break;

        case 'requiredToFill':
        break;
    }

}

}
