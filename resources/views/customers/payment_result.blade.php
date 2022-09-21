<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>نتيجة الدفع</title>
</head>
<body class="bg-green-50">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    
    <div class="bg-white w-[350px] md:w-[500px] mx-auto mt-5 pb-8 items-center place-self-center shadow-lg shadow-gray-200 border border-gray-300 rounded-lg">
        <div class="w-[300px] lg:w-[400px] mx-auto text-center">
            @if($result === 'success')
                <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_5cl8ifa4.json"  background="transparent"  speed="1"  class="w-[300px] h-[300px] md:w-[400px] md:h-[400px]"    autoplay></lottie-player>
                <h1 class="text-2xl mb-4 text-black font-bold">شكرا لك</h1>
                <h3 class="text-gray-400 mb-6 "> تم استلام طلبك رقم <strong class="font-bold text-xl">( {{ $order_id }} )</strong> بنجاح, سيتم التواصل معك من طرف ادارة المطعم لتسليم الطلب. </h3>
                <div class="w-full h-[150px] grid grid-cols-1">
                    <a href="{{route('menu', [$slug])}}"              class="w-full p-2 items-center bg-transparent border border-green-400 text-green-400 hover:bg-green-400 hover:text-white text-xl font-bold my-2 rounded-full">  عودة للقائمة <i class="lar la-check-circle"></i> </a>
                    <a href="{{route('send.whatsapp', [$order_id])}}" class="w-full p-2 items-center bg-transparent border border-green-400 text-green-400 hover:bg-green-400 hover:text-white text-xl font-bold my-2 rounded-full" target="_blank">  ارسل الطلب للواتساب <i class="lab la-whatsapp"></i> </a>
                </div>
            @endif

            @if($result === 'error')
                <lottie-player src="https://assets7.lottiefiles.com/packages/lf20_skyzkvon.json"  background="transparent"  speed="1"  class="w-[300px] h-[300px] md:w-[400px] md:h-[400px]"    autoplay></lottie-player>
                <h1 class="text-2xl mb-4 text-black font-bold"> لم يكتمل الدفع بنجاح </h1>
                <h3 class="text-gray-400 mb-6 "> لقد فشلت عملية الدفع لطلبكم رقم ( {{ $order_id }} ) بإمكانك محاولة الدفع مجدداً </h3>
                <div class="w-full h-[150px]">                    
                    <a href="{{route('order.details', [$order_id])}}" class="w-full px-4 p-2 items-center bg-transparent border border-green-400 text-green-400 hover:bg-green-400 hover:text-white text-xl font-bold my-2 rounded-full">  الدفع مجددا <i class="lar la-credit-card"></i>  </a>
                </div>
            @endif
        </div>
    </div>

</body>
</html>