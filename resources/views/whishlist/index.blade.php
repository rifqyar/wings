<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Whishlist') }}
        </h2>
    </x-slot>

    @if(count($whishlists) > 0)
        @foreach ($whishlists as $whishlist)
            <div class="py-12 container max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-start flex-wrap" style="cursor: pointer;" onclick="detailProduct(`{{route('product.detail', ['id' => $whishlist->product_id])}}`)">
                <div class="w-full md:w-1/6 xl:w-1/6 flex flex-col bg-gray-200 dark:bg-gray-400 rounded-md m-5 hover:shadow-lg">
                    <img class="rounded-md" src="{{asset('assets/img/no-item.png')}}">
                </div>
                <div class="w-full md:w-1/6 xl:w-1/6 m-5 grow hover:shadow-lg">
                    <p class="text-xl text-gray-900 dark:text-gray-100">
                        {{$whishlist->product[0]->product_name}}
                    </p>
                    @if ($whishlist->product[0]->discount != 0)
                        <div class="flex flex-row items-center">
                            <p class="text-md text-red-500 mt-4 line-through">
                                {{$whishlist->product[0]->currency}} {{$whishlist->product[0]->price}}
                            </p>
                            <p class="text-md  text-gray-900 dark:text-gray-100 mt-4 ml-4"> {{$whishlist->product[0]->discount}}% Off</p>
                        </div>
                        <p class="text-lg text-gray-900 dark:text-gray-100 mt-2">
                            {{$whishlist->product[0]->currency}} {{discount($whishlist->product[0]->price, $whishlist->product[0]->discount)}}
                        </p>
                    @else
                        <p class="text-lg text-gray-900 dark:text-gray-100 mt-2">
                            {{$whishlist->product[0]->currency}} {{$whishlist->product[0]->price}}
                        </p>
                    @endif


                    <p class="text-md text-gray-900 dark:text-gray-100 mt-4">
                        Dimension : {{$whishlist->product[0]->dimension}}
                    </p>

                    <p class="text-md text-gray-900 dark:text-gray-100 mt-4">
                        Price unit : {{$whishlist->product[0]->unit}}
                    </p>

                    <a href="{{route('carts.store', ['id' => $whishlist->product[0]->id])}}">
                        <x-info-button class="mt-5">
                            {{ __('Add to Chart') }}
                        </x-info-button>
                    </a>

                    <a href="{{route('whishlist.remove', ['id' => $whishlist->product[0]->id])}}">
                        <x-danger-button class="mt-5 ml-3">
                            {{ __('Remove from Whishlist') }}
                        </x-danger-button>
                    </a>
                </div>
            </div>
        @endforeach
    @else
        <div class="py-12 container max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-start flex-wrap">
            <p class="text-lg text-red-500">
                Belum Ada Whishlist
            </p>
        </div>
    @endif

    <div id="pagination">
        {{ $whishlists->links('pagination::tailwind') }}
    </div>

    <script>
        $('#pagination').find('p').addClass("dark:text-gray-100 mr-3")
        function detailProduct(url){
            window.location.href = url
        }
    </script>
</x-app-layout>
