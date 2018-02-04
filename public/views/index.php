<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RMQPHP</title>
    <link rel="stylesheet" type="text/css" href="src/styles/style.css">
</head>
<body>
    <div class="RMQ-wrapper">
        <div class="RMQ-body">
            <div class="RMQ-body__header">
                <div class="RMQ-body__header--title">RMQPHP</div>
                <!-- <div class="RMQ-body__header--button">Home</div> -->
            </div>
            <div class="RMQ-body__app">
                <div class="RMQ-body__app--title">Money Transfer</div>
                <div class="RMQ-moneyInput">
                    <label for="RMQ-moneyInput__amount">Amount:</label>
                    <input id="RMQ-moneyInput__amount" name="RMQ-moneyInput__amount" type="number" step=any>
                </div>
                <div id="RMQ-btnPay" class="RMQ-body__app--pay">Pay <?php echo file_get_contents ("src/imgs/cog.svg"); ?></div>
            </div>
            <div class="RMQ-body__footer">Emir Mujic - RMQPHP</div>
        </div>
    </div>
</body>
    <script src="src/vendor/jquery/jquery-3.2.1.min.js"></script> 
    <script src="src/scripts/main.js"></script>
</html>