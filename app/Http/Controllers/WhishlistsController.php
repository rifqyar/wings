<?php

namespace App\Http\Controllers;

use App\Models\Whishlists;
use App\Http\Requests\StoreWhishlistsRequest;
use App\Http\Requests\UpdateWhishlistsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhishlistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $whishlists = Whishlists::where('user_id', Auth::user()->id)->with('product')->paginate(5);
        return view('whishlist.index', compact('whishlists'));
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
     * @param  \App\Http\Requests\StoreWhishlistsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $user_id = Auth::user()->id;
        Whishlists::create([
            'user_id' => $user_id,
            'product_id' => $id,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Whishlists  $whishlists
     * @return \Illuminate\Http\Response
     */
    public function show(Whishlists $whishlists)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Whishlists  $whishlists
     * @return \Illuminate\Http\Response
     */
    public function edit(Whishlists $whishlists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWhishlistsRequest  $request
     * @param  \App\Models\Whishlists  $whishlists
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWhishlistsRequest $request, Whishlists $whishlists)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Whishlists  $whishlists
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        Whishlists::where('product_id', $id)->where('user_id', $user_id)->delete();

        return back();
    }
}
