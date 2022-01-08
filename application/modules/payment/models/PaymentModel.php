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

class PaymentModel extends MY_Model{

	public function __construct() {
		parent::__construct();
	}

	public function dataList()
	{
		

		$qry="SELECT
					count(opd.order_code) as total_barang,
					sum(opd.price) as total_harga,
					op.status_payment,
					ck.order_code,					
					ck.created_on
				FROM checkout ck
					join order_product op on ck.order_code=op.order_code
					join order_product_detail opd on ck.order_code=opd.order_code
				group by 
				op.status_payment,
				ck.order_code,
				ck.created_on

				order by ck.created_on desc
			";

		$getdata=$this->db->query($qry)->result();

		$order_code="";
		if(count((array)$getdata)>0)
		{
			$row=array();
			foreach ($getdata as $key => $value) {
				
				if($value->status_payment==1)
				{
					$value->status_payment="<span class='badge badge-secondary'> Menunggu Pembayaran</span>";	
					$value->action='<button class="btn btn-primary detail pull-right"  data-orderCode="'.$value->order_code.'" >Upload Pembayaran</button>';
				}
				else
				{
					$value->status_payment="<span class='badge badge-success'> Lunas</span>";
					$value->action='<button class="btn btn-success detail pull-right"  data-orderCode="'.$value->order_code.'">Detail</button>';
				}


				$row[]=$value;
			}

			$data=array(
				"code"=>1,
				"message"=>'data di temukan',
				"order_code"=>$order_code,
				"data"=>$row				
			);
		}
		else
		{
			$data=array(
				"code"=>0,
				"message"=>'data tidak di temukan',				

			);

		}
			
		return($data);

	}

	public function detailData($orderCode)
	{
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

         $qryCheckout="
				SELECT  
				kr.name as kurir_name,
				ck.order_code,
				ck.kurir_fare,
				op.status_payment,
				ck.total_amount
				FROM 
				checkout ck
				join kurir kr on ck.kurir_id=kr.id
				join order_product op on ck.order_code=op.order_code 
				where ck.order_code='{$orderCode}'
				";

		$qryDetailPayment="
			SELECT * FROM 
			payment 
			where order_code='{$orderCode}'
		";

        $dataOrderDetail=$this->db->query($qry)->result();
        $totalDataCheckout=$this->db->query($qryCheckout)->row();
        $detailPayment=$this->db->query($qryDetailPayment);

        $data=array('dataDetail'=>$dataOrderDetail,
        			'totalDataCheckout'=>$totalDataCheckout,
        			'detailPayment'=>$detailPayment->num_rows()<1?"":$detailPayment->row()
    				);

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

	public function delete_data($table,$data,$where)
	{
		$this->db->where($where);
		$this->db->delete($table, $data);
	}


}
