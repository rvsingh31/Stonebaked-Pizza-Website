<?php

	session_start();
	unset($_SESSION["cart"]);
	unset($_SESSION["cart_count"]);
	echo "done";
?>