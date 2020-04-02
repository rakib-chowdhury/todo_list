<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Todo_lib
 * @author Rakib Ibna Hamid Chowdhury
 * @copyright Copyright (c) 2020, Rakib Ibna Hamid Chowdhury
 */
class Todo_lib
{
	/**
	 * Constructor
	 * Load necessary models, libraries & helpers
	 */
    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('Basic_model');
		date_default_timezone_set('Asia/Dhaka');
    }

	/**
	 * Converts date & time in milliseconds
	 * @param $date
	 * @param $time
	 * @return int time in milliseconds
	 */
    public function convert_date_time_to_millisecond($date, $time)
    {
        $concat = $date.' '.$time;
        return strtotime($concat)*1000;
    }
}
