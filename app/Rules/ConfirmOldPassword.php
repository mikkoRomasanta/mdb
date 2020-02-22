<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ConfirmOldPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($oldPassword)  //cur_password is passed here
    {
        $this->oldPassword = $oldPassword; //add cur_password to $this->oldPassword
    }

    public function passes($attribute, $value)
    {
        return Hash::check($value, $this->oldPassword); //will check if cur_password has the same hash
    }

    public function message()
    {
        return 'Incorrect old password.';
    }
}
