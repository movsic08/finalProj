<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordStrengthValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if (!(preg_match('/[A-Z]/', $value))) {    //check if pattern has no atleast one capital letter
            $fail("Password must contain at least one capital letter.");
        }else if (!(preg_match('/[a-z]/', $value))) {
            $fail("Password must contain at least one lowercase letter.");
        }else if (!(preg_match('/\d/', $value))) {
            $fail("Password must contain at least one digit.");
        }else if (!(preg_match('/[!@#$%^&*()\-_=+{}\[\];:\'",.<>?~\\\\|]/', $value))) {
            $fail("Password must contain at least one special character.");
        }


    }
}
