@include('client_dashboard.header')

<div class="content">

    <h2 class="text-2xl font-bold mb-4">{{__('items')}} > {{ $category->title_ar }}</h2>
    <a href="{{route('dashboard.items.add' , $category_id)}}" class="send_btn">{{__('add_item')}}</a>

    @foreach($items as $item)

    @endforeach

</div>

@include('client_dashboard.footer')