<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class User extends MY_Controller{
	public function __construct(){
		parent::__construct();
		is_login();
		$this->load->model("userModel","user");
	}

	public function index(){   

		$getUserGroup=$this->user->select_data("user_group"," where status=1 order by name asc")->result();
		
		$dataUserGroup[""]="Pilih";
		foreach ($getUserGroup as $key => $value) {
			$dataUserGroup[$value->id]=$value->name;
		}

		
        $data = array(
            'title'    => 'user',
            'content'  => 'index',   
			'dataUserGroup'=>$dataUserGroup,         

        );

		$this->load->view('default', $data);
	}

	public function getDataList()
	{

		$data=$this->user->getDataList();
		
		echo json_encode($data);


	}

	public function actionAdd()
	{
		$name=trim($this->input->post("name"));
		$username=trim($this->input->post("username"));
		$address=trim($this->input->post("address"));
		$password=trim($this->input->post("password"));
		$phoneNumber=trim($this->input->post("phoneNumber"));
		$idGroup=trim($this->input->post("idGroup"));
		$email=trim($this->input->post("email"));

		$data=array(
					"name"=>$name,
					"address"=>$address,
					"email"=>$email,
					"status"=>1,
					"password"=>md5($password),
					"username"=>$username,
					"no_hp"=>$phoneNumber,
					"created_by"=>"admin",
					"id_group"=>$idGroup

				);

		$checkUsername=$this->user->select_data("user", " where upper(username)=upper('{$username}')");

		if(empty($name) or empty($username) or empty($address) or empty($password) or empty($phoneNumber))
		{
			$res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
		}
		else if($checkUsername->num_rows()>0)
		{
			$res=array("code"=>0, "message"=>'Nama Sudah Ada ');
		}
		else
		{
			$this->db->trans_begin();

			$this->user->insert_data("user",$data);

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
		$name=trim($this->input->post("nameEdit"));
		$username=trim($this->input->post("username"));
		$address=trim($this->input->post("addressEdit"));
		$phoneNumber=trim($this->input->post("phoneNumberEdit"));
		$idGroup=trim($this->input->post("idGroupEdit"));

		$id=trim($this->input->post("idEdit"));


		$data=array(
					"name"=>$name,
					"address"=>$address,
					"no_hp"=>$phoneNumber,
					"updated_by"=>"admin",
					"updated_on"=>date("Y-m-d H:i:s"),
					"id_group"=>$idGroup

				);		

		$checkUsername=$this->user->select_data("user", " where upper(username)=upper('{$username}') and id<>{$id}");

		if(empty($name) or empty($id))
		{
			$res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
		}
		else if($checkUsername->num_rows()>0)
		{
			$res=array("code"=>0, "message"=>'Nama Sudah Ada ');
		}
		else
		{
			$this->db->trans_begin();

			
			$this->user->update_data("user",$data, " id=$id");
            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $res=array("code"=>0, "message"=>'Gagal Edit Data ');
            }
            else 
            {
                $this->db->trans_commit();
                $res=array("code"=>1, "message"=>'Berhasil Edit data ');
            }


		}

		echo json_encode($res);
	}

	public function actionDelete_16012022()
	{
		$id=trim($this->input->post("idDelete"));

		if(empty($id))
		{
			$res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
		}
		else
		{
			$this->db->trans_begin();

			$this->user->delete_data("user", "id=$id");

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

	public function actionDelete()
	{
		$id=trim($this->input->post("idDelete"));
		$statusDelete=trim($this->input->post("statusDelete"));

		// print_r($this->input->post()); exit;

		if(empty($id) or $statusDelete=="" )
		{
			$res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
		}
		else
		{
			$data=array(
				"status"=>$statusDelete,
				"updated_on"=>date("Y-m-d H:i:s"),
				"updated_by"=>$this->session->userdata("username")

			);

			// print_r($data); exit;
			$this->db->trans_begin();

			$this->user->update_data("user", $data, "id=$id");

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
