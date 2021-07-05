<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Script -->
    <script src="{{asset('js/checkout.js')}}"></script>

</head>
<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="payment">
        <div class="payment-container">

            @if (session('success_message'))
                <div>
                    {{ session('success_message') }}
                </div>
            @endif

            <div class="flex-center position-ref full-height">

                <div class="payment-header">
                    <div class="top-right links">
                        <form autocomplete="off" onsubmit="return confirm('Se torni indietro perderai i dati del tuo carrello');" action="{{ url('/') }}" method="get">
                            <button class="cancel-pay-btn" type="submit">Annulla e vai alla Home</button>
                        </form>
                        <a class="btn btn-primary mx-3" v-on:click="populateForm">test data</a>
                    </div>
                </div>

                <div class="content">
                    <form autocomplete="off" method="post" id="payment-form"
                    v-if="confirmPrice == {{$totPrice}}"
                    action="{{ route('checkouts.transaction', [$totPrice, $dishes_ids]) }}">
                    @csrf
                        <section>

                            <div class="payment-recap">
                                <div class="payment-title">
                                    Riepilogo ordine:
                                </div>

                                <div class="order-recap">
                                    <div class="input-label">
                                        Totale da Pagare:
                                    </div>
                                    <div class="input-wrapper amount-wrapper">
                                        {{ $totPrice }} €
                                    </div>
                                </div>

                                <div class="payment-info-rider">
                                    <div class="payment-ta">

                                        <label for="notes">
                                            <div class="text-center">
                                                Note:
                                            </div>

                                            <textarea name="notes" id="notes" cols="30" rows="3" :value="testNote">

                                            </textarea>


                                        <label for="delivery_address">
                                    </div>

                                    <div class="payment-da">
                                        <div class="text-center">
                                            Indirizzo di spedizione:
                                        </div>
                                        <input name="delivery_address" id="delivery_address" required type="text" :value="testAddress">
                                    </div>

                                    <div class="payment-da">
                                        <div class="text-center">
                                            Nome sul campanello:
                                        </div>
                                        <input name="doorbell_name" id="doorbell_name" required type="text" :value="testDoorbell">
                                    </div>

                                    <div class="payment-da">
                                        <div class="text-center">
                                            email:
                                        </div>
                                        <input name="email" id="email" required type="text" :value="testEmail">
                                    </div>


                                    <div class="payment-da">
                                        <div class="text-center">
                                            Telefono:
                                        </div>
                                        <input name="telephone" id="telephone" required type="text" :value="testPhone">
                                    </div>
                                </div>
                            </div>

                            <div class="bt-drop-in-wrapper">
                                <div id="bt-dropin" class="payment-credit-card"></div>
                            </div>
                        </section>

                        <div class="hide-button">
                            <input id="nonce" name="payment_method_nonce" type="hidden" />
                            <button class="btn btn-primary paybutton" type="submit">Procedi al pagamento</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        new Vue({
            el: '#payment',

            data: function () {
                return {
                    confirmPrice: null,
                    testNote: '',
                    testAddress: '',
                    testDoorbell: '',
                    testEmail: '',
                    testPhone: '',
                }
            },
            methods: {
                populateForm: function() {
                    this.testNote = 'Secondo portocinto a destra, secondo piano';
                    this.testAddress = 'via Giacomo Leopardi 41';
                    this.testDoorbell = 'Gaudenti';
                    this.testEmail = 'gaudenti@mail.com';
                    this.testPhone = '3459258963';
                }
            },
            mounted() {
                if(localStorage.getItem('totSessionPrice') == {{ $totPrice }}) {
                    this.confirmPrice = {{ $totPrice }};
                }
            },            
        });
    </script>
    <script src="https://js.braintreegateway.com/web/dropin/1.30.1/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";

        braintree.dropin.create({
        authorization: client_token,
        selector: '#bt-dropin',
        // paypal: {
        //     flow: 'vault'
        // }
        }, function (createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                }

                // Add the nonce to the form and submit
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();
                });
            });
        });
    </script>
</body>
</html>
