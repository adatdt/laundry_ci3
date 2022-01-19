<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Login extends MY_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->model("LoginModel","login");
	}

	public function index(){   

        $data = array(
            'title'    => 'login',

        );

		$this->load->view('login/index',$data);
	}

	public function actionLogin(){
		$username=$this->input->post("username");
		$password=md5($this->input->post("password"));

		
		if (empty($username) or empty($password))
		{
			$res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
			echo json_encode($res);
			exit;
		}

		$checkUsername=$this->login->select_data("user"," where username='{$username}' and status=1 and id_group !=2  ");

		$getUser=$checkUsername->row();
		if($checkUsername->num_rows()<1)
		{
			$res=array("code"=>0, "message"=>'Username Tidak di temukan');
		}
		else if($getUser->password<>$password)			
		{
			$res=array("code"=>0, "message"=>'Password Salah');	
		}
		else
		{

			$newdata = array(
			        'username'  => $getUser->username,
			        'is_login'     =>1,
			        'group' => $getUser->id_group,
			        'user_id'=>$getUser->id
			);

			$this->session->set_userdata($newdata);
			$res=array("code"=>1, "message"=>'Berhasil');		
		}

		echo json_encode($res);

	}

	public function logout()
	{
		session_destroy();
		$this->load->view('login/index');
	}


}
