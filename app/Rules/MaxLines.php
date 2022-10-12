<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

/**
 * Checks the maximum number of lines in the field (as a string).
 */
class MaxLines implements InvokableRule
{
    public function __construct(private int $maxLines)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (count(explode(PHP_EOL, $value)) > $this->maxLines) {
            $fail('validation.max_lines')->translate(['max' => $this->maxLines]);
        }
    }
}
