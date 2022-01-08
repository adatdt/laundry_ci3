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

class OrderModel extends MY_Model{

	public function __construct() {
		parent::__construct();
	}

	public function dataList()
	{
		// $getdata=$this->select_data("product", " ")->result();
		// return($getdata);

		$getOrder=$this->select_data('order_product', "where status_payment='0' ");

		if($getOrder->num_rows()>0)
		{
			$orderCode=$getOrder->row()->order_code;
			$qry="
					SELECT 
						count(pd.id_product) as total_product,
						sum(pd.price) as total_amount,
						pd.price,
						pd.order_code,
						p.path,
						p.id,
						p.name
					from order_product_detail pd
					join product p on pd.id_product=p.id
					where pd.order_code='$orderCode'
					group BY
					pd.price, pd.order_code,p.path, p.id,p.name
					order by p.name asc
			";

			$data=array(
				"code"=>1,
				"message"=>'data di temukan',
				"data"=>$this->db->query($qry)->result()				
			);


		}
		else
		{
			$data=array(
				"code"=>0,
				"message"=>'data tidak di temukan',				

			);

		}

		return $data;
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

	public function delete_data($table,$where)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}


}
