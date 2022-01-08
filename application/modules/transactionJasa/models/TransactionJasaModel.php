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

class TransactionJasaModel extends MY_Model{

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

    public function contentDetail($where="")
    {
		$qry=$this->qry($where);
        $getDetail=$this->db->query($qry)->result();

		$returnData=array();

		if($getDetail)
		{
			foreach ($getDetail as $key => $value) {

				if($value->total_weight==0)
				{
					$value->total_weight="<i style='color:red' >Sedang Di Proses </i>";
				}

				$returnData[]=$value;
			}
		}

		return $returnData;
		
    }	

    public function qry($where="")
    {
		$sql="
			select 
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
			{$where}
			order by ts.id desc limit 10  		
		";

		return $sql;
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
