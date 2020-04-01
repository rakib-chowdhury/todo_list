<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Todo_lib
{
    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('Basic_model');
		date_default_timezone_set('Asia/Dhaka');
    }

    public function convert_date_time_to_millisecond($date, $time)
    {
        $concat = $date.' '.$time;
        return strtotime($concat)*1000;
    }
}
