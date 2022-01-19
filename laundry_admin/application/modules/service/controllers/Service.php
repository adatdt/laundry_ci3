<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Service extends MY_Controller{
	public function __construct(){
		parent::__construct();
		is_login();

		$this->load->model("ServiceModel","service");
	}

	public function index(){   
		
        $data = array(
            'title'    => 'Layanan Tambahan',
            'content'  => 'index',

        );

		$this->load->view('default', $data);
	}

	public function getDataList()
	{

		$data=$this->service->getDataList();
		
		echo json_encode($data);


	}

	public function actionAdd()
	{
		$name=trim($this->input->post('name')); 
		$price=trim($this->input->post('price')); 
		$unitWeight=trim($this->input->post('unitWeight')); 
		$description=trim($this->input->post('description')); 

        $this->form_validation->set_rules('name', 'Nama ', 'required');
        $this->form_validation->set_rules('price', 'Harga ', 'required');
        $this->form_validation->set_rules('unitWeight', 'Berat ', 'required');
		$this->form_validation->set_rules('description', 'Keterangan ', 'required');	
		
		$this->form_validation->set_message('required','%s harus diisi!');

		$check=$this->service->select_data("product_service", " where upper(name)=upper('{$name}') and status!='-5' ");
		
		if ($this->form_validation->run() === false) {
			$res=array("code"=>0, "message"=>validation_errors());
        }
		else if($check->num_rows()>0)
		{
			$res=array("code"=>0, "message"=>"Nama Sudah ada ");
		}
		else
		{
			$this->db->trans_begin();

			$data=array(
					"name"=>$name,
					"price"=>$price,
					"service_code"=>$this->createCode(),
					"unit_weight"=>$unitWeight,
					"description"=>$description,
					"status"=>1,
					"created_on"=>date("Y-m-d H:i:s"),
					"created_by"=>$this->session->userdata("username")

				);

			$this->service->insert_data("service",$data);

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $res=array("code"=>0, "message"=>'Gagal Simpan Data ');
            }
            else 
            {
                $this->db->trans_commit();
                $res=array("code"=>1, "message"=>'Berhasil Simpan data ');
            }


		}

		echo json_encode($res);
	}

	function createCode()
    {

        $front_code="LY-";

        $chekCode=$this->db->query("select * from service where left(service_code,".strlen($front_code).")='".$front_code."' ")->num_rows();

        if($chekCode<1)
        {
            $getCode=$front_code."001";
            return $getCode;
        }
        else
        {
            $max=$this->db->query("select max(service_code) as max_code from service where left(service_code,".strlen($front_code).")='".$front_code."' ")->row();
            $kode=$max->max_code;
            $noUrut = (int) substr($kode, strlen($front_code), 4);
            $noUrut++;
            $char = $front_code;
            $kode = $char . sprintf("%04s", $noUrut);
            return $kode;
        }
    }

	public function actionEdit()
	{
		$id=trim($this->input->post("idEdit")); 
		$name=trim($this->input->post('name')); 
		$price=trim($this->input->post('price')); 
		$unitWeight=trim($this->input->post('unitWeight')); 
		$description=trim($this->input->post('description')); 

        $this->form_validation->set_rules('name', 'Nama ', 'required');
		$this->form_validation->set_rules('idEdit', 'Id ', 'required');
        $this->form_validation->set_rules('price', 'Harga ', 'required');
        $this->form_validation->set_rules('unitWeight', 'Berat ', 'required');
		$this->form_validation->set_rules('description', 'Keterangan ', 'required');	
		
		$this->form_validation->set_message('required','%s harus diisi!');

		$check=$this->service->select_data("product_service", " where upper(name)=upper('{$name}') and status!='-5' and id <>{$id} ");
		
		if ($this->form_validation->run() === false) {
			$res=array("code"=>0, "message"=>validation_errors());
        }
		else if($check->num_rows()>0)
		{
			$res=array("code"=>0, "message"=>"Nama Sudah ada ");
		}
		else
		{
			$this->db->trans_begin();

			$data=array(
					"name"=>$name,
					"price"=>$price,
					"unit_weight"=>$unitWeight,
					"description"=>$description,
					"updated_on"=>date("Y-m-d H:i:s"),
					"updated_by"=>$this->session->userdata("username")

				);


			// $this->service->insert_data("product_service",$data);
			$this->service->update_data("service",$data, " id=$id");

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $res=array("code"=>0, "message"=>'Gagal Simpan Data ');
            }
            else 
            {
                $this->db->trans_commit();
                $res=array("code"=>1, "message"=>'Berhasil Simpan data ');
            }


		}

		echo json_encode($res);
	}



	public function actionDelete()
	{
		$id=trim($this->input->post("idDelate"));
		$statusDelate=trim($this->input->post("statusDelate"));

		if(empty($id) or $statusDelate=="" )
		{
			$res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
		}
		else
		{
			$data=array(
				"status"=>$statusDelate,
				"updated_on"=>date("Y-m-d H:i:s"),
				"updated_by"=>$this->session->userdata("username")

			);

			// print_r($data); exit;zz
			$this->db->trans_begin();

			$this->service->update_data("service", $data, "id=$id");

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $res=array("code"=>0, "message"=>'Gagal Hapus Data ');
            }
            else 
            {
                $this->db->trans_commit();
                $res=array("code"=>1, "message"=>'Berhasil Hapus data ');
            }


		}

		echo json_encode($res);
	}	


}
