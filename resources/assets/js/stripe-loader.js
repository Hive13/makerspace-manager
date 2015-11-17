/**
 * Created by tylergetsay on 11/16/15.
 */
function stripeLoader(data) {
    console.log($(data));
    var handler = StripeCheckout.configure({
        key: $(data).attr('data-key'),
        image: $(data).attr('data-image'),
        locale: 'auto',
        email: $(data).attr('data-email'),
        token: function (response) {
            console.log(response);
            var $form = $('#stripeCheckoutForm');
            if (response.error) {
                $form.find('.payment-errors').text(response.error.message);
                $form.find('button').prop('disabled', false);
            } else {
                // response contains id and card, which contains additional card details
                var token = response.id;
                // Insert the token into the form so it gets submitted to the server
                $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                // and submit
                $form.get(0).submit();
            }
        }
    });

    $('#stripeCheckout').on('click', function (e) {
        // Open Checkout with further options
        handler.open({
            name: $(data).attr('data-name'),
            description: 'Account Deposit'
        });
        e.preventDefault();
    });

    // Close Checkout on page navigation
    $(window).on('popstate', function () {
        handler.close();
    });
}
