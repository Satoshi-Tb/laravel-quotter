<?php

namespace App\Http\Requests\Quoot;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
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
            'quoot' => ['required', 'max:140'],
        ];
    }

    /**
     * Get the quoot content from the request.
     */
    public function getQuoot(): string
    {
        return $this->input('quoot');
    }
}
