<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateContractRequest extends FormRequest
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
        $allowedContractLengths = [24, 36, 48];
        $allowedAnnualMiles = [5000, 10000, 15000, 20000, 25000, 30000];

        return [
            'vehicle_id' => ['required', 'integer'],
            'contract_length' => ['required', 'integer', Rule::in($allowedContractLengths)],
            'annual_miles' => ['required', 'integer', Rule::in($allowedAnnualMiles)]
        ];
    }
}
