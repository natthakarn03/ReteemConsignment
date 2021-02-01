<?php

namespace App\Rules;

use App\banks;
use Illuminate\Contracts\Validation\Rule;

class checkNamaBank implements Rule
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
        $daftarBank = banks::where("nama_bank", $value)->count();
        if($daftarBank >0){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Bank telah ada';
    }
}
