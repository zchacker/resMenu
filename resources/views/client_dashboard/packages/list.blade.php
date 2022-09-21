@include('client_dashboard.header')

<div class="content">

@if($subscription != NULL)
<div class="bg-green-200 w-full rounded-xl min-h-fit p-4">
    <p class="text-blue-900">ينتهي اشتراكك في: <strong>{{ date("d/m/Y" , strtotime( $subscription->end_date )) }}</strong></p>
</div>
@endif

<section class="bg-white " id="prices">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
            <h1 class="mb-4 text-5xl tracking-tight font-extrabold text-black "> ترقية الباقة </h1>
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-black ">باقات تناسب جميع الانشطة</h2>
            <p class="mb-5 font-light text-black sm:text-xl ">مطاعم، مقاهي، فنادق، فود ترك، مراكز صحية، الصالونات، المعارض، المستشفيات، الشركات والمؤسسات</p>
        </div>
        <!-- <div class="grid grid-cols-2 text-center items-center bg-transparent h-14 md:w-1/3 mx-auto my-14 rounded-md">
            <span onclick="select_mounth()" id="mounth" class="monthly transition-all duration-200 hover:opacity-90 rounded-tr-md rounded-br-md">شهري</span>
            <span onclick="select_year()" id="year" class="yearly transition-all duration-200 hover:opacity-90 rounded-tl-md rounded-bl-md">سنوي</span>
        </div> -->
        <div class="space-y-8 lg:grid md:grid-cols-2 sm:gap-6 xl:gap-10 lg:space-y-0">                        
            <!-- Pricing Card -->
            <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-black bg-white rounded-lg border border-gray-700 shadow xl:p-8">
                <h3 class="mb-4 text-2xl font-semibold">أعمال</h3>
                <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400"> باقة الأعمال للشركات والمؤسسات الاحترافية </p>
                <div class="flex justify-center items-baseline my-8">
                    <span class="mr-2 text-5xl font-extrabold" id="pk-1" >180 ريال</span>
                    <span class="text-gray-500" id="pk-1-time">/سنوياً</span>
                </div>
                <!-- List -->
                <ul role="list" class="mb-8 space-y-4 text-left">
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>إتاحة تحديد الطلبات</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span> إتاحة السوشيال ميديا </span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span> إضافة المنيو pdf لامحدود </span>
                    </li>       
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>دفع الكتروني فيزا ، مدى ، ابل باي</span>
                    </li>                                  
                </ul>
                @if($package_code == 1 || $package_code == 2)
                    <a href="{{ route('register.user' , ['year' , 3] ) }}" id="pk-1-link" class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">الترقية الان</a>
                @elseif($package_code == 4)
                    
                @else 
                    <a href="javascript:void(0)" id="pk-1-link" class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"> هذه باقتك الحالية </a>
                @endif
            </div>
            <!-- Pricing Card -->
            <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-black bg-white rounded-lg border border-gray-700 shadow xl:p-8">
                <h3 class="mb-4 text-2xl font-semibold">أعمال VIP</h3>
                <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">باقة الأعمال للشركات والمؤسسات الاحترافية</p>
                <div class="flex justify-center items-baseline my-8">
                    <span class="mr-2 text-5xl font-extrabold" id="pk-2" >500 ريال</span>
                    <span class="text-gray-500" id="pk-2-time" >/مدى الحياة</span>
                </div>
                <!-- List -->
                <ul role="list" class="mb-8 space-y-4 text-left">
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>إتاحة تحديد الطلبات</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>إتاحة السوشيال ميديا</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>إضافة المنيو pdf لامحدود</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <!-- Icon -->
                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>دفع الكتروني فيزا ، مدى ، ابل باي</span>
                    </li>                                                              
                </ul>                
                @if($package_code == 1 || $package_code == 2 || $package_code == 3)
                    <a href="{{ route('register.user' , ['year' , 3] ) }}" id="pk-1-link" class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">الترقية الان</a>
                @else 
                    <a href="javascript:void(0)" id="pk-1-link" class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"> هذه باقتك الحالية </a>
                @endif
            </div>
        </div>
    </div>
</section>

</div>

@include('client_dashboard.footer')