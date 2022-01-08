<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * -----------------------
 * CLASS NAME : Transaction
 * -----------------------
 *
 * @author     adat <adatdt@gmail.com>
 * @copyright  2021
 *
 */

class TransactionModel extends MY_Model{

	public function __construct() {
		parent::__construct();
	}

	public function getDataList()
	{
		$cari =trim($this->input->post("cari"));
		$dateFrom=$this->input->post("dateFrom");
		$dateTo=$this->input->post("dateTo");
		$status=$this->input->post("status");

		$where = " where CAST(tr.created_on as date) BETWEEN '{$dateFrom}' and '{$dateTo}'  ";

		if(!empty($cari))
		{
			$where .= " and ( transaction_code like '%{$cari}%' ) ";
		}

		if($status<>"")
		{
			$where .= " and ( tr.status='{$status}' ) ";	
		}


		$qry=$this->qry($where);


		$getData=$this->db->query($qry)->result();

		$data=array();

		$no=1;
		foreach ($getData as $key => $value) 
		{
			$value->action="";
			$value->action .="<button class='btn btn-primary btn-sm' onClick=myData.getDetail('".$value->transaction_code."') >Detail</button> ";

			if($value->status==1)
			{
				$value->action .="<button class='btn btn-success btn-sm' onClick=myData.getUpdateStatus('".$value->id."') >Kirim</button>";
				$value->status='<h6><span class="badge badge-warning">Dibayar</span></h6>';
			}	
			elseif ($value->status==2) 
			{
				$value->status='<h6><span class="badge badge-success">Berhasil</span></h6>';	
			}
			else
			{
				$value->status='<h6><span class="badge badge-danger">Menunggu Pembayaran</span></h6>';	
			}		
			$data[]=$value;
			$no++;
		}

		return $sendData=array(

							"data"=>$data,
							"recordsTotal"=>count((array)$data)
						);
	}

	public function downloadExcel()
	{
		$cari =trim($this->input->get("cari"));
		$dateFrom=$this->input->get("dateFrom");
		$dateTo=$this->input->get("dateTo");
		$status=$this->input->get("status");

		$where = " where CAST(tr.created_on as date) BETWEEN '{$dateFrom}' and '{$dateTo}'  ";

		if(!empty($cari))
		{
			$where .= " and ( transaction_code like '%{$cari}%' ) ";
		}
		
		if($status<>"")
		{
			$where .= " and ( tr.status='{$status}' ) ";	
		}

		$qry=$this->qry($where);


		$getData=$this->db->query($qry)->result();

		$data=array();

		$no=1;
		foreach ($getData as $key => $value) 
		{
			$value->action="";
			$value->action .="<button class='btn btn-primary btn-sm' onClick=myData.getDetail('".$value->transaction_code."') >Detail</button> ";

			if($value->status==1)
			{
				$value->status='Dibayar';
			}	
			elseif ($value->status==2) 
			{
				$value->status='Berhasil';	
			}
			else
			{
				$value->status='Menunggu Pembayaran';	
			}		
			$data[]=$value;
			$no++;
		}

		return $data;

	}


	public function qry($where="")
	{
		$qry="SELECT *,
	    		(select count(id) from transaction_detail where transaction_code=tr.transaction_code) as total_barang
				FROM transaction tr
				{$where}
			";

		return $qry;
	}

	public function getDetail($trxCode)
	{
		$qry="
			SELECT 
				tr.status,
			    py.created_on as tanggal_bayar,
			    tr.transaction_code,
			    py.payment_code,
			    tr.created_on as tanggal_transaksi,
			    p.name,
			    py.amount as total_transfer,
			    py.path ,
			    tr.email,
			    trd.price
			FROM transaction tr
			join transaction_detail trd on tr.transaction_code=trd.transaction_code
			left join product p on trd.id_product=p.id
			left JOIN payment py on tr.transaction_code=py.transaction_code
			where tr.transaction_code='{$trxCode}'
		";

		$getDetail=$this->db->query($qry)->result();
		$data=array();

		foreach ($getDetail as $key => $value) {
			
			if($value->status==1)
			{
				$value->status='<span class="badge badge-warning">Dibayar</span>';
			}
			else if($value->status==2)
			{
				$value->status='<span class="badge badge-success">Berhasil</span>';
			}
			else
			{
				$value->status='<span class="badge badge-danger">Menunggu Pembayaran</span>';
			}

			if (file_exists($value->path)) 
			{
				$value->path="<img src='".base_url($value->path)."' width='100px' />"; 		
			} 
			else 
			{
				$value->path='<span class="badge badge-danger">Gambar Tidak ada</span>';
			}


			$data[]=$value;
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
