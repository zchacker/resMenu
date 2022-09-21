<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}?v=2">
    <script src="{{asset('js/app.js')}}"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>لوحة التحكم</title>
</head>

<body>

    
    <div class="flex">
        <!-- header page  -->
        <nav class="lg:w-72">
            <span class="absolute shadow-md p-2 border-gray-100 border-solid border-2 rounded-md text-black text-4xl top-5 right-4 cursor-pointer" onclick="openSidebar()">
                <!-- <img src="{{ asset('imgs/menu.svg') }}" class="h-8 w-8" alt="القائمة"> -->
                <i class="las la-bars la-3xl"></i>
            </span>
            <div class="sidebar z-50 transition duration-150 ease-in-out  hidden lg:block fixed top-0 bottom-0 lg:right-0 p-2 w-[250px] overflow-y-auto text-center bg-[#17203d]">
                <div class="text-gray-100 text-xl">
                    <div class="p-2.5 mt-1 flex items-center">
                        <a href="{{route('home')}}"><h1 class="font-bold text-right text-white lg:text-[1.6rem] ml-3">لوحة التحكم</h1></a>
                        <div class="lg:hidden left-0 absolute">
                            <i class="las la-times-circle la-2x h-8 w-8 ml-5 cursor-pointer" onclick="openSidebar()"></i>
                        </div>
                        <!-- <img src="{{ asset('imgs/letter-x.svg') }}" class="h-8 w-8 ml-5 cursor-pointer left-0 absolute lg:hidden" onclick="openSidebar()" alt="">                         -->
                    </div>
                    <div class="my-2 bg-white h-[1px]"></div>
                </div>
                <div class="navbar_item">

                    <i class="las la-home la-2x"></i>
                    <a href="{{ route('dashboard.home') }}" class="navbar_item_text">الرئيسية</a>

                </div>
                <div class="navbar_item">
                    <i class="las la-store-alt la-2x"></i>
                    <a href="{{ route('dashboard.shop') }}" class="navbar_item_text">متجرك</a>
                </div>
                <div class="navbar_item">
                    <i class="las la-box la-2x"></i>
                    <a href="{{ route('dashboard.categories') }}" class="navbar_item_text">المنتجات</a>
                </div>
                @role('paidUser')
                <div class="navbar_item">
                    <i class="las la-shipping-fast la-2x"></i>
                    <a href="{{ route('dashboard.orders') }}" class="navbar_item_text">الطلبات</a>
                </div>
                @endrole
                <div class="navbar_item">
                    <i class="las la-qrcode la-2x"></i>
                    <a href="{{route('dashboard.qr')}}" class="navbar_item_text">باركود</a>
                </div>
                @role('paidUser')
                <div class="navbar_item">
                    <i class="lab la-whatsapp la-2x"></i>
                    <a href="{{ route('dashboard.whatsapp') }}" class="navbar_item_text">ربط مع whatsApp</a>
                </div>
                @endrole
                <div class="navbar_item">
                    <i class="las la-poll la-2x"></i>
                    <a href="{{ route('dashboard.package.list') }}" class="navbar_item_text">الباقة</a>
                </div>
                @role('paidUser')
                <div class="navbar_item">
                    <i class="las la-file-invoice la-2x"></i>
                    <span class="navbar_item_text">المدفوعات</span>
                </div>
                @endrole
                <!-- <div class="navbar_item">
                    <i class="las la-cog la-2x"></i>
                    <a href="{{ route('dashboard.settings') }}" class="navbar_item_text">الاعدادات</a>
                </div> -->
                <div class="navbar_item" onclick="dropdown()">
                    <i class="bi bi-chat-left-text-fill"></i>
                    <div class="flex justify-between w-full items-center">
                        <i class="las la-cog la-2x"></i>
                        <span class="navbar_item_text"> الاعدادات </span>
                        <span class="text-sm rotate-180" id="arrow">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </div>
                </div>
                <div class="text-right text-sm mt-2 w-4/5 mx-auto text-gray-200 font-bold hidden" id="submenu">
                    <a href="{{ route('dashboard.settings') }}" class="block cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1"> المعلومات الشخصية </a>
                    <a href="{{ route('dashboard.password') }}" class="block cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1"> كلمة السر </a>
                    
                </div>
                <!-- <div class="navbar_item" onclick="dropdown()">
                    <i class="bi bi-chat-left-text-fill"></i>
                    <div class="flex justify-between w-full items-center">
                        <span class="navbar_item_text">Chatbox</span>
                        <span class="text-sm rotate-180" id="arrow">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </div>
                </div>
                <div class="text-right text-sm mt-2 w-4/5 mx-auto text-gray-200 font-bold hidden" id="submenu">
                    <h1 class="cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">
                        Social
                    </h1>
                    <h1 class="cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">
                        Personal
                    </h1>
                    <h1 class="cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">
                        Friends
                    </h1>
                </div> -->
                <div class="navbar_item">
                    <i class="las la-power-off la-2x"></i>
                    <a href="{{ route('dashboard.logout') }}" class="navbar_item_text">تسجيل الخروج</a>
                </div>

            </div>
        </nav>

        <script type="text/javascript">
            function dropdown() {
                document.querySelector("#submenu").classList.toggle("hidden");
                document.querySelector("#arrow").classList.toggle("rotate-0");
            }

            //dropdown();

            function openSidebar() {
                document.querySelector(".sidebar").classList.toggle("hidden");
            }
        </script>
        <!-- end of header  -->
        
        <!-- start of body  -->