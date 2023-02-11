<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Http\Requests\StoreTransactionsRequest;
use App\Http\Requests\UpdateTransactionsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transactions::with('details.product')->with('users')->get();
        $pdf = PDF::loadView('report', compact('data'))->setPaper('a4', 'landscape');
        return $pdf->download('laporan penjualan.pdf');
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
     * @param  \App\Http\Requests\StoreTransactionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lastData = Transactions::orderBy('id', 'desc')->first();
        $trxNumber = '';
        if ($lastData == null){
            $trxNumber = '0001';
        } else {
            $trxNumber = autoNumber($lastData->document_number, 0, 4);
        }

        $dataHeader = [
            'document_code' => 'TRX',
            'document_number' => $trxNumber,
            'user' => Auth::user()->id,
            'total' => $request->total,
            'date' => date('Y-m-d'),
        ];
        try {
            $trxHeader = Transactions::create($dataHeader);
            $detail = (new TransactionDetailsController)->store($request, 'TRX', $trxNumber, $trxHeader->id);

            if($detail->original['status']['code'] != 200){
                self::destroy($trxHeader->id);
            }

            return response()->json($detail->original, $detail->original['status']['code']);
        } catch (\Exception $e){
            return response()->json([
                'status' => [
                    'code' => 400,
                    'msg' => 'Terjadi Kesalahan saat melakukan transaksi',
                ], 'detail' => $e
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show(Transactions $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function edit(Transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionsRequest  $request
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionsRequest $request, Transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transactions::where('id', $id)->delete();
    }
}
