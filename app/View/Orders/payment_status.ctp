<div>
	<?if($process=='success'){?>
		<div class="alert alert-success">
		     <a class="close" data-dismiss="alert" href="#">X</a>
		     <h4 class="alert-heading">Success!</h4>
		     Congratulations, the payment process is completed successfully, the order details and payment status will be emailed to you.
		</div>
	<?}else{?>
		<div class="alert alert-danger alert-error">
	     <a class="close" data-dismiss="alert" href="#">X</a>
	     <h4 class="alert-heading">Error!</h4>
	       The payment process failed, please contact support
	    </div>
	<?}?>
</div>