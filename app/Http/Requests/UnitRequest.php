<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UnitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'unit' => 'required|string|min:1|max:255',
            'tipe' => 'required|integer|exists:master_unit_tipe,id',
            'fakultas' => 'required_if:unit_type,==,2|integer', # unit type 2 prodi, parent always fakultas
            'jenjang' => 'required_if:unit_type,==,2|array',
        ];
    }

    /**
     * Send Error JSON
     *
     * @param Validator $validator
     * @throws ValidationException
     */
    public function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'status' => false,
            'message' => $validator->errors()->all(':message')[0]
        ], 400);

        throw new ValidationException($validator, $response);
    }
}
