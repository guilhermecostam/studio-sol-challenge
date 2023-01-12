<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinUppercaseRule implements Rule
{
    /**
     * @var int
     */
    private int $minUppercase;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($minUppercase)
    {
        $this->minUppercase = $minUppercase;
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
        return preg_match('/[A-Z]/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'minUppercase';
    }
}
