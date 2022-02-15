<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Internal_api extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct();
    }

    /*********************
    |Websites Internal API|
    **********************/

    public function getStream()
    { 
        $cryptocoins    = $this->db->select("Symbol")
                            ->from('cryptolist')
                            ->order_by('SortOrder', 'asc')
                            ->limit(200, 0)
                            ->get()
                            ->result();

        $coin_stream = array();
        foreach ($cryptocoins as $coin_key => $coin_value) {
            array_push($coin_stream, "5~CCCAGG~".$coin_value->Symbol."~USD");
        }
          
        echo json_encode($coin_stream);
    }

    public function Settings()
    { 
        $settings       = $this->db->select("*")
                            ->get('setting')
                            ->row();
          
        echo json_encode(array('nsetting'=> $settings));
    }

    public function gateway()
    { 
        $gateway        = $this->db->select('*')
                            ->from('payment_gateway')
                            ->where('id', 4)
                            ->where('status', 1)
                            ->get()
                            ->row();
          
        echo json_encode($gateway);
    }


    /****************************************
    |Backend And Customer Panel Internal API|
    *****************************************/
    public function getAdvertisementinfo($id='')
    {
        $this->load->model('backend/cms/advertisement_model');

        if(!empty($id)){
            $advertisement = $this->advertisement_model->single($id);
        }
        else{
            $advertisement = array(
                'id'                => '',
                'name'              => '',
                'page'              => '', 
                'image'             => '',
                'script'            => '',
                'url'               => '',
                'serial_position'   => '',
                'status'            => ''
            );
        }

        echo json_encode($advertisement);
    }

    public function getemailsmsgateway()
    {
        $sms = $this->db->select('*')->from('email_sms_gateway')->where('es_id', 1)->get()->row();

        echo json_encode($sms);
    }

    public function getlinechartdata()
    {
        $current_year = date('Y');

        $investment = $this->db->query("SELECT MONTHNAME(`invest_date`) as month, SUM(`amount`) as investment FROM `investment` WHERE YEAR(`invest_date`) = '".$current_year."' GROUP BY YEAR(CURDATE()), MONTH(`invest_date`)")->result();
        $roi        = $this->db->query("SELECT MONTHNAME(`date`) as month, SUM(`amount`) as roi FROM `earnings` WHERE YEAR(`date`) = '".$current_year."' GROUP BY YEAR(CURDATE()), MONTH(`date`)")->result();

        $monthsi      = array();
        $monthsr      = array();
        $investamount = array();
        $roiamount    = array();
        if(!empty($investment)){
            foreach ($investment as $key => $value) {
                array_push($investamount,$value->investment);
                array_push($monthsi,$value->month);
            }
        }

        if(!empty($roi)){
            foreach ($roi as $key => $value) {
                array_push($roiamount,$value->roi);
                array_push($monthsr,$value->month);
            }
        }
            
        $months = array_merge($monthsi, $monthsr);
        
        echo json_encode(array('investamount'=>$investamount,'roiamount'=>$roiamount,'months'=>$months));
    }

    public function getpiechartdata($value='')
    {
        $current_year = date('Y');

        $transections = $this->db->query("SELECT `transection_category` as transection_category, SUM(`amount`) as transections FROM `transections` WHERE status=1 AND (transection_category='deposit' OR transection_category='withdraw') AND YEAR(`transection_date_timestamp`) = '".$current_year."' GROUP BY `transection_category`")->result();

        $transactioncat    = array();
        $transactionamount = array();
        foreach ($transections as $key => $value) {
            array_push($transactioncat,$value->transection_category);
            array_push($transactionamount,$value->transections);
        }

        echo json_encode(array('transactioncat'=>$transactioncat,'transactionamount'=>$transactionamount));
    }
    

}