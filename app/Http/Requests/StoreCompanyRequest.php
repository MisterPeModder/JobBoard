<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCompanyRequest extends FormRequest
{
    const MAX_DESCRIPTION_SIZE = 4096;

    const MAX_ICON_SIZE = 4000;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // can only create company if user doesn't already belong to one
        return Auth::user()?->comapny == null;
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
            'description' => 'string|required|filled|max:'.self::MAX_DESCRIPTION_SIZE,
            'icon' => 'file|mimes:jpg,png,webp,pdf|max:'.self::MAX_ICON_SIZE,
        ];
    }
}
