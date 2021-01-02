<?php 

	function trim_modified($data) {
		$data = trim($data);
		$data = stripslashes($data);
		return $data;
	}

	function flashStatus() {
		echo "<div class='' style='color:green;'>".$_SESSION['prompt']."</div>";
	}

	function flashError() {
		echo "<div class='' style='color:red;'>".$_SESSION['errprompt']."</div>";
	}

	function flashS($text) {
		echo "<div class='' style='color:green;'>".$text."</div>";
	}

	function flashE($text) {
		echo "<div class='' style='color:red;'>".$text."</div>";
	}
	/*
	function sql_injection_protection (){
		if(empty($_SESSION['studentno'])){
			header("location:")
		}
	}
	. 
	. 
	.
	*/
