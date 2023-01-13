<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoRepetedRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $passLenght = strlen($value);
        for ($i=0; $i < $passLenght-1; $i++) {
            if ($value[$i] == $value[$i+1]) {
                return false;
            }
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
        return 'noRepeted';
    }
}
