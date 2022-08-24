@include('home.header')

<script>
  $(".scrollTo").on('click', function(e) {    
     e.preventDefault();
     var target = $(this).attr('href');
     var targetArr = target.split("#");
     var id = "#"+targetArr[1];
     console.log(id)

     $('html, body').animate({
       scrollTop: ($(id).offset().top)
     }, 800);
  });
</script>

<section id="head" class="h-[600px] bg-[#000000] opacity-90 md:opacity-100 md:bg-transparent mt-[0px]  p-0 w-full mb-[0px] relative justify-center">
    <!-- <video autoplay loop muted plays-inline poster="{{asset('img/menu-header.png')}}" class="absolute object-cover opacity-50 right-0 left-0 top-auto -z-10 w-full h-full">
        <source src="{{asset('video/intro1.mp4')}}" type="video/mp4" />
        <img src="{{asset('img/menu-header.png')}}" alt="" class="absolute object-cover opacity-0 right-0 left-0 top-auto -z-10 w-full h-full">
    </video> -->
    <img src="{{asset('img/menu-header.png')}}" alt="" class="absolute object-cover object-right-bottom md:object-left  opacity-50 md:opacity-100 right-0 left-0 top-auto -z-10 w-full h-full">
    <div class="absolute mx-4 lg:mx-0 top-[25%] lg:top-[40%] right-[0%] lg:right-[50%]">
        <h1 class="relative self-start align-bottom  text-white md:text-black p-0 text-right font-bold text-[45px]">أسهل وأوفر طريقة لعمل منيو الكتروني مع باركود</h1>
        <a href="{{ route('register' , app()->getLocale() ) }}" class="relative top-6 mt-4 call_to_action text-3xl">انضم الان</a>
    </div>
</section>

<section title="page header" id="features" class="block w-full min-h-[400px] px-[0%] lg:px-[10%] py-[5%] bg-white">
    <h3 class="text-black self-center text-center text-[2.5rem] font-bold mb-6">لماذا نحن</h3>
    <div class="cards grid grid-cols-1 lg:grid-col-3 md:grid-cols-3 gap-4 place-items-center lg:place-items-stretch h-auto w-full lg:w-[1050px] mx-auto my-6">

        <div class="card">
            <svg class="icon_home" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-labelledby="qrIconTitle" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <title id="qrIconTitle">QR Code</title>
                <rect x="10" y="3" width="7" height="7" transform="rotate(90 10 3)" />
                <rect width="1" height="1" transform="matrix(-1 0 0 1 7 6)" />
                <rect x="10" y="14" width="7" height="7" transform="rotate(90 10 14)" />
                <rect x="6" y="17" width="1" height="1" />
                <rect x="14" y="20" width="1" height="1" />
                <rect x="17" y="17" width="1" height="1" />
                <rect x="14" y="14" width="1" height="1" />
                <rect x="20" y="17" width="1" height="1" />
                <rect x="20" y="14" width="1" height="1" />
                <rect x="20" y="20" width="1" height="1" />
                <rect x="21" y="3" width="7" height="7" transform="rotate(90 21 3)" />
                <rect x="17" y="6" width="1" height="1" />
            </svg>
            <h2 class="text-3xl font-bold text-red-600">باركود رقمي</h2>
            <p>بمجرد أن يمرر الزبون كاميرا الجوال على الباركود يتم توجيهه إلى المنيو مباشرة</p>
        </div>

        <div class="card">
            <svg class="icon_home fill-red-600" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 489.773 489.773" xml:space="preserve">
                <g id="XMLID_95_">
                    <path id="XMLID_98_" d="M155.183,305.646c-2.081,0.175-4.157,0.265-6.238,0.265c-5.693,0-11.23-0.826-16.652-2.081L6.834,429.293c-6.158,6.149-6.158,16.137,0,22.287l32.47,32.478c6.158,6.15,16.135,6.15,22.276,0l150.785-150.757l-27.944-30.15L155.183,305.646z" />
                    <path id="XMLID_97_" d="M485.345,104.649c-5.888-5.885-15.417-5.885-21.304,0l-81.303,81.301c-7.693,7.685-20.154,7.685-27.847,0c-7.659-7.679-7.659-20.13,0-27.807l80.901-80.884c6.112-6.118,6.112-16.036,0-22.168c-6.141-6.11-16.055-6.11-22.167,0l-80.868,80.876c-7.693,7.693-20.14,7.693-27.833,0c-7.677-7.676-7.677-20.136,0-27.806l81.286-81.293c5.904-5.894,5.904-15.441,0-21.343c-5.888-5.895-15.434-5.895-21.338,0l-91.458,91.463c-21.989,22.003-28.935,52.888-21.816,80.991l61.31,61.314c28.101,7.093,59.001,0.144,80.965-21.841l91.471-91.458C491.249,120.1,491.249,110.543,485.345,104.649z" />
                    <path id="XMLID_96_" d="M41.093,13.791c-3.134-3.135-7.372-4.854-11.724-4.854c-0.926,0-1.857,0.079-2.766,0.231c-5.295,0.896-9.838,4.295-12.172,9.133c-26.79,55.373-15.594,121.631,27.894,165.121l77.801,77.791c7.676,7.685,18.055,11.939,28.819,11.939c1.151,0,2.305-0.048,3.456-0.143l45.171-3.855l196.971,212.489c3.058,3.303,7.342,5.221,11.855,5.31c0.093,0,0.19,0,0.288,0c4.412,0,8.636-1.743,11.771-4.855l33.734-33.741c3.117-3.11,4.859-7.331,4.859-11.73c0-4.398-1.742-8.622-4.846-11.732L41.093,13.791z" />
                </g>
            </svg>
            <h2 class="text-3xl font-bold text-red-600">منيو الكتروني</h2>
            <p>استعراض الوجبات والمنتجات بطريقة جذابة وإضافتها لسلة التسوق</p>
        </div>

        <div class="card">
            <svg class="icon_home fill-red-600" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 55.26 55.26" xml:space="preserve">
                <g>
                    <path d="M19.912,34.967c-3.313,0-4-0.426-4-0.949c0-0.525,9.084-1.473,18.525-2.805c9.44-1.334,14.926-2.844,14.926-2.844c1.896-0.304,3.207-1.798,3.258-3.715V12.956c-0.006-1.954-0.987-3.12-3.526-3.528c-2.539-0.408-8.028-1.549-17.778-1.361C20.129,7.58,13.912,8.828,13.912,8.088V6.75c-0.01-2.391-1.924-4.302-4.31-4.312h-6.86C1.228,2.438,0,3.667,0,5.181c0,1.515,1.229,2.743,2.742,2.743c0,0,1.273,0,2.841,0c1.569,0,2.842,2.687,2.842,6c0,0-0.83,2.204-1,9.579c-0.17,7.375,1,12.642,1,12.642c0.013,2.39,1.924,4.3,4.313,4.31h39.78c1.514,0,2.742-1.229,2.742-2.744s-1.229-2.742-2.742-2.742L19.912,34.967z" />
                    <path d="M20.902,41.979c-2.995,0-5.422,2.429-5.422,5.42c0,2.995,2.427,5.424,5.422,5.424c2.993,0,5.422-2.429,5.422-5.424C26.324,44.406,23.896,41.979,20.902,41.979z" />
                    <path d="M47.031,41.979c-2.994,0-5.422,2.429-5.422,5.42c0,2.995,2.428,5.424,5.422,5.424c2.992,0,5.422-2.429,5.422-5.424C52.453,44.406,50.023,41.979,47.031,41.979z" />
                    <path d="M20.537,27.253h-1.304c-0.974,0-1.462-0.778-1.763-1.764c0,0-0.646-2.522-0.646-5.461c0-2.94,0.646-6.512,0.646-6.512c0.289-0.966,0.789-1.764,1.763-1.764h1.304c0.974,0,1.431,0.735,1.764,1.764c0,0,0.585,3.484,0.601,6.512c0.03,2.703-0.601,5.461-0.601,5.461C21.992,26.484,21.511,27.253,20.537,27.253z" />
                    <path d="M29.197,26.503H28.02c-0.879,0-1.32-0.703-1.592-1.593c0,0-0.584-2.278-0.584-4.933c0-2.655,0.584-5.882,0.584-5.882c0.261-0.872,0.713-1.593,1.592-1.593h1.177c0.881,0,1.293,0.664,1.594,1.593c0,0,0.529,3.147,0.543,5.882c0.027,2.441-0.543,4.933-0.543,4.933C30.513,25.81,30.078,26.503,29.197,26.503z" />
                    <path d="M37.372,25.628h-1.03c-0.77,0-1.154-0.615-1.393-1.394c0,0-0.512-1.993-0.512-4.316c0-2.323,0.512-5.146,0.512-5.146c0.228-0.763,0.623-1.394,1.393-1.394h1.03c0.771,0,1.131,0.581,1.394,1.394c0,0,0.463,2.754,0.475,5.146c0.023,2.137-0.475,4.316-0.475,4.316C38.523,25.021,38.143,25.628,37.372,25.628z" />
                    <path d="M44.689,24.96h-0.918c-0.687,0-1.029-0.548-1.242-1.241c0,0-0.455-1.776-0.455-3.846c0-2.07,0.455-4.586,0.455-4.586c0.203-0.68,0.557-1.241,1.242-1.241h0.918c0.686,0,1.006,0.517,1.24,1.241c0,0,0.412,2.454,0.424,4.586c0.021,1.903-0.424,3.846-0.424,3.846C45.714,24.419,45.375,24.96,44.689,24.96z" />
                </g>
            </svg>
            <h2 class="text-3xl font-bold text-red-600">طلب مباشر</h2>
            <p>بإمكان العملاء الطلب المباشر واستقبال طلباتهم عن طريق اشعارات مباشرة</p>
            </svg>
        </div>
    </div>
</section>

<section title="page header" id="menus" class="grid w-full min-h-[400px] px-[10%] py-[5%] bg-white">
    <h2 class="text-3xl font-bold text-red-600 text-center">نماذج المنيو</h2>
    <div class="block lg:flex m-auto overflow-x-auto my-5">

        <div class="menue_sample_wraper">
            <img src="{{ asset('img/slide1.png') }}" alt="" class="menue_sample_img">
        </div>
        <div class="menue_sample_wraper">
            <img src="{{ asset('img/slide2.png') }}" alt="" class="menue_sample_img">
        </div>
        <div class="menue_sample_wraper">
            <img src="{{ asset('img/slide3.png') }}" alt="" class="menue_sample_img">
        </div>

    </div>
</section>

<section title="page header" class="w-full mx-auto min-h-[300px] px-[0%] lg:px-[10%] py-[7%] bg-blue-200">

    <h2 class="text-3xl font-bold text-white text-center">الربط مع شبكات التواصل</h2>

    <div class="md:block  grid grid-cols-2 lg:flex lg:w-[400px] w-full m-auto my-5">
        <div class="menue_sample_wraper">
            <img src="{{ asset('img/whatsapp.png') }}" class="w-14">
        </div>
        <div class="menue_sample_wraper">
            <img src="{{ asset('img/twitter.png') }}" class="w-14">
        </div>
        <div class="menue_sample_wraper">
            <img src="{{ asset('img/google.png') }}" class="w-14">
        </div>
        <div class="menue_sample_wraper">
            <img src="{{ asset('img/instagram.png') }}" class="w-14">
        </div>
    </div>

</section>


<section class="bg-white " id="prices">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-black ">باقات تناسب جميع الانشطة</h2>
            <p class="mb-5 font-light text-black sm:text-xl ">مطاعم، مقاهي، فنادق، فود ترك، مراكز صحية، الصالونات، المعارض، المستشفيات، الشركات والمؤسسات</p>
        </div>
        <div class="grid grid-cols-2 text-center items-center bg-transparent h-14 md:w-1/3 mx-auto my-14 rounded-md">
            <span onclick="select_mounth()" id="mounth" class="monthly transition-all duration-200 hover:opacity-90 rounded-tr-md rounded-br-md">شهري</span>
            <span onclick="select_year()" id="year" class="yearly transition-all duration-200 hover:opacity-90 rounded-tl-md rounded-bl-md">سنوي</span>
        </div>
        <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
            <!-- Pricing Card -->
            <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-black bg-white rounded-lg border border-gray-700 shadow xl:p-8">
                <h3 class="mb-4 text-2xl font-semibold">مبتدئ</h3>
                <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">إذا كنت صاحب عمل متناهي الصغر وما زلت في البدايات, نحن نرحب بك</p>
                <div class="flex justify-center items-baseline my-8">
                    <span class="mr-2 text-5xl font-extrabold">مجاناً</span>
                    <span class="text-gray-500 dark:text-gray-400"></span>
                </div>
                <!-- List -->
                <ul role="list" class="mb-8 space-y-4 text-left">
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>إنشاء الحساب مجاناً</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>إضافة 7 منتجات</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>مساحة تخزين تصل الى <span class="font-semibold">500 ميجا</span></span>
                    </li>
                    <!-- <li class="flex items-center space-x-3"> -->
                        <!-- Icon -->
                        <!-- <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Premium support: <span class="font-semibold">6 months</span></span>
                    </li> -->
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>مجاني <span class="font-semibold">مدى الحياة</span></span>
                    </li>
                </ul>
                <a href="{{ route('login' , app()->getLocale() ) }}" class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">اشترك الان</a>
            </div>
            <!-- Pricing Card -->
            <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-black bg-white rounded-lg border border-gray-700 shadow xl:p-8">
                <h3 class="mb-4 text-2xl font-semibold">أساسي</h3>
                <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">مناسب لأغلب الانشطة والمحلات بإمكانيات منافسة</p>
                <div class="flex justify-center items-baseline my-8">
                    <span class="mr-2 text-5xl font-extrabold" id="pk-1" >29 ريال</span>
                    <span class="text-gray-500" id="pk-1-time">/شهريا</span>
                </div>
                <!-- List -->
                <ul role="list" class="mb-8 space-y-4 text-left">
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>منتجات غير محدودة</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>تخزين غير محدود</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>إمكانية إضافة  <span class="font-semibold">وسائل التواصل الاجتماعي</span></span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>إستقبال طلبات العملاء <span class="font-semibold">داخل لوحة التحكم</span></span>
                    </li>                    
                </ul>
                <a href="{{ route('login' , app()->getLocale() ) }}" class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">اشترك الان</a>
            </div>
            <!-- Pricing Card -->
            <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-black bg-white rounded-lg border border-gray-700 shadow xl:p-8">
                <h3 class="mb-4 text-2xl font-semibold">أعمال</h3>
                <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">باقة الأعمال للشركات والمؤسسات الاحترافية</p>
                <div class="flex justify-center items-baseline my-8">
                    <span class="mr-2 text-5xl font-extrabold" id="pk-2" >39 ريال</span>
                    <span class="text-gray-500" id="pk-2-time" >/شهريا</span>
                </div>
                <!-- List -->
                <ul role="list" class="mb-8 space-y-4 text-left">
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>منتجات غير محدودة</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>تخزين غير محدود</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>إمكانية إضافة  <span class="font-semibold">وسائل التواصل الاجتماعي</span></span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>إستقبال طلبات العملاء <span class="font-semibold">داخل لوحة التحكم</span></span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>إستقبال طلبات العملاء <span class="font-semibold">عبر الواتساب</span></span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>استلم المدفوعات <span class="font-semibold">عبر بطاقات فيزا/مدى</span></span>
                    </li>                      
                </ul>
                <a href="{{ route('login' , app()->getLocale() ) }}" class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">اشترك الان</a>
            </div>
        </div>
    </div>
</section>

<script>

    function select_mounth(){

        $('#mounth').removeClass('yearly').addClass('monthly');
        $('#year').removeClass('monthly').addClass('yearly');

        $('#pk-1').text('29 ريال');
        $('#pk-2').text('39 ريال');

        $('#pk-1-time').text(' / شهريا');
        $('#pk-2-time').text(' / شهريا');

    }

    function select_year(){

        $('#year').removeClass('yearly').addClass('monthly');
        $('#mounth').removeClass('monthly').addClass('yearly');

        $('#pk-1').text('319 ريال');
        $('#pk-2').text('429 ريال');

        $('#pk-1-time').text(' / سنويا ');
        $('#pk-2-time').text(' / سنويا ');

    }

</script>

@include('home.footer')