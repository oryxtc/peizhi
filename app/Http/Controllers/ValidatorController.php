<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidatorController extends Controller
{
    /**
     * 验证 验证码
     * @param $phone
     * @param $phone_code
     * @param $type
     * @return bool
     */
    public static function validatorCode($phone,$phone_code,$type){

        $code=\DB::table('validator_code')
            ->where(['phone'=>$phone,'type'=>$type])
            ->value('code');

        return $code==$phone_code;
    }
}
