<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest
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
            'title'         => ['required', 'string'],
            'description'   => ['required', 'string', 'min:10'],
            'tag'           => ['nullable', 'max:10']
        ];
    }

    public function messages()
    {
        return [
            'title.required'            => 'Title mohon diisi.',
            'description.required'      => 'Description mohon diisi.',
            'description.min'           => 'Description minimal berisi 10 kata.',
            'string'                    => 'Field harus berisikan string',
            'tag.max'                   => 'Tag maksimal berisi 10 kata.'
        ];
    }
}
