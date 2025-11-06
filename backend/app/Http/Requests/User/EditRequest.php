<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditRequest extends FormRequest
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
            'display_name' => ['required', 'max:50'],
            'profile' => ['max:160'],
            'profile_image' => ['nullable', 'image', 'max:1024', 'mimes:jpeg,jpg,png,gif'], // プロフィール画像のバリデーション
        ];
    }

    /**
     * Get the display name from the request.
     */
    public function getDisplayName(): string
    {
        return $this->input('display_name');
    }

    /**
     * Get the profile from the request.
     */
    public function getProfile(): ?string
    {
        return $this->input('profile'); // プロフィールはnull許容
    }

    /**
     * Get the profile image from the request.
     */
    public function getProfileImage()
    {
        return $this->file('profile_image');
    }
}
