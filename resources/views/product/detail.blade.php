<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Detail') }}
        </h2>
    </x-slot>

    <div class="py-12 container max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-start flex-wrap">
        <div class="w-full md:w-1/4 xl:w-1/4 flex flex-col bg-gray-200 dark:bg-gray-400 rounded-md m-5 hover:shadow-lg">
            <img class="rounded-md" src="{{asset('assets/img/no-item.png')}}">
        </div>
        <div class="w-full md:w-1/4 xl:w-1/8 m-5 grow hover:shadow-lg">
            <p class="text-xl text-gray-900 dark:text-gray-100">
                {{$product->product_name}}
            </p>
            @if ($product->discount != 0)
                <div class="flex flex-row items-center">
                    <p class="text-md text-red-500 mt-4 line-through">
                        {{$product->currency}} {{$product->price}}
                    </p>
                    <p class="text-md  text-gray-900 dark:text-gray-100 mt-4 ml-4"> {{$product->discount}}% Off</p>
                </div>
                <p class="text-lg text-gray-900 dark:text-gray-100 mt-2">
                    {{$product->currency}} {{discount($product->price, $product->discount)}}
                </p>
            @else
                <p class="text-lg text-gray-900 dark:text-gray-100 mt-2">
                    {{$product->currency}} {{$product->price}}
                </p>
            @endif


            <p class="text-md text-gray-900 dark:text-gray-100 mt-4">
                Dimension : {{$product->dimension}}
            </p>

            <p class="text-md text-gray-900 dark:text-gray-100 mt-4">
                Price unit : {{$product->unit}}
            </p>

            <a href="{{route('carts.store', ['id' => $product->id])}}">
                <x-info-button class="mt-5">
                    {{ __('Add to Chart') }}
                </x-info-button>
            </a>

            @if(count($product->whishlists) > 0)
                @if ($product->whishlists[0]->user_id == Auth::user()->id)
                    <a href="{{route('whishlist.remove', ['id' => $product->id])}}">
                        <x-danger-button class="mt-5">
                            {{ __('Remove from Whishlist') }}
                        </x-danger-button>
                    </a>
                @else
                    <a href="{{route('whishlist.product', ['id' => $product->id])}}">
                        <x-success-button class="mt-5">
                            {{ __('Add to Whishlist') }}
                        </x-success-button>
                    </a>
                @endif
            @else
                <a href="{{route('whishlist.product', ['id' => $product->id])}}">
                    <x-success-button class="mt-5">
                        {{ __('Add to Whishlist') }}
                    </x-success-button>
                </a>
            @endif
        </div>
    </div>
</x-app-layout>
