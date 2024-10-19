<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContractRequest extends FormRequest
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
            'plan_id' => 'required|exists:plans,id',
        ];
    }

    public function messages()
    {
        return [
            'plan_id.required' => 'O campo plano é obrigatório.',
            'plan_id.exists' => 'O plano selecionado não existe.',
        ];
    }
}
