<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * -----------------------
 * -----------------------
 *
 * @author     Adat <adatdt@gmail.com>
 * @copyright  2022
 *
 */

class ProductJasaModel extends MY_Model{

	public function __construct() {
		parent::__construct();
	}

	public function dataList($kategori)
	{
		// ini hanya untuk barang yang dikirim saja 
		$where=empty($kategori)?"":" where p.id_category='$kategori' and id_category not in (1,2) ";

		$qry=" SELECT 
					p.*,
					need_number 
				from 
					product p 
				left join category c on p.id_category=c.id
					{$where}
				order by p.id desc  
				";

		$getdata=$this->db->query($qry)->result();

		foreach ($getdata as $key => $value) {
			if(!empty($value->path))
			{
				$value->path='<img class="card-img-top img-fluid" src="<?=base_url()?>assets/img/'.$value->path.' " >';
			}
			else
			{
				$value->path=" ";
			}
		}

		$count=count((array)$getdata);
		$data=array("code"=>$count<1?0:1,
					"messege"=>"success",
					"data"=>$getdata );
		
		return($data);
	}

	public function getDetail($idOperator)
	{
		$qry="
			SELECT 
				p.*, 
				ct.name as category_name,
				op.name as operator_name 
			from
			product p 
			left join operator op on p.id_operator=op.id  
			left join category ct on p.id_category=ct.id  
			where id_operator='{$idOperator}' order by saldo asc
		";

		return $this->db->query($qry)->result();
	}

	public function select_data($table, $where)
	{

		return $this->db->query("select * from $table $where");
	}

	public function insert_data($table,$data)
	{
		$this->db->insert($table, $data);
	}

	public function update_data($table,$data,$where)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function delete_data($table,$data,$where)
	{
		$this->db->where($where);
		$this->db->delete($table, $data);
	}


}
