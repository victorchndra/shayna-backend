<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
        // sesuaikan dengan database (tabel transactions)
        return [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'number' => 'required|max:255',
            'address' => 'required',
            'transaction_total' => 'required|integer',
            'transaction_status' => 'nullable|string|in:PENDING,SUCCESS,FAILED',
            'transaction_details' => 'required|array', // penjelasan : detail ini nantinya akan mengambil smua id product berdasarkan id transaksi di transaction details
            'transaction_details.*' => 'integer|exists:products,id' // penjelasan : .* merupakan apapun isi dalam array. exists : rule dimana inputan (dlm kasus ini array) merupakan value yang terdapat dalam tabel products kolom id.
        ];
    }
}
