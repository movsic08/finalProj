<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPhillippinesPhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Regular expression to match valid Philippines phone numbers
        $pattern = '/^\+63\d{10}$/';

        //check if the value matches the pattern
        if(!(preg_match($pattern, $value))){
            $fail( 'Mobile number format must be like +639121231234. The mobile must be a valid Philippines phone number. '); //return an error message if validation fails
        }

    }

    /*
    public function message(){
        return 'The mobile must be a valid Philippines phone number.';
    }*/
}
