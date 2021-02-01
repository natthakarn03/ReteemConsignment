<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Cookie;

class CekEmaillogin implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $arrUser   = json_decode(Cookie::get('datauser')); 
        $ketemu    = 0; 
        for($i = 0; $i < count($arrUser); $i++)
        {
            if($arrUser[$i]->email == $value)
            {
                $ketemu+=1; 
            }
        }

        if($ketemu == 1) { return true; } else { return false; }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'EMAIL BELUM TERDAFTAR';
    }
}
