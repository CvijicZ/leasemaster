<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVehicleRequest extends FormRequest
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
        $commonRules=['required', 'max:50', 'alpha_num:ascii'];
        return [
            'make' => $commonRules,
            'model' => $commonRules,
            'engine' => ['required', 'max:50'],
            'miles' => ['required', 'numeric'],
            'color' => $commonRules,
            'seats' => ['required', 'integer'],
            'transmission' => ['required', 'max:50', 'string'],
            'fuel_consumption' => ['required', 'numeric'],
            'value' => ['required', 'numeric'],
            'year' => ['required', 'integer']
        ];
    }
}
