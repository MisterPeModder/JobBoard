<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdvertApplicationRequest extends FormRequest
{
    const MAX_MESSAGE_SIZE = 4096;

    const MAX_ATTACHMENT_COUNT = 3;

    /**
     * The maximum size of an attachment, in kilobytes.
     */
    const MAX_ATTACHMENT_SIZE = 1000;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'string|required|filled',
            'surname' => 'string|nullable',
            'email' => 'string|required|filled|email',
            'phone-number' => 'string|nullable',
            'message' => 'string|required|filled|max:'.self::MAX_MESSAGE_SIZE,
            'attachments' => 'array|max:'.self::MAX_ATTACHMENT_COUNT,
            'attachments.*' => 'file|mimes:jpg,png,webp,pdf,docx,odt|max:'.self::MAX_ATTACHMENT_SIZE,
        ];
    }
}
