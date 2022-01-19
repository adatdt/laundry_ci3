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
		$statusProces=$this->input->post("statusProces");

		$where = " where  ts.status is not null and CAST(ts.created_on AS DATE)  between '{$dateFrom}' and '{$dateTo}' ";

		if(!empty($status))
		{
			$where .=" and ts.status_payment=$status ";		
		}

		if(!empty($statusProces))
		{
			$where .=" and ts.status_proces=$statusProces ";
		}

		if(!empty($cari))
		{
			$where .=" and (
					ts.transaction_code like '%$cari%'
					or ts.email like '%$cari%'
					or ts.no_hp like '%$cari%'
					or ts.user_transaction like '%$cari%'
			) ";
		}		


		$qry=$this->qry($where." order by ts.id desc ");

		// die($qry); exit;

		$getData=$this->db->query($qry)->result();

		$data=array();

		$no=1;
		foreach ($getData as $key => $value) 
		{
			$value->action="";

			$value->icon='<span  class="badge badge-success"><i class="fa fa-plus" aria-hidden="true"></i></span>';

			$value->total_amount="<span  id='td_total_amount{$value->transaction_code}'>".formatUang($value->total_amount)."</span>";
			$value->total_weight="<span  id='td_total_weight{$value->transaction_code}'>".formatUang($value->total_weight)."</span>";
			
			switch ($value->status_proces) {
				case '2':
						$value->status_proces2="<span id='td_penjemputan_{$value->transaction_code}'><span  class='badge badge-warning'>Penjemputan</span></span>";
					break;
				case '3':
					$value->status_proces2="<span id='td_penjemputan_{$value->transaction_code}'><span  class='badge badge-warning' >Proses</span></span>";
				break;
				case '4':
					$value->status_proces2="<span id='td_penjemputan_{$value->transaction_code}'><span  class='badge badge-warning'>Pengiriman</span></span>";
				break;				
				case '5':
					$value->status_proces2="<span id='td_penjemputan_{$value->transaction_code}'><span  class='badge badge-success'>Selesai</span></span>";
				break;				
				case '6':
					$value->status_proces2="<span id='td_penjemputan_{$value->transaction_code}'><span  class='badge badge-danger'  >Tidak valid</span></span>";	
				break;																
				default: // proses status 0 order
					$value->status_proces2="<span id='td_penjemputan_{$value->transaction_code}'><span  class='badge badge-dark' >Order</span></span>";
					break;
			}

			$value->status_payment2=$value->status_payment==2?"<span class='badge badge-success' id='statusBayar{$value->transaction_code}'>Dibayar</span>":"<span class='badge badge-danger' id='statusBayar{$value->transaction_code}'>Belum</span>";
			
						

			$data[]=$value;
			$no++;
		}

		return $sendData=array(

							"data"=>$data,
							"recordsTotal"=>count((array)$data)
						);
	}

	public function detailRowChild($transactionCode)
	{


		$where = " where ts.transaction_code='{$transactionCode}' ";

		
		
		$qry=$this->qry($where);
		
		
		$getData=$this->db->query($qry)->row();
		switch ($getData->status_proces) {
			case '2':
				$getData->status_proces2="<span id='td_penjemputan_{$getData->transaction_code}'><span id='td_penjemputan_{$getData->transaction_code}' class='badge badge-warning'>Penjemputan</span></span>";
			break;
			case '3':
				$getData->status_proces2="<span id='td_penjemputan_{$getData->transaction_code}'><span  class='badge badge-warning' id='td_penjemputan_{$getData->transaction_code}' >Proses</span></span>";
			break;
			case '4':
				$getData->status_proces2="<span id='td_penjemputan_{$getData->transaction_code}'><span  class='badge badge-warning' id='td_penjemputan_{$getData->transaction_code}' >Pengiriman</span></span>";
			break;				
			case '5':
				$getData->status_proces2="<span id='td_penjemputan_{$getData->transaction_code}'><span  class='badge badge-success' id='td_penjemputan_{$getData->transaction_code}' >Selesai</span></span>";
			break;				
			case '6':
				$getData->status_proces2="<span id='td_penjemputan_{$getData->transaction_code}'><span  class='badge badge-danger' id='td_penjemputan_{$getData->transaction_code}' >Tidak valid</span></span>";	
			break;																
			default: // proses status 0 order
				$getData->status_proces2="<span id='td_penjemputan_{$getData->transaction_code}'><span  class='badge badge-dark' id='td_penjemputan_{$getData->transaction_code}' >Order</span></span>";
				break;
		}		


		$getData->total_amount2="<span  id='td_total_amount{$getData->transaction_code}'>".formatUang($getData->total_amount)."</span>";
		$getData->total_weight2="<span  id='td_total_weight{$getData->transaction_code}'>".formatUang($getData->total_weight)."</span>";		

		return $getData;
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
		$qry="		
			SELECT 
				ts.transaction_code,
				ts.status_payment ,
				ts.status_proces,
				ts.email,
				ts.no_hp,
				ps.name as product_service_name,
				ts.price_product_service ,
				ts.price_service_delivery ,
				ts.price_service_pickup ,
				ts.total_amount ,
				ts.total_weight ,
				ts.address ,
				ts.created_on,
				ts.date_pickup ,
				ts.time_pickup ,
				s.name as layanan_antar,
				ts.user_transaction,
				s2.name as layanan_jemput

			from transaction_service ts 
			left join service s on ts.id_service_delivery =s.id 
			left join service s2 on ts.id_service_pickup =s2.id 
			left join product_service  ps on ts.id_product_service =ps.id 
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
				ts.user_transaction,
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
