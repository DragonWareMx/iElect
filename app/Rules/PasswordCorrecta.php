<?php

namespace App\Rules;
use App\Models\User;

use Illuminate\Contracts\Validation\Rule;

class CorreoUnico implements Rule
{
    private $id;

    public function __construct($actualPassword,$id)
    {
        $this->id=$id;
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
        dd($value,$this->id);
        $user=User::findOrFail($this->id);
        if(Hash::check($value, $user->password))
            return $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Contraseña actual incorrecta.';
    }
}
