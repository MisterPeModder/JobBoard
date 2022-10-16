<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssetRequest extends FormRequest
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
            'name' => 'string|required|filled|max:255',
            'blob-id' => 'integer|required|exists:blobs,id',
            'mime-type' => 'string|required',
            'creation-date' => 'date|required',
            'user' => 'email|nullable|exists:users,email',
            'company-id' => 'integer|nullable|exists:companies,id',
            'access' => 'string|required|in:public,private',
        ];
    }
}
