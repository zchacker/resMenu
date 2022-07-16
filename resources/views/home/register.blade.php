@include('home.header')

    <section title="page header" class="grid w-full min-h-[400px] px-[10%] py-[5%] bg-white">
        <h2 class="text-3xl font-bold text-black text-right">{{ __('register') }}</h2>
        @if(Session::has('errors'))
            <div class="my-3 w-1/3 p-4 bg-orange-500 text-white rounded-md">
                {{session('errors')->first('used_email_err')}}
            </div>
        @endif
        <div class="block lg:flex m-2 overflow-x-auto my-5">
            
            <form action="{{ route('submit.register') }}" method="post" class="w-full">
                @csrf
                <div class="mb-4">
                    <label for="name" class="lable_form">{{ __('name') }}</label>
                    <input type="text" name="name" class="form_input"/>
                </div>

                <div class="mb-4">
                    <label for="email" class="lable_form">{{ __('email') }}</label>
                    <input type="text" name="email" class="form_input"/>
                </div>

                <div class="mb-4">
                    <label for="phone" class="lable_form">{{ __('phone') }}</label>
                    <input type="text" name="phone" class="form_input"/>
                </div>

                <div class="mb-4">
                    <label for="password" class="lable_form">{{ __('password') }}</label>
                    <input type="password" name="password" class="form_input"/>
                </div>

                <div class="mb-4">
                    <input type="submit" value="{{ __('create_account') }}" class="bg-red-600 text-white rounded-full py-2 px-4" />
                </div>

            </form>
            
        </div>
    </section>

@include('home.footer')