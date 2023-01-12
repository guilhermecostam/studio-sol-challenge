<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinDigitRule implements Rule
{
    /**
     * @var int
     */
    private int $minDigit;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($minDigit)
    {
        $this->minDigit = $minDigit;
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
        return preg_match_all( "/[0-9]/", $value) >= 4;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'minDigit';
    }
}
