<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * -----------------------
 * CLASS NAME : Operator
 * -----------------------
 *
 * @author     adat <adatdt@gmail.com>
 * @copyright  2022
 *
 */

class MenuModel extends MY_Model{

	public function __construct() {
		parent::__construct();
	}

	public function getDataList()
	{
		$cari =trim($this->input->post("cari"));

		$where = " where status !='-5' ";

		if(!empty($cari))
		{
			$where .= " and ( 
							name like '%{$cari}%'
							or url like '%{$cari}%'
							) ";
		}


		$qry="	SELECT
					* 
				from menu 
				{$where}
				order by id desc
				";

		// die($qry); exit;

		$getData=$this->db->query($qry)->result();
		$data=array();

		$no=1;
		foreach ($getData as $key => $value) {

			$value->action ="";
			$value->action .=" <button class='btn btn-danger btn-sm btnDelete' onClick=myData.getDelete('$value->id','-5') title='Hapus' ><i class=' fa fa-trash'></i></button>";

			if($value->status==1)
			{

				$value->action .=" <button class='btn btn-danger btn-sm btnDelete' onClick=myData.getDelete('$value->id','0') title='Non Aktif' ><i class='fa fa-ban' aria-hidden='true'></i></button>";
				$value->action .=" <button class='btn btn-warning btn-sm btnEdit' id='btnEdit".$no."' onClick=myData.getEdit('btnEdit".$no."') data-id='".$value->id."' 
					data-name='".$value->name."' 
					data-url='".$value->url."' 
					data-ordering='".$value->ordering."' 
					title='Edit' ><i class=' fa fa-pencil' ></i></button>";
				
				$value->status='<span class="badge badge-success"> Aktif</span>';
			}
			else
			{

				$value->action .=" <button class='btn btn-success btn-sm btnDelete' onClick=myData.getDelete('$value->id','1') title='Aktif' ><i class='fa fa-check' aria-hidden='true'></i></button>";
				$value->status='<span class="badge badge-danger">Non Aktif</span>';
			}


			$data[]=$value;
			$no++;
		}

		return $sendData=array(

							"data"=>$data
						);
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
