<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetails;
use App\Http\Requests\StoreTransactionDetailsRequest;
use App\Http\Requests\UpdateTransactionDetailsRequest;
use Illuminate\Http\Request;

class TransactionDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionDetailsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $documentCode, $documentNumber, $headerId)
    {
        if(count($request->product_code) > 0){
            $postData = [];
            for($i = 0; $i < count($request->product_code); $i++){
                if ($request->product_code[$i] != 'null'){
                    $data = [
                        'header_id' => $headerId,
                        'document_code' => $documentCode,
                        'document_number' => $documentNumber,
                        'product_code' => $request->product_code[$i],
                        'price' => $request->price[$i],
                        'quantity' => $request->quantity[$i],
                        'unit' => $request->unit[$i],
                        'sub_total' => $request->sub_total[$i],
                        'currency' => $request->currency[$i],
                    ];
                    array_push($postData, $data);
                }
            }
            try {
                TransactionDetails::insert($postData);

                return response()->json([
                    'status' => [
                        'code' => 200,
                        'msg' => 'OK'
                    ], 'detail' => 'data detail berhasil disimpan'
                ],200);
            } catch (\Throwable $e){
                return response()->json([
                    'status' => [
                        'code' => 500,
                        'msg' => 'Terjadi Kesalahan saat melakukan transaksi'
                    ], 'detail' => $e
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionDetails  $transactionDetails
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionDetails $transactionDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionDetails  $transactionDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionDetails $transactionDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionDetailsRequest  $request
     * @param  \App\Models\TransactionDetails  $transactionDetails
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionDetailsRequest $request, TransactionDetails $transactionDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionDetails  $transactionDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionDetails $transactionDetails)
    {
        //
    }
}
