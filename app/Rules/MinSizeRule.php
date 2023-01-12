<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinSizeRule implements Rule
{
    /**
     * @var int
     */
    private int $minSize;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($minSize)
    {
        $this->minSize = $minSize;
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
        return strlen($value) >= $this->minSize;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'minSize';
    }
}
