<?php

use App\DbAuth\DbAuth;

if(!Dbauth::getAuth(App::getInstance()->get_Db())->isConnect())
{
    header("Location: ".$_SESSION["temp_url"]);
}
if(!isset($_SESSION["temp_checkout"]) || !($_SESSION["temp_checkout"][0] == true))
{
    header("Location: home");
}

if(!(isset($_GET["transaction_id"]) && $_SESSION["temp_checkout"][0] == true && $_SESSION["temp_checkout"][1] == $_GET["transaction_id"]))
{
    header("Location: home");
}
$user = \App\User\User::getInstance(App::getInstance()->get_Db())->getfullidentity();

?>
<div class="loader-wrapper">
    <div class="loader"></div>
</div>
<div class="checkout">
    <div class="ligne">
        <div class="colonne-2 colonne-md-0 colonne-sm-0">
        </div>
        <div class="colonne-7 colonne-md-7 colonne-sm-12">
            <div class="tab-content">
                <div class="tab-pane show active fade" id="checkInfo">
                    <div class="checkout-address">
                        <p class="checkout-shipping-address">Delivery Address</p>
                        <div class="names">
                            <input type="text" placeholder="Name" id="name_order" value=<?=$user->name?> >
                            <input type="text" placeholder="surname" id="lName_order" value=<?=$user->surname?>>
                        </div>
                        <div class="addresses">
                            <textarea placeholder="address n°1(Required)" id="address_order"><?=$user->address?></textarea>
                            <textarea placeholder="address n°2(Optional)" id="address_order2"></textarea>
                        </div>
                        <div class="phone">
                            <input type="tel" placeholder="phone number" id="phone_order" value=<?=$user->phone?>>
                        </div>
                        <div class="country">
                            <input type="text" value="KKTC" disabled>
                            <select class="champs" required id="district_order">
                                <option value="" disabled  >Select your district...</option>
                                <option <?=$user->district == "Lefkosa" ? "selected" : "" ?> >Lefkosa</option>
                                <option <?=$user->district == "Kyrenia" ? "selected" : "" ?> >Kyrenia</option>
                                <option <?=$user->district == "Lefke" ? "selected" : "" ?> >Lefke</option>
                                <option <?=$user->district == "Guzelyurt" ? "selected" : "" ?> >Guzelyurt</option>
                                <option <?=$user->district == "Iskele" ? "selected" : "" ?> >Iskele</option>
                                <option <?=$user->district == "Gazimagusa" ? "selected" : "" ?> >Gazimagusa</option>
                            </select>
                        </div>
                        <div class="buttons">
                            <button type="button" class="btn-checkout" href="#wayPayment" id="chckContinue">Continue to billing</button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="wayPayment">
                    <div class="checkout-address">
                        <div class="buttons">
                            <div id="smart-button-container">
                                <div style="text-align: center;">
                                    <div id="paypal-button-container"></div>
                                </div>
                            </div>
                        </div>
                        <div class="empty">

                        </div>
                        <div class="buttons">
                            <button type="button" class="btn-checkout" id="chckBack">Back</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="colonne-3 colonne-md-5 colonne-sm-12">
            <?php
            $product = App::getInstance()->get_Db()->selectionner("SELECT * FROM product WHERE prod_code=?",[$_SESSION["temp_checkout"][2]],true);
            $size = strlen($_GET["transaction_id"]);
            $currency = $_GET["transaction_id"][$size-2].$_GET["transaction_id"][$size-1];
            $curr;
            switch ($currency)
            {
                case "02" : $currency ="€";$curr="EUR"; break;
                case "03" : $currency ="£";$curr="GBP"; break;
                case "04" : $currency ="$";$curr="USD"; break;
                case "05" : $currency ="₺";$curr="TRY";
            }
            ?>
            <div class="order-summary">
                <p>Order Summary </p>
                <p>#<?=$_GET["transaction_id"]?></p>
                <div class="ligne">
                    <div class="colonne-5">Price</div>
                    <div class="colonne-5"><?=$currency." ".$_SESSION["temp_checkout"][5]?></div>
                </div>
                <div class="ligne">
                    <div class="colonne-5">Delivery fees</div>
                    <div class="colonne-5"><?=$currency." ".App::getInstance()->getDeliveryFees($product->owner,$curr)?></div>
                </div>
                <div class="ligne">
                    <div class="colonne-5">Total</div>
                    <div class="colonne-5"><?=$currency." "?><span id="tPrice"><?= $_SESSION["temp_checkout"][5] +(int) App::getInstance()->getDeliveryFees($product->owner,$curr) ?></span></div>
                    <input type="hidden" value=<?=$curr?> id="currency">
                </div>
            </div>
            <div class="order-detail">
                <p>Order Detail</p>
                <hr>
                <div class="ligne">
                    <div class="colonne-5">
                        <img src=<?= 'data:image/jpeg;base64,'.base64_encode($product->picture1);?> width="100%" height="100%">
                    </div>
                    <div class="colonne-7">
                        <p><?=$product->name_ ?></p>
                        <p><?=$product->condition?></p>
                        <p><?=$currency." ".$product->price?> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    $link = "https://www.paypal.com/sdk/js?client-id=Aa4LfsKMWaG4NTm1IwvB3yeW8bpWIBy0qmgJKV8vHYwnB-SkPTEpOuf_1A9UkkiRmMeqeNDI0BA5Z0mt&enable-funding=venmo&currency=".$curr;
?>
<script data-sdk-integration-source="button-factory" src=<?=$link?> ></script>
<script>
    function initPayPalButton() {
        paypal.Buttons({

        // Call your server to set up the transaction
        createOrder: function(data, actions) {
            return fetch('App/Payment/order/orderCreate.php', {
                method: 'post'
            }).then(function(res) {
                return res.json();
            }).then(function(orderData) {
                return orderData.id;
            });
        },

        // Call your server to finalize the transaction
        onApprove: function(data, actions) {
            return fetch('App/Payment/approve/orderApprove.php?id='+data.orderID, {
                method: 'post',
            }).then(function(res) {
                return res.json();
            }).then(function(orderData) {
                var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

                if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                    return actions.restart(); 
                }

                if (errorDetail) {
                    var msg = 'Sorry, your transaction could not be processed.';
                    if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                    if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                    return alert(msg);
                }
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                var transaction = orderData.purchase_units[0].payments.captures[0];
                console.log('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                
                var timerSec = 6;
                var Tprice = parseInt($("#tPrice").html());
                var currency = $("#currency").val();
                table = new Array();
                console.log(orderData);
                $("#chckBack").prop("disabled",true);
                $.ajax({
                    url:"App/pont/pont_payment.php",
                    type:"POST",
                    data:{"type":"confirm","order":orderData,"tPrice":Tprice,"currency_code":currency},
                    dataType:"JSON",
                    success:function (data){
                        table = data;
                        if(table[0])
                        {
                            var timer = setInterval(function(){
                                timerSec -= 1;
                                if(timerSec == 0)
                                {
                                    clearInterval(timer);
                                    //window.open(table[1],"_self");
                                }
                            })
                        }
                        else {
                            alert(table[1]);
                            console.log(table[1]);
                        }
                    },
                    error:function (errorThrown){
                        console.log(errorThrown);
                    }
                })
            });
        }

        }).render('#paypal-button-container');
    }
    initPayPalButton();
</script>
<script src="./public/assets/js/checkout.js"></script>
