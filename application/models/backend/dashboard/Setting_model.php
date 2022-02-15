<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {
 
	private $table = "setting";

	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("*")
			->from($this->table)
			->get()
			->row();
	} 
	
  	public function update($data = [])
	{
		return $this->db->where('setting_id',$data['setting_id'])
			->update($this->table,$data); 
	} 

	//new add 
	public function getMenuSingelRoleInfo($id="")
	{
		$role_id = $this->session->userdata('role_id');

		if($role_id!=0){

			return $this->db->select('*')
				->from('dbt_role_permission')
				->where('role_id',$role_id)
				->where('sub_menu_id',$id)
				->get()
				->row();
		}
		else{
			return "";
		}
	}

}
