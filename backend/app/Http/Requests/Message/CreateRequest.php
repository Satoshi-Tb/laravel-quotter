<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'message' => ['required', 'max:140']
        ];
    }

    /**
     * Get the message content from the request.
     */
    public function getMessage(): string
    {
        return $this->input('message');
    }

    /**
     * Get the authenticated user's ID.
     */
    public function getUserId(): int
    {
        return $this->user()->id;
    }
}
