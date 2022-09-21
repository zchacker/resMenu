@include('client_dashboard.header')

<div class="content">
    <div class="bg-yellow-200 w-full rounded-xl min-h-fit p-4">
        <!-- grid md:grid-cols-1 grid-cols-1 -->
        <div class="bloack">
            <h1 class="font-bold text-xl text-center my-5">الدفع للاشتراك</h1>
            <h2 class="font-bold text-right my-4">الإجمالي: <span class="text-red-500 font-bold text-2xl my-5">{{$priceValue}}</span> ريال</h2>
            <div id="card-element" class="h-[330px]"></div>
            <button onclick="submit()" id="paymentBtn" class="bg-green-400 font-bold text-xl text-white text-center rounded-md w-1/2 mx-auto p-2">أدفع الان</button>
        </div>
    </div>
</div>


<!-- Test Environment -->
<script src="{{asset('js/app.js')}}"></script>
<script src="https://demo.myfatoorah.com/cardview/v1/session.js"></script>

<script>
    var config = {
        countryCode: "{{$CountryCode}}", // Here, add your Country Code.
        sessionId: "{{$SessionId}}", // Here you add the "SessionId" you receive from InitiateSession Endpoint.
        cardViewId: "card-element",
        // The following style is optional.
        style: {
            direction: "rtl",
            cardHeight: 250,
            input: {
                color: "black",
                fontSize: "13px",
                fontFamily: "sans-serif",
                inputHeight: "42px",
                inputMargin: "5px",
                borderColor: "c7c7c7",
                borderWidth: "1px",
                borderRadius: "8px",
                boxShadow: "",
                placeHolder: {
                    holderName: "الاسم على البطاقة",
                    cardNumber: "رقم البطاقة",
                    expiryDate: "الشهر / السنة",
                    securityCode: "الكود السري",
                }
            },
            label: {
                display: false,
                color: "black",
                fontSize: "13px",
                fontWeight: "normal",
                fontFamily: "sans-serif",
                text: {
                    holderName: "Card Holder Name",
                    cardNumber: "Card Number",
                    expiryDate: "Expiry Date",
                    securityCode: "Security Code",
                },
            },
            error: {
                borderColor: "red",
                borderRadius: "8px",
                boxShadow: "0px",
            },
        },
    };
    myFatoorah.init(config);

    var paymentBtn = $('#paymentBtn');

    function submit() {
                
        paymentBtn.attr("disabled", true);

        myFatoorah.submit()
            // On success
            .then(function(response) {
                
                //console.log(response);

                // Here you need to pass session id to you backend here
                var sessionId = response.SessionId;
                var cardBrand = response.CardBrand;
                
                send_payment(sessionId , cardBrand);

                //alert('sessionId: ' + sessionId + ' cardBrand: ' + cardBrand);

            })
            // In case of errors
            .catch(function(error) {
                paymentBtn.removeAttr("disabled");
                alert("erorr:" + error)
                console.log(error);
            });
    }


    function send_payment(sessionId , cardBrand)
    {
        $.ajax('{{route("dashboard.package.pay.submit")}}', {
            
            type: 'POST', // http method
            dataType: 'json',
            data: {

                _token: '{{ csrf_token() }}',
                sessionId: sessionId,                
                cardBrand: cardBrand,

            }, // data to submit
            success: function(data, status, xhr) {
                
                console.log(data);
                
                if( data.success ) {                        
                    
                    location.replace(data.url);

                }else{

                    paymentBtn.removeAttr("disabled");
                    alert(data.error);
                
                }

            },
            error: function(jqXhr, textStatus, errorMessage) {
                                    
                alert("حدث خطأ غير متوقع حاول لاحقاً");
                console.log('server error: ', [errorMessage]);
                paymentBtn.removeAttr("disabled");

            }
        });
    }

</script>

@include('client_dashboard.footer')