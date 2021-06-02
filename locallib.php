<?php

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot . '/user/selector/lib.php');
require_once($CFG->libdir.'/filelib.php');
require_once('ColorInterpreter.php');


// função que converte cor hexadecimal em rgb
function hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);
    $seperator = ',';
    if(strlen($hex) == 3) {
       $r = hexdec(substr($hex,0,1).substr($hex,0,1));
       $g = hexdec(substr($hex,1,1).substr($hex,1,1));
       $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
       $r = hexdec(substr($hex,0,2));
       $g = hexdec(substr($hex,2,2));
       $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);
    //return implode(",", $rgb); // returns the rgb values separated by commas
    return implode($seperator, $rgb); // returns an array with the rgb values
}
// função que converte cor hexadecimal em seu nome
function nameColor($hex) {

    $seperator = ' ';
    $instance = new ColorInterpreter();
    $result = $instance->name($hex);

     //return implode(",", $rgb); // returns the neme values space-separated
    return implode($seperator,$result);  // returns an array with the name values
}    