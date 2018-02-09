<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Cleaner {

    public function strip($data='')
    {
    	return preg_replace('/[^A-Za-z0-9\-\(\) ]/', '', mysql_real_escape_string(strip_quotes(strip_slashes(trim($data)))));
    }
}

/* End of file Cleaner.php */