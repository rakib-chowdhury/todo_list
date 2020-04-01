<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Basic_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_records($selector, $table_name)
    {
        $this->db->select($selector);
        $result = $this->db->get($table_name);
        return $result;
    }

    public function insert_ret($table_name, $table_data)
    {
        $this->db->insert($table_name, $table_data);
        return $this->db->insert_id();
    }

    public function get_where($selector, $condition, $table_name)
    {
        $this->db->select($selector);
        $this->db->from($table_name);
        $this->db->where($condition);
        return $this->db->get();
    }

    public function update_function($column_name, $column_val, $table_name, $data)
    {
        $this->db->where($column_name, $column_val);
        $this->db->update($table_name, $data);
        return $this->db->affected_rows();
    }

    public function delete_function($table_name, $column_name, $column_val)
    {
        $this->db->where($column_name, $column_val);
        $this->db->delete($table_name);
		return $this->db->affected_rows();
    }
	public function truncate_table($table_name)
	{
		$this->db->empty_table($table_name);
	}

	public function perform_action($action_type, $tasks)
	{
		$data = array();
		$data['status'] = $action_type;
		$this->db->trans_start();
		if($action_type == CLEAR_COMPLETED){
			$get_completed_tasks = $this->get_where('id', 'status = "'.COMPLETED.'"', 'todo_list');
			if($get_completed_tasks->num_rows() > 0){
				foreach ($get_completed_tasks->result() as $row){
					$this->delete_function('todo_list', 'id', $row->id);
				}
			}
		}else{
			foreach ($tasks as $row){
				$this->update_function('id', $row, 'todo_list', $data);
			}
		}
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return TRUE;
		}
	}
}

?>
