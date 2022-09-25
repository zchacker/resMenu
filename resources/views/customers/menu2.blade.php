<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/downupPopup.css')}}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>{{ $restrant->name }}</title>
</head>

<body>
    @if(strlen($restrant->cover) == 0 )
    <div class="block w-full min-h-[250px] mb-4 md:mx-auto bg-gray-200 -z-10 bg-local bg-no-repeat bg-cover bg-center-bottom" style="background-image: url('{{ asset('img/food.jpg') }}');">
        @else
        <div class="block w-full min-h-[250px] mb-5 md:mx-auto bg-gray-500 -z-10 bg-local bg-no-repeat bg-cover bg-center-bottom" style="background-image: url('{{ route('image.displayImage', $cover_img) }}');">
            @endif

            <div class="lg:flex relative1 bg-[#0000008e] opacity-100 w-full min-h-[250px] h-fit py-5 z-[12] text-white">

                <div class="md:w-2/12 w-full">
                    @if(strlen($restrant->avatar) == 0 )
                    <img src="{{ asset('img/shop.jpg') }}" alt="" id="avatar-preview-image" class="w-[75px] h-[75px] lg:w-[150px] lg:h-[150px] mb-3 md:mb-0 relative top-2 md:top-6 right-3 rounded-md" />
                    @else
                    <img src="{{ route('image.displayImage', $avatar_img) }}" alt="" id="avatar-preview-image" class="w-[75px] h-[75px] lg:w-[150px] lg:h-[150px] mb-3 md:mb-0 relative top-2 md:top-6 right-3 rounded-md" />
                    @endif
                </div>

                <div class="md:w-10/12 w-full px-2">
                    <h1 class="md:mr-2 mb-4 text-[2rem] font-bold"> {{$restrant->name}} </h1>
                    <h1 class="md:mr-2 mb-4 text-[1.2rem] font-thin"> {{$restrant->message}} </h1>
                    <div class="md:mr-2 mb-6 bg-transparent h-5 w-full">
                        <div class="flex items-center bg-[#ffffff52] w-fit rounded-full text-center p-1 px-2 md:px-2 md:justify-start justify-center">
                            <p>العنوان : {{$restrant->address}}</p>
                            <a href="#" class="text-white text-xl font-bold  mx-4"><i class="lar la-map"></i></a>
                        </div>
                    </div>
                    <div class="md:mr-2 mb-4 bg-transparent h-5 w-full" title="social medida">
                        <div class="flex items-center justify-center w-fit">
                            <a href="#" class="text-yellow-400 text-3xl font-bold  mx-4"> <i class="lab la-twitter"></i> </a>
                            <a href="#" class="text-yellow-400 text-3xl font-bold  mx-4"> <i class="lab la-facebook-f"></i> </a>
                            <a href="#" class="text-yellow-400 text-3xl font-bold  mx-4"> <i class="lab la-instagram"></i> </a>
                            <a href="#" class="text-yellow-400 text-3xl font-bold  mx-4"> <i class="lab la-snapchat-ghost"></i> </a>
                        </div>
                    </div>
                </div>


            </div>

        </div>

        <div class="relative1 top-8">
            <div class="flex h-20 bg-white w-full md:w-3/4 m-auto overflow-x-auto p-2">
                @foreach($menucategories as $category)
                <a href="#{{$category->id}}" class="relative px-[15px] min-w-[130px] py-[5px] mx-2 h-10 rounded-3xl border-[1px] border-blue-400 bg-blue-400 text-white w-[200px] text-center">{{$category->title_ar}}</a>
                @endforeach
            </div>
        </div>

        <div class="block w-full min-h-fit mx-auto md:w-3/4 bg-transparent -z-10 mb-8 pb-16">

            @foreach($menueitems as $item)
            <div id="{{$item->menu_category_id}}" class="relative top-10 mt-5 rounded-md z-0 h-25 w-5/6 mx-auto md:w-5/6 text-black">
                <div class="lg:flex block bg-green-50 border-2 border-purple-400 border-dashed rounded-md h-full p-4">
                    <img class="w-[105px] h-[105px] lg:w-[15%] lg:h-[150px] object-cover rounded-md lazy" data-src="{{ route('image.displayImage', $item->file_name ) }}">
                    <div class="mx-4 self-stretch lg:w-[80%] w-full text-right">
                        <h1 class=" text-black font-bold text-3xl mb-2">{{$item->name}}</h1>
                        @if ($item->offer_price != NULL || $item->offer_price > 0)
                        <div class="block">
                            <p class="mb-2 w-full text-lg font-semibold">{{$item->offer_price}} SAR</p>
                            <p class="mb-0 w-full text-sm font-semibold line-through text-red-600">{{$item->price}} SAR</p>
                        </div>
                        @else
                        <span class="mb-4 text-lg font-semibold">{{$item->price}} SAR</span>
                        @endif
                        <p>{{$item->description}}</p>
                    </div>

                    @if($restrant->orders_allow == 'on')
                    @if ($item->offer_price != NULL || $item->offer_price > 0)
                    <button onclick="show_item({{$item->id}} , '{{$item->name}}' , {{$item->offer_price}});" class="bg-red-700 text-white rounded-md lg:mt-0 mt-4 h-10 lg:self-center text-xl text-center lg:px-4 px-6 lg:w-[20%] w-full"> إضافة <i class="las la-plus la-1x"></i></button>
                    @else
                    <button onclick="show_item({{$item->id}} , '{{$item->name}}' , {{$item->price}});" class="bg-red-700 text-white rounded-md lg:mt-0 mt-4 h-10 lg:self-center text-xl text-center lg:px-4 px-6 lg:w-[20%] w-full"> إضافة <i class="las la-plus la-1x"></i></button>
                    @endif
                    @endif
                </div>
            </div>
            @endforeach

        </div>

        <div id="cartBox" class="border border-gray-500 shadow-md px-0 bg-gray-500">
            <div class="">
                <div class="overflow-y-auto h-[45vh] py-0">
                    <div id="product_list" class="w-full ">

                        <div class="lg:flex justify-between lg:justify-evenly my-2 p-4 rounded-lg border border-dashed border-yellow-500">
                            <p class="lg:w-3/4 font-bold text-2xl">اسم المنتج</p>
                            <div class="flex lg:w-1/4 items-center">
                                <p class="flex lg:w-1/5 w-1/2 text-center"><span class="mx-1"> 15 </span> <span> SAR </span></p>
                                <div class="flex lg:w-[75%] w-1/2 h-9 mt-0 bg-white items-stretch  mx-4 rounded-full p-0 box-border">
                                    <button id="plus" onclick="add();" class="flex-1 bg-gray-500 rounded-r-full"><i class="las la-plus la-1x !text-white "></i></button>
                                    <p class="flex-1 bg-white text-center items-center self-center"><span>1</span></p>
                                    <button id="minus" onclick="sub();" class="flex-1 bg-gray-500 rounded-l-full"><i class="las la-minus la-1x !text-white"></i></button>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="block w-full mx-auto px-3 my-2 items-end text-center">
                        <input type="text" placeholder="اسمك الكامل" id="customer_name" class="form_dash_input !bg-slate-50 my-3" />

                        <input type="tel" placeholder="رقم الهاتف" id="customer_phone" class="form_dash_input !bg-slate-50 my-3" />

                        <input type="email" placeholder="البريد الالكتروني (اختياري)" id="customer_email" class="form_dash_input !bg-slate-50 my-3" />

                        <select name="" id="payment_type" class="form_dash_input !bg-slate-50 my-3">
                            <option value="cash" selected>الدفع عند الاستلام</option>
                            @if( strlen($restrant->payment_token) > 0 && $restrant->payment_allow == 'on')
                            <option value="credit">الدفع بالبطاقة</option>
                            @endif
                        </select>
                        <div class="border border-gray-500 p-2 my-5 rounded-md shadow-md">
                            <p>
                                <span>إجمالي المبلغ المطلوب:</span>
                                <span id="subtotal" class="text-red-500 font-bold text-3xl">123</span>
                                <span>SAR</span>
                            </p>
                        </div>
                        @csrf
                        <button onclick="send_order();" class="bg-green-500 text-white rounded-full p-2 w-3/4">اطلب الآن</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="item" class="border border-gray-500 shadow-md px-0 bg-gray-500">

            <div class="bg-gray-800 w-full h-full p-3">
                <p class="text-white text-2xl my-2" id="product_title">اسم المننتج</p>
                <div class="flex items-center py-2 border-t border-t-white">

                    <button onclick="add_item_to_cart();" class="flex-1 bg-gray-600 hover:bg-gray-300 hover:text-black transform-gpu transition-all duration-300 text-white rounded-full lg:mt-0 mt-4 h-10 lg:self-center text-xl text-center lg:px-4 px-6 lg:w-[20%] w-full">أضف <span id="price">0</span> ريال</button>

                    <div class="flex h-10 md:mt-0 mt-4 bg-white items-stretch flex-none w-2/6 mx-5 rounded-full p-0 box-border">
                        <button id="plus" onclick="add();" class="flex-1 bg-gray-500 rounded-r-full"><i class="las la-plus la-2x !text-white "></i></button>
                        <p class="flex-1 bg-white text-center items-center self-center"><span id="total">1</span></p>
                        <button id="minus" onclick="sub();" class="flex-1 bg-gray-500 rounded-l-full"><i class="las la-minus la-2x !text-white"></i></button>
                    </div>

                </div>
            </div>

        </div>

        <div id="cart_btn" class="fixed hidden bottom-0 left-0 right-0 h-25 p-3 w-full bg-[#00000081]">
            <div class="flex items-center justify-between rounded-md px-2 py-1 bg-[#000000] text-white">
                <div>
                    <p><span id="count">1</span>) منتج</p>
                    <p><span id="sub_total">29.00</span> ريال</p>
                </div>
                <div>
                    <button onclick="open_cart()">مشاهدة الطلب <i class="las la-angle-left"></i> </button>
                </div>
            </div>
        </div>

        <!-- document for bottomsheet -->
        <!-- https://www.jqueryscript.net/other/bottom-sheet-drawer.html -->
        <script src="{{asset('js/app.js')}}"></script>
        <script src="{{asset('js/downupPopup.js')}}"></script>
        <script src="{{asset('js/cart.js')}}"></script>
        <script>
            // this for cart data
            var total = 0;
            var cart = []; // cart array

            // this for item data
            var productId = -1;
            var count = 1;
            var price = 0;
            var productName = "";


            function add() {
                count++;
                var sum_price = price * count;

                $('#total').text(count);
                $('#price').text(sum_price);

            }

            function sub() {
                count--;

                if (count < 1) {
                    count = 1;
                }

                var sum_price = price * count;

                $('#total').text(count);
                $('#price').text(sum_price);

            }

            function show_item(productId, product_name, product_price) {

                this.productId = productId;
                this.productName = product_name;
                this.price = product_price;
                this.total = 1;

                $('#product_title').text(product_name);
                $('#price').text(product_price);
                $('#item').downupPopup('open');

            }

            function add_item_to_cart() {
                let item = new CartItem(this.productId, this.productName, this.price, this.count);

                const searchIndex = cart.findIndex((item) => item.productId == this.productId);
                //console.log("searchIndex: ", searchIndex);

                if (searchIndex == -1) {
                    cart.push(item);
                } else {
                    cart[searchIndex].counter = (cart[searchIndex].counter + this.count);
                }

                //console.log("cart: " , cart);


                // reset item
                this.productId = -1;
                this.productName = "";
                this.price = 0;
                this.total = 1;
                this.count = 1;

                $('#total').text(count);
                $('#item').downupPopup('close');

                show_cart();

            }

            function show_cart() {
                // loop in cart            
                var local_count = 0;
                var local_sub_total = 0;

                cart.forEach(function(item) {
                    local_sub_total += (item.price * item.counter);
                    local_count += item.counter;
                });

                $('#count').text(cart.length);
                $('#sub_total').text(local_sub_total);
                $('#cart_btn').show();

                var json = JSON.parse(JSON.stringify(cart));
                console.log("json: ", json);

            }

            $("#item").downupPopup({
                distance: 70,
                width: "100%",
                duration: "300",
                animation: "ease",
                headerText: "",
                radiusLeft: "0px",
                radiusRight: "0px",
                scroll: false,
                background: true
            });

            $('#cartBox').downupPopup({
                distance: 40,
                width: "100%",
                duration: "300",
                animation: "ease",
                headerText: "سلة المشتريات",
                radiusLeft: "0px",
                radiusRight: "0px",
                scroll: false,
                background: true
            });

            function add_more(index) {
                this.cart[index].counter++;
                renderCart();
            }

            function decrease_more(index) {
                this.cart[index].counter--;
                if (this.cart[index].counter <= 0) {
                    this.cart.splice(index, 1);
                }
                renderCart();
            }

            function renderCart() {

                $('#product_list').empty();

                cart.forEach(function(item, i) {

                    var item_name = item.productName;
                    var item_price = (item.price * item.counter);
                    var item_count = item.counter;

                    var item = `<div class="lg:flex my-2 p-4 rounded-lg border border-dashed border-yellow-500">
                                <p class="lg:w-3/4 font-bold text-2xl">` + item_name + ` </p>
                                <div class="flex md:w-1/4 mt-4 md:mt-0 items-center">
                                    <p class="flex w-1/5 text-center"><span class="mx-1"> ` + item_price + ` </span> <span> SAR </span></p>
                                    <div class="flex w-[75%] h-9 mt-0 bg-white items-stretch  mx-4 rounded-full p-0 box-border">
                                        <button id="plus" onclick="add_more(` + i + `);" class="flex-1 bg-green-500 rounded-r-full"><i class="las la-plus la-1x !text-white "></i></button>
                                        <p class="flex-1 bg-white text-center items-center self-center"><span >` + item_count + `</span></p>
                                        <button id="minus" onclick="decrease_more( ` + i + ` );" class="flex-1 bg-green-500 rounded-l-full"><i class="las la-minus la-1x !text-white"></i></button>
                                    </div>
                                </div>
                            </div>`;

                    $('#product_list').append(item);

                });

                // to update bottom bar cart summary
                var local_count = 0;
                var local_sub_total = 0;

                cart.forEach(function(item) {
                    local_sub_total += (item.price * item.counter);
                    local_count += item.counter;
                });

                $('#count').text(cart.length);
                $('#sub_total').text(local_sub_total);
                $('#subtotal').text(local_sub_total);
                $('#cart_btn').show();

                // if cart empty then hide everything
                if (cart.length == 0) {
                    $('#cart_btn').hide();
                    $('#cartBox').downupPopup('close');
                }

            }

            function open_cart() {
                renderCart();

                $('#cartBox').downupPopup('open');

            }

            function send_order() {

                // check required inputs 
                var customer_name = $('#customer_name').val();
                var customer_phone = $('#customer_phone').val();
                var customer_email = $('#customer_email').val();
                var payment_type = $('#payment_type').val();


                var json = JSON.parse(JSON.stringify(cart));

                if ($('#customer_name').val().length === 0) {
                    alert("رجاء أدخل اسمك الكامل");
                    return;
                }

                if ($('#customer_phone').val().length === 0) {
                    alert("رجاء أدخل رقم الهاتف");
                    return;
                }


                $.ajax('{{route("addOrder")}}', {

                    type: 'POST', // http method
                    dataType: 'json',
                    data: {

                        _token: '{{ csrf_token() }}',
                        cart: json,
                        restrant_id: '{{$restrant_id}}',
                        customer_name: customer_name,
                        customer_phone: customer_phone,
                        customer_email: customer_email,
                        payment_type: payment_type

                    }, // data to submit
                    success: function(data, status, xhr) {

                        if (data.success) {
                            location.replace(data.url);
                        } else {
                            alert(data.error);
                        }

                        //console.log('server says: ', [data.orderID]);

                    },
                    error: function(jqXhr, textStatus, errorMessage) {

                        alert("حدث خطأ غير متوقع حاول لاحقاً");
                        console.log('server error: ', [errorMessage]);

                    }
                });

            }


            document.addEventListener("DOMContentLoaded", function() {
                var lazyloadImages = document.querySelectorAll("img.lazy");
                var lazyloadThrottleTimeout;

                function lazyload() {
                    if (lazyloadThrottleTimeout) {
                        clearTimeout(lazyloadThrottleTimeout);
                    }

                    lazyloadThrottleTimeout = setTimeout(function() {
                        var scrollTop = window.pageYOffset;
                        lazyloadImages.forEach(function(img) {
                            if (img.offsetTop < (window.innerHeight + scrollTop)) {
                                img.src = img.dataset.src;
                                img.classList.remove('lazy');
                            }
                        });
                        if (lazyloadImages.length == 0) {
                            document.removeEventListener("scroll", lazyload);
                            window.removeEventListener("resize", lazyload);
                            window.removeEventListener("orientationChange", lazyload);
                        }
                    }, 20);
                }

                document.addEventListener("scroll", lazyload);
                window.addEventListener("resize", lazyload);
                window.addEventListener("orientationChange", lazyload);
            });
        </script>
</body>

</html>