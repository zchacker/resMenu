<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>welcome</title>
</head>

<body>
    <!-- Navbar goes here -->
    <nav class="bg-black shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <!-- Website Logo -->
                        <a href="#" class="flex items-center py-4 px-4">
                            <img src="{{asset('img/logo.png')}}" alt="Logo" class="h-12 w-auto ml-1">
                            <!-- <span class="font-semibold text-gray-500 text-lg">Navigation</span> -->
                        </a>
                    </div>
                    <!-- Primary Navbar items -->
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="" class="py-4 px-2 text-green-500 border-b-4 border-green-500 font-semibold ">من نحن</a>
                        <a href="" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">المميزات</a>
                        <a href="" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">القوالب</a>
                        <a href="" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">الأسعار</a>
                        <a href="" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">اتصل بنا</a>
                    </div>
                </div>
                <!-- Secondary Navbar items -->
                <div class="hidden md:flex items-center space-x-3 ">
                    <a href="" class="py-2 px-2 font-medium text-gray-300 rounded  hover:text-white transition duration-300">دخول</a>
                    <a href="" class="py-2 px-5 font-medium text-black bg-yellow-500 rounded-full hover:bg-yellow-400 transition duration-300">انضم الان</a>
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
                <li class="active"><a href="index.html" class="block text-sm px-2 py-4 text-white bg-green-500 font-semibold">Home</a></li>
                <li><a href="#services" class="block text-sm px-2 py-4 text-gray-300 hover:bg-green-500 transition duration-300">Services</a></li>
                <li><a href="#about" class="block text-sm px-2 py-4 text-gray-300 hover:bg-green-500 transition duration-300">About</a></li>
                <li><a href="#contact" class="block text-sm px-2 py-4 text-gray-300 hover:bg-green-500 transition duration-300">Contact Us</a></li>
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



    <section class="h-[600px] bg-black dark:bg-black mt-[0px] opacity-[0.95] p-0 w-full mb-[0px] relative justify-center">
        <video autoplay loop muted plays-inline class="absolute object-cover opacity-50 right-0 left-0 top-auto -z-10 w-full h-full">
            <source src="{{asset('video/intro.mp4')}}" type="video/mp4" />
        </video>
        <img src="{{asset('img/header.jpeg')}}" alt="" class="absolute object-cover opacity-0 right-0 left-0 top-auto -z-10 w-full h-full">
        <div class="absolute mx-4 lg:mx-0 top-[10%] lg:top-[40%] right-[0%] lg:right-[50%]">
            <h1 class="relative self-start align-bottom  text-white p-0 text-right text-[45px]">أسهل وأوفر طريقة لعمل منيو الكتروني مع باركود</h1>
            <a href="" class="relative top-6 mt-4 py-2 px-5 font-medium text-black bg-yellow-500 rounded-full hover:bg-yellow-400 transition duration-300">انضم الان</a>
        </div>
    </section>

    <section title="page header" class="w-full min-h-[400px] px-[10%] py-[5%] bg-white">
        <h3 class="text-black self-center text-center text-[2.5rem] font-bold mb-6">لماذا نحن</h3>
        <div class="cards grid grid-cols-1 lg:grid-col-3 md:grid-cols-3 gap-4 place-items-stretch h-56 w-full lg:w-[1050px] mx-auto">
            <div class="card">

            </div>
            <div class="card">

            </div>
            <div class="card">

            </div>
        </div>
    </section>

</body>

</html>