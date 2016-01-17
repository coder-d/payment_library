     $(document).ready(function(){
     	$(document).on("change",".currency",function(e){
     		var currentElement = $(this+':selected');
     		var currencyRate = currentElement.attr('data-rate');
     		var priceElement = currentElement.closest('div.product').find('.price:first');
     		if(currencyRate == '1.00'){
     			var updatedPrice = 	currentElement.attr('data-default-price');;
     		}else{
     			var updatedPrice = parseFloat(priceElement.text()*currencyRate).toFixed(2);
     		}
     		priceElement.text(updatedPrice);
     	});
     	$(document).on("click","#proceed_to_payment",function(e){
     		if(!$('#customer_name').val()){
     			$("#error").removeClass('hide').text('Please enter name');
     			return false;
     		}
     		return true;
     	});	
     	$(document).on("click","#process_payment",function(e){
          if(_checkName($('#cc_holder_name').val()) && _checkCcNumber($('#cc_number').val()) &&_checkCcExpiration($('#cc_expiration').val()) && _checkCcCvv($('#cc_cvv').val())){
               return true;
          }
          $("#error").removeClass('hide').text('Please enter all details correctly');
          return false;
          });

          function _checkName(name){
               if(!name){
                    return false;
               }
               return true;
          }

          function _checkCcNumber(ccNumber){
               if($.isNumeric(ccNumber)){
                    if(ccNumber.length == 12 || ccNumber.length == 16){
                         return true;   
                    }    
               }
               return false;
          }
          function _checkCcExpiration(ccExpiration){
               if($.isNumeric(ccExpiration)){
                    if(ccExpiration.length == 6){
                         return true;   
                    }    
               }
               return false;
          }
          function _checkCcCvv(ccCvv){
               if($.isNumeric(ccCvv)){
                    return true;   
               }
               return false;
          }
    });
