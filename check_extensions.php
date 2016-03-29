<?php
/**
* PHP PGO Training - to be used during Profile Guided Optimization builds.
*
* Copyright (C) 2016 Intel Corporation
*
* This program is free software and open source software; you can redistribute
* it and/or modify it under the terms of the GNU General Public License as
* published by the Free Software Foundation; either version 2 of the License,
* or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful, but WITHOUT
* ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
* FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for
* more details.
*
* You should have received a copy of the GNU General Public License along
* with this program; if not, write to the Free Software Foundation, Inc.,
* 51 Franklin St, Fifth Floor, Boston, MA 02110-1301, USA
* http://www.gnu.org/licenses/gpl.html
*
* Authors:
*   Gabriel Samoila <gabriel.c.samoila@intel.com>
*   Bogdan Andone <bogdan.andone@intel.com>
*/

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