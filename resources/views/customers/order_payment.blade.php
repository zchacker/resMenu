<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>ملخص الطلب و الدفع</title>
</head>

<body>
    <div class="bg-blue-100 w-full h-screen pt-5">
        <div class="md:w-1/2 px-2 mx-auto text-center">
            <h1 class="font-bold text-xl text-center my-5">الدفع للطلب</h1>
            <h2 class="font-bold text-right my-4">الإجمالي: <span class="text-red-500 font-bold text-2xl my-5">{{$sub_total}}</span> ريال</h2>
            <div id="card-element" class="h-[330px]"></div>
            <button onclick="submit()" class="bg-green-400 font-bold text-xl text-white text-center rounded-md w-1/2 mx-auto p-2">أدفع الان</button>
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

        function submit() {
            myFatoorah.submit()
                // On success
                .then(function(response) {
                    // Here you need to pass session id to you backend here
                    var sessionId = response.SessionId;
                    var cardBrand = response.CardBrand;
                    
                    send_payment(sessionId , cardBrand);

                    //alert('sessionId: ' + sessionId + ' cardBrand: ' + cardBrand);

                })
                // In case of errors
                .catch(function(error) {
                    alert("erorr:" + error)
                    console.log(error);
                });
        }


        function send_payment(sessionId , cardBrand)
        {
            $.ajax('{{route("order.pay")}}', {
                
                type: 'POST', // http method
                dataType: 'json',
                data: {

                    _token: '{{ csrf_token() }}',
                    sessionId: sessionId,
                    order_id: '{{$order_id}}',
                    cardBrand: cardBrand,

                }, // data to submit
                success: function(data, status, xhr) {
                    
                    console.log(data);
                    
                    if( data.success ) {                        
                        
                        location.replace(data.url);

                    }else{

                        alert(data.error);
                    
                    }

                },
                error: function(jqXhr, textStatus, errorMessage) {
                                        
                    alert("حدث خطأ غير متوقع حاول لاحقاً");
                    console.log('server error: ', [errorMessage]);

                }
            });
        }

    </script>

</body>

</html>