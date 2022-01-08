<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * -----------------------

 * -----------------------
 *
 * @author     adat <adatdt@gmail.com>
 * @copyright  2022
 *
 */

class CheckTransactionModel extends MY_Model{

	public function __construct() {
		parent::__construct();
	}

	public function dataList()
	{
		// ini hanya untuk barang yang dikirim saja 
		$noTrans=trim($this->input->post("noTrans"));		

		$qry="
			SELECT
				ts.created_on,
				ts.transaction_code,
				ts.created_by,
				ts.total_weight ,
				ts.price_service_delivery ,
				ts.price_service_pickup ,
				ts.price_product_service ,
				ts.total_amount ,
				ps.name as layanan_prodak,
				s.name as service_pengiriman,
				(
					select status_proces from transaction_service_detail
					where status=1 order by id desc limit 1
				) as status_process,				
				s2.name as service_pengambilan
			from transaction_service ts 
			join product_service ps on ts.id_product_service =ps.id 
			left join service s on ts.id_service_delivery =s.id 
			left join service s2 on ts.id_service_pickup =s2.id	
			where	
				ts.transaction_code='{$noTrans}'
		";

		$getData=$this->db->query($qry);


		if(empty($noTrans))
		{
			$data=array("code"=>0,
					"message"=>"Data Masih Ada yang kosong");			
		}
		else if($getData->num_rows()<1)
		{
				$data=array("code"=>0,
					"message"=>"Data Tidak Ditemukan");
		}
		else
		{
			$qryTracking=" 
				SELECT 
					mstd.name
				from transaction_service_detail tsd 
				join master_status_transaction_detail mstd on tsd.status_proces=mstd.id
				where tsd.status=1 and mstd.status=1 
				and tsd.transaction_code='{$noTrans}'
				order by tsd.id asc
			";
			
			$tracking=$this->db->query($qryTracking)->result();

			$data=array("code"=>1,
					"message"=>"success",
					"data"=>$getData->row(),
					"tracking"=> $tracking
				);
		}
		
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
