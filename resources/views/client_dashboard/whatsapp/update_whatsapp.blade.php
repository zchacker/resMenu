@include('client_dashboard.header')
<link rel="stylesheet" itemprop="url" href="{{asset('css/intlTelInput.min.css')}}"/>

<div class="content">
    <h2 class="text-2xl font-bold mb-4">{{__('whatsapp_nofication')}}</h2>
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
        <form action="{{ route('dashboard.whatsapp.update') }}" onsubmit="return form_submit(event)" id="form_submit" method="post" class="w-full" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <input type="submit" value="{{ __('save') }}" class="bg-red-600 text-white rounded-full py-2 px-4" />
            </div>

            <div class="mb-4">
                <label for="allow_whatsapp_orders" class="lable_form ">{{ __('whats_on_off') }}</label>
                <select name="allow_whatsapp_orders" id="allow_whatsapp_orders" class="form_dash_input">
                    <option value="on"  {{ ($restrant->allow_whatsapp_orders === "on")  ? "selected" : "" }} >نعم</option>
                    <option value="off" {{ ($restrant->allow_whatsapp_orders === "off")  ? "selected" : "" }}>لا</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="phone" class="lable_form ">{{ __('whatsapp_number') }}</label>
                <input type="tel" name="whatsapp_number" id="phone" class="form_dash_input text-left" dir="ltr" placeholder="536301031" value="{{ $restrant->whatsapp_number }}" />
            </div>

            <div class="mb-4">
                <label for="wahtsapp_message_body" class="lable_form">{{ __('whatspp_msg') }}</label>
                <textarea name="wahtsapp_message_body" id="wahtsapp_message_body" cols="30" rows="10" class="form_dash_input" placeholder="{{__('whatspp_msg')}}">{{ $restrant->wahtsapp_message_body }}</textarea>
            </div>

            <div class="mb-4">
                <label for="" class="lable_form">{{__('shortcode')}}</label>
                <div class="flex items-center">
                    <input type="text" class="form_dash_input !p-1 ml-2 my-2 !w-[250px]" disabled value="{ORDER_ID}" /> {{__('order_id')}}
                </div>
                <div class="flex items-center">
                    <input type="text" class="form_dash_input !p-1 ml-2 my-2 !w-[250px]" disabled value="{ORDER_DETAILS}" /> {{__('order_details')}}
                </div>
                <div class="flex items-center">
                    <input type="text" class="form_dash_input !p-1 ml-2 my-2 !w-[250px]" disabled value="{CUSTOMER_DETAILS}" /> {{__('client_details')}}
                </div>
                <div class="flex items-center">
                    <input type="text" class="form_dash_input !p-1 ml-2 my-2 !w-[250px]" disabled value="{ORDER_TOTAL}" /> {{__('order_subtotal')}}
                </div>                
            </div>
            

            <div class="mb-4">
                <input type="submit" value="{{ __('save') }}" class="bg-red-600 text-white rounded-full py-2 px-4" />
            </div>

        </form>

    </div>

</div>

<!-- https://github.com/jackocnr/intl-tel-input  -->
<script src="{{asset('js/intlTelInput-jquery.min.js')}}"></script>
<script src="{{asset('js/intlTelInput.min.js')}}"></script>
<script>
    
    /*var input = document.querySelector("#phone");
    
    window.intlTelInput(input, {
        // show dial codes too
        separateDialCode: true,
        // If there are some countries you want to show on the top.
        // here we are promoting russia and singapore.
        preferredCountries: ["sa", "ae" , 'uk', 'us'],
        //Default country
        initialCountry:"sa",
        // show only these countres, remove all other
        //onlyCountries: ["ru", "cn","pk", "sg", "my", "bd"],
        // If there are some countries you want to execlde.
        // here we are exluding india and israel.
        //excludeCountries: ["in","il"]
        
    });

    $('#form_submit').on('submit' , function(){
        if($('#phone').intlTelInput('getNumber')){
            console.log($('#phone').intlTelInput('getNumber'));
            $('#phone').val( $('#phone').intlTelInput('getNumber') );
        }else{
            console.log(' no submit ');
        }

        return false;
    });*/

    $('#phone').intlTelInput({
        
        initialCountry: 'sa',
        separateDialCode: true,
        preferredCountries: ["sa", "ae" , 'uk', 'us'],
        utilsScript : "{{asset('js/utils.js')}}",
        
    });    

    function form_submit(e) {
        

        if($('#phone').intlTelInput("getNumber")) {
            $('#phone').val($('#phone').intlTelInput("getNumber"));
            return true;
        }else{
            e.preventDefault();
            alert('الرجاء ادخال رقم هاتف صحيح');
            return false;
        }
        
    }

</script>
@include('client_dashboard.footer')