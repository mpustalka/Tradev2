<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
  
        if (!$this->session->userdata('isLogIn')) 
        redirect('customer'); 
 
        $this->load->model(array(

            'customer/auth_model',
            'customer/diposit_model',
            'customer/deshboard_model',
            'customer/profile_model',
            'customer/buy_model',
            'common_model',

        ));

    }

/*
|-------------------------------------
|   Customer Deshboard
|-------------------------------------
*/
    public function index()
    {   
        
       $user_id = $this->session->userdata('user_id');

        $data = $this->deshboard_model->get_cata_wais_transections();
        $data['package'] = $this->deshboard_model->all_package();
        $data['info'] = $this->deshboard_model->my_info();
        $data['my_payout'] = $this->deshboard_model->my_payout();
        $data['my_sales'] = $this->deshboard_model->my_sales();
        $data['pending_withdraw'] = $this->deshboard_model->pending_withdraw();
        $data['level_info'] = $this->deshboard_model->my_level_information($user_id);

        $data['investment'] = $this->deshboard_model->my_total_investment($user_id);


        $data['title']   = display('home'); 
        $data['content'] = $this->load->view('customer/dashboard/home', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);  
    }



    public function bank_info_update(){

        $user_id = $this->session->userdata('user_id');

        $bank_data = array(
            'user_id'           => $this->session->userdata('user_id'),
            'beneficiary_name'    => $this->input->post('beneficiary_name',TRUE),
            'bank_name'    => $this->input->post('bank_name',TRUE),
            'branch'              => $this->input->post('branch',TRUE),
            'account_number' => $this->input->post('account_number',TRUE),
            'ifsc_code' => $this->input->post('code',TRUE),
        );

        $data = $this->db->select('*')->from('bank_info')->where('user_id',$user_id)->get()->num_rows();
        if($data > 0){
            $this->db->where('user_id',$user_id)->update('bank_info',$bank_data);
        }else{
           $this->db->insert('bank_info',$bank_data); 
        }
        $this->session->set_flashdata('message','Bank Information Update Successfully!');
        redirect("customer/home/");
        
    }


/*
|-------------------------------------
|   View profile 
|-------------------------------------
*/
    public function profile()
    {
        $data['title'] = display('profile'); 
        $data['user']  = $this->home_model->profile($this->session->userdata('id'));
        $data['content'] = $this->load->view('backend/dashboard/profile', $data, true);
        $this->load->view('backend/layout/main_wrapper', $data);  
    }

/*
|-------------------------------------
|   Update profile 
|-------------------------------------
*/
    public function edit_profile()
    { 
        $data['title']    = display('edit_profile');
        $id = $this->session->userdata('id');
        /*-----------------------------------*/
        $this->form_validation->set_rules('firstname', 'First Name','required|max_length[50]|xss_clean');
        $this->form_validation->set_rules('lastname', 'Last Name','required|max_length[50]|xss_clean');
        #------------------------#
        $this->form_validation->set_rules('email', 'Email Address', "required|valid_email|max_length[100]|xss_clean"); 
        #------------------------#
        $this->form_validation->set_rules('password', 'Password','required|max_length[32]|md5|xss_clean');
        $this->form_validation->set_rules('about', 'About','max_length[1000]|xss_clean');
        /*-----------------------------------*/ 
        //set config 
        $config = [
            'upload_path'   => './assets/images/uploads/',
            'allowed_types' => 'gif|jpg|png|jpeg', 
            'overwrite'     => false,
            'maintain_ratio' => true,
            'encrypt_name'  => true,
            'remove_spaces' => true,
            'file_ext_tolower' => true 
        ]; 
        $this->load->library('upload', $config);
 
        if ($this->upload->do_upload('image')) {  
            $data = $this->upload->data();  
            $image = $config['upload_path'].$data['file_name']; 

            $config['image_library']  = 'gd2';
            $config['source_image']   = $image;
            $config['create_thumb']   = false;
            $config['encrypt_name'] = TRUE;
            $config['width']          = 115;
            $config['height']         = 90;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $this->session->set_flashdata('message', display("image_upload_successfully"));
        }
        /*-----------------------------------*/
        $data['user'] = (object)$userData = array(
            'id'          => $this->input->post('id',TRUE),
            'firstname'   => $this->input->post('firstname',TRUE),
            'lastname'    => $this->input->post('lastname',TRUE),
            'email'       => $this->input->post('email',TRUE),
            'password'    => md5($this->input->post('password',TRUE)),
            'about'       => $this->input->post('about',TRUE),
            'image'       => (!empty($image)?$image:$this->input->post('old_image',TRUE)) 
        );

        /*-----------------------------------*/
        if ($this->form_validation->run()) {

            if (empty($userData['image'])) {
                $this->session->set_flashdata('exception', $this->upload->display_errors()); 
            }

            if ($this->home_model->update_profile($userData)) 
            {
                $this->session->set_userdata(array(
                    'fullname'   => $this->input->post('firstname',TRUE). ' ' .$this->input->post('lastname',TRUE),
                    'email'       => $this->input->post('email',TRUE),
                    'image'       => (!empty($image)?$image:$this->input->post('old_image',TRUE))
                ));
                $this->session->set_flashdata('message', display('update_successfully'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect("backend/dashboard/home/edit_profile");

        } else { 
            $data['user']   = $this->home_model->profile($id);
            $data['content'] = $this->load->view('backend/dashboard/edit_profile', $data, true);
            $this->load->view('backend/layout/main_wrapper', $data);  
        }
    }
    

}