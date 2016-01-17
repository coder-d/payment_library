<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'Payment Library ');
?>
<!DOCTYPE html>
<html >
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
        echo $this->Html->script(array( 'jquery-1.7.1.min','bootstrap','bootstrap.min','hq_js'));
        echo $this->Html->css(array('cake.generic','bootstrap','bootstrap.min'));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
 <body>

   <div role="navigation" class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="#" class="navbar-brand">HQ Payment Library</a>
        </div>
      </div>
    </div>
    <div class="container" style="padding-top: 50px;">
        <div  class="row">               
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
          </div><!--/row-->
        <div class="row">
       	      <?php echo $this->element('sql_dump'); ?>
        </div>
          
    </div> <!-- /container -->
    
    <footer>            
		<div class="row-fluid">
			<div class="span10 noLeftMargin">
				<div id="copyright" class="muted">
				</div>
				<div id="footer_links">					
				</div>
			</div>
		</div>
	</footer>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->



  </body>
</html>
