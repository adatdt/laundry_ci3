<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Privilege extends MY_Controller{
	public function __construct(){
		parent::__construct();
		is_login();

		$this->load->model("privilegeModel","privilege");
	}

	public function index(){   
		$getUserGroup=$this->privilege->select_data("user_group"," where status=1 order by name asc ")->result();

		$dataGroup[""]="Pilih";
		foreach ($getUserGroup as $key => $value) {
			$dataGroup[$value->id]=$value->name;
		}
        $data = array(
            'title'    => 'Privilege',
            'content'  => 'index', 
			'group' =>$dataGroup    
        );

		$this->load->view('default', $data);
	}

	public function getDataList()
	{

		if(empty($this->input->post("group")))
		{	
			echo json_encode(array("data"=>array()));
			exit;
		}

		$data=$this->privilege->getDataList();
		
		echo json_encode($data);


	}

	public function actionPrivilege()
	{
		$groupId=trim($this->input->post('groupId')); 
		$menuId=trim($this->input->post('menuId')); 
		$valueChecked=trim($this->input->post('valueChecked')); 

        $this->form_validation->set_rules('groupId', 'group ', 'required');
		$this->form_validation->set_rules('menuId', 'menu ', 'required');
		
		$this->form_validation->set_message('required','%s harus diisi!');

		
		if ($this->form_validation->run() === false) {
			$res=array("code"=>0, "message"=>validation_errors());
        }
		else
		{
			$this->db->trans_begin();

			$checkDataPrivilege=$this->privilege->select_data("privilege"," where menu_id={$menuId} and user_group_id={$groupId} ");

			// jika datanya tidak ada sudah di pastikan checkboxnya  off
			if($checkDataPrivilege->num_rows()<1)
			{
				$dataInsert=array(
					"menu_id"=>$menuId,
					"status"=>1,
					"user_group_id"=>$groupId,
					"created_on"=>date('Y-m-d H:i:s'),
					"created_by"=>$this->session->userdata("username")
				);

				$this->privilege->insert_data("privilege",$dataInsert);
			}
			else
			{

				$updateData=array(
					"status"=>$valueChecked,
					"updated_on"=>date('Y-m-d H:i:s'),
					"updated_by"=>$this->session->userdata("username")
				);

				$this->privilege->update_data("privilege",$updateData," menu_id={$menuId} and user_group_id={$groupId} ");				
			}

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



}
