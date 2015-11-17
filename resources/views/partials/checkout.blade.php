</br>
{!! Form::open()->action(url('trans'))->id('stripeCheckoutForm') !!}
{!! csrf_field() !!}
{!! Form::text('Amount (Dollars)','amount') !!}
<div class="javascript-function" data-function="stripeLoader" data-key="{{env('STRIPE_KEY')}}"
     data-name="{{env('SPACE_NAME')}}" data-image="{{url('img/logo.svg')}}" data-email="{{Auth::User()->email}}"></div>
<a id="stripeCheckout" class="btn btn-success">Checkout</a>
</form>


