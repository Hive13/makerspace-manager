</br>
{!! Form::open()->action(url('trans')) !!}
    {!! csrf_field() !!}
    {!! Form::text('Amount (Dollars)','amount') !!}
    <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{env('STRIPE_KEY')}}"
            data-name="{{env('SPACE_NAME')}}"
            data-description="Account Deposit"
            data-image="{{url('img/logo.svg')}}"
            data-locale="auto"
            data-email="{{Auth::User()->email}}"
            >
    </script>
</form>