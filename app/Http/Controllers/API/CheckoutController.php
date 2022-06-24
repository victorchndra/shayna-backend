<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CheckoutRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(CheckoutRequest $request)
    {
        // except ni digunakan sbg pengecualian, transaction_details ada di rules CheckOutRequest juga. tujuan pakai except ini agar nntinya akan diinput secara terpisah.
        $data = $request->except('transaction_details');
        $data['uuid'] = 'TRX' . mt_rand(10000, 999999) . mt_rand(100, 999);

        $transaction = Transaction::create($data);

        // krn yg direturn adalah array, maka kita mau insert masing" value array ke dalam transaction_details dengan id transactions yang baru dibuat (stiap looping, id transaksinya sama semua sesuai dgn yg barusan dibuat)
        foreach($request->transaction_details as $product)
        {
            $details[] = new TransactionDetail([
                'transactions_id' => $transaction->id,
                'products_id' => $product,
            ]);

            // kurangi stok di tabel products. inget $product returnnya angka sesuai dgn id product
            // atau kurangi setiap quantity di product dgn id product yg berlaku
            Product::find($product)->decrement('quantity');
        }

        // Yang tadi itu belum create btw, cm masukin ke dalam variabel array details.
        // jadi yg kutangkap, saveMany digunakan utk save byk data lgsg dgn syarat menggunakan array.
        // transaction memanggil relasi detail, dimana detail ini akan create byk data TransactionDetail ke dalam tabel tsb
        // atau bahasa lainnya menyimpan data relasi dari tabel transaksi, sipp. bisa cara lain jg btw
        $transaction->details()->saveMany($details);

        return ResponseFormatter::success($transaction);
    }
}
