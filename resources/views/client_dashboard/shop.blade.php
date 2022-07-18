@include('client_dashboard.header')

<div class="content">
    <h2 class="text-2xl font-bold mb-4">{{__('manage_shop')}}</h2>

    <div class="bg-gray-800 w-full rounded-xl min-h-fit p-4">
        <form action="{{ route('submit.login') }}" method="post" class="w-full">
            @csrf
            <div class="mb-4">
                <input type="submit" value="{{ __('save') }}" class="bg-red-600 text-white rounded-full py-2 px-4" />
            </div>

            <div class="mb-4">
                <label for="name" class="lable_form !text-gray-300">{{ __('shop_name') }}</label>
                <input type="text" name="name" class="form_dash_input" placeholder="{{ __('shop_name') }}" value="{{ old('name') }}"/>
            </div>

            <div class="mb-4">
                <label for="name" class="lable_form !text-gray-300">{{ __('slag') }}</label>
                <input type="text" name="slag" class="form_dash_input" placeholder="{{ __('slag') }}" value="{{ old('name') }}"/>
            </div>

            <div class="mb-4">
                <label for="message" class="lable_form !text-gray-300">{{ __('shop_message') }}</label>                
                <textarea name="message" id="" cols="30" rows="10" class="form_dash_input" placeholder="{{__('shop_message')}}"></textarea>
            </div>

            <div class="lg:flex">
                <div class="mb-4 lg:mx-2 lg:w-1/2">
                    <label for="address" class="lable_form !text-gray-300">{{ __('shop_address') }}</label>                    
                    <input type="text" name="address" class="form_dash_input" placeholder="{{__('shop_address')}}" value="{{ old('address') }}"/>
                </div>

                <div class="mb-4 lg:mx-2 lg:w-1/2">
                    <label for="message" class="lable_form !text-gray-300">{{ __('phone') }}</label>
                    <input type="tel" name="phone" class="form_dash_input" placeholder="{{__('phone')}}" value="{{ old('phone') }}"/>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="password" class="lable_form !text-gray-300">{{ __('password') }}</label>
                <input type="password" name="password" class="form_dash_input"/>
            </div>

            <div class="mb-4">
                <input type="submit" value="{{ __('save') }}" class="bg-red-600 text-white rounded-full py-2 px-4" />
            </div>
            
        </form>

    </div>
    
</div>

@include('client_dashboard.footer')