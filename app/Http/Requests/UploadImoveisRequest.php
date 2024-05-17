<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImoveisRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'arquivo' => 'required|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'arquivo.required' => 'Por favor, selecione um arquivo CSV.',
            'arquivo.file' => 'O arquivo enviado não é válido.',
            'arquivo.mimes' => 'O arquivo deve ser um arquivo CSV.',
            'arquivo.max' => 'O arquivo deve ter no máximo 2MB.',
        ];
    }
}
