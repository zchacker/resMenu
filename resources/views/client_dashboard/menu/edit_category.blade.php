@include('client_dashboard.header')

<div class="content">
    <h2 class="text-2xl font-bold mb-4">{{__('edit_category')}}</h2>
    
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

    <div class="bg-gray-800 w-full rounded-xl min-h-fit p-4">
        <form action="{{ route('dashboard.categories.edit.submit') }}" method="post" class="w-full">
            @csrf

            <div class="mb-4">
                <label for="name" class="lable_form !text-gray-300">{{ __('category_name') }}</label>
                <input type="text" name="name" class="form_dash_input" placeholder="{{ __('category_name') }}" value="{{ $category->name }}" />
            </div>

            <div class="mb-4">
                <input type="submit" value="{{ __('save') }}" class="bg-red-600 text-white rounded-full py-2 px-4" />
            </div>

        </form>
    </div>
    
</div>

@include('client_dashboard.footer')