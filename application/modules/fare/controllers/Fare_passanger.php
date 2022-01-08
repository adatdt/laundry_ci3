<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Fare_passanger extends MY_Controller{
	public function __construct(){
		parent::__construct();

        $this->_username = $this->session->userdata('username');
        $this->_module   = 'fare/fare_passanger';
	}

	public function index(){   
        // if($this->input->is_ajax_request()){
        //     $rows = $this->fare->dataList();
        //     echo json_encode($rows);
        //     exit;
        // }

        $data = array(
            'title'    => 'Tarif Penumpang',
            'content'  => 'fare_passanger/index',

        );

		$this->load->view('default', $data);
	}

    public function add(){
        validate_ajax();
        $this->global_model->checkAccessMenuAction($this->_module,'add');

        if(!empty($this->session->userdata("port_id")))
        {
            $data['route'] = $this->fare->get_route(" where a.status=1 and a.origin=".$this->session->userdata("port_id")." order by concat(b.name,' - ',c.name) asc ")->result();
        }
        else
        {
            $data['route'] = $this->fare->get_route(" where a.status=1 order by concat(b.name,' - ',c.name) asc")->result();
        }

        $data['title'] = 'Tambah Tarif Penumpang';
        $data['type'] = $this->fare->select_data("app.t_mtr_passanger_type","where status=1 order by name asc")->result();
        $data['ship_class']=$this->fare->select_data("app.t_mtr_ship_class","where status=1 order by name asc")->result();
        $this->load->view($this->_module.'/add',$data);
    }

    public function action_add()
    {
        validate_ajax();
        $this->global_model->checkAccessMenuAction($this->_module,'add');

        $route_id=$this->enc->decode($this->input->post('route'));
        $tipe_penumpang_id=$this->enc->decode($this->input->post('type'));
        $ship_type_id=$this->enc->decode($this->input->post('ship_type'));
        $fare=$this->input->post('fare');
        $entry_fee=$this->input->post('entry_fee');
        $dock_fee=$this->input->post('dock_fee');
        $ifpro=$this->input->post('ifpro');
        $responsibility_fee=$this->input->post('responsibility_fee');
        $insurance_fee=$this->input->post('insurance_fee');
        $trip_fee=$this->input->post('trip_fee');


        $this->form_validation->set_rules('route', 'team', 'required');
        $this->form_validation->set_rules('type', 'Tipe Penumpang', 'required');
        $this->form_validation->set_rules('ship_type', 'ship tipe', 'required');
        $this->form_validation->set_rules('fare', 'Tarif', 'required');

        
        $data=array(
                    'rute_id'=>$route_id,
                    'passanger_type'=>$tipe_penumpang_id,
                    'ship_class'=>$ship_type_id,
                    'entry_fee'=>empty($entry_fee)?0:$entry_fee,
                    'dock_fee'=>empty($dock_fee)?0:$dock_fee,
                    'ifpro_fee'=>empty($ifpro)?0:$ifpro,
                    'responsibility_fee'=>empty($responsibility_fee)?0:$responsibility_fee,
                    'insurance_fee'=>empty($insurance_fee)?0:$insurance_fee,
                    'trip_fee'=>empty($trip_fee)?0:$trip_fee,
                    'fare'=>$fare,
                    'status'=>1,
                    'created_by'=>$this->session->userdata('username'),
                    'created_on'=>date("Y-m-d H:i:s"),
                    );

        // check harga route jika ada
        $check_fare=$this->fare->select_data($this->_table,"where rute_id=$route_id and passanger_type=$tipe_penumpang_id and ship_class=$ship_type_id and status not in (-5) ");

        if($this->form_validation->run()===false)
        {
            echo $res=json_api(0, 'Data masih ada yang kosong');
        }
        else if ($check_fare->num_rows()>0)
        {
            echo $res=json_api(0, 'Tarif sudah ada');   
        }
        else
        {

            $this->db->trans_begin();

            $this->fare->insert_data($this->_table,$data);

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
        $logUrl      = site_url().'fare/fara_passanger/action_add';
        $logMethod   = 'ADD';
        $logParam    = json_encode($data);
        $logResponse = $res;

        $this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
    }

    public function edit($id)
    {
        validate_ajax();
        $this->global_model->checkAccessMenuAction($this->_module,'edit');


        if(!empty($this->session->userdata('port_id')))
        {
            $data['route'] = $this->fare->get_route("where a.status=1 and a.origin=".$this->session->userdata("port_id")." order by concat(b.name,' - ',c.name) asc")->result();
        }
        else
        {
            $data['route'] = $this->fare->get_route("where a.status=1 order by concat(b.name,' - ',c.name) asc")->result();
        }


        $id_decode=$this->enc->decode($id);
        $assignment_code=$this->enc->decode($id);
        $data['title'] = 'Edit Tarif Penumpang';
        $data['type'] = $this->fare->select_data("app.t_mtr_passanger_type","where status not in (-5) order by name asc")->result();
        $data['detail']=$this->fare->select_data($this->_table,"where id=$id_decode")->row();
        $data['ship_class']=$this->fare->select_data("app.t_mtr_ship_class","where status in (1) order by name asc")->result();


        $this->load->view($this->_module.'/edit',$data);   
    }

    public function action_edit()
    {
        validate_ajax();
        $this->global_model->checkAccessMenuAction($this->_module,'edit');

        $route_id=$this->enc->decode($this->input->post('route'));
        $tipe_penumpang_id=$this->enc->decode($this->input->post('type'));
        $ship_type_id=$this->enc->decode($this->input->post('ship_type'));
        $fare=$this->input->post('fare');
        $entry_fee=$this->input->post('entry_fee');
        $dock_fee=$this->input->post('dock_fee');
        $ifpro=$this->input->post('ifpro');
        $responsibility_fee=$this->input->post('responsibility_fee');
        $insurance_fee=$this->input->post('insurance_fee');
        $trip_fee=$this->input->post('trip_fee');
        $id=$this->enc->decode($this->input->post('id'));


        $this->form_validation->set_rules('route', 'team', 'required');
        $this->form_validation->set_rules('type', 'Tipe Penumpang', 'required');
        $this->form_validation->set_rules('ship_type', 'ship tipe', 'required');
        $this->form_validation->set_rules('fare', 'Tarif', 'required');
        $this->form_validation->set_rules('id', 'Id', 'required');

        $data=array(
                    'rute_id'=>$route_id,
                    'passanger_type'=>$tipe_penumpang_id,
                    'ship_class'=>$ship_type_id,
                    'fare'=>$fare,
                    'entry_fee'=>empty($entry_fee)?0:$entry_fee,
                    'dock_fee'=>empty($dock_fee)?0:$dock_fee,
                    'ifpro_fee'=>empty($ifpro)?0:$ifpro,
                    'responsibility_fee'=>empty($responsibility_fee)?0:$responsibility_fee,
                    'insurance_fee'=>empty($insurance_fee)?0:$insurance_fee,
                    'trip_fee'=>empty($trip_fee)?0:$trip_fee,
                    'updated_by'=>$this->session->userdata('username'),
                    'updated_on'=>date("Y-m-d H:i:s"),
                    );

        $check_fare=$this->fare->select_data($this->_table,"where rute_id=$route_id and passanger_type=$tipe_penumpang_id and ship_class=$ship_type_id and id!=$id and status not in (-5) ");

        if($this->form_validation->run()===false)
        {
            echo $res=json_api(0, 'Data masih ada yang kosong');
        }
        else if ($check_fare->num_rows()>0)
        {
            echo $res=json_api(0, 'Data sudah ada');      
        }
        else
        {

            $this->db->trans_begin();

            $this->fare->update_data($this->_table,$data,"id=$id");

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


         /* Fungsi Create Log */
        $createdBy   = $this->session->userdata('username');
        $logUrl      = site_url().'fare/fara_passanger/action_add';
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
        $this->fare->update_data($this->_table,$data,"id=".$d[0]);

        // if ($this->db->trans_status() === FALSE)
        // {
        //     $this->db->trans_rollback();
        //     echo $res=json_api(0, 'Gagal '.$d[2]);
        // }
        // else
        // {
        //     $this->db->trans_commit();
        //     echo $res=json_api(1, 'Berhasil '.$d[2].' data');
        // }   

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
        $logUrl      = site_url().'fare/fare_passanger/action_change';
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
        $this->fare->update_data($this->_table,$data," id='".$id."'");

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
        $logUrl      = site_url().'fare/passanger/action_delete';
        $logMethod   = 'DELETE';
        $logParam    = json_encode($data);
        $logResponse = $res;

        $this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
    }


}
