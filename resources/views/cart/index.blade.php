<x-app-layout>
    <div wire:loading class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-50 flex flex-col items-center justify-center" id="loading" style="display:none">
        <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4"></div>
        <h2 class="text-center text-white text-xl font-semibold">Loading...</h2>
    </div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    @if(count($carts) > 0)
        {{-- <form action="{{route('checkout')}}" method="post"> --}}
            @csrf
            @foreach ($carts as $cart)
                <div class="py-12 container max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-start flex-wrap product" id="{{$cart->id}}" data-price="{{discount($cart->product[0]->price, $cart->product[0]->discount)}}">
                    <input type="hidden" name="product_code" value="{{$cart->product[0]->product_code}}">
                    <input type="hidden" name="price" value="{{discount($cart->product[0]->price, $cart->product[0]->discount)}}">
                    <input type="hidden" name="unit" value="{{$cart->product[0]->unit}}">
                    <input type="hidden" name="currency" value="{{$cart->product[0]->currency}}">

                    <input type="checkbox" name="checklist" class="border-gray-300 dark:border-gray-200 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                    <div class="w-full md:w-1/6 xl:w-1/6 flex flex-col bg-gray-200 dark:bg-gray-400 rounded-md m-5 hover:shadow-lg" style="cursor: pointer;" onclick="detailProduct(`{{route('product.detail', ['id' => $cart->product_id])}}`)">
                        <img class="rounded-md" src="{{asset('assets/img/no-item.png')}}">
                    </div>
                    <div class="w-full md:w-1/6 xl:w-1/6 m-5 grow hover:shadow-lg">
                        <p class="text-xl text-gray-900 dark:text-gray-100" style="cursor: pointer;" onclick="detailProduct(`{{route('product.detail', ['id' => $cart->product_id])}}`)">
                            {{$cart->product[0]->product_name}}
                        </p>

                        <div class="flex items-center">
                            <input type="number" min="1" value="{{$cart->quantity}}" name="quantity" style="width: 4rem; height: 2rem" class="mt-4 border-gray-300 dark:border-gray-200 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                            <span class="text-gray-900 dark:text-gray-100 ml-3 mt-4">{{$cart->product[0]->unit}}</span>
                        </div>

                        <div class="flex items-center flex-wrap">
                            <p class="text-gray-900 dark:text-gray-100 mb-5">Sub Total : {{$cart->product[0]->currency}}</p>
                            <input type="number" min="1" readonly value="{{discount($cart->product[0]->price, $cart->product[0]->discount)}}" name="subtotal" id="subtotal-{{$cart->id}}" class="shadow-sm mb-5 text-gray-900 dark:text-gray-100" style="background-color: transparent !important; border:none !important">
                        </div>

                        <a href="{{route('carts.remove', ['id' => $cart->id])}}">
                            <x-danger-button class="mt-5">
                                {{ __('Remove from Cart') }}
                            </x-danger-button>
                        </a>
                    </div>
                </div>
            @endforeach
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center flex-wrap">
                    <div class="flex items-center flex-wrap">
                        <p class="text-gray-900 dark:text-gray-100 mb-5">Total Harga : </p>
                        <input type="number" min="1" readonly value="0" name="total" class="shadow-sm mb-4 text-gray-900 dark:text-gray-100" style="background-color: transparent !important; border:none !important">
                    </div>
                    <x-success-button class="mb-5 submit">
                        Checkout
                    </x-success-button>
                </div>
            </header>
        {{-- </form> --}}
    @else
        <div class="py-12 container max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-start flex-wrap">
            <p class="text-lg text-red-500">
                Belum Ada Whishlist
            </p>
        </div>
    @endif

    <script>
        $(document).ready(function(){
            $('#pagination').find('p').addClass("dark:text-gray-100 mr-3")
            function detailProduct(url){
                window.location.href = url
            }

            // Data Processing
            $('input[name="quantity"]').on('change', function(){
                let qty = $(this).val()
                const container = $(this).parentsUntil('.container').parent()[0]
                var price = $(container).data('price')
                const id = $(container).attr('id')
                var total = $('input[name="total"]').val()
                var newTotal
                price = qty * price

                if ($(container).find('input[name="checklist"]').is(':checked')){
                    let currSubTotal = $(`#subtotal-${id}`).val()
                    newTotal = parseInt(total) - parseInt(currSubTotal)
                    newTotal = parseInt(price) + parseInt(newTotal)
                    $('input[name="total"]').val(newTotal)
                }

                $(`#subtotal-${id}`).val(price)
            })

            $('input[name="checklist"]').on('change', function(){
                const container = $(this).parent()
                const id = $(container).attr('id')
                if($(this).is(':checked')){
                    var total = $('input[name="total"]').val()
                    let subtotal = $(`#subtotal-${id}`).val()

                    total = parseInt(subtotal) + parseInt(total)
                    $('input[name="total"]').val(total)
                } else {
                    var total = $('input[name="total"]').val()
                    let subtotal = $(`#subtotal-${id}`).val()

                    total =  parseInt(total) - parseInt(subtotal)
                    $('input[name="total"]').val(total)
                }
            })

            $('.submit').on('click', function(){
                var formData = new FormData()
                let container = $('.product')
                var valid = false

                for (let i = 0; i < container.length; i++) {
                    if ($(container[i]).find('input[name="checklist"]').is(':checked')){
                        valid = true
                    }
                }

                if(valid){
                    for (let i = 0; i < container.length; i++) {
                        if ($(container[i]).find('input[name="checklist"]').is(':checked')){
                            formData.append(`product_code[${i}]`, $('input[name="product_code"]')[i].value)
                            formData.append(`price[${i}]`, $('input[name="price"]')[i].value)
                            formData.append(`unit[${i}]`, $('input[name="unit"]')[i].value)
                            formData.append(`currency[${i}]`, $('input[name="currency"]')[i].value)
                            formData.append(`quantity[${i}]`, $('input[name="quantity"]')[i].value)
                            formData.append(`sub_total[${i}]`, $('input[name="subtotal"]')[i].value)
                        } else {
                            formData.append(`product_code[${i}]`, null)
                            formData.append(`price[${i}]`, null)
                            formData.append(`unit[${i}]`, null)
                            formData.append(`currency[${i}]`, null)
                            formData.append(`quantity[${i}]`, null)
                            formData.append(`sub_total[${i}]`, null)
                        }
                    }

                    formData.append('total', $('input[name="total"]').val())

                    $.ajax({
                        url: `{{route('checkout')}}`,
                        method: 'POST',
                        headers: {
                            "X-CSRF-TOKEN": $('input[name="_token"]').val(),
                        },
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: () => {
                            $('#loading').fadeIn()
                        }, success: (res) => {
                            if(res.status.code == 200){
                                Swal.fire({
                                    title: 'Nerhasil',
                                    text: 'Berhasil melakukan checkout',
                                    icon: 'success',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                })
                            }
                        }, error: (xhr, err) => {
                            Swal.fire({
                                title: `Terjadi Kesalahan (Error Code : ${xhr.status})`,
                                text: xhr.statusText,
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            })
                        }
                    })
                } else {
                    Swal.fire({
                        title: 'Tidak ada barang yang dipilih!',
                        text: 'Harap pilih setidaknya satu barang',
                        icon: 'error',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        confirmButtonText: 'Cool'
                    })
                }

                $('#loading').fadeOut()
            })
        })
    </script>
</x-app-layout>
