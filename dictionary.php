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

/* Constants for scaling the number of runs;
 * Users can change these value for tuning execution weights
 */
define('KEYS_SIZE', 50);      /* number of keys pregenerated in keys.php */
define('DICTIONARY_IT', 300000);  /* number of hash-map iterations */
define('ARRAY_KEYS_IT', 20000);         /* # of array_keys() calls */

function hash_register_training(& $functions)
{
  echo "Hash benchmark module loaded!\n";
  $functions[] = "run_hash";
}

function run_hash()
{
  fill_dictionary(DICTIONARY_IT);
}

$KEYS = array("q0################",
"q1#################",
"q2##################",
"q3###################",
"q4####################",
"q5#####################",
"q6######################",
"q7#######################",
"q8########################",
"q9#########################",
"q10##########################",
"q11###########################",
"q12############################",
"q13#############################",
"q14##############################",
"q15###############################",
"q16################################",
"q17#################################",
"q18##################################",
"q19###################################",
"q20####################################",
"q21#####################################",
"q22######################################",
"q23#######################################",
"q24########################################",
"q25#########################################",
"q26##########################################",
"q27###########################################",
"q28############################################",
"q29#############################################",
"q30##############################################",
"q31###############################################",
"q32################",
"q33#################",
"q34##################",
"q35###################",
"q36####################",
"q37#####################",
"q38######################",
"q39#######################",
"q40########################",
"q41#########################",
"q42##########################",
"q43###########################",
"q44############################",
"q45#############################",
"q46##############################",
"q47###############################",
"q48################################",
"q49#################################");


$dictionary = array();
$references = array();

function add_entry($name, $value) {
  if (isset($references[$name])) {
    $references[$name]++;
  }
  else {
    $references[$name] = 1;
  }
  $dictionary[$name] = $value;
  //count($dictionary);
}

function get_array_keys() {
  return array_keys($GLOBALS['dictionary']);
}

function get_array_values() {
  return array_values($GLOBALS['dictionary']);
}


function fill_dictionary($size) {

  if (!extension_loaded("hash")) {
    echo "Hash is missing!\n";
    return -1;
  }

  $IT = $size / KEYS_SIZE;
  $KEYS = $GLOBALS["KEYS"];
  for($j=0; $j < $IT; $j++)
    for ($i = 0; $i < KEYS_SIZE; $i++) {
      $name = 'KEYS';
      add_entry($KEYS[$i], $i);
      $new = $$name[$i];
      $new = null;
    }

  for ($i = 0; $i < ARRAY_KEYS_IT; $i++) {
    $keys = get_array_keys();
  }
  for ($i = 0; $i < ARRAY_KEYS_IT; $i++) {
    $keys = get_array_values();
  }

}

?>
