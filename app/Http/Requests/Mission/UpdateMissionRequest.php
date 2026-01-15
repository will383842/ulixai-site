<?php

namespace App\Http\Requests\Mission;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $mission = $this->route('mission');

        return auth()->check() &&
               $mission &&
               $mission->requester_id === auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'category_id' => 'sometimes|exists:categories,id',
            'subcategory_id' => 'nullable|exists:categories,id',
            'subsubcategory_id' => 'nullable|exists:categories,id',
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:5000',
            'budget_min' => 'nullable|numeric|min:0',
            'budget_max' => 'nullable|numeric|min:0|gte:budget_min',
            'budget_currency' => 'nullable|string|size:3',
            'service_duration' => 'nullable|string|max:100',
            'location_country' => 'sometimes|string|max:255',
            'location_city' => 'nullable|string|max:255',
            'requester_duration_in_country' => 'nullable|string|max:100',
            'is_remote' => 'boolean',
            'language' => 'nullable|string|max:100',
            'spoken_languages' => 'nullable|array',
            'spoken_languages.*' => 'string|max:100',
            'urgency' => 'nullable|in:low,medium,high,urgent',
            'status' => 'sometimes|in:draft,published,cancelled',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'category_id.exists' => 'The selected category is invalid.',
            'title.max' => 'The title cannot exceed 255 characters.',
            'description.max' => 'The description cannot exceed 5000 characters.',
            'budget_max.gte' => 'Maximum budget must be greater than or equal to minimum budget.',
            'status.in' => 'Invalid status value.',
        ];
    }
}
