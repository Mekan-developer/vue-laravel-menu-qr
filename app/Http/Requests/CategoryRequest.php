<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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

        $rules = [
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'required',
        ];
        if ($this->has('parent_id')) {
            $rules['parent_id'] = 'required|integer';
        }

        if ($this->image_require) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'; //required bolmalymy ya nullable?????
        }

        return $rules;

    }
}
