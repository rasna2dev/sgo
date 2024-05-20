<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuariosRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $params = [
            'nome' => 'required|min:3|max:255',
            'uf' => 'required|min:2|max:2',
            'telefone' => 'required|regex:/^\+(?:[0-9] ?){6,14}[0-9]$/|max:20'
        ];

        if ($this->method() === 'PUT') {
            $params['email'] = 'required|email|max:255|unique:Usuarios,email,'.$this->route('usuario');
            $params['senha'] = [
                'nullable'
                ,'min:6'
                ,function ($attribute, $value, $fail) {
                    if (!empty($this->input('senha')) && $this->input('senha') !== $this->input('resenha')) {
                        $fail('As senhas não coincidem.');
                    }
                }
            ];
            $params['resenha'] = [
                'required_if:senha,!='
            ];
        } else {
            $params['email'] = "required|email|max:255|unique:Usuarios,email";
            $params['senha'] = [
                'required'
                ,'min:2'
                ,'max:64'
                ,function ($attribute, $value, $fail) {
                    if (!empty($this->input('senha')) && $this->input('senha') !== $this->input('resenha')) {
                        $fail('As senhas não coincidem.');
                    }
                }
            ];
            $params['resenha'] = [
                'required_if:senha,!='
            ];
        }

        return $params;
    }

    public function messages()
    {
        return [
            'nome.required' => 'Informe um nome para o usuário.'
            ,'nome.min' => 'O nome deve ter ao menos 3 caracteres.'
            ,'nome.max' => 'O nome deve ter no máximo 255 caracteres.'
            ,'nome.required' => 'Informe um e-mail válido.'
            ,'email.email' => 'Informe um e-mail válido.'
            ,'email.max' => 'O e-mail deve ter no máximo 255 caracteres.'
            ,'email.unique' => 'O e-mail já foi utilizado.'
            ,'uf.required' => 'Informe um Estado para o usuário.'
            ,'uf.min' => 'O estado deve ter 2 caracteres.'
            ,'uf.max' => 'O estado deve ter 2 caracteres.'
            ,'telefone.required' => 'Informe um telefone para o usuário.'
            ,'telefone.regex' => 'O formato do telefone deve ser +5599987654321.'
            ,'telefone.max' => 'O telefone deve ter no máximo 20 caracteres.'
            ,'senha.required' => 'Informe uma senha para o usuário.'
            ,'senha.min' => 'A senha deve ter ao menos 6 caracteres.'
            ,'senha.max' => 'A senha deve ter no máximo 64 caracteres.'
            ,'senha.confirmed' => 'O campo de confirmação da senha não corresponde.'
            ,'resenha.required_if' => 'O campo resenha é obrigatório quando a senha é preenchida.'
        ];
    }
}
