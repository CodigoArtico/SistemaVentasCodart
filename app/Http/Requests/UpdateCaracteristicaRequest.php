<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCaracteristicaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $caracteristicaId = $this->route('categoria');
        return [
            //
            'nombre' => 'required|max:60|unique:caracteristicas,nombre,' . $caracteristicaId . ',id',
            'descripcion' => 'nullable|max:255',
            'destacado' => 'nullable|boolean',  // Valida el checkbox
        ];
    }
}
