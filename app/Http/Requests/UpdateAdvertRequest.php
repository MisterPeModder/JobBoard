<?php

namespace App\Http\Requests;

use App\Enums\Currency;
use App\Enums\JobType;
use App\Enums\SalaryType;
use App\Rules\MaxLines;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateAdvertRequest extends FormRequest
{
    /**
     * The maximum number of lines that can be in a short description.
     */
    const MAX_SHORT_DESC_LINES = 5;

    /**
     * The maximum width in characters (or bytes maybe?) of a short desc line.
     */
    const MAX_SHORT_DESC_LINE_LENGTH = 100;

    const MAX_FULL_DESC_LENGTH = 4096;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // checked in AdvertController::update
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'string|required|filled|max:255',
            'location' => 'string|nullable|max:255',
            'short-description' => [
                'string',
                'required',
                'filled',
                'max:'.(self::MAX_SHORT_DESC_LINES * self::MAX_SHORT_DESC_LINE_LENGTH),
                new MaxLines(self::MAX_SHORT_DESC_LINES),
            ],
            'salary-min' => 'numeric|nullable|required_with_all:salary-max,salary-currency,salary-type|min:0',
            'salary-max' => 'numeric|nullable|required_with:salary|gte:salary-min',
            'salary-currency' => ['nullable', 'required_with:salary-min', new Enum(Currency::class)],
            'salary-type' => ['nullable', 'required_with:salary-min', new Enum(SalaryType::class)],
            'job-type' => ['nullable', new Enum(JobType::class)],
            'full-description' => 'string|required|filled|max:'.self::MAX_FULL_DESC_LENGTH,
        ];
    }
}
