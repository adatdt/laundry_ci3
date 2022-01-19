<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class UserGroup extends MY_Controller{
	public function __construct(){
		parent::__construct();
		is_login();

		$this->load->model("UserGroupModel","userGroup");
	}

	public function index(){   

        $data = array(
            'title'    => 'User Group',
            'content'  => 'index',     
        );

		$this->load->view('default', $data);
	}

	public function getDataList()
	{

		$data=$this->userGroup->getDataList();
		
		echo json_encode($data);


	}

	public function actionAdd()
	{
		$name=trim($this->input->post('name')); 

        $this->form_validation->set_rules('name', 'Nama ', 'required');
		
		$this->form_validation->set_message('required','%s harus diisi!');

		$check=$this->userGroup->select_data("user_group", " where upper(name)=upper('{$name}') and status!='-5' ");
		
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
					"status"=>1,
					"created_on"=>date("Y-m-d H:i:s"),
					"created_by"=>$this->session->userdata("username")

				);

			$this->userGroup->insert_data("user_group",$data);

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
		$id=trim($this->input->post("idEdit")); 
		$name=trim($this->input->post('name')); 


        $this->form_validation->set_rules('name', 'Nama ', 'required');
		$this->form_validation->set_rules('idEdit', 'Id ', 'required');

		$this->form_validation->set_message('required','%s harus diisi!');

		$check=$this->userGroup->select_data("user_group", " where upper(name)=upper('{$name}') and status!='-5' and id <>{$id} ");
		
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
					"updated_on"=>date("Y-m-d H:i:s"),
					"updated_by"=>$this->session->userdata("username")

				);


			// $this->userGroup->insert_data("product_service",$data);
			$this->userGroup->update_data("user_group",$data, " id=$id");

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

			$this->userGroup->update_data("user_group", $data, "id=$id");

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
