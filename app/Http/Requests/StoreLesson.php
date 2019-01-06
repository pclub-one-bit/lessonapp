<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLesson extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject' => 'required|string|max:100',
            'lesson_datetime' => 'required|date',
            // 'total_participant' => 'required|integer|max:10',
            'total_revenue' => 'required|integer|max:999999999',
            'total_expense' => 'required|integer|max:999999999',
            'total_budget' => 'required|integer|max:999999999',
            'participants.*.name' => 'required|string|max:100',
            'participants.*.parent_name' => 'required|string|max:100',
            'revenues.*.item' => 'required|string|max:100',
            'revenues.*.amount' => 'required|integer|max:999999999',
            'expenses.*.item' => 'required|string|max:100',
            'expenses.*.amount' => 'required|integer|max:999999999',
        ];
    }
}
