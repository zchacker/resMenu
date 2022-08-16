<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}"></script>
    <title>أسهل منصة توليد منيو باركود ذكي</title>
</head>

<body>
    <!-- Navbar goes here -->
    <nav class="bg-black shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <!-- Website Logo -->
                        <a href="{{ route('home' ) }}" class="flex items-center py-4 px-4">
                            <img src="{{asset('img/logo.png')}}" alt="Logo" class="h-12 w-auto ml-1">
                            <!-- <span class="font-semibold text-gray-500 text-lg">Navigation</span> -->
                        </a>
                    </div>
                    <!-- Primary Navbar items -->
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="{{route('home')}}" class="py-4 px-2 text-green-500 border-b-4 border-green-500 font-semibold ">الرئيسية</a>
                        <a href="{{route('home')}}#features" class="py-4 px-2 text-gray-300 font-semibold hover:text-green-500 transition duration-300">المميزات</a>
                        <a href="{{route('home')}}#menus" class="py-4 px-2 text-gray-300 font-semibold hover:text-green-500 transition duration-300">القوالب</a>
                        <a href="{{route('home')}}#prices" class="py-4 px-2 text-gray-300 font-semibold hover:text-green-500 transition duration-300">الأسعار</a>
                        <a href="{{route('home')}}#contact" class="py-4 px-2 text-gray-300 font-semibold hover:text-green-500 transition duration-300">اتصل بنا</a>
                    </div>
                </div>
                <!-- Secondary Navbar items -->
                <div class="hidden md:flex items-center space-x-3 ">
                    <a href="{{ route('login' , app()->getLocale() ) }}" class="py-2 px-2 font-medium text-gray-300 rounded  hover:text-white transition duration-300">دخول</a>
                    <a href="{{ route('register' , app()->getLocale() ) }}" class="py-2 px-5 font-medium text-black bg-yellow-500 rounded-full hover:bg-yellow-400 transition duration-300">انضم الان</a>
                </div>
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button class="outline-none mobile-menu-button">
                        <svg class=" w-6 h-6 text-gray-50 hover:text-green-500 " x-show="!showMenu" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- mobile menu -->
        <div class="hidden mobile-menu">
            <ul class="">
                <li class="active"><a href="{{route('home')}}" class="block text-sm px-2 py-4 text-white bg-green-500 font-semibold">الرئيسية</a></li>
                <li><a href="{{route('home')}}#features" class="block text-sm px-2 py-4 text-gray-300 hover:bg-green-500 transition duration-300">المميزات</a></li>
                <li><a href="{{route('home')}}#menus" class="block text-sm px-2 py-4 text-gray-300 hover:bg-green-500 transition duration-300">القوالب</a></li>
                <li><a href="{{route('home')}}#prices" class="block text-sm px-2 py-4 text-gray-300 hover:bg-green-500 transition duration-300">الاسعار</a></li>
                <li><a href="{{route('home')}}#contact" class="block text-sm px-2 py-4 text-gray-300 hover:bg-green-500 transition duration-300">اتصل بنا</a></li>
                <li><a href="{{ route('login' , app()->getLocale() ) }}" class="block text-sm px-2 py-4 text-gray-300 hover:bg-green-500 transition duration-300"> دخول </a></li>
                <li><a href="{{ route('register' , app()->getLocale() ) }}" class="block text-sm px-2 py-4 text-gray-800 font-bold bg-yellow-500 transition duration-300"> انضم الان </a></li>
            </ul>
        </div>
        <script>
            const btn = document.querySelector("button.mobile-menu-button");
            const menu = document.querySelector(".mobile-menu");

            btn.addEventListener("click", () => {
                menu.classList.toggle("hidden");
            });
        </script>
    </nav>