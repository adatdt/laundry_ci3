<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * -----------------------
 * CLASS NAME : Port_model
 * -----------------------
 *
 * @author     Robai <robai.rastim@gmail.com>
 * @copyright  2018
 *
 */

class TransactionModel extends MY_Model{

	public function __construct() {
		parent::__construct();
	}

	public function dataList()
	{
		// ini hanya untuk barang yang dikirim saja 
		$noTrans=trim($this->input->post("noTrans"));
		$email=trim($this->input->post("email"));

		$qry="

				SELECT 
					p.name as product_name,
					p.price,
					tr.* 
				from transaction tr
				left join transaction_detail trd on tr.transaction_code=trd.transaction_code
				left join product p on trd.id_product=p.id
				where email='{$email}' and tr.transaction_code='{$noTrans}'
		";

		$getData=$this->db->query($qry);


		if(empty($noTrans) or empty($email))
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

			$dataSend=$getData->row();

			if($dataSend->status==1)
			{
				$dataSend->status_name="<span class='badge badge-warning'> Dibayar </span>";
			}
			else if($dataSend->status==2)
			{
				$dataSend->status_name="<span class='badge badge-success'> Berhasil Proses </span>";
			}
			else 
			{
				$dataSend->status_name="<span class='badge badge-danger'>Menunggu Pembayaran</span>";
			}


			$data=array("code"=>1,
					"message"=>"success",
					"data"=>$getData->row() );
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
