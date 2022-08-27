@include('home.header')

    <section title="page header" class="grid z-0 mt-[20px] w-full min-h-[400px] h-[600px] px-[10%] py-[5%] bg-white">
        <h2 class="text-3xl font-bold text-black text-right">{{ __('login') }}</h2>
        
        @if(Session::has('success'))
            <div class="my-3 w-2/4 p-1 h-1/2 items-center bg-green-600 text-green-200 rounded-md">
                {!! session('success') !!}
            </div>
        @endif

        @if(Session::has('errors'))
            <div class="my-3 w-2/4 p-4 bg-orange-500 text-white rounded-md">
                {!! session('errors')->first('login_error') !!}
            </div>
        @endif
        
        <div class="block lg:flex m-2 overflow-x-auto my-5">
            
            <form action="{{ route('submit.login') }}" method="post" class="w-full">
                @csrf
                <div class="mb-4">
                    <label for="email" class="lable_form">{{ __('email') }}</label>
                    <input type="text" name="email" class="form_input" value="{{ old('email') }}"/>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="lable_form">{{ __('password') }}</label>
                    <input type="password" name="password" class="form_input"/>
                </div>

                <div class="mb-4">
                    <input type="submit" value="{{ __('login_btn') }}" class="bg-red-600 text-white rounded-full py-2 px-4" />
                </div>

                <div class="mb-4 flex justify-between w-3/12">
                    <a href="{{ route('register' , app()->getLocale() ) }}" title="{{__('register')}}" class="link">{{__('register')}}</a>
                    <span> . </span>
                    <a href="{{ route('forgotPassword' , app()->getLocale() ) }}" title="{{__('forgot_password')}}" class="link">{{__('forgot_password')}}</a>
                </div>
            </form>
            
        </div>
    </section>

@include('home.footer')