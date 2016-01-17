- I have used cakephp framework for this works.
- The database setting are in payment_library/app/Config/database.php
- The payment gateway keys are in  payment_library/app/Config/bootstrap.php
- debug mode(payment_library/app/config.core.php) can be changed to 0 after running the app once.
- The index url is domain/payment_library.
- To keep it simple there is only one item for an order.
- After all form data is received in orders controller checkout function 
 a base library class payment_library/app/Lib/PaymentGatewayProcessor.php is used to load
 the appropriate payment gateway class(paypal or braintree) and process the payment.
- Test cases link payment_library/app/test.php
- Test cases code can be found in payment_library/app/Test/case/Controller/OrderControllerTest.php
  payment_library/app/Test/case/Model 
- There are two sql files hq_db and hq_db_test			