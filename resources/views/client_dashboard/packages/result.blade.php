@include('client_dashboard.header')

<div class="content">

    @if($result == 'error')
        <div class="bg-red-500 text-white w-full rounded-xl min-h-fit p-4">
            <p>{{$message}}</p>
        </div>
    @else
        <div class="bg-yellow-200 w-full rounded-xl min-h-fit p-4">
            <p>{{$message}}</p>
        </div>
    @endif
</div>

@include('client_dashboard.footer')