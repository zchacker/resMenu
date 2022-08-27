@include('home.header')

<section title="page header" class="grid z-0 mt-[20px] w-full min-h-[400px] h-[600px] px-[10%] py-[5%] bg-white">
        <h2 class="text-3xl font-bold text-black text-right">{{ __('update_password') }}</h2>
        
        @if(Session::has('success'))
            <div class="my-3 w-2/4 p-1 h-1/2 items-center bg-green-600 text-green-200 rounded-md">
                {!! session('success') !!}
            </div>
        @endif

        @if(Session::has('errors'))
            <div class="my-3 w-2/4 p-1 h-1/2 items-center bg-green-600 text-green-200 rounded-md">
                {{ __('forgot_pass_sent') }}
            </div>
        @endif

        <div class="block lg:flex m-2 overflow-x-auto my-5">
            
            <form action="{{ route('forgotPassword.submit' , app()->getLocale()) }}" method="post" class="w-full">
                @csrf

                <input type="hidden" name="id" value="{{ $id }}">

                <input type="hidden" name="token" value="{{ $token }}">
                
                <div class="mb-4">
                    <label for="password" class="lable_form">{{ __('password') }}</label>
                    <input type="password" name="password" class="form_input" required/>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="lable_form">{{ __('re-password') }}</label>
                    <input type="password" name="password" class="form_input" required/>
                </div>  

                <div class="mb-4">
                    <input type="submit" value="{{ __('send') }}" class="bg-red-600 text-white rounded-full py-2 px-4" />
                </div>

                <div class="mb-4">
                    <a href="{{ route('login' , app()->getLocale() ) }}" title="{{__('login')}}" class="link">{{__('login')}}</a>
                </div>
                
            </form>
            
        </div>
    </section>

@include('home.footer')