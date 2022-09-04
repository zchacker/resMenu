@include('client_dashboard.header')

<div class="content">

    <h2 class="text-2xl font-bold mb-4">{{__('orders')}}</h2>

    <div class="relative rounded-tl-xl  rounded-tr-xl overflow-auto">
        <div class="overflow-x-auto relative">
            
            <table class="w-full text-sm text-right text-gray-500">
                <thead class="text-xs text-gray-50 uppercase bg-blue-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">{{__('order_no')}}</th>
                        <th scope="col" class="py-3 px-6">{{__('status')}}</th>
                        <th scope="col" class="py-3 px-6">{{__('payment_type')}}</th>
                        <th scope="col" class="py-3 px-6">{{__('date')}}</th>
                        <th scope="col" class="py-3 px-6">{{__('total_amount')}}</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-50">
                    @foreach($orders as $order)
                        <tr data-href="{{ route('dashboard.orders.details' , $order->id ) }}" class="clickable-row cursor-pointer hover:bg-gray-200">
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400"> {{$order->id}} </td>
                            
                            @switch($order->status)
                                @case(1)
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-red-700 font-bold">   {{ __('holding') }} </td>
                                    @break
                                @case(2)
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-orange-500 font-bold"> {{ __('pending') }} </td>
                                    @break
                                @case(3)
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-green-600 font-bold"> {{ __('completed') }} </td>
                                    @break
                                @default
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 font-bold"> {{ __('uncomplete') }} </td>
                            @endswitch
                            
                            @switch($order->payment_type)
                                @case('cash')
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 "> {{ __('cash') }} </td>
                                    @break
                                @case('credit')
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 "> {{ __('credit') }} </td>
                                    @break
                                @default
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 "> {{ __('cash') }} </td>
                            @endswitch
                            
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 "> {{$order->created_at}} </td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 "> {{$order->total_amount}} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>        
    </div>

    <div class="text-left mt-10" dir="rtl">
        {{ $orders->onEachSide(5)->links('pagination::tailwind') }}
    </div>

</div>


<script>
    $(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>
@include('client_dashboard.footer')