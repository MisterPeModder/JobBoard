<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // already checked in CompanyController::update
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'string|required|filled',
            'location' => 'string|nullable',
            'description' => 'string|required|filled|max:'.StoreCompanyRequest::MAX_DESCRIPTION_SIZE,
            'icon' => 'nullable|file|mimes:jpg,png,webp,pdf|max:'.StoreCompanyRequest::MAX_ICON_SIZE,
        ];
    }
}
