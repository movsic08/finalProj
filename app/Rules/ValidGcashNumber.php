<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidGcashNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Regular expression to match valid Philippines phone numbers
        $pattern = '/^09\d{9}$/';

        //check if the value matches the pattern
        if(!(preg_match($pattern, $value))){
            $fail( 'Mobile Number must be a valid Gcash Account Number.'); //return an error message if validation fails
        }
    }
}
