$(document).ready(function () {
    $('#RMQ-btnPay').click(function(){
        var host = window.location.origin;
        var amount = $('#RMQ-moneyInput__amount').val();

        if(amount != '' && host != ''){
            $.ajax({
                method: "POST",
                url: host + '/router.php',
                data: {
                    route: "sendPayment",
                    body: {
                        amount: amount,
                        currency: "EUR"
                    }
                }
            })
                .done(function (msg) {
                    console.log("Data Saved!");
                });
        }

    });
});