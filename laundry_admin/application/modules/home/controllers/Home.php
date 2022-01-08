<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Home extends MY_Controller{
	public function __construct(){
		parent::__construct();
		is_login();

		$this->load->model("HomeModel","home");
	}

	public function index(){   

		$getUser=$this->getUser();
		
        $data = array(
            'title'    => 'Home',
            'content'  => 'index',
            'detailUser'=>$getUser

        );

		$this->load->view('default', $data);
	}

	public function actionEdit(){

		$name=trim($this->input->post("name"));
    	$phoneNumber=trim($this->input->post("phoneNumber"));
    	$address=trim($this->input->post("address"));	

		if(empty($name) or empty($phoneNumber) or empty($address))
		{
			$res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
		}
		else
		{
			$this->db->trans_begin();

			$data=array(
						"name"=>$name,
						"no_hp"=>$phoneNumber,
						"address"=>$address,
						"updated_by"=>$this->session->userdata("username"),
						"updated_on"=>date("Y-m-d H:i:s")
					);
			
			$this->home->update_data("user",$data, " id=".$this->session->userdata("user_id"));
            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $res=array("code"=>0, "message"=>'Gagal Edit Data ');
            }
            else 
            {
                $this->db->trans_commit();
                $getUser=$this->getUser();
                $res=array("code"=>1, "message"=>'Berhasil Edit data ', "data"=>$getUser);
            }


		}

		echo json_encode($res);    	



    }

    function changePassword()
    {

    	$password=trim($this->input->post("password"));	

		if(empty($password))
		{
			$res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
		}
		else
		{
			$this->db->trans_begin();

			$data=array(
						"password"=>md5($password),
						"updated_by"=>$this->session->userdata("username"),
						"updated_on"=>date("Y-m-d H:i:s")
					);
			
			$this->home->update_data("user",$data, " id=".$this->session->userdata("user_id"));
            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $res=array("code"=>0, "message"=>'Gagal Ganti Passsword ');
            }
            else 
            {
                $this->db->trans_commit();
                $getUser=$this->getUser();
                $res=array("code"=>1, "message"=>'Berhasil Ganti Passsword ', "data"=>$getUser);
            }


		}

		echo json_encode($res);    	

    }

    function getUser()
    {
    	$getUser=$this->home->select_data("user", " where id=".$this->session->userdata("user_id"))->row();
    	return $getUser;
    }


}
