<?php

namespace App\Http\PaymentGateways\Requests;

use App\Enums\Activity;
use Illuminate\Foundation\Http\FormRequest;

class Xendit extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        if (request()->midtrans_status == Activity::ENABLE) {
            return [
                'xendit_secretKey' => ['required', 'string'],
                'xendit_mode'             => ['required', 'string'],
                'xendit_status'           => ['nullable', 'numeric'],
            ];
        } else {
            return [
                'xendit_secretKey' => ['nullable', 'string'],
                'xendit_mode'             => ['nullable', 'string'],
                'xendit_status'           => ['nullable', 'numeric'],
            ];
        }
    }
}
