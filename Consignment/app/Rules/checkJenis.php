<?php

namespace App\Rules;

use App\jenisbarangs;
use Illuminate\Contracts\Validation\Rule;

class checkJenis implements Rule
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
        $daftarJenis = jenisbarangs::where('NAMA_JENIS',"like","%".$value."%")->count();
        // dd($daftarJenis);
        if($daftarJenis > 0){
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
        return 'Jenis telah terdaftar';
    }
}
