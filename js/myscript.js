$(document).ready(function () {
    
    $(".cartremove").click(function (e) {
//        console.log('helllo');
        e.preventDefault();
        var ele = $(this);
        var pid = ele.attr("data-id");
        //alert(pid);
        $.post("controller/ajaxcontroller.php", {req_type: "removefromcart", r_pid: pid},
                function (result) {
                    //alert(result);
                    var obj = jQuery.parseJSON(result);
                    if (obj["status"] == 1) {
//                        $("#cartcounter").html(obj["data"]["cartcounter"]);
//                        $("#trid-" + pid).remove();
//
//                        $("#cart-subtotal").html("₹ " + obj["data"]["cartsubtotal"]);
//                        $("#cart-shipping").html("₹ " + obj["data"]["cartshipping"]);
//                        $("#cart-total").html("₹ " + (obj["data"]["cartsubtotal"] + obj["data"]["cartshipping"]));
//
//                        $("#usewalletprice").html("₹ " + obj["data"]["walletpay"]);
                        location.reload();
                    }
                }).fail(function () {
            console.log("error");

        });
    });
});
