<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // ← falseからtrueに変更
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:50'],
            'kana' => ['required', 'regex:/^[ァ-ヴー・\s]+$/u', 'max:50'],
            'tel' => ['required', 'max:20', 'unique:customers,tel,' . $this->customer->id], // ← 自分のIDは除外
            'email' => ['required', 'email', 'max:255', 'unique:customers,email,' . $this->customer->id], // ← 自分のIDは除外
            'postcode' => ['required', 'max:7'],
            'address' => ['required', 'max:100'],
            'birthday' => ['nullable', 'date'],
            'gender' => ['required'],
            'memo' => ['nullable', 'max:1000'],
        ];
    }
}
