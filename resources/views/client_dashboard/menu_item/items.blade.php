@include('client_dashboard.header')

<div class="content">

    <h2 class="text-2xl font-bold mb-4"><a href="{{route('dashboard.categories')}}">{{__('items')}}</a><i class="las la-angle-double-left"></i>{{ $category->title_ar }}</h2>
    <a href="{{route('dashboard.items.add' , $category_id)}}" class="send_btn">{{__('add_item')}}</a>

    <div class="cards grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-4 gap-4 place-items-center lg:place-items-stretch h-auto w-full mx-auto my-6">
        @foreach($items as $item)
        <div class="block place-items-center self-stretch p-2 w-full bg-yellow-200 rounded-xl border border-gray-100">
            <a href="{{route( 'dashboard.items.edit', [$category_id , $item->id] )}}">
                <div class="grid place-items-center text-center mb-2  max-w-xs rounded-lg ">
                    <h2 class="text-[25px] font-bold text-gray-800">{{ $item->name }}</h2>
                </div>
                <div class="p-1 bg-green-50 rounded-md">
                    <img src="{{ route('image.displayImage', $item->file_name ) }}" class="w-full h-[250px] object-cover" alt="">
                </div>
                <div class="relative left-[-10px] bottom-8 bg-white w-3/12 p-2 rounded-md">
                    @if ($item->offer_price != NULL || $item->offer_price > 0)
                        <p class="text-lg font-bold">{{$item->offer_price}} SAR</p>
                        <p class="text-sm text-red-600 font-bold line-through">{{$item->price}} SAR</p>
                    @else
                        <p class="text-lg font-bold">{{$item->price}} SAR</p>
                    @endif
                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>

@include('client_dashboard.footer')