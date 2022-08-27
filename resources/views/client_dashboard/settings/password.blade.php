@include('client_dashboard.header')

<div class="content">
    <h2 class="text-2xl font-bold mb-4">{{__('update_password')}}</h2>
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
        <form action="{{ route('dashboard.password.update') }}" onsubmit="return form_submit(event)" id="form_submit" method="post" class="w-full" enctype="multipart/form-data">

            @csrf
            
            <div class="mb-4">
                <label for="current-password" class="lable_form">{{ __('current-password') }}</label>
                <input type="password" name="current-password" id="current-password" class="form_dash_input" placeholder="******"  />
            </div>

            <div class="mb-4">
                <label for="new-password" class="lable_form ">{{ __('new-password') }}</label>
                <input type="password" name="new-password" id="new-password" class="form_dash_input" placeholder="******"  />
            </div>                        

            <div class="mb-4">
                <input type="submit" value="{{ __('save') }}" class="bg-red-600 text-white rounded-full py-2 px-8" />
            </div>

        </form>

    </div>

</div>


@include('client_dashboard.footer')