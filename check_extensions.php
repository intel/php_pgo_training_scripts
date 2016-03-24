<?php
	function check()
	{	
		echo "Checking if required extensions are installed...\n";
		if (!extension_loaded("mysqli")) {
			echo "Mysqli is missing!\n";
		}
		if (!extension_loaded("standard")) {
			echo "Standard is missing!\n";
		}
		if (!extension_loaded("mbstring")) {
			echo "Mbstring is missing!\n";
		}	
		if (!extension_loaded("hash")) {
			echo "Hash is missing!\n";
		}
		if (!extension_loaded("date")) {
			echo "Date is missing!\n";
		}
		if (!extension_loaded("sockets")) {
			echo "Sockets is missing!\n";
		}
		if (!extension_loaded("pcre")) {
			echo "Pcre is missing!\n";
		}
		echo "DONE!\n";
	}
?>