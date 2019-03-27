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
define('CLASS_STUDENT_IT', 100);                /* # of classes created */

function class_register_training(& $functions)
{
    echo "Class benchmark module loaded!\n";
    $functions[] = "run_class";
}

function run_class() {
    run_create_classes();
}

/**
*   This php file constains classes that simulates WP classes.
*/
class Student {

    var $valid = false;
    var $string_var = 'This is Student class';
    static $num_instances = 0;
    var $num_var = 0;
    var $float_var = 3.1415;
    var $grades = array();
    var $grades_string_array = array('one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten');
    var $float_array = array(1.1, 2.2, 3.3, 3.14, 2.73);
    var $bool_array = array(true, false, true, true, false);
    var $storage = array();
    var $end = false;
    protected $name;
    protected $date;
    protected $annual_grade;
    private $faculty;
    private $university;
    public $available_methods = array("set_float", "get_float", "set_personal_info",
                                         "set_fac", "get_fac", "print", "set_grades",
                                         "get_grades", "get_grade", "make_unusable", "to_string");

    function __construct() {
        $this->valid = true;
        $this->annual_grade = 0.0;
         Student::$num_instances += 1;
    }

    function set_float($var) {
        $this->float_var = $var;
    }

    function get_float() {
        return $this->float_var;
    }

    function set_personal_info($n, $d, $g) {
        $this->name = $n;
        $this->date = $d;
        $this->annual_grade = $g;
    }
    function get_personal_info() {
        $rez = (string)$this->name . " " . (string)$this->date . " " . (string) $this->annual_grade;
        return $rez;
    }

    function set_fac($f, $u) {
        $this->faculty = $f;
        $this->university = $u;
    }

    function get_fac() {
        $rez = (string)$this->faculty . " " . (string)$this->university;
        return $rez;
    }
    function print() {
        echo Student::$num_instances;
    }

    function set_grades($g_array) {
        $this->grades = $g_array;
        $len = sizeof($this->grades);
        for ($i=0; $i<$len; $i++) {
            $this->annual_grade += $this->grades[$i];
        }
        $this->annual_grade /= $len;
    }

    function get_grades() {
        return $this->grades;
    }

    function get_grade() {
        return $this->annual_grade;
    }

    function make_unusable() {
        $this->valid = false;
    }
    function to_string() {
        $rez = "Personal info: " . $this->get_personal_info() . "\n\t" . $this->get_fac();
        $rez .= "\nGrades: \n";
        $grades_array = $this->get_grades();
        $len = sizeof($grades_array);
        for ($i =0; $i < $len ; $i++) {
            $rez .= "\t" . $grades_array[$i] . "\n";
        }
        $rez .="Annual grade: " . $this->annual_grade . "\n";
        return $rez;
    }

    function get_available_methods() {
        return $this->available_methods;
    }

}

class LastYearStudent extends Student {
    var $group;
    function set_group($g) {
        $this->group = $g;
    }
}

class Faculty {
    var $name;
    var $city;
    var $country;
    var $university_name;
    var $students = array();

    function __construct($n, $cty, $ctry, $uname) {
        $this->name = $n;
        $this->city = $cty;
        $this->country = $ctry;
        $this->university_name = $uname;
    }

    function add_student($stud) {
        array_push($this->students, $stud);
    }

}
function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}

/**
*   Students are created here and Student class methods
*   are called.
*/
function create_student() {
    $stud =  new Student();

    /* some method call by name */
    $name = "James J Jordan";
    $date = "10-09-1993";
    $grade = 0.0;
    call_user_func(array($stud, "set_personal_info"), $name, $date, $grade);

    $fname = "Some Faculty of Computer Science";
    $uname = "University of Humans and/or Machines";
    call_user_func(array($stud, "set_fac"), $fname, $uname);

    /* some clasic method call */
    $grades = array(10,9,7,9);
    $stud->set_grades($grades);

    $description = $stud->to_string();
    $methods = $stud->get_available_methods();
    for ($i = 0; $i < sizeof($methods); $i++) {
        /* call all student getters */
        if (startsWith($methods[$i], "get")) {
            $rval = call_user_func(array($stud, $methods[$i]));
        }
    }
    return $stud;
}

function create_last_year_student() {
    $stud =  new LastYearStudent();

    /* some method call by name */
    $name = "Smithy Jones";
    $date = "10-09-1990";
    $grade = 0.0;
    call_user_func(array($stud, "set_personal_info"), $name, $date, $grade);

    $fname = "Some Faculty of Computer Science";
    $uname = "University of Humans and/or Machines";
    call_user_func(array($stud, "set_fac"), $fname, $uname);

    /* some clasic method call */
    $grades = array(10,9, 10,9);
    $stud->set_grades($grades);

    $description = $stud->to_string();
    $methods = $stud->get_available_methods();
    for ($i = 0; $i < sizeof($methods); $i++) {
        /* call all student getters */
        if (startsWith($methods[$i], "get")) {
            $rval = call_user_func(array($stud, $methods[$i]));
        }
    }
    return $stud;
}

/**
*   This function creates CLASS_STUDENT_IT students and
*   adds them to faculty class
*/
function run_create_classes() {
    $fac = new Faculty("Some Faculty of Computer Science", "GenericCityName", "GenericCountryName", "UNIVERSITY");
    for($i=0; $i < CLASS_STUDENT_IT; $i++) {
        $s = create_student();
        $fac->add_student($s);
    }
    $s = create_last_year_student();
    $fac->add_student($s);
    $s = create_last_year_student();
    $fac->add_student($s);
    $s = create_last_year_student();
    $fac->add_student($s);
}

?>
