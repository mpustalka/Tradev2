<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('isAdmin')) 
			redirect('logout');

		if (!$this->session->userdata('isLogIn') 
			&& !$this->session->userdata('isAdmin')
		) 
			redirect('admin'); 
		
		$this->load->model(array(
			'backend/dashboard/setting_model','Common_model'
		));
		
	}


	public function index()
	{
		$data['title'] = display('application_setting');
		$this->check_setting();
		#-------------------------------#
		$this->form_validation->set_rules('title',display('website_title'),'required|max_length[50]|xss_clean');
		$this->form_validation->set_rules('description', display('address') ,'max_length[255]|xss_clean');
		$this->form_validation->set_rules('email',display('email'),'max_length[100]|valid_email|xss_clean');
		$this->form_validation->set_rules('phone',display('phone'),'max_length[20]|xss_clean');
		$this->form_validation->set_rules('language',display('language'),'max_length[250]|xss_clean'); 
		$this->form_validation->set_rules('footer_text',display('footer_text'),'max_length[255]|xss_clean'); 
		$this->form_validation->set_rules('time_zone',display('time_zone'),'required|max_length[100]|xss_clean');
		#-------------------------------#
		//logo upload
		$logo = $this->upload_lib->do_upload(
			'upload/settings/',
			'logo'
		);
		// if logo is uploaded then resize the logo
		if ($logo !== false && $logo != null) {
			$this->upload_lib->do_resize(
				$logo, 
				210,
				48
			);
		}
		//if logo is not uploaded
		if ($logo === false) {
			$this->session->set_flashdata('exception', display('invalid_logo'));
		}

		//Web logo_web upload
		$logo_web = $this->upload_lib->do_upload(
			'upload/settings/',
			'logo_web'
		);
		// if logo_web is uploaded then resize the logo_web
		if ($logo_web !== false && $logo_web != null) {
			$this->upload_lib->do_resize(
				$logo_web, 
				230,
				70
			);
		}
		//if logo_web is not uploaded
		if ($logo_web === false) {
			$this->session->set_flashdata('exception', display('invalid_logo'));
		}


		//favicon upload
		$favicon = $this->upload_lib->do_upload(
			'upload/settings/',
			'favicon'
		);
		// if favicon is uploaded then resize the favicon
		if ($favicon !== false && $favicon != null) {
			$this->upload_lib->do_resize(
				$favicon, 
				32,
				32
			);
		}
		//if favicon is not uploaded
		if ($favicon === false) {
			$this->session->set_flashdata('exception',  display('invalid_favicon'));
		}		
		#-------------------------------#

		$data['setting'] = (object)$postData = [
			'setting_id'  => $this->input->post('setting_id',TRUE),
			'title' 	  => $this->input->post('title',TRUE),
			'description' => $this->input->post('description',TRUE),
			'email' 	  => $this->input->post('email',TRUE),
			'phone' 	  => $this->input->post('phone',TRUE),
			'logo' 	      => (!empty($logo)?$logo:$this->input->post('old_logo',TRUE)),
			'logo_web' 	  => (!empty($logo_web)?$logo_web:$this->input->post('old_web_logo',TRUE)),
			'favicon' 	  => (!empty($favicon)?$favicon:$this->input->post('old_favicon',TRUE)),
			'language'    => $this->input->post('language',TRUE), 
			'time_zone'   => $this->input->post('time_zone',TRUE), 
			'site_align'  => $this->input->post('site_align',TRUE), 
			'office_time' => $this->input->post('office_time',TRUE), 
			'latitude' 	  => $this->input->post('latitude',TRUE), 
			'footer_text' => $this->input->post('footer_text',TRUE),
		]; 
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $setting_id then insert data
			if (empty($postData['setting_id'])) {
				if ($this->setting_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
			} else {
				if ($this->setting_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				} 
			} 
			redirect('backend/dashboard/setting');

		} else {  
			$data['languageList'] = $this->languageList(); 
			$data['setting'] = $this->setting_model->read();
			$data['content'] = $this->load->view('backend/dashboard/setting',$data,true);
			$this->load->view('backend/layout/main_wrapper',$data);

		} 

	}

	//check setting table row if not exists then insert a row
	public function check_setting()
	{
		if ($this->db->count_all('setting') == 0) {
			$this->db->insert('setting',[
				'title' => 'bdtask Treading System',
				'description' => '123/A, Street, State-12345, Demo',
				'time_zone' => 'Asia/Dhaka',
				'footer_text' => '2018&copy;Copyright',
			]);

		}

	}


	public function languageList()
	{ 
		if ($this->db->table_exists("language")) { 

			$fields = $this->db->field_data("language");

			$i = 1;
			foreach ($fields as $field)
			{  
				if ($i++ > 2)
					$result[$field->name] = ucfirst($field->name);
			}

			if (!empty($result)) return $result;


		} else {
			return false;

		}
	}

/*
|----------------------------
|	commission_setup Setting form view
|----------------------------
*/   

public function commission_setup()
{
	$data['setup_commission'] = $this->db->select('*')->from('setup_commission')->order_by('level_name','ASC')->get()->result();
	$data['title'] = display('commission_setup');
	$data['content'] = $this->load->view('backend/dashboard/commission_setting',$data,true);
	$this->load->view('backend/layout/main_wrapper',$data);
}


public function commission_update()
{
	$id = $this->input->post('id',TRUE);
	$level = $this->input->post('level',TRUE);
	$personal_invest = $this->input->post('personal_invest',TRUE);
	$total_invest = $this->input->post('total_invest',TRUE);
	$team_bonous = $this->input->post('team_bonous',TRUE);
	$referral_bonous = $this->input->post('referral_bonous',TRUE);

	for ($i=0; $i<=count($id); $i++) {
		if (array_key_exists($i, $id)) {
			$data = array(
				'level_name' => $level[$i],
				'personal_invest' => $personal_invest[$i],
				'total_invest' => $total_invest[$i],
				'team_bonous' => $team_bonous[$i],
				'team_bonous' => $team_bonous[$i],
				'referral_bonous' => $referral_bonous[$i],
			);

			$this->db->where('level_id',$id[$i])->update('setup_commission',$data);
		}
	}

	$this->session->set_flashdata('message',display('update_successfully'));
	redirect('backend/dashboard/setting/commission_setup');

}

/*
|----------------------------
|	Fees Setting form view
|----------------------------
*/   

public function fees_setting()
{
	$data['title'] = display('fees_setting');
	$data['fees_data'] = $this->db->select('*')->from('fees_tbl')->get()->result();
	$data['content'] = $this->load->view('backend/dashboard/fees_setting',$data,true);
	$this->load->view('backend/layout/main_wrapper',$data);
}

/*
|----------------------------
|	Fees Setting save
|----------------------------
*/
public function fees_setting_save()
{
	$check = $this->db->select('*')->from('fees_tbl')->where('level',$this->input->post('level',TRUE))->get()->num_rows();
	if($check>0){
		$this->session->set_flashdata('exception','This Level Already Exist!');
		redirect('backend/dashboard/setting/fees_setting');
	}else{
		$fees = array(
			'level'=>$this->input->post('level',TRUE),
			'fees'=>$this->input->post('fees',TRUE)
		);
		$this->db->insert('fees_tbl',$fees);
		$this->session->set_flashdata('message',display('fees_setting_successfully'));
		redirect('backend/dashboard/setting/fees_setting');
	}

}

/*
|----------------------------
|	Delete Fees Setting 
|----------------------------
*/   

public function delete_fees_setting($id=NULL)
{

	if ($this->db->where('id',$id)->delete('fees_tbl')) {
		$this->session->set_flashdata('message', display('delete_successfully'));
	} else {
		$this->session->set_flashdata('exception', display('please_try_again'));
	}
	redirect('backend/dashboard/setting/fees_setting');
}


/*
|----------------------------
|	Fees Setting form view
|----------------------------
*/   

public function email_sms_setting()
{
	$data['email'] = $this->db->select('*')->from('sms_email_send_setup')->where('method','email')->get()->row();
	$data['sms'] = $this->db->select('*')->from('sms_email_send_setup')->where('method','sms')->get()->row();
	$data['title'] = display('fees_setting');
	$data['content'] = $this->load->view('backend/dashboard/email_and_sms_setting',$data,true);
	$this->load->view('backend/layout/main_wrapper',$data);
}

/*
|----------------------------
|	Fees Setting form view
|----------------------------
*/   

public function update_sender()
{
	$email = $this->input->post('email',TRUE);
	$sms = $this->input->post('sms',TRUE);

	if($email!=NULL){
		$data = array(
			'deposit' =>$this->input->post('deposit',TRUE),
			'transfer' =>$this->input->post('transfer',TRUE),
			'withdraw' =>$this->input->post('withdraw',TRUE),
			'payout' =>$this->input->post('payout',TRUE),
			'commission' =>$this->input->post('commission',TRUE),
			'team_bonnus' =>$this->input->post('team_bonnus',TRUE),
		);

		$this->db->where('method',$email)->update('sms_email_send_setup',$data);
	}
	if($sms!=NULL){
		$data = array(
			'deposit' =>$this->input->post('deposit',TRUE),
			'transfer' =>$this->input->post('transfer',TRUE),
			'withdraw' =>$this->input->post('withdraw',TRUE),
			'payout' =>$this->input->post('payout',TRUE),
			'commission' =>$this->input->post('commission',TRUE),
			'team_bonnus' =>$this->input->post('team_bonnus',TRUE),
		);

		$this->db->where('method',$sms)->update('sms_email_send_setup',$data);
	}
	$this->session->set_flashdata('message',display('update_successfully'));
	redirect('backend/dashboard/setting/email_sms_setting');
}

/*
|----------------------------
|	SMS Gateway
|----------------------------
*/   


/*
|----------------------------
|	Update SMS
|----------------------------
*/   

public function update_sms_gateway()
{
	$sms = $this->input->post('es_id',TRUE);

	$pass = '';
	$password = $this->db->select('password')->from('email_sms_gateway')->where('es_id', 2)->get()->row();

	if($password->password == base64_decode($this->input->post('password',TRUE))){
		$pass = $password->password;

	}else{
		$pass = $this->input->post('password',TRUE);

	}

	$data = array(
		'gatewayname' 	=>$this->input->post('gatewayname',TRUE),
		'title' 		=>$this->input->post('title',TRUE),
		'host' 			=>$this->input->post('host',TRUE),
		'user' 			=>$this->input->post('user',TRUE),
		'userid' 		=>$this->input->post('userid',TRUE),
		'password' 		=>$pass,
		'api' 			=>$this->input->post('api',TRUE)
	);

	$this->db->where('es_id',$sms)->update('email_sms_gateway',$data);


	$this->session->set_flashdata('message',display('update_successfully'));


	redirect('backend/dashboard/setting/sms_gateway');
}

public function sms_gateway()
{
	$data['title'] = "SMS Gateway";
	$data['sms'] = $this->db->select('*')->from('email_sms_gateway')->where('es_id', 1)->get()->row();
	$data['userrole'] = $this->setting_model->getMenuSingelRoleInfo(30);
	$data['content'] = $this->load->view('backend/dashboard/sms_gateway',$data,true);
	$this->load->view('backend/layout/main_wrapper',$data);
}
/*
|----------------------------
|	Update SMS
|----------------------------
*/   

public function update_email_gateway()
{
	$email = $this->input->post('es_id',TRUE);

	$pass = '';
	$password = $this->db->select('password')->from('email_sms_gateway')->where('es_id', 2)->get()->row();

	if($password->password == base64_decode($this->input->post('email_password',TRUE))){
		$pass = $password->password;

	}else{
		$pass = $this->input->post('email_password',TRUE);

	}
	$data = array(
		'title' 	=>$this->input->post('email_title',TRUE),
		'protocol' 	=>$this->input->post('email_protocol',TRUE),
		'host' 		=>$this->input->post('email_host',TRUE),
		'port' 		=>$this->input->post('email_port',TRUE),
		'user' 		=>$this->input->post('email_user',TRUE),
		'password' 	=>$pass,
		'mailtype' 	=>$this->input->post('email_mailtype',TRUE),
		'charset' 	=>$this->input->post('email_charset',TRUE)
	);

	$this->db->where('es_id', $email)->update('email_sms_gateway',$data);

	$this->session->set_flashdata('message',display('update_successfully'));

	redirect('backend/dashboard/setting/email_gateway');
}
/*
|----------------------------
|	E-mail Gateway Form
|----------------------------
*/ 
	public function email_gateway()
	{
		$data['title'] = "Email Gateway";
		$data['email'] = $this->db->select('*')->from('email_sms_gateway')->where('es_id', 2)->get()->row();
		$data['userrole'] = $this->setting_model->getMenuSingelRoleInfo(30);
		$data['content'] = $this->load->view('backend/dashboard/email_gateway',$data,true);
		$this->load->view('backend/layout/main_wrapper',$data);
	}
/*
|----------------------------
|	Email Testing Action
|----------------------------
*/ 
	public function test_email()
	{
		$this->form_validation->set_rules('email_to','Email','required|valid_email|xss_clean');
		$this->form_validation->set_rules('email_sub','Subject','required|xss_clean');
		$this->form_validation->set_rules('email_message','Message','required|xss_clean');


		if($this->form_validation->run()){

			$post = array(
				'title'             => "Test Email Gateway",
				'subject'           => $this->input->post('email_sub',TRUE),
				'to'                => $this->input->post('email_to',TRUE),
				'message'           => $this->input->post('email_message',TRUE),
			);

			if(@$this->Common_model->send_email($post)){

				$this->session->set_flashdata('message','Email Send Successfully!');
			} else {

				$this->session->set_flashdata('exception', $this->email->print_debugger(array('headers')));
			}

		} else {

			$this->session->set_flashdata('exception',validation_errors());
		}

		redirect('backend/dashboard/setting/email_gateway');
	}

	public function test_sms()
	{

		$this->form_validation->set_rules('mobile_num','Mobile Number','required|trim|xss_clean');
		$this->form_validation->set_rules('test_message','Test SMS','required|xss_clean');

		if($this->form_validation->run()){

			#----------------------------
	        #      SMS Test
	        #----------------------------
			$this->load->library('sms_lib');

			$mobile_num 	= $this->input->post('mobile_num',TRUE);
			$test_message 	= $this->input->post('test_message',TRUE);

			if ($mobile_num) {

				try {

					$smssend = $this->sms_lib->send(array(
						'to'                => $mobile_num, 
						'template'          => $test_message,
						'template_config'	=> ''
					));
				}
				catch (exception $e) {
					$this->session->set_flashdata('exception',"Please Set Your SMS Gateway Information!");
				}

				if (is_string($smssend) && is_array(json_decode($smssend, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false) {

					$smsdata = json_decode($smssend,true);

					if($smsdata['status']){

						$this->session->set_flashdata('message',$smsdata['message']);
					} else {

						$this->session->set_flashdata('exception',$smsdata['message']);
					}
				}
				else{

					$this->session->set_flashdata('message',$smssend);
				}

			} else {

				$this->session->set_flashdata('exception', "There is no Phone number!!!");

			}

		}else{
			$this->session->set_flashdata('exception',validation_errors());
		}

		redirect('backend/dashboard/setting/sms_gateway');
	}
}