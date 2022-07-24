@include('client_dashboard.header')

<div class="content">
    <h2 class="text-2xl font-bold mb-4">{{__('categories')}}</h2>
    <a href="{{route('dashboard.categories.add')}}" class="send_btn">{{__('add_category')}}</a>

    @foreach($categories as $category)
        <div class="flex justify-between shadow-md rounded-md p-3 mt-4 border border-gray-300 text-black">
            <a href="javascript:void()" class="w-full h-full">
                <p class="font-bold">{{ $category->title_ar }}</p>
            </a>
            <a href="{{ route('dashboard.categories.edit') }}/{{ $category->id }}" class="text-orange-600 mx-2 font-bold hover:underline">{{ __('edit') }}</a>
            <a href="{{ route('dashboard.categories.delete') }}/{{ $category->id }}" class="text-red-600 mx-2 font-bold hover:underline">{{ __('delete') }}</a>
        </div>        
    @endforeach

</div>

@include('client_dashboard.footer')