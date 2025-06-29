<?php
// app/Http/Requests/UpdateProfileRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Izinkan semua user yang sudah login untuk mengupdate profilnya
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'job' => ['required', 'string', 'max:255'],
            'monthly_income' => ['required', 'numeric', 'min:0'],
        ];
    }

    /**
     * Custom validation messages for a better user experience.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'job.required' => 'Pekerjaan wajib diisi.',
            'monthly_income.required' => 'Penghasilan bulanan wajib diisi.',
            'monthly_income.numeric' => 'Penghasilan harus berupa angka.',
        ];
    }
}