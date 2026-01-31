<?php

namespace App\Http\Requests\Mission;

use Illuminate\Foundation\Http\FormRequest;

class StoreMissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->status === 'active';
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:categories,id',
            'subsubcategory_id' => 'nullable|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'budget_min' => 'nullable|numeric|min:0',
            'budget_max' => 'nullable|numeric|min:0|gte:budget_min',
            'budget_currency' => 'nullable|string|size:3',
            'service_duration' => 'nullable|string|max:100',
            'location_country' => 'required|string|max:255',
            'location_city' => 'nullable|string|max:255',
            'requester_duration_in_country' => 'nullable|string|max:100',
            'is_remote' => 'boolean',
            'language' => 'nullable|string|max:100',
            'spoken_languages' => 'nullable|array',
            'spoken_languages.*' => 'string|max:100',
            'urgency' => 'nullable|in:low,medium,high,urgent',
            'attachments' => 'nullable|array|max:5',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,xls,xlsx,txt|max:10240', // 10MB max per file, safe types only
            'terms_accepted' => 'required|accepted',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'Please select a category for your request.',
            'category_id.exists' => 'The selected category is invalid.',
            'title.required' => 'Please provide a title for your request.',
            'title.max' => 'The title cannot exceed 255 characters.',
            'description.required' => 'Please describe your request.',
            'description.max' => 'The description cannot exceed 5000 characters.',
            'budget_max.gte' => 'Maximum budget must be greater than or equal to minimum budget.',
            'location_country.required' => 'Please specify the country for this service.',
            'terms_accepted.required' => 'You must accept the terms and conditions.',
            'terms_accepted.accepted' => 'You must accept the terms and conditions.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_remote' => filter_var($this->is_remote, FILTER_VALIDATE_BOOLEAN),
        ]);
    }
}
