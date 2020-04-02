<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Home
 * @author Rakib Ibna Hamid Chowdhury
 * @copyright Copyright (c) 2020, Rakib Ibna Hamid Chowdhury
 */
class Home extends CI_Controller {
	/**
	 * Constructor
	 * Load necessary models, libraries & helpers
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('todo_helper');
		$this->load->library('Todo_lib');
		$this->load->model('Basic_model');
	}

	/**
	 * Shows home page
	 * @return mixed
	 */
	public function index()
	{
		$this->load->view('todo_view');
	}

	/**
	 * Fetches tasks
	 * @return mixed
	 */
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
		$status_to_be_checked = COMPLETED;
		$check_tasks = $this->Basic_model->get_where('id, title, status', "status = '$status_to_be_checked'", 'todo_list');
		$data = [];
		$data['tasks'] = $get_tasks->num_rows() > 0 ? $get_tasks->result_array() : null;
		$data['has_completed_tasks'] = $check_tasks->num_rows() > 0 ? 1 : 0;
		echo json_encode(array('data'=>$data));
	}

	/**
	 * Adds new task
	 * @return mixed
	 */
	public function post_task()
	{
		$this->form_validation->set_rules('task_name', 'Task Name', 'trim|required');
		if($this->form_validation->run() === FALSE){
			echo 0;
		}else{
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

	/**
	 * Updates task
	 * @return mixed
	 */
	public function update_task()
	{
		$this->form_validation->set_rules('task_value', 'Value', 'trim|required');
		if($this->form_validation->run() === FALSE){
			echo 0;
		}else{
			$task_id = $this->input->post('task_id');
			$task_value = $this->input->post('task_value');
			$data = array();
			$data['title'] = $task_value;
			if($this->Basic_model->update_function('id', $task_id, 'todo_list', $data) > 0){
				echo 1;
			}else{
				echo 0;
			}
		}
	}

	/**
	 * Deletes task
	 * @return mixed
	 */
	public function delete_task()
	{
		$task_id = $this->input->post('task_id');
		if($this->Basic_model->delete_function('todo_list', 'id', $task_id) > 0){
			echo 1;
		}else{
			echo 0;
		}
	}

	/**
	 * Performs action according to the selected tasks and actions
	 * @return mixed
	 */
	public function post_action()
	{
		$action_type = $this->input->post('action_type');
		$tasks = $this->input->post('task_id');
		if($action_type == CLEAR_COMPLETED){
			if($this->Basic_model->delete_function('todo_list', 'status', COMPLETED) > 0){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			if($this->Basic_model->perform_action($action_type, $tasks)){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
}
