<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'content' => 'required',
            'tag' => 'array'
        ];

        if ($this->isMethod('PUT')) {
            // Aturan validasi untuk update
            $rules = [
                'title' => 'required|unique:blogs,title,' . $this->blog->id,
            ];
        } else {
            // Aturan validasi untuk penambahan baru
            $rules = [
                'title' => 'required',
            ];
        }
        return $rules;
    }
}
