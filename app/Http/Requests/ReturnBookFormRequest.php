<?php

namespace App\Http\Requests;

use App\Models\BorrowRecord;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReturnBookFormRequest extends FormRequest
{
    protected $borrowRecord;

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
    public function rules()
    {
        return [
            'due_date' => 'nullable|date',
        ];
    }

    protected function prepareForValidation()
    {
        $this->borrowRecord = BorrowRecord::findOrFail($this->route('id'));
    }


    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->due_date && $this->due_date < $this->borrowRecord->borrowed_at) {
                $validator->errors()->add('due_date', 'due date cannot be before borrow date.');
            }
        });
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ], 422));
    }
}
