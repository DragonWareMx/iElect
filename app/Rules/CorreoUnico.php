<?php

namespace App\Rules;
use App\Models\User;

use Illuminate\Contracts\Validation\Rule;

class CorreoUnico implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($actualPassword,$id)
    {
        $this->actualPassword=$actualPassword;
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
        $user=User::findOrFail($id);
        if(Hash::check($request->actualPassword, $usuario->password))
            return true;
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
