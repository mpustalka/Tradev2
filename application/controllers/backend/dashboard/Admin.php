<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();	
 		
 		if (!$this->session->userdata('isAdmin')) 
        redirect('logout');
 		
		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');
		
		$this->load->model(array(
 			'backend/dashboard/admin_model'  
 		));
 	}
 
	public function index()
	{  
		$data['title']      = display('admin_list');
		$data['admin'] = $this->admin_model->read();
		$data['content'] = $this->load->view("backend/admin/list", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	}
 

    public function email_check($email, $id)
    { 
        $emailExists = $this->db->select('email')
            ->where('email',$email) 
            ->where_not_in('id',$id) 
            ->get('admin')
            ->num_rows();

        if ($emailExists > 0) {
            $this->form_validation->set_message('email_check', 'The {field} is already registered.');
            return false;
        } else {
            return true;
        }
    } 

 

	public function form($id = null)
	{ 
		$data['title']    = display('add_admin');
		/*-----------------------------------*/
		$this->form_validation->set_rules('firstname', display('firstname'),'required|max_length[50]|xss_clean');
		$this->form_validation->set_rules('lastname', display('lastname'),'required|max_length[50]|xss_clean');
		#------------------------#
		if (!empty($id)) {   
       		$this->form_validation->set_rules('email', display('email'), "required|valid_email|max_length[100]|xss_clean");
       		/*---#callback fn not supported#---*/  
		} else {
			$this->form_validation->set_rules('email', display('email'),'required|valid_email|is_unique[admin.email]|max_length[100]|xss_clean');
		}
		#------------------------#
		
		$this->form_validation->set_rules('about', display('about'),'max_length[1000]|xss_clean');
		$this->form_validation->set_rules('status', display('status'),'required|max_length[1]|xss_clean');
		/*-----------------------------------*/
        $config = [
            'upload_path'   	=> 'upload/dashboard/',
            'allowed_types' 	=> 'gif|jpg|png|jpeg', 
            'overwrite'     	=> false,
            'maintain_ratio' 	=> true,
            'encrypt_name'  	=> true,
            'remove_spaces' 	=> true,
            'file_ext_tolower' 	=> true 
        ]; 
        $this->load->library('upload', $config);
 
        if ($this->upload->do_upload('image')) {  
            $data = $this->upload->data();  
            $image = $config['upload_path'].$data['file_name']; 

			$config['image_library']  = 'gd2';
			$config['source_image']   = $image;
			$config['create_thumb']   = false;
			$config['maintain_ratio'] = TRUE;
			$config['width']          = 115;
			$config['height']         = 90;
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->session->set_flashdata('message', display('image_upload_successfully'));
        }
		/*-----------------------------------*/

		$existingData = $this->admin_model->findById('admin', array('is_admin' => 2, 'id'=>$id));

		if(!empty($this->input->post('password',TRUE))){
			$newpassword = md5($this->input->post('password',TRUE));
		} else if(empty($existingData)){
			$newpassword = md5($this->input->post('password',TRUE));
		} else {
			$newpassword = $existingData->password;
		}
		
		$data['admin'] = (object)$adminLevelData = array(
			'id' 		  => $this->input->post('id',TRUE),
			'firstname'   => $this->input->post('firstname',TRUE),
			'lastname' 	  => $this->input->post('lastname',TRUE),
			'email' 	  => $this->input->post('email',TRUE),
			'password' 	  => $newpassword,
			'about' 	  => $this->input->post('about',true),
			'image'   	  => (!empty($image)?$image:$this->input->post('old_image',TRUE)),
			'last_login'  => null,
			'last_logout' => null,
			'ip_address'  => null,
			'status'      => $this->input->post('status',TRUE),
			'is_admin'    => 2
		);

		/*-----------------------------------*/
		if ($this->form_validation->run()) 
		{

	        if (empty($adminLevelData['image'])) {
				$this->session->set_flashdata('exception', $this->upload->display_errors()); 
	        }

			if (empty($adminLevelData['id'])) {
				if ($this->admin_model->create($adminLevelData)) {
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect("backend/dashboard/admin/form/");

			} else {
				if ($this->admin_model->update($adminLevelData)) {
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect("backend/dashboard/admin/form/$id");
			}
		} 
		else 
		{ 
			if(!empty($id)) {
				$data['title'] = display('edit_admin');
				$data['admin']   = $this->admin_model->single($id);
			}
			$data['content'] = $this->load->view("backend/admin/form", $data, true);
			$this->load->view("backend/layout/main_wrapper", $data);
		}
	}


	public function delete($id = null)
	{ 
		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');

		if ($this->admin_model->delete($id)) {
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect("backend/dashboard/admin/index");
	}
}