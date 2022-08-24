@include('client_dashboard.header')

<div class="content">
    <h2 class="text-2xl font-bold mb-4">{{__('qr')}}</h2>
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
        <div class="grid md:grid-cols-2 grid-cols-1">
            <div class="p-3">
                @if($restrant->slug != NULL)

                    @if(strlen($avatar_img) == 0 )

                        @php
                            // https://www.simplesoftware.io/#/docs/simple-qrcode                            
                            $img = route('image.displayImage', $avatar_img);
                            $qr = base64_encode( QrCode::style('round')->errorCorrection('M')->format('png')->encoding('UTF-8')->backgroundColor( 255, 255, 255 )->color( 191, 2, 39 , 90)->size(300)->generate( route('menu' , $restrant->slug) ) );
                            //$qr_download = base64_encode( QrCode::style('round')->errorCorrection('H')->format('png')->encoding('UTF-8')->backgroundColor( 255, 255, 255 )->color( 191, 2, 39 , 90)->size(1024)->generate( route('menu' , $restrant->slug) ) );
                        @endphp

                        <!-- {{QrCode::errorCorrection('H')->encoding('UTF-8')->color(88 ,77, 179,  100)->size(300)->generate('https://www.google.com/')}} -->
                        <img src="data:image/png;base64,{{ $qr }}" id="img" class="w-[300px] h-[300px] my-4 border border-gray-500 rounded-md p-2 bg-white">

                        <a href="data:image/png;base64, {{ $qr }}" id="download" download="qr_code.png" class="send_btn"><i class="las la-download "></i>{{__('download')}}</a>

                    @else

                        @php
                            // https://www.simplesoftware.io/#/docs/simple-qrcode
                            $size = $restrant->qr_size / 100;
                            $img = route('image.displayImage', $avatar_img);
                            $qr = base64_encode( QrCode::style('round')->errorCorrection('M')->format('png')->merge("$img" , $size , true)->encoding('UTF-8')->backgroundColor( 255, 255, 255 )->color( 191, 2, 39 , 90)->size(512)->generate( route('menu' , $restrant->slug) ) );
                            //$qr_download = base64_encode( QrCode::style('round')->errorCorrection('H')->format('png')->merge("$img" , $size , true)->encoding('UTF-8')->backgroundColor( 255, 255, 255 )->color( 191, 2, 39 , 90)->size(1024)->generate( route('menu' , $restrant->slug) ) );

                            if( $restrant->qr_with_logo == 'off'){
                                $qr = base64_encode( QrCode::style('round')->errorCorrection('M')->format('png')->encoding('UTF-8')->backgroundColor( 255, 255, 255 )->color( 191, 2, 39 , 90)->size(300)->generate( route('menu' , $restrant->slug) ) );
                                //$qr_download = base64_encode( QrCode::style('round')->errorCorrection('H')->format('png')->encoding('UTF-8')->backgroundColor( 255, 255, 255 )->color( 191, 2, 39 , 90)->size(1024)->generate( route('menu' , $restrant->slug) ) );
                            }
                        @endphp

                        <!-- {{QrCode::errorCorrection('H')->encoding('UTF-8')->color(88 ,77, 179,  100)->size(300)->generate('https://www.google.com/')}} -->
                        <img src="data:image/png;base64,{{ $qr }}" id="img" class="w-[300px] h-[300px] my-4 border border-gray-500 rounded-md p-2 bg-white">

                        <a href="data:image/png;base64, {{ $qr }}" id="download" download="qr_code.png" class="send_btn"><i class="las la-download "></i>{{__('download')}}</a>

                    @endif

                @else
                    <div>
                        <p class="pb-8">{{ __('no_qr') }}</p>
                        <a href="{{ route('dashboard.shop') }}" class="normal_button" > إنشاء رابط للمتجر </a>
                    </div>
                @endif
            </div>
            <div class="p-3">   
                <form action="{{ route('dashboard.qr.submit') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="" class="lable_form"> مقاس الشعار </label>
                        <div class="flex">
                            <input type="number" name="qr_size" class="form_input !w-[70px] !p-2" value="{{ $restrant->qr_size }}" />
                            <span class="p-2 items-center text-2xl">%</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="" class="lable_form"> عرض الشعار </label>
                        <select name="qr_with_logo" class="form_input">
                            <option value="on"  {{ ($restrant->qr_with_logo === "on" )  ? "selected" : "" }}>{{ __('on') }}</option>
                            <option value="off" {{ ($restrant->qr_with_logo === "off")  ? "selected" : "" }}>{{ __('off') }}</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <input type="submit" value="{{ __('save') }}" class="send_btn" />
                    </div>

                </form>
            </div>
        </div>



    </div>

</div>


@include('client_dashboard.footer')