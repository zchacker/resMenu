@include('home.header')
<link rel="stylesheet" itemprop="url" href="{{asset('css/intlTelInput.min.css')}}"/>

    <section title="page header" class="w-full min-h-[800px] mt-[20px] px-[10%] py-[2%] bg-white">
        <h2 class="text-3xl font-bold text-black text-right">{{ __('register') }}</h2>
        @if(Session::has('errors'))
            <div class="my-3 w-2/4 p-4 bg-orange-500 text-white rounded-md">
                {!! session('errors')->first('register_error') !!}
            </div>
        @endif
        <div class="block lg:flex m-2 overflow-x-auto my-2 md:my-5">
            
            <form action="{{ route('submit.register') }}" method="post" class="w-full">
                @csrf
                <div class="mb-4">
                    <label for="name" class="lable_form">{{ __('name') }}</label>
                    <input type="text" name="name" class="form_input" value="{{ old('name') }}"/>
                </div>

                <div class="mb-4">
                    <label for="email" class="lable_form">{{ __('email') }}</label>
                    <input type="text" name="email" class="form_input" value="{{ old('email') }}"/>
                </div>

                <div class="mb-4">
                    <label for="phone" class="lable_form">{{ __('phone') }}</label>
                    <input type="text" name="phone" id="phone" class="form_dash_input !border-blue-500 text-left" dir="ltr" value="{{ old('phone') }}"/>
                </div>

                <div class="mb-4">
                    <label for="password" class="lable_form">{{ __('password') }}</label>
                    <input type="password" name="password" class="form_input"/>
                </div>

                <div class="mb-4">
                    <input type="submit" value="{{ __('create_account') }}" class="bg-red-600 text-white rounded-full py-2 px-4" />
                </div>

                <div class="mb-4">
                    <a href="{{ route('login' , app()->getLocale() ) }}" title="{{__('login')}}" class="link">{{__('login')}}</a>
                </div>

            </form>
            
        </div>
    </section>


<!-- https://github.com/jackocnr/intl-tel-input  -->
<script src="{{asset('js/intlTelInput-jquery.min.js')}}"></script>
<script src="{{asset('js/intlTelInput.min.js')}}"></script>
<script>

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
@include('home.footer')