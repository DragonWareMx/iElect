<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Campaign;

class Codigo implements Rule
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
        //
        $campanas = Campaign::get();
        foreach ($campanas as $campana) {
            if ($campana->codigo == $value) {
                return $value;
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El código de campaña ingresado no existe.';
    }
}