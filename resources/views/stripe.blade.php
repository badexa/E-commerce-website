@extends('layouts.user')

@section('title', 'Boutique d\'accessoires pour voitures')

@section('contents')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Total amount to pay ---> {{ $totaleprice }} $</h1>
    <div class="w-full max-w-sm mx-auto">
        <div class="bg-white shadow-md rounded-lg px-8 py-12">
            @if (Session::has('success'))
                <div class="alert alert-success text-center mb-4">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    {{ Session::get('success') }}
                </div>
            @endif
            <form role="form" action="{{ route('stripe.post', $totaleprice) }}" method="post" class="require-validation"
                data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-800 font-bold mb-2">Name on Card</label>
                    <input class="appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 focus:outline-none focus:border-blue-500"
                        type="text" size="4" name="name">
                </div>

                <div class="mb-4">
<label class="block text-gray-800 font-bold mb-2">Card Number</label>
                    <input autocomplete="off" class="appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 focus:outline-none focus:border-blue-500 card-number"
                        type="text" size="20" name="card_number">
                </div>

                <div class="flex mb-4">
                    <div class="mr-4">
                        <label class="block text-gray-800 font-bold mb-2">Expiration Month</label>
                        <input class="appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 focus:outline-none focus:border-blue-500 card-expiry-month"
                            type="text" size="2" name="expiry_month">
                    </div>
                    <div class="mr-4">
                        <label class="block text-gray-800 font-bold mb-2">Expiration Year</label>
                        <input class="appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 focus:outline-none focus:border-blue-500 card-expiry-year"
                            type="text" size="4" name="expiry_year">
                    </div>
                    <div class="">
                        <label class="block text-gray-800 font-bold mb-2">CVC</label>
                        <input autocomplete="off" class="appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 focus:outline-none focus:border-blue-500 card-cvc"
                            type="text" size="4" name="cvc">
                    </div>
                </div>

                <div class="mb-6">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now ({{ $totaleprice }}$)</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(function () {
        /*------------------------------------------
        --------------------------------------------
        Stripe Payment Code
        --------------------------------------------
        --------------------------------------------*/
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function (e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('hide');
            $('.has-error').removeClass('has-error');
            $inputs.each(function (i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });
            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }
        });
      
        /*------------------------------------------
        --------------------------------------------
        Stripe Response Handler--------------------------------------------
        --------------------------------------------*/
        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    });
</script>
@endsection