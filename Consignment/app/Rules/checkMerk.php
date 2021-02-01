<?php

namespace App\Rules;

use App\merkbarangs;
use Illuminate\Contracts\Validation\Rule;

class checkMerk implements Rule
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
        $daftarMerk = merkbarangs::where('NAMA_MERK2',"like","%".$value."%")->count();
        // dd($daftarJenis);
        if($daftarMerk > 0){
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
        return 'Merk telah ada';
    }
}
