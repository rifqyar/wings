<?php

use App\Models\Carts;
use App\Models\Whishlists;

function replaceProductName($string){
    if (strlen($string) > 15){
        return substr_replace($string,'...',15);
    } else {
        return $string;
    }
}

function discount($price, $discount){
    $newPrice = $price - ($price * $discount/100);
    return $newPrice;
}

function getCart($user){
    $cart = Carts::where('user_id', $user)->count();
    return $cart;
}

function getWhishlist($user){
    $whishlist = Whishlists::where('user_id', $user)->count();
    return $whishlist;
}

function autoNumber($lastId = '', $kodeLength = 0, $numberLength = 0){

    $code = substr($lastId, 0, $kodeLength);
    $number = substr($lastId, $kodeLength, $numberLength);
    $newNumber = str_repeat("0", $numberLength - strlen($number+1)).($number+1);

    // menggabungkan kode dengan nilang angka baru
    $newId = $code.$newNumber;

    return $newId;
}

function rupiah($n){
    $rp = "Rp " . number_format($n,0,'','.');
	return $rp;
}
?>
