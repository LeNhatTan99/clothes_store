
// change value number
    $('.btn-number').click(function(e){
    e.preventDefault();

    fieldName = $(this).attr('data-field');
    type     = $(this).attr('data-type');
     var input = $("input[id='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {

            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
                $(this).attr('disabled', false);
            }

        }
    } else {
        input.val(0);
    }
});

// change product qty list cart
      function updateItemCart(id) {
        var url = 'updateItemCart/'+id.id+'/'+id.value;
       window.location.href = url
    }


// show and hidem btn check out
        function validate(){
            var payment = document.getElementById('radio-payment');
            var order = document.getElementById('radio-order');
            var btnPayment = document.getElementById('payment');
            var btnOrder = document.getElementById('order');
            if (payment.checked) {
                btnPayment.style.display = "block";
                btnOrder.style.display = "none";
         } else if(order.checked) {
            btnPayment.style.display = "none";
            btnOrder.style.display = "block";
            }
        }
