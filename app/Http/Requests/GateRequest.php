<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'price' => [
                'required',
                'gt:0'
            ],
            'point' => [
                'required',
                'gte:0'
            ],
            'order_id' => [
                'required',
                'max:10',
                'min:10',
            ],
            'user_id' => [
                'required',
                'max:36',
                'min:36',
            ],
            'ref_code' => [
                'required',
                'max:10',
                'min:10',
            ],
            'callback_success_url' => 'required',
            'callback_fail_url' => 'required',
            'hash' => [
                'max:40',
                'min:40',
                function (string $attr, mixed $value, \Closure $fail) {
                    $hashedString = str()->createHash(
                        ...$this->collect(['callback_fail_url', 'callback_success_url', 'price',])
                            ->prepend(config('callback.salt'))
                            ->values()
                    );

                    if ($value !== $hashedString) {
                        $fail(trans('validation.confirmed', ['attribute' => $attr]));
                    }
                },
            ],
        ];
    }
}
