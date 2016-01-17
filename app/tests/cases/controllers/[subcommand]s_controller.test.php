<?php
/* [subcommand]s Test cases generated on: 2014-08-07 22:13:57 : 1407429837*/
App::import('Controller', '[subcommand]s');

class Test[subcommand]sController extends [subcommand]sController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class [subcommand]sControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->[subcommand]s =& new Test[subcommand]sController();
		$this->[subcommand]s->constructClasses();
	}

	function endTest() {
		unset($this->[subcommand]s);
		ClassRegistry::flush();
	}

}
?>