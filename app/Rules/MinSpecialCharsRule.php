<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinSpecialCharsRule implements Rule
{
    /**
     * @var int
     */
    private int $minSpecialChars;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($minSpecialChars)
    {
        $this->minSpecialChars = $minSpecialChars;
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
        return preg_match_all( "/[^A-Za-z0-9]/", $value) >= 2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'minSpecialChars';
    }
}
