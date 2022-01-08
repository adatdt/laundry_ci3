<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Discount extends MY_Controller{
	public function __construct(){
		parent::__construct();

        logged_in();
        $this->load->model('m_discount','discount');
        $this->load->model('global_model');
        $this->load->library('log_activitytxt');

        $this->_table    = 'app.t_mtr_discount';
        $this->_username = $this->session->userdata('username');
        $this->_module   = 'fare/discount';
	}

	public function index(){   
        checkUrlAccess(uri_string(),'view');
        if($this->input->is_ajax_request()){
            $rows = $this->discount->dataList();
            echo json_encode($rows);
            exit;
        }

        $data = array(
            'home'     => 'Home',
            'url_home' => site_url('home'),
            'title'    => 'Diskon',
            'content'  => 'discount/index',
            'port'  => $this->filter_port(),
            'btn_add'  => generate_button_new($this->_module, 'add',  site_url($this->_module.'/add')),

        );

		$this->load->view('default', $data);
	}

    public function fare_passanger()
    {
        checkUrlAccess($this->_module,'view');
        if($this->input->is_ajax_request()){
            $rows = $this->discount->fare_passanger();
            echo json_encode($rows);
            exit;
        }
    }

    public function fare_vehicle()
    {
        checkUrlAccess($this->_module,'view');
        if($this->input->is_ajax_request()){
            $rows = $this->discount->fare_vehicle();
            echo json_encode($rows);
            exit;
        }
    }

    public function payment_type()
    {
        checkUrlAccess($this->_module,'view');
        if($this->input->is_ajax_request()){
            $rows = $this->discount->payment_type();
            echo json_encode($rows);
            exit;
        }
    }

    public function add(){
        validate_ajax();
        $this->global_model->checkAccessMenuAction($this->_module,'add');

        $data['title'] = 'Tambah Diskon';
        $data['discount_schema'] = $this->discount->select_data("app.t_mtr_discount_schema", " where status=1 order by description asc")->result();
        $data['port']  = $this->filter_port();
        $data['route']  = $this->get_route2();
        $data['ship_class']  = $this->discount->select_data("app.t_mtr_ship_class"," where status=1 order by name asc")->result();
        $data['payment_type']  = $this->discount->select_data("app.t_mtr_payment_type"," order by payment_type asc ")->result();
        $data['value_type']  = $this->discount->select_data("app.t_mtr_discount_value_type"," where status=1 order by name asc ")->result();
        $this->load->view($this->_module.'/add',$data);
    }

    public function action_add()
    {
        $schema_code=$this->input->post('schema_code');
        $check=$this->discount->select_data("app.t_mtr_discount_schema"," where schema_code='{$schema_code}' ")->row();

        if($check->slug=='fare_update')
        {
            $this->schema_fare();
        }
        else if($check->slug=='basic_discount')
        {
            $this->schema_basic();
        }
        else
        {
            echo $res=json_api(0, " Belum ada schema ");

            $data=array('schema'=>'tidak ada schema');
            /* Fungsi Create Log */
            $createdBy   = $this->session->userdata('username');
            $logUrl      = site_url().'fare/discount/action_add';
            $logMethod   = 'ADD';
            $logParam    = json_encode($data);
            $logResponse = $res;

            $this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);   
        }
    }

    public function schema_fare()
    {
        validate_ajax();
        $this->global_model->checkAccessMenuAction($this->_module,'add');

        $schema_code=$this->input->post('schema_code');
        $start_date=$this->input->post('start_date');
        $end_date=$this->input->post('end_date');
        $start_time=$this->input->post('start_time');
        $end_time=$this->input->post('end_time');
        $description=$this->input->post('description');
        $route_id=$this->enc->decode($this->input->post('route'));
        $payment_type=$this->input->post('payment_type[]');

        // echo $schema_code; exit;


        $this->form_validation->set_rules('schema_code', 'Kode Scema', 'required');
        $this->form_validation->set_rules('start_date', 'Tanggal Awal', 'required');
        $this->form_validation->set_rules('end_date', 'Tanggal Akhir', 'required');
        $this->form_validation->set_rules('description', 'Nama Diskon', 'required');
        $this->form_validation->set_rules('route', 'Rute', 'required');

        $pos_passanger=$this->input->post('pos_passanger');
        $pos_vehicle=$this->input->post('pos_vehicle');
        $vm=$this->input->post('vm');
        $mobile=$this->input->post('mobile');
        $web=$this->input->post('web');
        $b2b=$this->input->post('b2b');
        $ifcs=$this->input->post('ifcs');


        // mengambil data port berdasarkan origin 
        $port_id=$this->discount->select_data("app.t_mtr_rute", "where id={$route_id} ")->row();


        $discount_code=$this->createCode($port_id->origin);

        // echo $discount_code; exit;

        $entry_fee=$this->input->post('entry_fee[]');
        $dock_fee=$this->input->post('dock_fee[]');
        $ifpro_fee=$this->input->post('ifpro_fee[]');
        $trip_fee=$this->input->post('trip_fee[]');
        $responsibility_fee=$this->input->post('responsibility_fee[]');    
        $insurance_fee=$this->input->post('insurance_fee[]'); 
        $fare=$this->input->post('fare[]');
        $passanger_type_id=$this->input->post('passanger_type[]');
        $ship_class_id=$this->input->post('ship_class[]');


        $entry_fee_eks=$this->input->post('entry_fee_eks[]');
        $dock_fee_eks=$this->input->post('dock_fee_eks[]');
        $ifpro_fee_eks=$this->input->post('ifpro_fee_eks[]');
        $trip_fee_eks=$this->input->post('trip_fee_eks[]');
        $responsibility_fee_eks=$this->input->post('responsibility_fee_eks[]');    
        $insurance_fee_eks=$this->input->post('insurance_fee_eks[]'); 
        $fare_eks=$this->input->post('fare_eks[]');
        $passanger_type_id_eks=$this->input->post('passanger_type_eks[]');
        $ship_class_id_eks=$this->input->post('ship_class_eks[]');

        // print_r($passanger_type_id_eks); exit;



        $vehicle_entry_fee=$this->input->post('vehicle_entry_fee[]');
        $vehicle_dock_fee=$this->input->post('vehicle_dock_fee[]');
        $vehicle_ifpro_fee=$this->input->post('vehicle_ifpro_fee[]');
        $vehicle_trip_fee=$this->input->post('vehicle_trip_fee[]');
        $vehicle_responsibility_fee=$this->input->post('vehicle_responsibility_fee[]');    
        $vehicle_insurance_fee=$this->input->post('vehicle_insurance_fee[]'); 
        $vehicle_fare=$this->input->post('vehicle_fare[]');
        $vehicle_class_id=$this->input->post('vehicle_class[]');
        $vehicle_ship_class_id=$this->input->post('vehicle_ship_class[]');

        // print_r($vehicle_ship_class_id); exit;



        $vehicle_entry_fee_eks=$this->input->post('vehicle_entry_fee_eks[]');
        $vehicle_dock_fee_eks=$this->input->post('vehicle_dock_fee_eks[]');
        $vehicle_ifpro_fee_eks=$this->input->post('vehicle_ifpro_fee_eks[]');
        $vehicle_trip_fee_eks=$this->input->post('vehicle_trip_fee_eks[]');
        $vehicle_responsibility_fee_eks=$this->input->post('vehicle_responsibility_fee_eks[]');    
        $vehicle_insurance_fee_eks=$this->input->post('vehicle_insurance_fee_eks[]'); 
        $vehicle_fare_eks=$this->input->post('vehicle_fare_eks[]');
        $vehicle_class_id_eks=$this->input->post('vehicle_class_eks[]');
        $vehicle_ship_class_id_eks=$this->input->post('vehicle_ship_class_eks[]');


        $data_discount=array(
            'schema_code'=>$schema_code,
            'discount_code'=>$discount_code,
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'start_time'=>$start_time,
            'end_time'=>$end_time,
            'split_date'=>$start_time>$end_time?'true':'false',
            'description'=>$description,
            'pos_passanger'=>empty($pos_passanger)?'false':'true',
            'pos_vehicle'=>empty($pos_vehicle)?'false':'true',
            'vm'=>empty($vm)?'false':'true',
            'mobile'=>empty($mobile)?'false':'true',
            'web'=>empty($web)?'false':'true',
            'b2b'=>empty($b2b)?'false':'true',
            'ifcs'=>empty($ifcs)?'false':'true',
            'status'=>1,
            'created_on'=>date('Y-m-d H:i:s'),
            'created_by'=>$this->session->userdata('username')
        );

        // print_r($data_discount); exit;

        $data_discount_port=array(

            'discount_code'=>$discount_code,
            'port_id'=>$port_id->origin,
            'rute_id'=>$route_id,
            'status'=>1,
            'created_on'=>date("Y-m-d H:i:s"),
            'created_by'=>$this->session->userdata('username'),
        );


        $data_discount_detail=array();
        if(count($payment_type)>0)
        {
            foreach ($payment_type as $key => $value) {
                
                $data_discount_detail[]=array(
                    'discount_code'=>$discount_code,
                    'payment_type'=>$value,
                    'value'=>0,
                    'status'=>1,
                    'created_on'=>date("Y-m-d H:i:s"),
                    'created_by'=>$this->session->userdata('username'),
                );       
            }
        }



        $data_discount_ship_class_reg=array(
            'discount_code'=>$discount_code,
            'ship_class'=>1, // hard cord
            'status'=>1,
            'created_on'=>date("Y-m-d H:i:s"),
            'created_by'=>$this->session->userdata('username'),
        );

        $data_discount_ship_class_eks=array(
            'discount_code'=>$discount_code,
            'ship_class'=>2, // hard cord
            'status'=>1,
            'created_on'=>date("Y-m-d H:i:s"),
            'created_by'=>$this->session->userdata('username'),
        );


        $fare_pass=array();
        $fare_pass_eks=array();
        $fare_veh=array();
        $fare_veh_eks=array();



        if (count($entry_fee)>0)
        {
            foreach ($entry_fee as $key => $value) 
            {
                $fare_pass[]=array(
                    'fare'=>$fare[$key],
                    'entry_fee'=>$value,
                    'dock_fee'=>$dock_fee[$key],
                    'trip_fee'=>$trip_fee[$key],
                    'responsibility_fee'=>$responsibility_fee[$key],
                    'insurance_fee'=>$insurance_fee[$key],
                    'ifpro_fee'=>$ifpro_fee[$key],
                    'discount_code'=>$discount_code,
                    'rute_id'=>$route_id,
                    'passanger_type'=>$this->enc->decode($passanger_type_id[$key]),
                    'ship_class'=>$this->enc->decode($ship_class_id[$key]),
                    'created_on'=>date("Y-m-d H:i:s"),
                    'created_by'=>$this->session->userdata("username"),

                );
            }

        }

        if (count($entry_fee_eks)>0)
        {
            foreach ($entry_fee_eks as $key => $value) 
            {
                $fare_pass_eks[]=array(
                    'fare'=>$fare_eks[$key],
                    'entry_fee'=>$value,
                    'dock_fee'=>$dock_fee_eks[$key],
                    'trip_fee'=>$trip_fee_eks[$key],
                    'responsibility_fee'=>$responsibility_fee_eks[$key],
                    'insurance_fee'=>$insurance_fee_eks[$key],
                    'ifpro_fee'=>$ifpro_fee_eks[$key],
                    'discount_code'=>$discount_code,
                    'rute_id'=>$route_id,
                    'passanger_type'=>$this->enc->decode($passanger_type_id_eks[$key]),
                    'ship_class'=>$this->enc->decode($ship_class_id_eks[$key]),
                    'created_on'=>date("Y-m-d H:i:s"),
                    'created_by'=>$this->session->userdata("username"),
                );
            }

        }

        if (count($vehicle_entry_fee)>0)
        {
            foreach ($vehicle_entry_fee as $key => $value) 
            {
                $fare_veh[]=array(
                    'fare'=>$vehicle_fare[$key],
                    'entry_fee'=>$value,
                    'dock_fee'=>$vehicle_dock_fee[$key],
                    'trip_fee'=>$vehicle_trip_fee[$key],
                    'responsibility_fee'=>$vehicle_responsibility_fee[$key],
                    'insurance_fee'=>$vehicle_insurance_fee[$key],
                    'ifpro_fee'=>$vehicle_ifpro_fee[$key],
                    'discount_code'=>$discount_code,
                    'rute_id'=>$route_id,
                    'vehicle_class_id'=>$this->enc->decode($vehicle_class_id[$key]),
                    'ship_class'=>$this->enc->decode($vehicle_ship_class_id[$key]),
                    'created_on'=>date("Y-m-d H:i:s"),
                    'created_by'=>$this->session->userdata("username"),
                );
            }

        }


        if (count($vehicle_entry_fee_eks)>0)
        {
            foreach ($vehicle_entry_fee_eks as $key => $value) 
            {
                $fare_veh_eks[]=array(
                    'fare'=>$vehicle_fare_eks[$key],
                    'entry_fee'=>$value,
                    'dock_fee'=>$vehicle_dock_fee_eks[$key],
                    'trip_fee'=>$vehicle_trip_fee_eks[$key],
                    'responsibility_fee'=>$vehicle_responsibility_fee_eks[$key],
                    'insurance_fee'=>$vehicle_insurance_fee_eks[$key],
                    'ifpro_fee'=>$vehicle_ifpro_fee_eks[$key],
                    'discount_code'=>$discount_code,
                    'rute_id'=>$route_id,
                    'vehicle_class_id'=>$this->enc->decode($vehicle_class_id_eks[$key]),
                    'ship_class'=>$this->enc->decode($vehicle_ship_class_id_eks[$key]),
                    'created_on'=>date("Y-m-d H:i:s"),
                    'created_by'=>$this->session->userdata("username"),
                );
            }

        }

        // print_r($data_discount); exit;

        $this->form_validation->set_message('required','%s harus diisi!');
        
        $data=array('discount'=>$data_discount,
            'detail_discount_port'=>$data_discount_port,
            'detail_ship_class_reg'=>$data_discount_ship_class_reg,
            'detail_ship_class_eks'=>$data_discount_ship_class_eks,
            'detail_discount'=>$data_discount_detail,
            'disscount_detail_pass'=>$fare_pass,
            'disscount_detail_pass_eks'=>$fare_pass_eks,
            'disscount_detail_veh'=>$fare_veh,
            'disscount_detail_veh_eks'=>$fare_veh_eks,
            );

        if($this->form_validation->run()===false)
        {
            echo $res=json_api(0, validation_errors());
        }
        else if(count($data_discount_detail)<1)
        {
            echo $res=json_api(0, " Tipe pembayaran harus dipilih ");
        }

        else if(empty($pos_passanger) and empty($pos_vehicle) and empty($mobile)  and empty($vm) and empty($b2b) and empty($web)  and empty($ifcs) )
        {
            echo $res=json_api(0, "Tempat berlaku harus di pilih");
        }
        else if(count($vehicle_entry_fee_eks)<1 and count($vehicle_entry_fee)<1 and count($entry_fee)<1 and count($entry_fee_eks)<1 )
        {
            echo $res=json_api(0, "rute tidak mempunyai punya tarif dasar");   
        }
        else if ($start_date>$end_date)
        {
            echo $res=json_api(0,"Tanggal awal berlaku tidak boleh lebih besar dari tanggal akhir berlaku");   
        }
        else
        {

            $this->db->trans_begin();

            $this->discount->insert_data("app.t_mtr_discount",$data_discount);
            $this->discount->insert_data("app.t_mtr_discount_detail_port", $data_discount_port);
            $this->discount->insert_data("app.t_mtr_discount_detail_ship_class",$data_discount_ship_class_reg);
            $this->discount->insert_data("app.t_mtr_discount_detail_ship_class",$data_discount_ship_class_eks);

            if(count($data_discount_detail)>0)
            {
                $this->discount->insert_batch_data("app.t_mtr_discount_detail",$data_discount_detail);
            }

            if(count($fare_pass)>0)
            {
                $this->discount->insert_batch_data("app.t_mtr_discount_fare_passanger",$fare_pass);   
            }

            if(count($fare_pass_eks)>0)
            {
                $this->discount->insert_batch_data("app.t_mtr_discount_fare_passanger",$fare_pass_eks);
            }

            if(count($fare_veh)>0)
            {
                $this->discount->insert_batch_data("app.t_mtr_discount_fare_vehicle",$fare_veh);
            }

            if(count($fare_veh_eks)>0)
            {
                $this->discount->insert_batch_data("app.t_mtr_discount_fare_vehicle",$fare_veh_eks);
            }

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                echo $res=json_api(0, 'Gagal tambah data');
            }
            else
            {
                $this->db->trans_commit();
                echo $res=json_api(1, 'Berhasil tambah data');
            }
        }


         /* Fungsi Create Log */
        $createdBy   = $this->session->userdata('username');
        $logUrl      = site_url().'fare/discount/action_add';
        $logMethod   = 'ADD';
        $logParam    = json_encode($data);
        $logResponse = $res;

        $this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
    }


    public function schema_basic()
    {
        validate_ajax();
        $this->global_model->checkAccessMenuAction($this->_module,'add');

        $schema_code=$this->input->post('schema_code');
        $start_date=$this->input->post('start_date');
        $end_date=$this->input->post('end_date');
        $start_time=$this->input->post('start_time');
        $end_time=$this->input->post('end_time');
        $data_value=trim($this->input->post('value'));
        $description=$this->input->post('description');
        $route_id=$this->enc->decode($this->input->post('route'));
        $ship_class=$this->enc->decode($this->input->post('ship_class'));
        $value_type=$this->enc->decode($this->input->post('value_type'));
        $payment_type=$this->input->post('payment_type[]');

        // echo $data_value; exit;


        $this->form_validation->set_rules('schema_code', 'Kode Scema', 'required');
        $this->form_validation->set_rules('start_date', 'Tanggal Awal', 'required');
        $this->form_validation->set_rules('end_date', 'Tanggal Akhir', 'required');
        $this->form_validation->set_rules('description', 'Nama Diskon', 'required');
        $this->form_validation->set_rules('route', 'Rute', 'required');

        $pos_passanger=$this->input->post('pos_passanger');
        $pos_vehicle=$this->input->post('pos_vehicle');
        $vm=$this->input->post('vm');
        $mobile=$this->input->post('mobile');
        $web=$this->input->post('web');
        $b2b=$this->input->post('b2b');
        $ifcs=$this->input->post('ifcs');


        // mengambil data port berdasarkan origin 
        $port_id=$this->discount->select_data("app.t_mtr_rute", "where id={$route_id} ")->row();


        $discount_code=$this->createCode($port_id->origin);

        $data_discount=array(
            'schema_code'=>$schema_code,
            'discount_code'=>$discount_code,
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'start_time'=>$start_time,
            'end_time'=>$end_time,
            'split_date'=>$start_time>$end_time?'true':'false',
            'description'=>$description,
            'pos_passanger'=>empty($pos_passanger)?'false':'true',
            'pos_vehicle'=>empty($pos_vehicle)?'false':'true',
            'vm'=>empty($vm)?'false':'true',
            'mobile'=>empty($mobile)?'false':'true',
            'web'=>empty($web)?'false':'true',
            'b2b'=>empty($b2b)?'false':'true',
            'ifcs'=>empty($ifcs)?'false':'true',
            'status'=>1,
            'created_on'=>date('Y-m-d H:i:s'),
            'created_by'=>$this->session->userdata('username')
        );

        // print_r($data_discount); exit;

        $data_discount_port=array(

            'discount_code'=>$discount_code,
            'port_id'=>$port_id->origin,
            'rute_id'=>$route_id,
            'status'=>1,
            'created_on'=>date("Y-m-d H:i:s"),
            'created_by'=>$this->session->userdata('username'),
        );


        $data_discount_detail=array();
        if(count($payment_type)>0)
        {
            foreach ($payment_type as $key => $value) {
                
                $data_discount_detail[]=array(
                    'discount_code'=>$discount_code,
                    'payment_type'=>$value,
                    'value'=>$data_value,
                    'value_type'=>$value_type,
                    'status'=>1,
                    'created_on'=>date("Y-m-d H:i:s"),
                    'created_by'=>$this->session->userdata('username'),
                );       
            }
        }

        // print_r($data_discount_detail); exit;



        $data_discount_ship_class_reg=array(
            'discount_code'=>$discount_code,
            'ship_class'=>1, // hard cord
            'status'=>1,
            'created_on'=>date("Y-m-d H:i:s"),
            'created_by'=>$this->session->userdata('username'),
        );

        $data_discount_ship_class_eks=array(
            'discount_code'=>$discount_code,
            'ship_class'=>2, // hard cord
            'status'=>1,
            'created_on'=>date("Y-m-d H:i:s"),
            'created_by'=>$this->session->userdata('username'),
        );


        // print_r($data_discount); exit;

        $this->form_validation->set_message('required','%s harus diisi!');
        
        $data=array('discount'=>$data_discount,
            'detail_discount_port'=>$data_discount_port,
            'detail_ship_class_reg'=>$data_discount_ship_class_reg,
            'detail_ship_class_eks'=>$data_discount_ship_class_eks,
            'detail_discount'=>$data_discount_detail,
            );

        if($this->form_validation->run()===false)
        {
            echo $res=json_api(0, validation_errors());
        }
        else if(count($data_discount_detail)<1)
        {
            echo $res=json_api(0, " Tipe pembayaran harus dipilih ");
        }

        else if(empty($pos_passanger) and empty($pos_vehicle) and empty($mobile)  and empty($vm) and empty($b2b) and empty($web) and empty($ifcs) )
        {
            echo $res=json_api(0, "Tempat berlaku harus di pilih");
        }
        else if ($start_date>$end_date)
        {
            echo $res=json_api(0,"Tanggal awal berlaku tidak boleh lebih besar dari tanggal akhir berlaku");   
        }
        else
        {

            $this->db->trans_begin();

            $this->discount->insert_data("app.t_mtr_discount",$data_discount);
            $this->discount->insert_data("app.t_mtr_discount_detail_port", $data_discount_port);

            if($ship_class==1)
            {
                $this->discount->insert_data("app.t_mtr_discount_detail_ship_class",$data_discount_ship_class_reg);
            }
            else if($ship_class==2)
            {
                $this->discount->insert_data("app.t_mtr_discount_detail_ship_class",$data_discount_ship_class_eks);
            }
            else
            {
                $this->discount->insert_data("app.t_mtr_discount_detail_ship_class",$data_discount_ship_class_reg);
                $this->discount->insert_data("app.t_mtr_discount_detail_ship_class",$data_discount_ship_class_eks);
            }

            if(count($data_discount_detail)>0)
            {
                $this->discount->insert_batch_data("app.t_mtr_discount_detail",$data_discount_detail);
            }

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                echo $res=json_api(0, 'Gagal tambah data');
            }
            else
            {
                $this->db->trans_commit();
                echo $res=json_api(1, 'Berhasil tambah data');
            }
        }


         /* Fungsi Create Log */
        $createdBy   = $this->session->userdata('username');
        $logUrl      = site_url().'fare/discount/action_add';
        $logMethod   = 'ADD';
        $logParam    = json_encode($data);
        $logResponse = $res;

        $this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
    }


    // public function action_add()
    // {
    //     validate_ajax();
    //     $this->global_model->checkAccessMenuAction($this->_module,'add');

    //     $schema_code=$this->input->post('schema_code');
    //     $start_date=$this->input->post('start_date');
    //     $end_date=$this->input->post('end_date');
    //     $start_time=$this->input->post('start_time');
    //     $end_time=$this->input->post('end_time');
    //     $description=$this->input->post('description');
    //     $route_id=$this->enc->decode($this->input->post('route'));
    //     $payment_type=$this->input->post('payment_type[]');

    //     // echo $schema_code; exit;


    //     $this->form_validation->set_rules('schema_code', 'Kode Scema', 'required');
    //     $this->form_validation->set_rules('start_date', 'Tanggal Awal', 'required');
    //     $this->form_validation->set_rules('end_date', 'Tanggal Akhir', 'required');
    //     $this->form_validation->set_rules('description', 'Nama Diskon', 'required');
    //     $this->form_validation->set_rules('route', 'Rute', 'required');

    //     $pos_passanger=$this->input->post('pos_passanger');
    //     $pos_vehicle=$this->input->post('pos_vehicle');
    //     $vm=$this->input->post('vm');
    //     $mobile=$this->input->post('mobile');
    //     $web=$this->input->post('web');
    //     $b2b=$this->input->post('b2b');


    //     // mengambil data port berdasarkan origin 
    //     $port_id=$this->discount->select_data("app.t_mtr_rute", "where id={$route_id} ")->row();


    //     $discount_code=$this->createCode($port_id->origin);

    //     // echo $discount_code; exit;

    //     $entry_fee=$this->input->post('entry_fee[]');
    //     $dock_fee=$this->input->post('dock_fee[]');
    //     $ifpro_fee=$this->input->post('ifpro_fee[]');
    //     $trip_fee=$this->input->post('trip_fee[]');
    //     $responsibility_fee=$this->input->post('responsibility_fee[]');    
    //     $insurance_fee=$this->input->post('insurance_fee[]'); 
    //     $fare=$this->input->post('fare[]');
    //     $passanger_type_id=$this->input->post('passanger_type[]');
    //     $ship_class_id=$this->input->post('ship_class[]');


    //     $entry_fee_eks=$this->input->post('entry_fee_eks[]');
    //     $dock_fee_eks=$this->input->post('dock_fee_eks[]');
    //     $ifpro_fee_eks=$this->input->post('ifpro_fee_eks[]');
    //     $trip_fee_eks=$this->input->post('trip_fee_eks[]');
    //     $responsibility_fee_eks=$this->input->post('responsibility_fee_eks[]');    
    //     $insurance_fee_eks=$this->input->post('insurance_fee_eks[]'); 
    //     $fare_eks=$this->input->post('fare_eks[]');
    //     $passanger_type_id_eks=$this->input->post('passanger_type_eks[]');
    //     $ship_class_id_eks=$this->input->post('ship_class_eks[]');

    //     // print_r($passanger_type_id_eks); exit;



    //     $vehicle_entry_fee=$this->input->post('vehicle_entry_fee[]');
    //     $vehicle_dock_fee=$this->input->post('vehicle_dock_fee[]');
    //     $vehicle_ifpro_fee=$this->input->post('vehicle_ifpro_fee[]');
    //     $vehicle_trip_fee=$this->input->post('vehicle_trip_fee[]');
    //     $vehicle_responsibility_fee=$this->input->post('vehicle_responsibility_fee[]');    
    //     $vehicle_insurance_fee=$this->input->post('vehicle_insurance_fee[]'); 
    //     $vehicle_fare=$this->input->post('vehicle_fare[]');
    //     $vehicle_class_id=$this->input->post('vehicle_class[]');
    //     $vehicle_ship_class_id=$this->input->post('vehicle_ship_class[]');

    //     // print_r($vehicle_ship_class_id); exit;



    //     $vehicle_entry_fee_eks=$this->input->post('vehicle_entry_fee_eks[]');
    //     $vehicle_dock_fee_eks=$this->input->post('vehicle_dock_fee_eks[]');
    //     $vehicle_ifpro_fee_eks=$this->input->post('vehicle_ifpro_fee_eks[]');
    //     $vehicle_trip_fee_eks=$this->input->post('vehicle_trip_fee_eks[]');
    //     $vehicle_responsibility_fee_eks=$this->input->post('vehicle_responsibility_fee_eks[]');    
    //     $vehicle_insurance_fee_eks=$this->input->post('vehicle_insurance_fee_eks[]'); 
    //     $vehicle_fare_eks=$this->input->post('vehicle_fare_eks[]');
    //     $vehicle_class_id_eks=$this->input->post('vehicle_class_eks[]');
    //     $vehicle_ship_class_id_eks=$this->input->post('vehicle_ship_class_eks[]');


    //     $data_discount=array(
    //         'schema_code'=>$schema_code,
    //         'discount_code'=>$discount_code,
    //         'start_date'=>$start_date,
    //         'end_date'=>$end_date,
    //         'start_time'=>$start_time,
    //         'end_time'=>$end_time,
    //         'split_date'=>$start_time>$end_time?'true':'false',
    //         'description'=>$description,
    //         'pos_passanger'=>empty($pos_passanger)?'false':'true',
    //         'pos_vehicle'=>empty($pos_vehicle)?'false':'true',
    //         'vm'=>empty($vm)?'false':'true',
    //         'mobile'=>empty($mobile)?'false':'true',
    //         'web'=>empty($web)?'false':'true',
    //         'b2b'=>empty($b2b)?'false':'true',
    //         'status'=>1,
    //         'created_on'=>date('Y-m-d H:i:s'),
    //         'created_by'=>$this->session->userdata('username')
    //     );

    //     $data_discount_port=array(

    //         'discount_code'=>$discount_code,
    //         'port_id'=>$port_id->origin,
    //         'rute_id'=>$route_id,
    //         'status'=>1,
    //         'created_on'=>date("Y-m-d H:i:s"),
    //         'created_by'=>$this->session->userdata('username'),
    //     );


    //     $data_discount_detail=array();
    //     if(count($payment_type)>0)
    //     {
    //         foreach ($payment_type as $key => $value) {
                
    //             $data_discount_detail[]=array(
    //                 'discount_code'=>$discount_code,
    //                 'payment_type'=>$value,
    //                 'value'=>0,
    //                 'status'=>1,
    //                 'created_on'=>date("Y-m-d H:i:s"),
    //                 'created_by'=>$this->session->userdata('username'),
    //             );       
    //         }
    //     }



    //     $data_discount_ship_class_reg=array(
    //         'discount_code'=>$discount_code,
    //         'ship_class'=>1, // hard cord
    //         'status'=>1,
    //         'created_on'=>date("Y-m-d H:i:s"),
    //         'created_by'=>$this->session->userdata('username'),
    //     );

    //     $data_discount_ship_class_eks=array(
    //         'discount_code'=>$discount_code,
    //         'ship_class'=>2, // hard cord
    //         'status'=>1,
    //         'created_on'=>date("Y-m-d H:i:s"),
    //         'created_by'=>$this->session->userdata('username'),
    //     );


    //     $fare_pass=array();
    //     $fare_pass_eks=array();
    //     $fare_veh=array();
    //     $fare_veh_eks=array();



    //     if (count($entry_fee)>0)
    //     {
    //         foreach ($entry_fee as $key => $value) 
    //         {
    //             $fare_pass[]=array(
    //                 'fare'=>$fare[$key],
    //                 'entry_fee'=>$value,
    //                 'dock_fee'=>$dock_fee[$key],
    //                 'trip_fee'=>$trip_fee[$key],
    //                 'responsibility_fee'=>$responsibility_fee[$key],
    //                 'insurance_fee'=>$insurance_fee[$key],
    //                 'ifpro_fee'=>$ifpro_fee[$key],
    //                 'discount_code'=>$discount_code,
    //                 'rute_id'=>$route_id,
    //                 'passanger_type'=>$this->enc->decode($passanger_type_id[$key]),
    //                 'ship_class'=>$this->enc->decode($ship_class_id[$key]),
    //                 'created_on'=>date("Y-m-d H:i:s"),
    //                 'created_by'=>$this->session->userdata("username"),

    //             );
    //         }

    //     }

    //     if (count($entry_fee_eks)>0)
    //     {
    //         foreach ($entry_fee_eks as $key => $value) 
    //         {
    //             $fare_pass_eks[]=array(
    //                 'fare'=>$fare_eks[$key],
    //                 'entry_fee'=>$value,
    //                 'dock_fee'=>$dock_fee_eks[$key],
    //                 'trip_fee'=>$trip_fee_eks[$key],
    //                 'responsibility_fee'=>$responsibility_fee_eks[$key],
    //                 'insurance_fee'=>$insurance_fee_eks[$key],
    //                 'ifpro_fee'=>$ifpro_fee_eks[$key],
    //                 'discount_code'=>$discount_code,
    //                 'rute_id'=>$route_id,
    //                 'passanger_type'=>$this->enc->decode($passanger_type_id_eks[$key]),
    //                 'ship_class'=>$this->enc->decode($ship_class_id_eks[$key]),
    //                 'created_on'=>date("Y-m-d H:i:s"),
    //                 'created_by'=>$this->session->userdata("username"),
    //             );
    //         }

    //     }

    //     if (count($vehicle_entry_fee)>0)
    //     {
    //         foreach ($vehicle_entry_fee as $key => $value) 
    //         {
    //             $fare_veh[]=array(
    //                 'fare'=>$vehicle_fare[$key],
    //                 'entry_fee'=>$value,
    //                 'dock_fee'=>$vehicle_dock_fee[$key],
    //                 'trip_fee'=>$vehicle_trip_fee[$key],
    //                 'responsibility_fee'=>$vehicle_responsibility_fee[$key],
    //                 'insurance_fee'=>$vehicle_insurance_fee[$key],
    //                 'ifpro_fee'=>$vehicle_ifpro_fee[$key],
    //                 'discount_code'=>$discount_code,
    //                 'rute_id'=>$route_id,
    //                 'vehicle_class_id'=>$this->enc->decode($vehicle_class_id[$key]),
    //                 'ship_class'=>$this->enc->decode($vehicle_ship_class_id[$key]),
    //                 'created_on'=>date("Y-m-d H:i:s"),
    //                 'created_by'=>$this->session->userdata("username"),
    //             );
    //         }

    //     }


    //     if (count($vehicle_entry_fee_eks)>0)
    //     {
    //         foreach ($vehicle_entry_fee_eks as $key => $value) 
    //         {
    //             $fare_veh_eks[]=array(
    //                 'fare'=>$vehicle_fare_eks[$key],
    //                 'entry_fee'=>$value,
    //                 'dock_fee'=>$vehicle_dock_fee_eks[$key],
    //                 'trip_fee'=>$vehicle_trip_fee_eks[$key],
    //                 'responsibility_fee'=>$vehicle_responsibility_fee_eks[$key],
    //                 'insurance_fee'=>$vehicle_insurance_fee_eks[$key],
    //                 'ifpro_fee'=>$vehicle_ifpro_fee_eks[$key],
    //                 'discount_code'=>$discount_code,
    //                 'rute_id'=>$route_id,
    //                 'vehicle_class_id'=>$this->enc->decode($vehicle_class_id_eks[$key]),
    //                 'ship_class'=>$this->enc->decode($vehicle_ship_class_id_eks[$key]),
    //                 'created_on'=>date("Y-m-d H:i:s"),
    //                 'created_by'=>$this->session->userdata("username"),
    //             );
    //         }

    //     }

    //     // print_r($data_discount); exit;

    //     $this->form_validation->set_message('required','%s harus diisi!');
        
    //     $data=array('discount'=>$data_discount,
    //         'detail_discount_port'=>$data_discount_port,
    //         'detail_ship_class_reg'=>$data_discount_ship_class_reg,
    //         'detail_ship_class_eks'=>$data_discount_ship_class_eks,
    //         'detail_discount'=>$data_discount_detail,
    //         'disscount_detail_pass'=>$fare_pass,
    //         'disscount_detail_pass_eks'=>$fare_pass_eks,
    //         'disscount_detail_veh'=>$fare_veh,
    //         'disscount_detail_veh_eks'=>$fare_veh_eks,
    //         );

    //     if($this->form_validation->run()===false)
    //     {
    //         echo $res=json_api(0, validation_errors());
    //     }
    //     else if(count($data_discount_detail)<1)
    //     {
    //         echo $res=json_api(0, " Tipe pembayaran harus dipilih ");
    //     }

    //     else if(empty($pos_passanger) and empty($pos_vehicle) and empty($mobile)  and empty($vm) and empty($b2b) and empty($web))
    //     {
    //         echo $res=json_api(0, "Tempat berlaku harus di pilih");
    //     }
    //     else if ($start_date>$end_date)
    //     {
    //         echo $res=json_api(0,"Tanggal awal berlaku tidak boleh lebih besar dari tanggal akhir berlaku");   
    //     }
    //     else
    //     {

    //         $this->db->trans_begin();

    //         $this->discount->insert_data("app.t_mtr_discount",$data_discount);
    //         $this->discount->insert_data("app.t_mtr_discount_detail_port", $data_discount_port);
    //         $this->discount->insert_data("app.t_mtr_discount_detail_ship_class",$data_discount_ship_class_reg);
    //         $this->discount->insert_data("app.t_mtr_discount_detail_ship_class",$data_discount_ship_class_eks);

    //         if(count($data_discount_detail)>0)
    //         {
    //             $this->discount->insert_batch_data("app.t_mtr_discount_detail",$data_discount_detail);
    //         }

    //         if(count($fare_pass)>0)
    //         {
    //             $this->discount->insert_batch_data("app.t_mtr_discount_fare_passanger",$fare_pass);   
    //         }

    //         if(count($fare_pass_eks)>0)
    //         {
    //             $this->discount->insert_batch_data("app.t_mtr_discount_fare_passanger",$fare_pass_eks);
    //         }

    //         if(count($fare_veh)>0)
    //         {
    //             $this->discount->insert_batch_data("app.t_mtr_discount_fare_vehicle",$fare_veh);
    //         }

    //         if(count($fare_veh_eks)>0)
    //         {
    //             $this->discount->insert_batch_data("app.t_mtr_discount_fare_vehicle",$fare_veh_eks);
    //         }

    //         // $data_discount
    //         // $data_discount_port
    //         // $data_discount_ship_class_reg
    //         // $data_discount_ship_class_eks
    //         // $data_discount_detail[]
    //         // $fare_pas[];
    //         // $fare_pass_eks[];
    //         // $fare_veh[];
    //         // $fare_veh_eks[];

    //         if ($this->db->trans_status() === FALSE)
    //         {
    //             $this->db->trans_rollback();
    //             echo $res=json_api(0, 'Gagal tambah data');
    //         }
    //         else
    //         {
    //             $this->db->trans_commit();
    //             echo $res=json_api(1, 'Berhasil tambah data');
    //         }
    //     }


    //      /* Fungsi Create Log */
    //     $createdBy   = $this->session->userdata('username');
    //     $logUrl      = site_url().'fare/discount/action_add';
    //     $logMethod   = 'ADD';
    //     $logParam    = json_encode($data);
    //     $logResponse = $res;

    //     $this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
    // }

    public function edit($discount_code)
    {
        validate_ajax();
        $this->global_model->checkAccessMenuAction($this->_module,'edit');

        $code_decode=$this->enc->decode($discount_code);        

        $schema_slug=$this->discount->get_schema("$code_decode")->row();

        $data['dicount_code']=$code_decode;
        $data['title'] = 'Edit Schema Diskon';
        $data['payment_type']=$this->discount->select_data("app.t_mtr_payment_type"," order by payment_type asc")->result();


        if($schema_slug->slug=='fare_update')            
        {
             // Mengambil tarif penumpang reguler
            $data['pr']=$this->discount->get_discount_fare_passanger($code_decode,1)->result();

            // Mengambil tarif penumpang eksekutif
            $data['pe']=$this->discount->get_discount_fare_passanger($code_decode,2)->result();

            // Mengambil tarif kendaraan reguler
            $data['vr']=$this->discount->get_discount_fare_vehicle($code_decode,1)->result();
            
            // Mengambil tarif kendaraan ekse
            $data['ve']=$this->discount->get_discount_fare_vehicle($code_decode,2)->result();

            $data['discount_schema']=$this->discount->select_data("app.t_mtr_discount_schema"," where schema_code='{$schema_slug->schema_code}' order by description asc   ")->result();
            $data['detail_discount']=$this->discount->select_data("app.t_mtr_discount_detail", " where discount_code='{$code_decode}' and status=1  ")->result();
            $data['discount']=$this->discount->select_data($this->_table, " where discount_code='{$code_decode}'")->row();

            $data['detail_port']=$this->discount->get_detail_port(" where a.discount_code='{$code_decode}' ")->result();

            $this->load->view($this->_module.'/edit1',$data);
        }
        else if($schema_slug->slug=='basic_discount')
        {
            $check_discount_ship_class=$this->discount->select_data("app.t_mtr_discount_detail_ship_class"," where discount_code='{$code_decode}' and status=1 ");

            $data['discount_schema']=$this->discount->select_data("app.t_mtr_discount_schema"," where schema_code='{$schema_slug->schema_code}' order by description asc   ")->result();
            $data['detail_discount']=$this->discount->select_data("app.t_mtr_discount_detail", " where discount_code='{$code_decode}' and status=1  ")->result();
            $data['discount']=$this->discount->select_data($this->_table, " where discount_code='{$code_decode}'")->row();

            $data['detail_port']=$this->discount->get_detail_port(" where a.discount_code='{$code_decode}' ")->row();

            $data['detail_value']=$this->discount->select_data("app.t_mtr_discount_detail", " where discount_code='{$code_decode}' and status=1  ")->row();

            $data['value_type']  = $this->discount->select_data("app.t_mtr_discount_value_type"," where status=1 order by name asc ")->result();

            if(count($check_discount_ship_class->result())>1)
            {
                $data['ship_class_name']='SEMUA TIPE';
            }
            else
            {
                $data_check=$check_discount_ship_class->row();

                // if($data_check->ship_class==1)
                // {
                //     $data_class=$this->discount->select_data("app.t_mtr_ship_class"," where id=1 ")->row();
                //     $data['ship_class_name']=strtoupper($data_class->name);
                // }
                // else
                // {
                //     $data_class=$this->discount->select_data("app.t_mtr_ship_class"," where id=1 ")->row();
                //     $data['ship_class_name']=strtoupper($data_class->name);
                // }


                $data_class=$this->discount->select_data("app.t_mtr_ship_class"," where id='{$data_check->ship_class}' ")->row();
                    $data['ship_class_name']=strtoupper($data_class->name);

            }

            $this->load->view($this->_module.'/edit2',$data);

        }
   
    }

    public function action_edit1()      
    {
        validate_ajax();
        $this->global_model->checkAccessMenuAction($this->_module,'edit');

        $discount_code=trim($this->input->post('discount_code'));
        $start_date=trim($this->input->post('start_date'));
        $end_date=trim($this->input->post('end_date'));
        $description=trim($this->input->post('description'));
        $start_time=trim($this->input->post('start_time'));
        $end_time=trim($this->input->post('end_time'));
        $pos_passanger=$this->input->post('pos_passanger');
        $pos_vehicle=$this->input->post('pos_vehicle');
        $vm=$this->input->post('vm');
        $mobile=$this->input->post('mobile');
        $web=$this->input->post('web');
        $b2b=$this->input->post('b2b');
        $ifcs=$this->input->post('ifcs');

        $payment_type=$this->input->post('payment_type[]');

        // print_r($payment_type); exit;

        $entry_fee=$this->input->post('entry_fee[]');
        $dock_fee=$this->input->post('dock_fee[]');
        $ifpro_fee=$this->input->post('ifpro_fee[]');
        $trip_fee=$this->input->post('trip_fee[]');
        $responsibility_fee=$this->input->post('responsibility_fee[]');    
        $insurance_fee=$this->input->post('insurance_fee[]'); 
        $fare=$this->input->post('fare[]');
        $passanger_type_id=$this->input->post('passanger_type[]');
        $ship_class_id=$this->input->post('ship_class[]');
        $id_dis_fare_pass=$this->input->post('id_dis_fare_pass[]');


        $entry_fee_eks=$this->input->post('entry_fee_eks[]');
        $dock_fee_eks=$this->input->post('dock_fee_eks[]');
        $ifpro_fee_eks=$this->input->post('ifpro_fee_eks[]');
        $trip_fee_eks=$this->input->post('trip_fee_eks[]');
        $responsibility_fee_eks=$this->input->post('responsibility_fee_eks[]');    
        $insurance_fee_eks=$this->input->post('insurance_fee_eks[]'); 
        $fare_eks=$this->input->post('fare_eks[]');
        $passanger_type_id_eks=$this->input->post('passanger_type_eks[]');
        $ship_class_id_eks=$this->input->post('ship_class_eks[]');
        $id_dis_fare_pass_eks=$this->input->post('id_dis_fare_pass_eks[]');

        // print_r($passanger_type_id_eks); exit;

        $vehicle_entry_fee=$this->input->post('vehicle_entry_fee[]');
        $vehicle_dock_fee=$this->input->post('vehicle_dock_fee[]');
        $vehicle_ifpro_fee=$this->input->post('vehicle_ifpro_fee[]');
        $vehicle_trip_fee=$this->input->post('vehicle_trip_fee[]');
        $vehicle_responsibility_fee=$this->input->post('vehicle_responsibility_fee[]');    
        $vehicle_insurance_fee=$this->input->post('vehicle_insurance_fee[]'); 
        $vehicle_fare=$this->input->post('vehicle_fare[]');
        $vehicle_class_id=$this->input->post('vehicle_class[]');
        $vehicle_ship_class_id=$this->input->post('vehicle_ship_class[]');
        $id_dis_fare_veh=$this->input->post('id_dis_fare_veh[]');

        // print_r($vehicle_ship_class_id); exit;

        $vehicle_entry_fee_eks=$this->input->post('vehicle_entry_fee_eks[]');
        $vehicle_dock_fee_eks=$this->input->post('vehicle_dock_fee_eks[]');
        $vehicle_ifpro_fee_eks=$this->input->post('vehicle_ifpro_fee_eks[]');
        $vehicle_trip_fee_eks=$this->input->post('vehicle_trip_fee_eks[]');
        $vehicle_responsibility_fee_eks=$this->input->post('vehicle_responsibility_fee_eks[]');    
        $vehicle_insurance_fee_eks=$this->input->post('vehicle_insurance_fee_eks[]'); 
        $vehicle_fare_eks=$this->input->post('vehicle_fare_eks[]');
        $vehicle_class_id_eks=$this->input->post('vehicle_class_eks[]');
        $vehicle_ship_class_id_eks=$this->input->post('vehicle_ship_class_eks[]');
        $id_dis_fare_veh_eks=$this->input->post('id_dis_fare_veh_eks[]');


        $this->form_validation->set_rules('discount_code', 'Kode Diskon', 'required');
        $this->form_validation->set_rules('start_date', 'Tanggal Awal Berlaku', 'required');
        $this->form_validation->set_rules('end_date', 'Tanggal Akhir Berlaku', 'required');
        $this->form_validation->set_rules('description', 'Nama Promo', 'required');
        $this->form_validation->set_rules('start_time', 'Jam Awal Berlaku', 'required');
        $this->form_validation->set_rules('end_time', 'Jam Akhir Berlaku', 'required');

        $this->form_validation->set_message('required','%s harus diisi!');


        $data_discount=array(
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'start_time'=>$start_time,
            'end_time'=>$end_time,
            'split_date'=>$start_time>$end_time?'true':'false',
            'description'=>$description,
            'pos_passanger'=>empty($pos_passanger)?'false':'true',
            'pos_vehicle'=>empty($pos_vehicle)?'false':'true',
            'vm'=>empty($vm)?'false':'true',
            'mobile'=>empty($mobile)?'false':'true',
            'web'=>empty($web)?'false':'true',
            'b2b'=>empty($b2b)?'false':'true',
            'ifcs'=>empty($ifcs)?'false':'true',
            'updated_on'=>date('Y-m-d H:i:s'),
            'updated_by'=>$this->session->userdata('username')
        );



        $fare_pass=array();
        $fare_pass_eks=array();
        $fare_veh=array();
        $fare_veh_eks=array();



        if (count($entry_fee)>0)
        {
            foreach ($entry_fee as $key => $value) 
            {
                $fare_pass[]=array(
                    'fare'=>$fare[$key],
                    'entry_fee'=>$value,
                    'dock_fee'=>$dock_fee[$key],
                    'trip_fee'=>$trip_fee[$key],
                    'responsibility_fee'=>$responsibility_fee[$key],
                    'insurance_fee'=>$insurance_fee[$key],
                    'ifpro_fee'=>$ifpro_fee[$key],
                    'passanger_type'=>$this->enc->decode($passanger_type_id[$key]),
                    'ship_class'=>$this->enc->decode($ship_class_id[$key]),
                    'updated_on'=>date("Y-m-d H:i:s"),
                    'updated_by'=>$this->session->userdata("username"),

                );
            }

        }

        if (count($entry_fee_eks)>0)
        {
            foreach ($entry_fee_eks as $key => $value) 
            {
                $fare_pass_eks[]=array(
                    'fare'=>$fare_eks[$key],
                    'entry_fee'=>$value,
                    'dock_fee'=>$dock_fee_eks[$key],
                    'trip_fee'=>$trip_fee_eks[$key],
                    'responsibility_fee'=>$responsibility_fee_eks[$key],
                    'insurance_fee'=>$insurance_fee_eks[$key],
                    'ifpro_fee'=>$ifpro_fee_eks[$key],
                    'passanger_type'=>$this->enc->decode($passanger_type_id_eks[$key]),
                    'ship_class'=>$this->enc->decode($ship_class_id_eks[$key]),
                    'updated_on'=>date("Y-m-d H:i:s"),
                    'updated_by'=>$this->session->userdata("username"),
                );
            }

        }

        if (count($vehicle_entry_fee)>0)
        {
            foreach ($vehicle_entry_fee as $key => $value) 
            {
                $fare_veh[]=array(
                    'fare'=>$vehicle_fare[$key],
                    'entry_fee'=>$value,
                    'dock_fee'=>$vehicle_dock_fee[$key],
                    'trip_fee'=>$vehicle_trip_fee[$key],
                    'responsibility_fee'=>$vehicle_responsibility_fee[$key],
                    'insurance_fee'=>$vehicle_insurance_fee[$key],
                    'ifpro_fee'=>$vehicle_ifpro_fee[$key],
                    'vehicle_class_id'=>$this->enc->decode($vehicle_class_id[$key]),
                    'ship_class'=>$this->enc->decode($vehicle_ship_class_id[$key]),
                    'updated_on'=>date("Y-m-d H:i:s"),
                    'updated_by'=>$this->session->userdata("username"),
                );
            }

        }

        if (count($vehicle_entry_fee_eks)>0)
        {
            foreach ($vehicle_entry_fee_eks as $key => $value) 
            {
                $fare_veh_eks[]=array(
                    'fare'=>$vehicle_fare_eks[$key],
                    'entry_fee'=>$value,
                    'dock_fee'=>$vehicle_dock_fee_eks[$key],
                    'trip_fee'=>$vehicle_trip_fee_eks[$key],
                    'responsibility_fee'=>$vehicle_responsibility_fee_eks[$key],
                    'insurance_fee'=>$vehicle_insurance_fee_eks[$key],
                    'ifpro_fee'=>$vehicle_ifpro_fee_eks[$key],
                    'vehicle_class_id'=>$this->enc->decode($vehicle_class_id_eks[$key]),
                    'ship_class'=>$this->enc->decode($vehicle_ship_class_id_eks[$key]),
                    'updated_on'=>date("Y-m-d H:i:s"),
                    'updated_by'=>$this->session->userdata("username"),
                );
            }

        }



        $arr_insert_discount_detail=array();
        $arr_update_discount_detail=array();


        if($this->form_validation->run()===false)
        {
            echo $res=json_api(0, validation_errors());
        }
        else if(count($payment_type)<1)
        {
            echo $res=json_api(0,"Tipe pembayaran tidak boleh kosong");   
        }
        else if (empty($pos_passanger) and empty($pos_vehicle) and empty($vm) and empty($mobile) and empty($web) and empty($b2b) and empty($ifcs) )
        {
            echo $res=json_api(0,"Tempat berlaku harus di pilih");     
        }
        else if(count($vehicle_entry_fee_eks)<1 and count($vehicle_entry_fee)<1 and count($entry_fee)<1 and count($entry_fee_eks)<1 )
        {
            echo $res=json_api(0, "rute tidak mempunyai punya tarif dasar");   
        }        
        else if ($start_date>$end_date)
        {
            echo $res=json_api(0,"Tanggal awal berlaku tidak boleh lebih besar dari tanggal akhir berlaku");   
        }
        else
        {

            $this->db->trans_begin();


            if (count($fare_pass)>0)
            {
                foreach ($fare_pass as $key => $value) {

                    $where=" id=".$this->enc->decode($id_dis_fare_pass[$key]);

                    $this->discount->update_data("app.t_mtr_discount_fare_passanger", $fare_pass[$key], $where  );
                }
            }


            if (count($fare_pass_eks)>0)
            {
                foreach ($fare_pass_eks as $key => $value) {

                    $where="  id=".$this->enc->decode($id_dis_fare_pass_eks[$key]);
                    $this->discount->update_data("app.t_mtr_discount_fare_passanger", $fare_pass_eks[$key],$where);
                }
            }

            if (count($fare_veh)>0)
            {
                foreach ($fare_veh as $key => $value) {

                    $where="  id=".$this->enc->decode($id_dis_fare_veh[$key]);
                    $this->discount->update_data("app.t_mtr_discount_fare_vehicle", $fare_veh[$key],$where);
                }
            }

            if (count($fare_veh_eks)>0)
            {
                foreach ($fare_veh_eks as $key => $value) {

                    $where="  id=".$this->enc->decode($id_dis_fare_veh_eks[$key]);
                    $this->discount->update_data("app.t_mtr_discount_fare_vehicle", $fare_veh_eks[$key],$where);
                }
            }

            // ketika data yang sudah ada kemudian di uncheck maka data tersebut diubah status ke -5
            if(count($payment_type)>0)
            {
                $check_detail_discount=$this->discount->select_data("app.t_mtr_discount_detail", " where discount_code='{$discount_code}'")->result();

                foreach ($payment_type as $key => $value) {

                    // check apakah data ini di simpan di detail discount
                    $arr_check=array();
                    foreach ($check_detail_discount as $key2 => $value2) {
                        if(trim(strtoupper($value))==trim(strtoupper($value2->payment_type)))
                        {
                            $arr_check[]=1;  
                        }
                        else
                        {
                            $arr_check[]=0;   
                        }
                    }

                    // jika datanya sudah ada maka update jika belum ada maka di insert
                    if(array_sum($arr_check)>0)
                    {
                        
                        $update_data_discount_detail=array(
                        // 'value'=>0,
                        'status'=>1,
                        'payment_type'=>$value,
                        'updated_on'=>date("Y-m-d H:i:s"),
                        'updated_by'=>$this->session->userdata("username") );

                        $where="  discount_code='{$discount_code}' and upper(payment_type)=upper('{$value}') ";
                        $this->discount->update_data("app.t_mtr_discount_detail", $update_data_discount_detail, $where);

                        $arr_update_discount_detail[]=$update_data_discount_detail;

                    }
                    else
                    {
                        $insert_data_discount_detail=array(
                                                'value'=>0,
                                                'status'=>1,
                                                'discount_code'=>$discount_code,
                                                'payment_type'=>$value,
                                                'created_on'=>date("Y-m-d H:i:s"),
                                                'created_by'=>$this->session->userdata("username"));

                        $this->discount->insert_data("app.t_mtr_discount_detail", $insert_data_discount_detail);

                        $arr_insert_discount_detail[]=$insert_data_discount_detail;

                    }
                    
                }

                $not_in=array();

                foreach ($payment_type as $key => $value) {
                    $not_in[]="'".trim(strtoupper($value))."'";   
                }

                $del_data_discount_detail=array(
                'status'=>-5,
                'updated_on'=>date("Y-m-d H:i:s"),
                'updated_by'=>$this->session->userdata("username") );

                // update detail-discount
                $this->discount->update_data("app.t_mtr_discount_detail",$del_data_discount_detail," discount_code='{$discount_code}' and upper(payment_type) not in (".implode(",",$not_in).") ");

                // insert detail discount
                $this->discount->update_data("app.t_mtr_discount",$data_discount," discount_code='{$discount_code}' ");
            }




            if ($this->db->trans_status() === FALSE)
            {   
                $this->db->trans_rollback();
                echo $res=json_api(0, 'Gagal edit data');
            }
            else
            {
                $this->db->trans_commit();
                echo $res=json_api(1, 'Berhasil edit data');
            }
        }

        $data=array($data_discount,
            $fare_pass,
            $fare_pass_eks,
            $fare_veh,
            $fare_veh_eks,
            $arr_insert_discount_detail,
            $arr_update_discount_detail
            );

         /* Fungsi Create Log */
        $createdBy   = $this->session->userdata('username');
        $logUrl      = site_url().'fare/discount/action_edit1';
        $logMethod   = 'EDIT';
        $logParam    = json_encode($data);
        $logResponse = $res;

        $this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
    }


    public function action_edit2()
    {
        validate_ajax();
        $this->global_model->checkAccessMenuAction($this->_module,'edit');

        $discount_code=trim($this->input->post('discount_code'));
        $start_date=trim($this->input->post('start_date'));
        $end_date=trim($this->input->post('end_date'));
        $description=trim($this->input->post('description'));
        $start_time=trim($this->input->post('start_time'));
        $end_time=trim($this->input->post('end_time'));
        $data_value=trim($this->input->post('value'));

        $pos_passanger=$this->input->post('pos_passanger');
        $value_type=$this->enc->decode($this->input->post('value_type'));
        $pos_vehicle=$this->input->post('pos_vehicle');
        $vm=$this->input->post('vm');
        $mobile=$this->input->post('mobile');
        $web=$this->input->post('web');
        $b2b=$this->input->post('b2b');
        $ifcs=$this->input->post('ifcs');

        $payment_type=$this->input->post('payment_type[]');

        $this->form_validation->set_rules('discount_code', 'Kode Diskon', 'required');
        $this->form_validation->set_rules('start_date', 'Tanggal Awal Berlaku', 'required');
        $this->form_validation->set_rules('value', 'Potongan Harga', 'required');
        $this->form_validation->set_rules('value_type', 'Tipe Potongan', 'required');
        $this->form_validation->set_rules('end_date', 'Tanggal Akhir Berlaku', 'required');
        $this->form_validation->set_rules('description', 'Nama Promo', 'required');
        $this->form_validation->set_rules('start_time', 'Jam Awal Berlaku', 'required');
        $this->form_validation->set_rules('end_time', 'Jam Akhir Berlaku', 'required');

        $this->form_validation->set_message('required','%s harus diisi!');


        $data_discount=array(
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'start_time'=>$start_time,
            'end_time'=>$end_time,
            'split_date'=>$start_time>$end_time?'true':'false',
            'description'=>$description,
            'pos_passanger'=>empty($pos_passanger)?'false':'true',
            'pos_vehicle'=>empty($pos_vehicle)?'false':'true',
            'vm'=>empty($vm)?'false':'true',
            'mobile'=>empty($mobile)?'false':'true',
            'web'=>empty($web)?'false':'true',
            'b2b'=>empty($b2b)?'false':'true',
            'ifcs'=>empty($ifcs)?'false':'true',
            'updated_on'=>date('Y-m-d H:i:s'),
            'updated_by'=>$this->session->userdata('username')
        );


 
        $arr_insert_discount_detail=array();
        $arr_update_discount_detail=array();


        if($this->form_validation->run()===false)
        {
            echo $res=json_api(0, validation_errors());
        }
        else if(count($payment_type)<1)
        {
            echo $res=json_api(0,"Tipe pembayaran tidak boleh kosong");   
        }
        else if (empty($pos_passanger) and empty($pos_vehicle) and empty($vm) and empty($mobile) and empty($web) and empty($b2b) and empty($ifcs) )
        {
            echo $res=json_api(0,"Tempat berlaku harus di pilih");     
        }
        else if ($start_date>$end_date)
        {
            echo $res=json_api(0,"Tanggal awal berlaku tidak boleh lebih besar dari tanggal akhir berlaku");   
        }
        else
        {

            $this->db->trans_begin();

            // ketika data yang sudah ada kemudian di uncheck maka data tersebut diubah status ke -5
            if(count($payment_type)>0)
            {
                $check_detail_discount=$this->discount->select_data("app.t_mtr_discount_detail", " where discount_code='{$discount_code}'")->result();

                foreach ($payment_type as $key => $value) {

                    // check apakah data ini di simpan di detail discount
                    $arr_check=array();
                    foreach ($check_detail_discount as $key2 => $value2) {
                        if(trim(strtoupper($value))==trim(strtoupper($value2->payment_type)))
                        {
                            $arr_check[]=1;  
                        }
                        else
                        {
                            $arr_check[]=0;   
                        }
                    }

                    // jika datanya sudah ada maka update jika belum ada maka di insert
                    if(array_sum($arr_check)>0)
                    {
                        
                        $update_data_discount_detail=array(
                        // 'value'=>0,
                        'status'=>1,
                        'payment_type'=>$value,
                        'value'=>$data_value,
                        'value_type'=>$value_type,
                        'updated_on'=>date("Y-m-d H:i:s"),
                        'updated_by'=>$this->session->userdata("username") );

                        $where="  discount_code='{$discount_code}' and upper(payment_type)=upper('{$value}') ";
                        $this->discount->update_data("app.t_mtr_discount_detail", $update_data_discount_detail, $where);

                        $arr_update_discount_detail[]=$update_data_discount_detail;

                    }
                    else
                    {
                        $insert_data_discount_detail=array(
                                                'value'=>$data_value,
                                                'value_type'=>$value_type,
                                                'status'=>1,
                                                'discount_code'=>$discount_code,
                                                'payment_type'=>$value,
                                                'created_on'=>date("Y-m-d H:i:s"),
                                                'created_by'=>$this->session->userdata("username"));

                        $this->discount->insert_data("app.t_mtr_discount_detail", $insert_data_discount_detail);

                        $arr_insert_discount_detail[]=$insert_data_discount_detail;

                    }
                    
                }

                $not_in=array();

                foreach ($payment_type as $key => $value) {
                    $not_in[]="'".trim(strtoupper($value))."'";   
                }

                $del_data_discount_detail=array(
                'status'=>-5,
                'updated_on'=>date("Y-m-d H:i:s"),
                'updated_by'=>$this->session->userdata("username") );

                // update detail-discount
                $this->discount->update_data("app.t_mtr_discount_detail",$del_data_discount_detail," discount_code='{$discount_code}' and upper(payment_type) not in (".implode(",",$not_in).") ");

                // insert detail discount
                $this->discount->update_data("app.t_mtr_discount",$data_discount," discount_code='{$discount_code}' ");
            }




            if ($this->db->trans_status() === FALSE)
            {   
                $this->db->trans_rollback();
                echo $res=json_api(0, 'Gagal edit data');
            }
            else
            {
                $this->db->trans_commit();
                echo $res=json_api(1, 'Berhasil edit data');
            }
        }

        $data=array($data_discount,
            $arr_insert_discount_detail,
            $arr_update_discount_detail
            );

         /* Fungsi Create Log */
        $createdBy   = $this->session->userdata('username');
        $logUrl      = site_url().'fare/discount/action_edit2';
        $logMethod   = 'EDIT';
        $logParam    = json_encode($data);
        $logResponse = $res;

        $this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
    }

    public function action_change($param)
    {
        validate_ajax();
        $p = $this->enc->decode($param);
        $d = explode('|', $p);

        /* data */
        $data = array(
            'status' => $d[1],
            'updated_on'=>date("Y-m-d H:i:s"),
            'updated_by'=>$this->session->userdata('username'),
        );


        $this->db->trans_begin();
        $this->discount->update_data($this->_table,$data,"id=".$d[0]);

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            if ($d[1]==1)
            {
                echo $res=json_api(0, 'Gagal aktif');
            }
            else
            {
                echo $res=json_api(0, 'Gagal non aktif');
            }
            
        }
        else
        {
            $this->db->trans_commit();
            if ($d[1]==1)
            {
                echo $res=json_api(1, 'Berhasil aktif data');
            }
            else
            {
                echo $res=json_api(1, 'Berhasil non aktif data');
            }
        }   

        /* Fungsi Create Log */
        $createdBy   = $this->session->userdata('username');
        $logUrl      = site_url().'fare/discount/action_change';
        $d[1]==1?$logMethod='ENABLED':$logMethod='DISABLED';
        $logParam    = json_encode($data);
        $logResponse = $res;

        $this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
    }

    public function action_delete($id)
    {
        validate_ajax();
        $this->global_model->checkAccessMenuAction($this->_module,'delete');

        $data=array(
            'status'=>-5,
            'updated_on'=>date("Y-m-d H:i:s"),
            'updated_by'=>$this->session->userdata('username'),
            );

        $id = $this->enc->decode($id);

        $this->db->trans_begin();
        $this->discount->update_data($this->_table,$data," id='".$id."'");

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            echo $res=json_api(0, 'Gagal delete data');
        }
        else
        {
            $this->db->trans_commit();
            echo $res=json_api(1, 'Berhasil delete data');
        }   

        /* Fungsi Create Log */
        $createdBy   = $this->session->userdata('username');
        $logUrl      = site_url().'fare/discount/action_delete';
        $logMethod   = 'DELETE';
        $logParam    = json_encode($data);
        $logResponse = $res;

        $this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
    }

    public function detail1($enc_code)
    {
        // check hak akses
        $this->global_model->checkAccessMenuAction($this->_module,'detail');

        $check_discount=$this->discount->select_data($this->_table," where discount_code='".$this->enc->decode("$enc_code")."' ");

        if($check_discount->num_rows() <1 )
        {
            redirect('error_404');
            exit;
        }

        
        $data['home']     = 'Home';
        $data['url_home'] = site_url('home');
        $data['title']    = 'Detail Diskon';
        $data['url_parent']=site_url('fare/discount');
        $data['parent']='Diskon';
        $data['discount_code']=$enc_code;
        $data['content']  = 'discount/detail1';


        $this->load->view('default',$data);
    }

    public function detail2($enc_code)
    {
        // check hak akses
        $this->global_model->checkAccessMenuAction($this->_module,'detail');

        $check_discount=$this->discount->select_data($this->_table," where discount_code='".$this->enc->decode("$enc_code")."' ");

        if($check_discount->num_rows() <1 )
        {
            redirect('error_404');
            exit;
        }

        
        $data['home']     = 'Home';
        $data['url_home'] = site_url('home');
        $data['title']    = 'Detail Diskon';
        $data['url_parent']=site_url('fare/discount');
        $data['parent']='Diskon';
        $data['discount_code']=$enc_code;
        $data['content']  = 'discount/detail2';


        $this->load->view('default',$data);
    }    

    public function get_schema()
    {
        $schema_code=$this->enc->decode($this->input->post('schema'));

        if(empty($schema_code))
        {
            echo json_encode($init_code=array('init_code'=>'c'));
            exit;
        } 

        $data=$this->discount->select_data("app.t_mtr_discount_schema", " where schema_code='{$schema_code}' ")->row();

        // hard cord jik idnya 1
        if($data->slug=='fare_update')
        {
            $data->init_code='a';
        }
        elseif($data->slug=='basic_discount')
        {
            $data->init_code='b';   
        }
        else
        {
            $data->init_code='c';   
        }

        unset($data->id);

        echo json_encode($data);
    }

    public function get_port()
    {
        // vaidasi pemilihan data

        $r=$this->filter_port();

        $data=array();
        foreach ($r as $key => $value) 
        {
            $value->id=$this->enc->encode($value->id);
            unset($value->id);

            $data[]=$value;
        }

        echo json_encode($data);
    }

    public function get_route()
    {
        empty($this->input->post('port'))?$port_id='null':$port_id=$this->enc->decode($this->input->post('port'));

        // vaidasi pemilihan data
        $r=$this->discount->get_route(" where a.origin={$port_id} ")->result();

        $data=array();
        foreach ($r as $key => $value) 
        {
            $value->id=$this->enc->encode($value->id);
            unset($value->id);

            $data[]=$value;
        }

        echo json_encode($data);
    }

    public function get_fare()
    {
        empty($this->input->post('route'))?$route_id='null':$route_id=$this->enc->decode($this->input->post('route'));

        // Mengambil tarif penumpang reguler
        $pr=$this->discount->get_fare_passanger($route_id,1)->result();

        // Mengambil tarif penumpang eksekutif
        $pe=$this->discount->get_fare_passanger($route_id,2)->result();

        // Mengambil tarif kendaraan reguler
        $vr=$this->discount->get_fare_vehicle($route_id,1)->result();
        
        // Mengambil tarif kendaraan ekse
        $ve=$this->discount->get_fare_vehicle($route_id,2)->result();

        $passanger_reg=array();
        $passanger_eks=array();
        $vehicle_reg=array();
        $vehicle_eks=array();

        foreach ($pr as $key => $value) 
        {
            $value->id=$this->enc->encode($value->id);
            $value->rute_id=$this->enc->encode($value->rute_id);
            $value->ship_class=$this->enc->encode($value->ship_class);
            $value->passanger_type=$this->enc->encode($value->passanger_type);
            $value->id=$this->enc->encode($value->id);
            $value->entry_fee=empty($value->entry_fee)?$value->entry_fee=0:$value->entry_fee=$value->entry_fee;
            $value->dock_fee=empty($value->dock_fee)?$value->dock_fee=0:$value->dock_fee=$value->dock_fee;
            $value->ifpro_fee=empty($value->ifpro_fee)?$value->difpro_fee=0:$value->ifpro_fee=$value->ifpro_fee;
            $value->trip_fee=empty($value->trip_fee)?$value->trip_fee=0:$value->trip_fee=$value->trip_fee;
            $value->responsibility_fee=empty($value->responsibility_fee)?$value->responsibility_fee=0:$value->responsibility_fee=$value->responsibility_fee;
            $value->insurance_fee=empty($value->insurance_fee)?$value->insurance_fee=0:$value->insurance_fee=$value->insurance_fee;
            $value->fare=empty($value->fare)?$value->fare=0:$value->fare=$value->fare;


            $passanger_reg[]=$value;
        }

        foreach ($pe as $key => $value) 
        {
            $value->id=$this->enc->encode($value->id);
            $value->rute_id=$this->enc->encode($value->rute_id);
            $value->ship_class=$this->enc->encode($value->ship_class);
            $value->passanger_type=$this->enc->encode($value->passanger_type);
            $value->rute_id=$this->enc->encode($value->rute_id);
            $value->entry_fee=empty($value->entry_fee)?$value->entry_fee=0:$value->entry_fee=$value->entry_fee;
            $value->dock_fee=empty($value->dock_fee)?$value->dock_fee=0:$value->dock_fee=$value->dock_fee;
            $value->ifpro_fee=empty($value->ifpro_fee)?$value->difpro_fee=0:$value->ifpro_fee=$value->ifpro_fee;
            $value->trip_fee=empty($value->trip_fee)?$value->trip_fee=0:$value->trip_fee=$value->trip_fee;
            $value->responsibility_fee=empty($value->responsibility_fee)?$value->responsibility_fee=0:$value->responsibility_fee=$value->responsibility_fee;
            $value->insurance_fee=empty($value->insurance_fee)?$value->insurance_fee=0:$value->insurance_fee=$value->insurance_fee;
            $value->fare=empty($value->fare)?$value->fare=0:$value->fare=$value->fare;
            $passanger_eks[]=$value;
        }

        foreach ($vr as $key => $value) 
        {
            $value->id=$this->enc->encode($value->id);
            $value->rute_id=$this->enc->encode($value->rute_id);
            $value->ship_class=$this->enc->encode($value->ship_class);
            $value->vehicle_class_id=$this->enc->encode($value->vehicle_class_id);
            $value->entry_fee=empty($value->entry_fee)?$value->entry_fee=0:$value->entry_fee=$value->entry_fee;
            $value->dock_fee=empty($value->dock_fee)?$value->dock_fee=0:$value->dock_fee=$value->dock_fee;
            $value->ifpro_fee=empty($value->ifpro_fee)?$value->difpro_fee=0:$value->ifpro_fee=$value->ifpro_fee;
            $value->trip_fee=empty($value->trip_fee)?$value->trip_fee=0:$value->trip_fee=$value->trip_fee;
            $value->responsibility_fee=empty($value->responsibility_fee)?$value->responsibility_fee=0:$value->responsibility_fee=$value->responsibility_fee;
            $value->insurance_fee=empty($value->insurance_fee)?$value->insurance_fee=0:$value->insurance_fee=$value->insurance_fee;
            $value->fare=empty($value->fare)?$value->fare=0:$value->fare=$value->fare;
            $vehicle_reg[]=$value;
        }

        foreach ($ve as $key => $value) 
        {
            $value->id=$this->enc->encode($value->id);
            $value->rute_id=$this->enc->encode($value->rute_id);
            $value->ship_class=$this->enc->encode($value->ship_class);
            $value->vehicle_class_id=$this->enc->encode($value->vehicle_class_id);
            $value->entry_fee=empty($value->entry_fee)?$value->entry_fee=0:$value->entry_fee=$value->entry_fee;
            $value->dock_fee=empty($value->dock_fee)?$value->dock_fee=0:$value->dock_fee=$value->dock_fee;
            $value->ifpro_fee=empty($value->ifpro_fee)?$value->difpro_fee=0:$value->ifpro_fee=$value->ifpro_fee;
            $value->trip_fee=empty($value->trip_fee)?$value->trip_fee=0:$value->trip_fee=$value->trip_fee;
            $value->responsibility_fee=empty($value->responsibility_fee)?$value->responsibility_fee=0:$value->responsibility_fee=$value->responsibility_fee;
            $value->insurance_fee=empty($value->insurance_fee)?$value->insurance_fee=0:$value->insurance_fee=$value->insurance_fee;
            $value->fare=empty($value->fare)?$value->fare=0:$value->fare=$value->fare;
            $vehicle_eks[]=$value;
        }

        $data=array('passanger_reg'=>$passanger_reg,
                    'passanger_eks'=>$passanger_eks,
                    'vehicle_reg'=>$vehicle_reg,
                    'vehicle_eks'=>$vehicle_eks,
                    );

        echo json_encode($data);
    }

    public function filter_port()
    {
        if($this->app_identity()==0)
        {
            if(empty($this->session->userdata('port_id')))
            {
                $port=$this->discount->select_data("app.t_mtr_port", "where status=1 order by name asc")->result();
            }
            else
            {
                $port=$this->discount->select_data("app.t_mtr_port", "where id=".$this->session->userdata('port_id')."")->result();   
            }
        }
        else
        {
            $port=$this->discount->select_data("app.t_mtr_port", "where id=".$this->app_identity()."")->result();   
        }

        return $port;
    }


    function get_route2()
    {
        if($this->app_identity()==0)
        {
            if(empty($this->session->userdata('port_id')))
            {
                $route=$this->discount->get_route(" where a.status=1 ")->result();
            }
            else
            {
                $route=$this->discount->get_route(" where a.origin=".$this->session->userdata('port_id')." and a.status=1 ")->result();
            }
        }
        else
        {
            $route=$this->discount->get_route(" where a.origin=".$this->app_identity()." and a.status=1 ")->result(); 
        }

        return $route;
    }

    public function app_identity()
    {
        $data=$this->discount->select_data("app.t_mtr_identity_app")->row();
        return $data->port_id;
    }


    function createCode($port_id)
    {
        $front_code="DA".$port_id."".date('ymd');

        $total_length=strlen($front_code);

        $chekCode=$this->db->query("select * from app.t_mtr_discount where left(discount_code,".$total_length.")='".$front_code."' ")->num_rows();

        if($chekCode<1)
        {
            $kode=$front_code."01";
            return $kode;
        }
        else
        {
            $max=$this->db->query("select max (discount_code) as max_code from app.t_mtr_discount where left(discount_code,".$total_length.")='".$front_code."' ")->row();
            $kode=$max->max_code;
            $noUrut = (int) substr($kode, $total_length, 2);
            $noUrut++;
            $char = $front_code;
            $kode = $char . sprintf("%02s", $noUrut);
            return $kode;
        }
    }


}
