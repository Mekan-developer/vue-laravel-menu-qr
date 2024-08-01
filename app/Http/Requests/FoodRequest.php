<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
        
        $this['name'] = json_decode($this->name, true);

        $this->description = json_decode($this->description);
        if (empty(get_object_vars($this->description)))
            $this['description'] = null;

        $this['is_active'] = (filter_var(($this->is_active), FILTER_VALIDATE_BOOLEAN)) ? 1 : 0;
        $this['discount'] = json_decode($this->discount);
        $rules = [
            'name' => 'required',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'discount' => 'nullable|numeric|min:1',
            'discount_unit' => 'nullable|in:manat,percent',
            'is_active' => 'required'
        ];
        return $rules;
    }
}
