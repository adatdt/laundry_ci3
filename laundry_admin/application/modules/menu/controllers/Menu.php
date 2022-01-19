<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Menu extends MY_Controller{
	public function __construct(){
		parent::__construct();
		is_login();

		$this->load->model("menuModel","menuWeb");
	}

	public function index(){   

        $data = array(
            'title'    => 'Menu',
            'content'  => 'index',     
        );

		$this->load->view('default', $data);
	}

	public function getDataList()
	{

		$data=$this->menuWeb->getDataList();
		
		echo json_encode($data);


	}

	public function actionAdd()
	{
		$name=trim($this->input->post('name')); 
		$link=trim($this->input->post('link')); 
		$ordering=trim($this->input->post('ordering')); 

        $this->form_validation->set_rules('name', 'Nama ', 'required');
		$this->form_validation->set_rules('link', 'Link ', 'required');
		$this->form_validation->set_rules('ordering', 'Urutan ', 'required');

		$data=array(
			"name"=>$name,
			"url"=>$link,
			"ordering"=>$ordering,
			"status"=>1,
			"created_on"=>date("Y-m-d H:i:s"),
			"created_by"=>$this->session->userdata("username")

		);

		// print_r($data); exit;


		$this->form_validation->set_message('required','%s harus diisi!');

		$check=$this->menuWeb->select_data("menu", " where upper(name)=upper('{$name}') and status!='-5' ");
		$checkOrdering=$this->menuWeb->select_data("menu", " where ordering='{$ordering}' and status!='-5' ");
		
		if ($this->form_validation->run() === false) {
			$res=array("code"=>0, "message"=>validation_errors());
        }
		else if($check->num_rows()>0)
		{
			$res=array("code"=>0, "message"=>"Nama Sudah ada ");
		}
		else if($checkOrdering->num_rows()>0)
		{
			$res=array("code"=>0, "message"=>"Urutan Sudah ada ");
		}		
		else
		{
			$this->db->trans_begin();

			$this->menuWeb->insert_data("menu",$data);

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


	public function actionEdit()
	{
		$id=trim($this->input->post("id")); 
		$name=trim($this->input->post('name')); 
		$link=trim($this->input->post('link')); 
		$ordering=trim($this->input->post('ordering')); 

        $this->form_validation->set_rules('name', 'Nama ', 'required');
		$this->form_validation->set_rules('link', 'Link ', 'required');
		$this->form_validation->set_rules('ordering', 'Urutan ', 'required');
		$this->form_validation->set_rules('id', 'Id ', 'required');

		$this->form_validation->set_message('required','%s harus diisi!');

		$data=array(
			"name"=>$name,
			"url"=>$link,
			"ordering"=>$ordering,
			"updated_on"=>date("Y-m-d H:i:s"),
			"updated_by"=>$this->session->userdata("username")

		);

		$check=$this->menuWeb->select_data("menu", " where upper(name)=upper('{$name}') and status!='-5' and id<>{$id} ");
		$checkOrdering=$this->menuWeb->select_data("menu", " where ordering='{$ordering}' and status!='-5' and id<>{$id} ");
		
		if ($this->form_validation->run() === false) {
			$res=array("code"=>0, "message"=>validation_errors());
        }
		else if($check->num_rows()>0)
		{
			$res=array("code"=>0, "message"=>"Nama Sudah ada ");
		}
		else if($checkOrdering->num_rows()>0)
		{
			$res=array("code"=>0, "message"=>"Urutan sudah ada ");
		}		
		else
		{
			$this->db->trans_begin();


			// $this->menuWeb->insert_data("product_service",$data);
			$this->menuWeb->update_data("menu",$data, " id=$id");

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

			// print_r($data); exit;
			$this->db->trans_begin();

			$this->menuWeb->update_data("menu", $data, "id=$id");

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
