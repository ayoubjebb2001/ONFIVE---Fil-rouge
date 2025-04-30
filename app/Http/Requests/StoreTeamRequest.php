<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:64|unique:teams,name',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:512|dimensions:min_width=100,min_height=100,max_width=512,max_height=512',
            'city' => 'required|string|max:64',
        ];

    }

    public function messages()
    {
        return [
            'name.unique' => 'The team name is already taken.',
            'logo.image' => 'The logo must be an image.',
            'logo.mimes' => 'The logo must be a file of type: jpeg, png, jpg, webp.',
            'logo.max' => 'The logo may not be greater than 5MB.',
            'logo.dimensions' => 'The logo must be at least 100x100 pixels and at most 512x512 pixels.',
        ];
    }
}
