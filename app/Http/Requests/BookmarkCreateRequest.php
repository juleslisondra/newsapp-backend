<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class BookmarkCreateRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', 
                Rule::unique('bookmarks', 'title')->where('user_id', Auth::user()->id),
            ],
            'url' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'section_id' => ['required', 'string', 'max:255'],
            'section_name' => ['required', 'string', 'max:255'],
            'published_date' => ['required', 'date', 'max:255'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.unique' => 'Article already bookmarked',
        ];
    }
}
