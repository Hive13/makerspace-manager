</br>
<form action="{{url('trans')}}" method="POST">
    {!! csrf_field() !!}
    <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{env('STRIPE_KEY')}}"
            data-amount="1000"
            data-name="{{env('SPACE_NAME')}}"
            data-description="Account Deposit ($10.00)"
            data-image="{{url('img/logo.svg')}}"
            data-locale="auto"
            data-email="{{Auth::User()->email}}"
            >
    </script>
</form>