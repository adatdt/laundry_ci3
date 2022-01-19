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

class LaporanModel extends MY_Model{

	public function __construct() {
		parent::__construct();
	}

	public function getDataList()
	{
		$dateTo =trim($this->input->post("dateTo"));
		$dateFrom =trim($this->input->post("dateFrom"));

		$where = " where CAST(ts.created_on AS DATE) between '{$dateFrom}' and '{$dateTo}'  ";

		$qry=$this->qry($where);
		$getData=$this->db->query($qry)->result();
		$data=array();

		$no=1;
		$dataDibayar=array();
		$dataBelumDibayar=array();
		foreach ($getData as $key => $value) {

			switch ($value->status_payment) {
				case '2': // status dibayar
						$dataDibayar[]=$value;
					break;
				
				default:
					$dataBelumDibayar[]=$value;
					break;
			}
			
			$no++;
		}

		return $sendData=array(

							"dataBelumDibayar"=>$dataBelumDibayar,
							"dataDibayar"=>$dataDibayar
						);
	}

	public function getDataListPdf()
	{
		$dateTo =trim($this->input->get("dateTo"));
		$dateFrom =trim($this->input->get("dateFrom"));

		$where = " where CAST(ts.created_on AS DATE) between '{$dateFrom}' and '{$dateTo}'  ";

		$qry=$this->qry($where);
		$getData=$this->db->query($qry)->result();
		$data=array();

		$no=1;
		$dataDibayar=array();
		$dataBelumDibayar=array();
		foreach ($getData as $key => $value) {

			switch ($value->status_payment) {
				case '2': // status dibayar
						$dataDibayar[]=$value;
					break;
				
				default:
					$dataBelumDibayar[]=$value;
					break;
			}
			
			$no++;
		}

		return $sendData=array(

							"dataBelumDibayar"=>$dataBelumDibayar,
							"dataDibayar"=>$dataDibayar
						);
	}	
	public function qry($where){
		return $qry="
		
				select 
					ps.name as product_service_name,
					ts.status_payment,
					CAST(ts.created_on AS DATE) as transaction_date,
					sum(ts.total_amount) as total,
					count(CAST(ts.created_on AS DATE)) as total_transaction
				from transaction_service ts 
				left join product_service ps on ts.id_product_service =ps.id
				{$where}
				group by 
					ps.name,
					ts.status_payment,
					CAST(ts.created_on AS DATE) 
					order by ts.created_on asc 

		
		";
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
