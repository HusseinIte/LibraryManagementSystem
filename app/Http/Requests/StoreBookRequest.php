<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBookRequest extends FormRequest
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
            'title' => 'required',
            'author' => 'required|min:3|max:25',
            'description' => 'required',
            'published_at' => 'required|date',
            'category_id' => 'required|int'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'اسم الكتاب',
            'author' => 'اسم المؤلف',
            'description' => 'وصف الكتاب',
            'published_at' => 'تاريخ النشر',
            'category_id' => 'رقم الصنف'
        ];
    }

    public function messages()
    {
        return [
            'required' => ' :attribute مطلوب'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ], 422));
    }
}
