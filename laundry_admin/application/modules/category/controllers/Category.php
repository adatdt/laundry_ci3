<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Category extends MY_Controller{
	public function __construct(){
		parent::__construct();
		is_login();
		
		$this->load->model("categoryModel","category");
	}

	public function index(){   

		
        $data = array(
            'title'    => 'Kategori',
            'content'  => 'index',            

        );

		$this->load->view('default', $data);
	}

	public function getDataList()
	{

		$data=$this->category->getDataList();
		
		echo json_encode($data);


	}

	public function actionAdd()
	{
		$name=trim($this->input->post("name"));

		$checkName=$this->category->select_data("category", " where upper(name)=upper('{$name}')");

		if(empty($name))
		{
			$res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
		}
		else if($checkName->num_rows()>0)
		{
			$res=array("code"=>0, "message"=>'Nama Sudah Ada ');
		}
		else
		{
			$this->db->trans_begin();

			$data=array("name"=>$name);

			$this->category->insert_data("category",$data);
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
		$id=trim($this->input->post("idEdit"));

		$checkName=$this->category->select_data("category", " where upper(name)=upper('{$name}') and id<>{$id}");

		if(empty($name) or empty($id))
		{
			$res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
		}
		else if($checkName->num_rows()>0)
		{
			$res=array("code"=>0, "message"=>'Nama Sudah Ada ');
		}
		else
		{
			$this->db->trans_begin();

			$data=array("name"=>$name);
			
			$this->category->update_data("category",$data, " id=$id");
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

	public function actionDelete()
	{
		$id=trim($this->input->post("idDelete"));

		if(empty($id))
		{
			$res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
		}
		else
		{
			$this->db->trans_begin();

			$this->category->delete_data("category", "id=$id");

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
