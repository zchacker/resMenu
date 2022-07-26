@include('client_dashboard.header')

<div class="content">
    <a href="{{ route('dashboard.items' , $category_id) }}" class="text-blue-500 text-lg">{{__('back')}}</a>
    <h2 class="text-2xl font-bold mb-4">{{__('add_item')}}</h2>
    
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
        <form action="{{ route('dashboard.items.add.submit' , $category_id) }}" method="post"  enctype="multipart/form-data" class="w-full">
            @csrf            

            <div class="mb-4">
                <label for="name" class="lable_form !text-gray-300">{{ __('item_name') }}</label>
                <input type="text" name="name" class="form_dash_input" placeholder="{{ __('category_name') }}" value="" />
            </div>

            <div class="mb-4">
                <label for="name" class="lable_form !text-gray-300">{{ __('item_description') }}</label>
                <textarea name="description" id="" cols="30" rows="10" class="form_dash_input" placeholder="{{__('item_description')}}"></textarea>                
            </div>

            <div class="mb-4">
                <label for="name" class="lable_form !text-gray-300">{{ __('item_price') }}</label>
                <input type="text" name="price" class="form_dash_input" placeholder="{{ __('item_price') }}" value="" />
            </div>

            <div class="mb-4">
                <label for="name" class="lable_form !text-gray-300">{{ __('item_offer_price') }}</label>
                <input type="text" name="offer_price" class="form_dash_input" placeholder="{{ __('item_offer_price') }}" value="" />
            </div>

            <div class="mb-4">
                <label for="name" class="lable_form !text-gray-300">{{ __('item_img') }}</label>
                <input type="file" name="item_img" class="form_dash_input" placeholder="{{ __('item_img') }}" value="" />
            </div>

            <div class="mb-4">
                <input type="submit" value="{{ __('save') }}" class="bg-red-600 text-white rounded-full py-2 px-4" />
            </div>

        </form>
    </div>
    
</div>

@include('client_dashboard.footer')