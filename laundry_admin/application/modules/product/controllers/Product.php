<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Product extends MY_Controller{
	public function __construct(){
		parent::__construct();
		is_login();

		$this->load->model("ProductModel","product");
	}

	public function index(){   

		$category=$this->product->select_data("category"," order by name asc ")->result();
		$operator=$this->product->select_data("operator"," order by name asc ")->result();

		$dataCategory[""]="Pilih";
		$dataOperator[""]="Pilih";
		foreach ($category as $key => $value) {
			$dataCategory[$value->id]=strtoupper($value->name);

		}

		foreach ($operator as $key => $value) {
			$dataOperator[$value->id]=strtoupper($value->name);

		}		
		
        $data = array(
            'title'    => 'Product',
            'content'  => 'index',
            'category'=>$dataCategory,
            'operator'=>$dataOperator,            

        );

		$this->load->view('default', $data);
	}

	public function getDataList()
	{

		$data=$this->product->getDataList();
		
		echo json_encode($data);


	}

	public function actionAdd()
	{
		$name=trim($this->input->post('name')); 
		$category=trim($this->input->post('category')); 
		$operator=trim($this->input->post('operator')); 
		$saldo=trim($this->input->post('saldo')); 
		$price=trim($this->input->post('price')); 
		$type=trim($this->input->post('type')); 
		$description=trim($this->input->post('description')); 

		
		if(
			empty($name) or
			empty($category) or
			empty($operator) or
			empty($saldo) or
			empty($price) or
			// empty($type) or
			empty($description) )
		{
			$res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
		}
		else
		{
			$this->db->trans_begin();

			$data=array(
					"name"=>$name,
					"id_category"=>$category,
					"id_operator"=>$operator,
					"saldo"=>$saldo,
					"price"=>$price,
					"type"=>$type,
					"description"=>$description,
					"created_on"=>date("Y-m-d H:i:s"),
					"created_by"=>$this->session->userdata("username")

				);
			// print_r($data); exit;

			$this->product->insert_data("product",$data);

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
		$category=trim($this->input->post('categoryEdit')); 
		$operator=trim($this->input->post('operatorEdit')); 
		$saldo=trim($this->input->post('saldoEdit')); 
		$price=trim($this->input->post('priceEdit')); 
		$type=trim($this->input->post('typeEdit')); 
		$description=trim($this->input->post('descriptionEdit')); 

		
		if(
			empty($name) or
			empty($category) or
			empty($operator) or
			empty($saldo) or
			empty($price) or
			// empty($type) or
			empty($description) )
		{
			$res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
		}
		else
		{
			$this->db->trans_begin();

				$data=array(
					"name"=>$name,
					"id_category"=>$category,
					"id_operator"=>$operator,
					"saldo"=>$saldo,
					"price"=>$price,
					"type"=>$type,
					"description"=>$description,
					"updated_on"=>date("Y-m-d H:i:s"),
					"updated_by"=>$this->session->userdata("username")

				);
			
			// print_r($data);exit;
			$this->product->update_data("product",$data, " id=$id");

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

			$this->product->delete_data("product", "id=$id");

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
