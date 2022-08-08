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
<body>
    <div class="md:w-3/4 text-center mx-auto">

        @if($result === 'success')
            <div class="h-auto w-full bg-green-300  mb-8 p-2">
                <h2 class="text-white font-bold text-2xl">تم الدفع بنجاح</h2>
                
            </div>
            <a href="{{route('menu', [$slug])}}" class="p-3 bg-blue-400 text-lg font-bold text-white my-8 rounded-md">الرجوع الى القائمة</a>
        @endif

        @if($result === 'error')
            <div class="h-auto w-full bg-red-400 mb-8 p-2">
                <h2 class="text-white font-bold text-2xl"> حدث خطأ ما الرجاء المحاولة لاحقا </h2>                
            </div>
            <a href="{{route('menu', [$slug])}}" class="p-3 bg-blue-400 text-lg font-bold text-white my-8 rounded-md">الرجوع الى القائمة</a>
        @endif
        
    </div>
</body>
</html>