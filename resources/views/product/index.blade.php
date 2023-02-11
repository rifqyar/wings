<x-app-layout>
    <div class="py-12 container max-w-7xl mx-auto sm:px-6 lg:px-8 flex items-center justify-start flex-wrap">
        @foreach ($data as $dt)
            <div class="w-full md:w-1/6 xl:w-1/6 flex flex-col bg-gray-200 dark:bg-gray-400 rounded-md m-5 hover:grow hover:shadow-lg">
                <a href="{{route('product.detail', ['id' => $dt->id])}}">
                    <img class="rounded-md" src="{{asset('assets/img/no-item.png')}}">
                    <div class="pt-3 flex items-center justify-between px-3">
                        <p class="text-gray-900 dark:text-gray-100">
                            {{replaceProductName($dt->product_name)}}
                        </p>
                        @if (count($dt->whishlists) > 0)
                            @if ($dt->whishlists[0]->user_id == Auth::user()->id)
                                <a href="{{route('whishlist.remove', ['id' => $dt->id])}}">
                                    <svg class="h-6 w-6 fill-current text-red-500 hover:text-red-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M20.808,11.079C19.829,16.132,12,20.5,12,20.5s-7.829-4.368-8.808-9.421C2.227,6.1,5.066,3.5,8,3.5a4.444,4.444,0,0,1,4,2,4.444,4.444,0,0,1,4-2C18.934,3.5,21.773,6.1,20.808,11.079Z"/>
                                    </svg>
                                </a>
                            @else
                                <a href="{{route('whishlist.product', ['id' => $dt->id])}}">
                                    <svg class="h-6 w-6 fill-current text-gray-500 hover:text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z" />
                                    </svg>
                                </a>
                            @endif
                        @else
                            <a href="{{route('whishlist.product', ['id' => $dt->id])}}">
                                <svg class="h-6 w-6 fill-current text-gray-500 hover:text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z" />
                                </svg>
                            </a>
                        @endif
                    </div>
                    @if ($dt->discount != 0)
                        <div class="flex">
                            <p class="pt-1 line-through text-xs text-red-500 pl-3 pb-3">
                                {{$dt->currency}} {{$dt->price}}
                            </p>
                            <p class="text-gray-900 dark:text-gray-100 pb-3 pl-2">
                                {{$dt->currency}} {{discount($dt->price, $dt->discount)}}
                            </p>
                        </div>
                    @else
                        <p class="pt-1 text-gray-900 dark:text-gray-100 px-3 pb-3">
                            {{$dt->currency}} {{$dt->price}}
                        </p>
                    @endif
                </a>
            </div>
        @endforeach

        <div id="pagination">
            {{ $data->links('pagination::tailwind') }}
        </div>
    </div>

    <script>
        $('#pagination').find('p').addClass("dark:text-gray-100 mr-3")
    </script>
</x-app-layout>
