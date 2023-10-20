<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NonEmptyArray implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        if (!is_array($value) || empty($value)) {
            return false;
        }

        // Check if any element in the array is empty
        foreach ($value as $element) {
            if (empty($element)) {
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
        return  'The :attribute Cannot Be Empty.';
    }
}
