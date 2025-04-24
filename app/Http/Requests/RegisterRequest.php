<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'birth_date' => Carbon::parse($this->birth_date)->format('Y-m-d'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $pattern = '/^[A-Za-z\x{00C0}-\x{00FF}][A-Za-z\x{00C0}-\x{00FF}\'\-]+([\ A-Za-z\x{00C0}-\x{00FF}][A-Za-z\x{00C0}-\x{00FF}\'\-]+)*/u';
        return [
            'username' => 'required|string|unique:users|min:3|max:30|regex:/^[a-zA-Z0-9._]+$/',
            'first_name' => 'required|string|min:2|max:50|regex:' . $pattern,
            'last_name' => 'required|string|min:2|max:50|regex:' . $pattern,
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|string|min:8|confirmed|regex:/^[a-zA-Z0-9\s!@#$%^&*()_\-+:;=,.?]+$/',
            'birth_date' => ['required', 'date', Rule::date()->beforeOrEqual(today()->subYears(14))],
            'profile_picture' => 'nullable|image|mimes:jpeg,png,webp,jpg,tiff|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'username.regex' => 'The username may only contain letters, numbers, and the characters . and _',
            'first_name.regex' => 'The first name may only contain latin .',
            'last_name.regex' => 'The last name may only contain latin.',
            'password.regex' => 'The password may only contain letters, numbers, and special characters. !@#$%^&*()_\\-:;+=,.?',
        ];
    }
}
