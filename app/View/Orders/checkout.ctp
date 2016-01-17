<h3>Payment</h3>
<div>
	<div><span>Product title : <?=$orderDetail['Order']['title'];?></div>
	<div><span>Selected Currency : <?=$currency;?></div>
	<div><span>Total Amount : <?=$orderDetail['Order']['amount'];?></div>
	<div class="alert alert-danger hide" id="error"></div>
	<form action="<?=$this->webroot;?>orders/process_payment" method="post">
	<input type="hidden" value="<?=$orderDetail['Order']['product_id'];?>" name="data[Order][product_id]"/>
	<input type="hidden" value="<?=$orderDetail['Order']['customer_name'];?>" name="data[Order][customer_name]"/>
	<input type="hidden" value="<?=$currency;?>" name="data[Order][currency_abbr]"/>
	<input type="hidden" value="<?=$orderDetail['Order']['title'];?>" name="data[Order][title]"/>
	<input type="hidden" value="<?=$orderDetail['Order']['amount'];?>" name="data[Order][amount]"/>
	<div class="controls">
		<input class="input-medium" name="data[Order][cc_holder_name]" id="cc_holder_name" placeholder="Credit card holder name" maxlength="255" type="text"/>
	</div>
	<div class="controls">
		<input class="input-medium" name="data[Order][cc_number]" id="cc_number" placeholder="Credit card number" maxlength="16" type="text"/>
	</div>
	<div class="controls">
		<input class="input-medium" name="data[Order][cc_expiration]" id="cc_expiration" placeholder="Credit expiration mmyyyy" maxlength="6" type="text"/>
	</div>
	<div class="controls">
		<input class="input-medium" name="data[Order][cc_cvv]" id="cc_cvv" placeholder="CVV number" maxlength="4" type="text"/>
	</div>
	<div>
		<select name="data[Order][cc_type]">
		<? foreach($creditCards as $creditCard) { ?>
			<option value="<?= $creditCard;?>"><?= $creditCard;?></option>
		<?}?>
		</select>
	</div>
	<input class="submit" type="submit" value="Pay Now" id="process_payment" name="submit"/>
	</form>