@include('client_dashboard.header')

<div class="content">

    <h2 class="text-2xl font-bold mb-4">{{__('orders')}}</h2>

    <div class="relative rounded-xl overflow-auto">
        <div class="overflow-x-auto relative">
            
            <table class="w-full text-sm text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-blue-200 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="py-3 px-6">{{__('order_no')}}</th>
                        <th scope="col" class="py-3 px-6">{{__('status')}}</th>
                        <th scope="col" class="py-3 px-6">{{__('payment_type')}}</th>
                        <th scope="col" class="py-3 px-6">{{__('date')}}</th>
                        <th scope="col" class="py-3 px-6">{{__('total_amount')}}</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800">
                    @foreach($orders as $order)
                        <tr>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400"> {{$order->id}} </td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400"> {{$order->status}} </td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400"> {{$order->payment_type}} </td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400"> {{$order->created_at}} </td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400"> {{$order->total_amount}} </td>
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

@include('client_dashboard.footer')