<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'contract_id' => 'required|exists:contracts,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'contract_id.required' => 'O campo contrato é obrigatório.',
            'contract_id.exists' => 'O contrato selecionado não existe.',
            'amount.required' => 'O campo valor é obrigatório.',
            'amount.numeric' => 'O valor deve ser um número.',
            'amount.min' => 'O valor deve ser pelo menos 0.',
            'payment_date.required' => 'A data de pagamento é obrigatória.',
            'payment_date.date' => 'A data de pagamento deve ser uma data válida.',
        ];
    }
}
