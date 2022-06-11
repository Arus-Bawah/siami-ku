<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UserStoreRequest extends FormRequest
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
            'foto' => 'nullable|mimes:png,jpg,jpeg',
            'nama' => 'required|string|min:1|max:255',
            'jabatan' => 'required|string|min:1|max:255',
            'email' => 'required|min:1|max:255|email|unique:users,email',
            'password' => 'required|string|min:5|max:100',
            'signature_type' => 'required|in:upload,draw', // [upload, draw]
            'signature' => 'required_if:signature_type,==,upload|mimes:png,jpg,jpeg', // upload file
            'signature_draw' => 'required_if:signature_type,==,draw', // base64 from drawing
            'unit' => 'required|array' // role access
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
