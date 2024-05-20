<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegraRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'valor_prazo' => ['required', 'numeric','regex:/^\d+(\.\d{1,2})?$/'],
            'valor_inicial' => ['required', 'numeric','regex:/^\d+(\.\d{1,2})?$/', 'lt:valor_final'],
            'valor_final' => ['required', 'numeric','regex:/^\d+(\.\d{1,2})?$/'],
            'valor_desconto' => ['required', 'numeric','regex:/^\d+(\.\d{1,2})?$/'],
            'valor_condominio' => ['required', 'numeric','regex:/^\d+(\.\d{1,2})?$/'],
            'valor_iptu' => ['required', 'numeric','regex:/^\d+(\.\d{1,2})?$/'],
            'valor_prestacao_financiamento' => ['required', 'numeric','regex:/^\d+(\.\d{1,2})?$/'],
            'valor_entrada' => ['required', 'numeric','regex:/^\d+(\.\d{1,2})?$/'],
            'valor_documentacao' => ['required', 'numeric','regex:/^\d+(\.\d{1,2})?$/'],
            'valor_desocupacao' => ['required', 'numeric','regex:/^\d+(\.\d{1,2})?$/'],
            'valor_reforma' => ['required', 'numeric','regex:/^\d+(\.\d{1,2})?$/'],
            'valor_despesa_venda' => ['required', 'numeric','regex:/^\d+(\.\d{1,2})?$/'],
            'valor_despesa_extra' => ['required', 'numeric','regex:/^\d+(\.\d{1,2})?$/'],
        ];
    }

    public function messages()
    {
        return [
            'valor_prazo.required' => 'O campo valor prazo é obrigatório.',
            'valor_prazo.numeric' => 'O campo valor prazo deve ser numérico.',
            'valor_prazo.regex' => 'O campo valor prazo deve ser um valor de ponto flutuante.',
            'valor_inicial.required' => 'O campo valor inicial é obrigatório.',
            'valor_inicial.numeric' => 'O campo valor inicial deve ser numérico.',
            'valor_inicial.regex' => 'O campo valor inicial deve ser um valor de ponto flutuante.',
            'valor_inicial.lt' => 'A campo valor inicial deve ser menor que valor final',
            'valor_final.required' => 'O campo valor final é obrigatório.',
            'valor_final.numeric' => 'O campo valor final deve ser numérico.',
            'valor_final.regex' => 'O campo valor final deve ser um valor de ponto flutuante.',
            'valor_final.lt' => 'O campo valor final deve ser menor que o campo valor inicial.',
            'valor_desconto.required' => 'O campo valor desconto é obrigatório.',
            'valor_desconto.numeric' => 'O campo valor desconto deve ser numérico.',
            'valor_desconto.regex' => 'O campo valor desconto deve ser um valor de ponto flutuante.',
            'valor_iptu.required' => 'O campo valor iptu é obrigatório.',
            'valor_iptu.numeric' => 'O campo valor iptu deve ser numérico.',
            'valor_iptu.regex' => 'O campo valor iptu deve ser um valor de ponto flutuante.',
            'valor_prestacao_financiamento.required' => 'O campo valor prestação financiamento é obrigatório.',
            'valor_prestacao_financiamento.numeric' => 'O campo valor prestação financiamento deve ser numérico.',
            'valor_prestacao_financiamento.regex' => 'O campo valor prestação financiamento deve ser um valor de ponto flutuante.',
            'valor_condominio.required' => 'O campo valor condomínio é obrigatório.',
            'valor_condominio.numeric' => 'O campo valor condomínio deve ser numérico.',
            'valor_condominio.regex' => 'O campo valor condomínio deve ser um valor de ponto flutuante.',
            'valor_entrada.required' => 'O campo valor entrada é obrigatório.',
            'valor_entrada.numeric' => 'O campo valor entrada deve ser numérico.',
            'valor_entrada.regex' => 'O campo valor entrada deve ser um valor de ponto flutuante.',
            'valor_documentacao.required' => 'O campo valor documentação é obrigatório.',
            'valor_documentacao.numeric' => 'O campo valor documentação deve ser numérico.',
            'valor_documentacao.regex' => 'O campo valor documentação deve ser um valor de ponto flutuante.',
            'valor_desocupacao.required' => 'O campo valor desocupação é obrigatório.',
            'valor_desocupacao.numeric' => 'O campo valor desocupação deve ser numérico.',
            'valor_desocupacao.regex' => 'O campo valor desocupação deve ser um valor de ponto flutuante.',
            'valor_reforma.required' => 'O campo valor reforma é obrigatório.',
            'valor_reforma.numeric' => 'O campo valor reforma deve ser numérico.',
            'valor_reforma.regex' => 'O campo valor reforma deve ser um valor de ponto flutuante.',
            'valor_despesa_venda.required' => 'O campo valor despesa venda é obrigatório.',
            'valor_despesa_venda.numeric' => 'O campo valor despesa venda deve ser numérico.',
            'valor_despesa_venda.regex' => 'O campo valor despesa venda deve ser um valor de ponto flutuante.',
            'valor_despesa_extra.required' => 'O campo valor despesa extra é obrigatório.',
            'valor_despesa_extra.numeric' => 'O campo valor despesa extra deve ser numérico.',
            'valor_despesa_extra.regex' => 'O campo valor despesa extra deve ser um valor de ponto flutuante.',
        ];
    }

}
