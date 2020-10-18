<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'client_id' => ['required', 'uuid', 'exists:clients,id'],
            'value_freight' => ['required', 'numeric'],

            'products' => ['required', 'array'],

            'products.*.product_id' => ['required', 'uuid', 'exists:products,id'],
            'products.*.amount' => ['required', 'integer', 'min:1'],
            'products.*.value' => ['required', 'numeric'],

            'form_payment' => ['required', 'in:' . implode(',', Order::FORM_PAYMENT)],
            'form_delivery' => ['required', 'in:' . implode(',', Order::FORM_DELIVERY)],
        ];
    }
}
