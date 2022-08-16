@include('client_dashboard.header')

<div class="content">
    <h2 class="text-2xl font-bold mb-4">{{__('manage_shop')}}</h2>
    @if(Session::has('errors'))
    <div class="my-3 w-full p-4 bg-orange-500 text-white rounded-md">
        {!! session('errors')->first('error') !!}
    </div>
    @endif

    @if(Session::has('success'))
    <div class="my-3 w-full p-4 bg-green-700 text-white rounded-md">
        {!! session('success') !!}
    </div>
    @endif

    <div class="bg-yellow-200 w-full rounded-xl min-h-fit p-4">
        <form action="{{ route('dashboard.update.shop') }}" method="post" class="w-full" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <input type="submit" value="{{ __('save') }}" class="bg-red-600 text-white rounded-full py-2 px-4" />
            </div>

            <div class="mb-4">
                <label for="name" class="lable_form ">{{ __('shop_name') }}</label>
                <input type="text" name="name" class="form_dash_input" placeholder="{{ __('shop_name') }}" value="{{ $restrant->name }}" />
            </div>

            <div class="mb-4">
                <label for="name" class="lable_form ">{{ __('slug') }}</label>
                <input type="text" name="slug" class="form_dash_input" placeholder="{{ __('slug') }}" value="{{ $restrant->slug }}" />
                <p class="text-red-700 font-bold my-2">رابط المنيو الخاص بك</p>
                @if($restrant->slug != NULL)
                <a href="{{route('menu' , $restrant->slug)}}" target="_blank" class="text-blue-700 underline">{{route('menu' , $restrant->slug)}}</a>
                @endif
            </div>

            <div class="mb-4">
                <label for="working_hours" class="lable_form ">{{ __('working_hours') }}</label>
                <input type="text" name="working_hours" class="form_dash_input" placeholder="{{ __('working_hours') }}" value="{{ $restrant->working_hours }}" />
            </div>

            <div class="mb-4">
                <label for="message" class="lable_form ">{{ __('shop_message') }}</label>
                <textarea name="message" id="" cols="30" rows="10" class="form_dash_input" placeholder="{{__('shop_message')}}">{{ $restrant->shop_message }}</textarea>
            </div>

            <!-- <div class="flex items-center cursor-pointer justify-center relative w-16 h-16 rounded-full border-2 border-brand-100">
                <label for="file">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve" width="50px" height="50px">
                            <g>
                                <g>
                                    <g>
                                        <path d="M28,6h-4l-4-4h-8.001L8,6H4c0,0-4,0-4,4v12c0,4,4,4,4,4s5.662,0,11.518,0    c1.614,2.411,4.361,3.999,7.482,4c3.875-0.002,7.167-2.454,8.436-5.889C31.995,23.076,32,22,32,22s0-8,0-12S28,6,28,6z     M14.033,21.66C11.686,20.848,10,18.626,10,16c0-3.312,2.684-6,6-6c1.914,0,3.607,0.908,4.706,2.306    C16.848,13.321,14,16.822,14,21C14,21.223,14.018,21.441,14.033,21.66z M23,27.883c-3.801-0.009-6.876-3.084-6.885-6.883    c0.009-3.801,3.084-6.876,6.885-6.885c3.799,0.009,6.874,3.084,6.883,6.885C29.874,24.799,26.799,27.874,23,27.883z" data-original="#010002" class="active-path" data-old_color="##565A5" fill="#565A5C" />
                                        <polygon points="24.002,16 22,16 22,20 18,20 18,22 22,22 22,26 24.002,26 24.002,22 28,22 28,20     24.002,20   " data-original="#010002" class="active-path" data-old_color="##565A5" fill="#565A5C" />
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                </label>

                <input id="file" class="absolute w-full h-full" ref="file" type="file" accept="image/*" style=" visibility: hidden;" />
            </div> -->

            <div class="lg:flex">
                <div class="mb-4 lg:mx-2 lg:w-1/2">
                    <label for="address" class="lable_form ">{{ __('shop_address') }}</label>
                    <input type="text" name="address" class="form_dash_input" placeholder="{{__('shop_address')}}" value="{{ $restrant->address }}" />
                </div>

                <div class="mb-4 lg:mx-2 lg:w-1/2">
                    <label for="message" class="lable_form">{{ __('phone') }}</label>
                    <input type="tel" name="phone" class="form_dash_input" placeholder="{{__('phone')}}" value="{{ $restrant->phone }}" />
                </div>
            </div>

            <div class="md:flex mb-4">
                <div class="mb-4 lg:mx-2 lg:w-1/2">
                    <label for="" class="lable_form">شعار المتجر</label>
                    @if(strlen($restrant->avatar) == 0 )
                    <img src="{{ asset('img/shop.jpg') }}" alt="" id="avatar-preview-image" class="md:w-[150px] h-[150px] border-2 border-double border-gray-200 p-1 bg-white object-cover rounded-md" />
                    @else
                    <img src="{{ route('image.displayImage', $avatar_img) }}" alt="" id="avatar-preview-image" class="md:w-[150px] h-[150px] border-2 border-double border-gray-200 p-1 bg-white object-cover rounded-md" />
                    @endif
                    <input type="file" name="avatar" id="avatar" class="my-4" />
                </div>

                <div class="mb-4 lg:mx-2 lg:w-1/2">
                    <label for="" class="lable_form"> صورة غلاف المتجر (هيدر المتجر) </label>
                    @if(strlen($restrant->cover) == 0 )
                    <img src="{{ asset('img/cover.jpg') }}" alt="" id="cover-preview-image" class="md:w-[500px] h-[150px] border-2 border-double border-gray-200 p-1 bg-white object-cover rounded-md" />
                    @else
                    <img src="{{ route('image.displayImage', $cover_img ) }}" alt="" id="cover-preview-image" class="md:w-[500px] h-[150px] border-2 border-double border-gray-200 p-1 bg-white object-cover rounded-md" />
                    @endif
                    <input type="file" name="cover" id="cover" class="my-4" />
                </div>
            </div>

            <input type="hidden" name="latitude" id="latitude" value="{{ $restrant->latitude }}" />
            <input type="hidden" name="longitude" id="longitude" value="{{ $restrant->longitude }}" />

            <h2 class="font-bold my-5 lable_form">اختر الموقع على الخريطة</h2>

            <span id="location_name" class="text-red-700 text-lg my-8"></span>

            <a href="javascript:getLocation();" class="normal_button">
                <span class="mt-5 mb-10">حدد موقعي</span>
            </a>

            <div id="map" class="my-3 lg:h-[400px] h-[400px] lg:mx-10 lg:my-4 mx-3 bg-slate-700 ">

            </div>

            <div class="mb-4">
                <label for="" class="lable_form">السماح بالطلبات</label>
                <select name="orders_allow" id="" class="form_dash_input">
                    <option value="on"  {{ ($restrant->orders_allow === "on")  ? "selected" : "" }} >نعم</option>
                    <option value="off" {{ ($restrant->orders_allow === "off") ? "selected" : "" }} >لا</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="" class="lable_form">السماح بالدفع</label>
                <select name="payment_allow" id="" class="form_dash_input">
                    <option value="on"  {{ ($restrant->payment_allow === "on")  ? "selected" : "" }} >نعم</option>
                    <option value="off" {{ ($restrant->payment_allow === "off")  ? "selected" : "" }}>لا</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="" class="lable_form">رجاء أدخل المفتاح السري لحسابك في <a href="https://myfatoorah.com/" class="link" target="_blank">myfatoorah.com</a> </label>
                <input type="text" name="payment_token" id="" class="form_dash_input" value="{{ $restrant->payment_token }}" placeholder="tt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7 ...." />
            </div>

            <div class="mb-4">
                <input type="submit" value="{{ __('save') }}" class="bg-red-600 text-white rounded-full py-2 px-4" />
            </div>

        </form>

    </div>

</div>



<!-- 
     The `defer` attribute causes the callback to execute after the full HTML
     document has been parsed. For non-blocking uses, avoiding race conditions,
     and consistent behavior across browsers, consider loading using Promises
     with https://www.npmjs.com/package/@googlemaps/js-api-loader.
    -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API') }}&callback=initMap&v=weekly" defer></script>

<script>
    var map, marker;

    // Initialize and add the map
    function initMap() {
        
        // The location of Medina
        const medinaCoordinator = {
            lat: {{$restrant -> latitude}},
            lng: {{$restrant -> longitude}}
        };

        // The map, centered at medinaCoordinator
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: medinaCoordinator,
        });

        // The marker, positioned at medinaCoordinator
        marker = new google.maps.Marker({
            position: medinaCoordinator,
            map: map,
            draggable: true
        });

        //geocodePostion(marker.getPosition());      

        $('#latitude').val(marker.getPosition().lat());
        $('#longitude').val(marker.getPosition().lng());


        google.maps.event.addListener(marker, 'dragend', function() {

            $('#latitude').val(marker.getPosition().lat());
            $('#longitude').val(marker.getPosition().lng());

            map.setCenter(marker.getPosition());
            //geocodePostion(marker.getPosition());
            console.log("123");
        })
    }

    function geocodePostion(pos) {
        geocoder = new google.maps.Geocoder();
        geocoder.geocode({
                latLng: pos
            },
            function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    $('#location_name').html(results[0].formatted_address);

                    // $('#latitude').val(marker.getPosition().lat());
                    // $('#longitude').val(marker.getPosition().lng());                  
                } else {
                    $('#location_name').html("Location can not fetch");
                }
            });
    }

    function getLocation() {

        console.log("start get location");

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {

        const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
        };

        map.setCenter(pos);

        marker.setPosition(pos);

        $('#latitude').val(position.coords.latitude);
        $('#longitude').val(position.coords.longitude);

    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("لا يوجد اذن للوصول الى اللوكشين");
                //x.innerHTML = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                alert("غير قادر على الوصل الى موقعك");
                //x.innerHTML = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                alert("تجاوز الوقت المسموح به للوصول الى موقعك");
                //x.innerHTML = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                alert("حدث خطأ غير معرو");
                //x.innerHTML = "An unknown error occurred."
                break;
        }
    }

    //getLocation();

    window.initMap = initMap;


    $('#avatar').change(function() {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('#avatar-preview-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });

    $('#cover').change(function() {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('#cover-preview-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });
</script>


@include('client_dashboard.footer')