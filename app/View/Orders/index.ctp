
<?foreach($products as $product)?>
<div class="product">
	<ul>
		<li><span class="title"><?=$product['Product']['title'];?></span></li>
		<li>Price : <span id ="test" class="price"><?=$product['Product']['price'];?></span></li>
	</ul>
	<div class="alert alert-danger hide" id="error"></div>
	<form action="<?=$this->webroot;?>orders/checkout" method="post">
	<input type="hidden" value="<?=$product['Product']['id'];?>" name="data[Order][product_id]"/>
	<div class="currency">
		<select name="data[Product][currency]">
		<? foreach($currencies as $currency) { ?>
			<option value="<?= $currency['Currency']['abbreviation'];?>" data-default-price ="<?=$product['Product']['price'];?>" data-rate="<?=$currency['Currency']['rate'];?>"><?= $currency['Currency']['abbreviation'];?></option>
		<?}?>
		</select>
	</div>
	<div class="controls">
		<input class="input-medium" name="data[Order][customer_name]" id="customer_name" placeholder="Full name" maxlength="255" type="text"/>
	</div>
	<input class="submit" type="submit" value="Proceed to payment" id="proceed_to_payment" name="submit"/>
	</form>
</div>
