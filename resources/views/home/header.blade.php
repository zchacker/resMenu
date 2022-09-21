<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}?v=2">
    <script src="{{asset('js/app.js')}}"></script>
    <title>أسهل منصة توليد منيو باركود ذكي</title>
</head>

<body>
    <!-- Navbar goes here -->
    <nav class="bg-white block shadow-lg transition-all duration-500 ">
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
                        <a href="{{route('home')}}/#head" class="scrollTo py-4 px-2 text-black hover:text-red-500 font-semibold ">الرئيسية</a>
                        <a href="{{route('home')}}/#features" class="scrollTo py-4 px-2 text-black font-semibold hover:text-red-500 transition duration-300">المميزات</a>
                        <!-- <a href="{{route('home')}}/#menus" class="scrollTo py-4 px-2 text-black font-semibold hover:text-red-500 transition duration-300">القوالب</a> -->
                        <a href="{{route('home')}}/#prices" class="scrollTo py-4 px-2 text-black font-semibold hover:text-red-500 transition duration-300">الأسعار</a>
                        <a href="{{route('home')}}/#contact" class="scrollTo py-4 px-2 text-black font-semibold hover:text-red-500 transition duration-300">اتصل بنا</a>
                    </div>
                </div>
                <!-- Secondary Navbar items -->
                <div class="hidden md:flex items-center space-x-3 ">
                    <a href="{{ route('login' , app()->getLocale() ) }}" class="py-2 px-2 font-medium text-green-800 rounded  hover:text-red-800 transition duration-300">دخول</a>
                    <a href="{{ route('register.user' , app()->getLocale() ) }}" class="call_to_action">انضم الان</a>
                </div>
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button class="outline-none mobile-menu-button">
                        <svg class="w-9 h-9 text-black hover:text-orange-500 text-3xl" x-show="!showMenu" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- mobile menu -->
        <div class="hidden mobile-menu">
            <ul class="px-5">
                <li class="active"><a href="{{route('home')}}/#head" class="scrollTo block text-md px-2 py-4 text-black hover:bg-yellow-300 font-semibold">الرئيسية</a></li>
                <li><a href="{{route('home')}}/#features" class="scrollTo block text-md px-2 py-4 text-black hover:bg-yellow-300 transition duration-300">المميزات</a></li>
                <!-- <li><a href="{{route('home')}}/#menus" class="scrollTo block text-md px-2 py-4 text-black hover:bg-yellow-300 transition duration-300">القوالب</a></li> -->
                <li><a href="{{route('home')}}/#prices" class="scrollTo block text-md px-2 py-4 text-black hover:bg-yellow-300 transition duration-300">الاسعار</a></li>
                <li><a href="{{route('home')}}/#contact" class="scrollTo block text-md px-2 py-4 text-black hover:bg-yellow-300 transition duration-300">اتصل بنا</a></li>
                <li><a href="{{ route('login' , app()->getLocale() ) }}" class="block text-md px-2 py-4 text-black hover:bg-yellow-300 transition duration-300"> دخول </a></li>
                <li><a href="{{ route('register.user' , app()->getLocale() ) }}" class="block call_to_action my-5  mb-8"> انضم الان </a></li>
            </ul>
        </div>
        <script>
            const btn = document.querySelector("button.mobile-menu-button");
            const menu = document.querySelector(".mobile-menu");

            btn.addEventListener("click", () => {
                menu.classList.toggle("hidden");
            });

            /*-- Scroll Up/Down add class --*/
            /*var lastScrollTop = 0;
            $(window).scroll(function(event) {
                var st = $(this).scrollTop();
                console.log('rs: ' , st);
                console.log('lastScrollTop: ' , lastScrollTop);
                if (st > lastScrollTop) {
                    //âíèç
                    $('nav').addClass('fix_menue');
                    //$('nav').removeClass('fix_menue');
                } else {
                    // ââåðõ 
                    //$('nav').addClass('fix_menue');
                    $('nav').removeClass('fix_menue');
                }
                lastScrollTop = st;
            });*/

            $(document).ready(function(){
                $(window).bind('scroll', function() {
                    var navHeight = $( window ).height() - 500;                    
                    if ($(window).scrollTop() > navHeight) {
                        $('nav').addClass('fix_menue');
                        $('nav').removeClass('-top-[10%]');
                    }
                    else {
                        $('nav').removeClass('fix_menue');
                        $('nav').addClass('-top-[10%]');
                    }
                });
            });
        </script>
    </nav>

    