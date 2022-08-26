@include('client_dashboard.header')

<div class="content">
    <h2 class="text-2xl font-bold mb-4">{{__('personal_info')}}</h2>
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
        <form action="{{ route('dashboard.settings.update') }}" onsubmit="return form_submit(event)" id="form_submit" method="post" class="w-full" enctype="multipart/form-data">

            @csrf
            

            <div class="mb-4">
                <label for="name" class="lable_form">{{ __('name') }}</label>
                <input type="text" name="name" id="name" class="form_dash_input" placeholder="محمد احمد" value="{{ $user_info->name }}" />
            </div>

            <div class="mb-4">
                <label for="email" class="lable_form ">{{ __('email') }}</label>
                <input type="email" name="email" id="email" class="form_dash_input" placeholder="example@gmail.com" value="{{ $user_info->email }}" />
            </div>                        

            <div class="mb-4">
                <input type="submit" value="{{ __('save') }}" class="bg-red-600 text-white rounded-full py-2 px-4" />
            </div>

        </form>

    </div>

</div>


@include('client_dashboard.footer')