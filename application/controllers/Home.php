<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('todo_helper');
		$this->load->library('Todo_lib');
		$this->load->model('Basic_model');
	}

	public function index()
	{
		$this->load->view('todo_view');
	}

	public function fetch_tasks()
	{
		$status = $this->input->post('status');
		if(!$status){
			$get_tasks = $this->Basic_model->get_where('id, title, status', "id > 0", 'todo_list');
		}elseif(isset($status)){
			$get_tasks = $this->Basic_model->get_where('id, title, status', "status = '$status'", 'todo_list');
		}else{
			$get_tasks = $this->Basic_model->get_where('id, title, status', "id > 0", 'todo_list');
		}
		$data = [];
		if($get_tasks->num_rows() > 0){
			$data = $get_tasks->result_array();
		}
		echo json_encode(array('data'=>$data));
	}

	public function post_task()
	{
		$task_name = $this->input->post('task_name');
		$data = [];
		$data['title'] = $task_name;
		$data['status'] = PENDING;
		$data['created_on'] = $this->todo_lib->convert_date_time_to_millisecond(date('Y-m-d'), date('H:i:s'));
		$insert_id = $this->Basic_model->insert_ret('todo_list', $data);
		$data = [];
		if($insert_id > 0){
			echo $insert_id;
		}else{
			echo 0;
		}
	}
}
