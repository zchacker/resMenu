@include('client_dashboard.header')

<!-- start of body  -->
<div class="content">
    <h2 class="text-2xl font-bold mb-4">{{__('statistics')}}</h2>
    <div class="cards grid grid-cols-1 lg:grid-col-3 md:grid-cols-3 gap-4 place-items-center lg:place-items-stretch h-auto w-full lg:w-[1050px] mx-auto my-6">

        <div class="grid grid-cols-2 place-items-center self-stretch p-2 w-full bg-gray-700 rounded-2xl border border-gray-100">
            <div class="grid place-items-center text-center p-6 max-w-xs rounded-lg ">
                <h2 class="text-lg font-bold text-gray-400">طلبات معلقة</h2>
                <p class="text-[30px] font-bold text-gray-50">1</p>
            </div>
            <div class="p-4 bg-green-50 rounded-md">
                <i class="las la-box la-4x text-green-400"></i>
            </div>
        </div>

        <div class="grid grid-cols-2 place-items-center self-stretch p-2 w-full bg-gray-700 rounded-2xl border border-gray-100">
            <div class="grid place-items-center text-center p-6 max-w-xs rounded-lg ">
                <h2 class="text-lg font-bold text-gray-400">عدد مرات مسح الباركود</h2>
                <p class="text-[30px] font-bold text-gray-50">1</p>
            </div>
            <div class="p-4 bg-red-200 rounded-md">
                <i class="las la-qrcode la-4x text-red-600"></i>
            </div>
        </div>

        <div class="grid grid-cols-2 place-items-center self-stretch p-2 w-full bg-gray-700 rounded-2xl border border-gray-100">
            <div class="grid place-items-center text-center p-6 max-w-xs rounded-lg ">
                <h2 class="text-lg font-bold text-gray-400">الفروع</h2>
                <p class="text-[30px] font-bold text-gray-50">1</p>
            </div>
            <div class="p-4 bg-purple-200 rounded-md">
                <i class="las la-store la-4x text-purple-600"></i>
            </div>
        </div>


    </div>
</div>
<!-- end of body  -->

@include('client_dashboard.footer')