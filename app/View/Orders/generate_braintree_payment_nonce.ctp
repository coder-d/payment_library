<div id = "payment-form">
<form id="checkout" method="post" action="" autocomplete="off">
  <div id="dropin"></div>
	<input data-braintree-name="number" value="<?= $ccNumber;?>">
  <input data-braintree-name="cvv" value="100">

  <input data-braintree-name="expiration_date" value="<?= $ccExpiration;?>">

  <input data-braintree-name="cardholder_name" value="John Smith">

  <input type="submit" id="submit" value="Pay">
</form>
</div>
<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
<script>
 $(document).ready(function(){
  var clientToken = "<?= $clientToken; ?>";
  var ccNumber = "<?= $ccNumber;?>";
  var ccExpiration = "<?= $ccExpiration;?>";
console.log(clientToken);
  braintree.setup("<?= $clientToken; ?>", "dropin", {
    container: "payment-form",
    form: "checkout",
    onPaymentMethodReceived: function (nonce) {
      console.log(nonce);
      var form = document.getElementById("checkout");
      var payment_method_nonce = document.getElementById('payment_method_nonce');
      payment_method_nonce.value = nonce.nonce;
      payment_method_nonce.form.submit();
    }
  });

});

  // $(document).ready(function(){ 
  //   $('#pay').click();
  // });
</script>
