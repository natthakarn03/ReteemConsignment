<?php

namespace App\Rules;

use App\userpembelis;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class checkPhone implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $daftarUser = userpembelis::where("USERPB_PHONE_NUMBER", $value)->first();

        return $daftarUser == null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Nomor sudah terdaftar';
    }
}
