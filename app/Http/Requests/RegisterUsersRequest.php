<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUsersRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'              => ['required', 'string'],
            'email'             => ['required', 'email', 'unique:users,email'],
            'password'          => ['required', 'min:5', 'alpha_num'],
        ];
    }
    public function messages()
    {
        return [
            'name.required'              => 'Nama wajib diisi.',
            'email.required'             => 'E-mail wajib diisi.',
            'password.required'          => 'Password wajib diisi.',
            'name.string'                => 'Nama harus berisi string.',
            'email.email'                => 'Email yang dimasukkan harus email valid.',
            'password.min'               => 'Password minimal berisi 5 kata.',
            'email.unique'               => 'E-mail sudah digunakan.',
            'password.alpha_num'         => 'Password harus berisi alphabet dan angka.'
        ];
    }
}
