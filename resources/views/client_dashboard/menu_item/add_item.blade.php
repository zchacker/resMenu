@include('client_dashboard.header')

<div class="content">

    <a href="{{ route('dashboard.items' , $category_id) }}" class="text-white my-4 text-lg items-center px-5 py-1 bg-green-500 rounded-full"><i class="las la-arrow-right"> {{__('back')}} </i></a>
    
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

    <div class="bg-yellow-200 w-full rounded-xl min-h-fit p-4">
        <form action="{{ route('dashboard.items.add.submit' , $category_id) }}" method="post"  enctype="multipart/form-data" class="w-full">
            @csrf            

            <div class="mb-4">
                <label for="name" class="lable_form ">{{ __('item_name') }}</label>
                <input type="text" name="name" class="form_dash_input" placeholder="{{ __('category_name') }}" value="{{old('name')}}" />
            </div>

            <div class="mb-4">
                <label for="name" class="lable_form ">{{ __('item_description') }}</label>
                <textarea name="description" id="" cols="30" rows="10" class="form_dash_input" placeholder="{{__('item_description')}}">{{old('description')}}</textarea>                
            </div>

            <div class="mb-4">
                <label for="name" class="lable_form ">{{ __('item_price') }}</label>
                <input type="text" name="price" class="form_dash_input" placeholder="{{ __('item_price') }}" value="{{old('price')}}" />
            </div>

            <div class="mb-4">
                <label for="name" class="lable_form ">{{ __('item_offer_price') }}</label>
                <input type="text" name="offer_price" class="form_dash_input" placeholder="{{ __('item_offer_price') }}" value="{{old('offer_price')}}" />
            </div>

            <div class="mb-4">
                <img src="{{asset('img/image.png')}}" alt="" id="preview-image" class="md:w-[400px] h-[400px] border-2 border-double border-gray-400 p-2 bg-white object-cover rounded-md" />
            </div>

            <div class="mb-4">
                <label for="name" class="lable_form ">{{ __('item_img') }}</label>
                <input type="file" id="image" name="item_img" class="form_dash_input" placeholder="{{ __('item_img') }}" value="{{old('item_img')}}" />
            </div>

            <div class="mb-4">
                <input type="submit" value="{{ __('save') }}" class="bg-red-600 text-white rounded-full py-2 px-4" />
            </div>

        </form>
    </div>
    
</div>

<script type="text/javascript">
    $('#image').change(function(){
            
    let reader = new FileReader();
    reader.onload = (e) => { 
        $('#preview-image').attr('src', e.target.result); 
    }
    reader.readAsDataURL(this.files[0]); 

    });
</script>

@include('client_dashboard.footer')