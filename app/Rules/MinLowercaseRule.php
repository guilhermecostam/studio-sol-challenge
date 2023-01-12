<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinLowercaseRule implements Rule
{
    /**
     * @var int
     */
    private int $minLowercase;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($minLowercase)
    {
        $this->minLowercase = $minLowercase;
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
        return preg_match('/[a-z]/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'minLowercase';
    }
}
