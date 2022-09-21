@include('client_dashboard.header')

<div class="content">
    <h1 class="text-4xl font-bold text-black mb-5">{{__('order_details')}}</h1>
    <!-- customer info  -->
    <div class="md:flex gap-3">
        <div class="rounded-md border border-gray-300 w-full md:w-1/2  h-[170px] mt-2 md:mt-0 py-4 px-6">
            <h2 class="text-xl font-bold text-black"> {{ __('customer_details') }} </h2>
            <div class="border-b border-gray-100 my-2"></div>
            <p class="mt-3"><strong>{{ __('name')  }}</strong>: {{$customer->name}}</p>
            <p class="mt-3"><strong>{{ __('phone') }}</strong>: {{$customer->phone}}</p>
            <p class="mt-3"><strong>{{ __('email') }}</strong>: {{$customer->email}}</p>
        </div>
        <div class="rounded-md border border-gray-200 md:w-1/2 w-full h-[170px] mt-6 md:mt-0 py-4 px-6">
            <h2 class="text-xl font-bold text-black"> {{ __('order_data') }} </h2>
            <div class="border-b border-gray-100 my-2"></div>
            @switch($order->status)
                @case(1)
                    <p><strong>{{__('order_status')}}: </strong> <span class="bg-red-700 text-white text-sm px-5 py-1 rounded-md font-bold">{{ __('holding') }}</span> </p>
                    @break
                @case(2)
                    <p> <strong>{{__('order_status')}}: </strong> <span class="bg-orange-500 text-white text-sm px-5 py-1 rounded-md font-bold">{{ __('pending') }}</span> </p>
                    @break
                @case(3)
                    <p> <strong>{{__('order_status')}}: </strong> <span class="bg-green-600 text-white text-sm px-5 py-1 rounded-md font-bold">{{ __('completed') }}</span></p>
                    @break
                @case(4)
                    <p> <strong>{{__('order_status')}}: </strong> <span class="bg-red-700 text-white text-sm px-5 py-1 rounded-md font-bold">{{ __('canceled') }}</span> </p>
                    @break
                @default
                    <p> <strong>{{__('order_status')}}: </strong> <span class="bg-slate-500 text-white text-sm px-5 py-1 rounded-md font-bold">{{ __('uncomplete') }}</span> </p>
            @endswitch            
            <p class="mt-3"><strong>{{__('order_amount')}}: </strong> {{ $order->total_amount }}</p>
            <p class="mt-3"><strong>{{__('payment_type')}}: </strong> {{ $order->payment_type }}</p>
        </div>
    </div>

    <div class="rounded-md border border-gray-200 w-full h-auto pt-2 pb-0 px-2 mt-6">
        <h2 class="text-xl font-bold text-black"> {{ __('categories') }} </h2>
        <div class="border-b border-gray-100 my-2"></div>
        @foreach($order_items as $item)
            @php 

                $price = $item->price;
                
                if($item->offer_price != NULL || $item->offer_price > 0)
                {
                    $price = $item->offer_price;
                }

                $total = $item->price * $item->quantity;

            @endphp
            <div class="grid grid-cols-4 justify-items-stretch text-center w-full gap-1 my-3 last:mb-0 pb-2 last:border-0 border-b border-gray-100">
                <img class="w-[70px] h-[70px] rounded-md" src="{{ route('image.displayImage', $item->file_name ) }}" alt="">
                <p class="font-bold justify-self-start">{{$item->name}}</p>
                <p class="justify-self-start">({{$price}} * {{$item->quantity}})</p>
                <p class="justify-self-center">{{$total}}</p>
            </div>
        @endforeach
    </div>

</div>

@include('client_dashboard.footer')