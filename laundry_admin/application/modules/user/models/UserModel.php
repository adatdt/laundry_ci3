<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * -----------------------
 * CLASS NAME : Operator
 * -----------------------
 *
 * @author     adat <adatdt@gmail.com>
 * @copyright  2021
 *
 */

class UserModel extends MY_Model{

	public function __construct() {
		parent::__construct();
	}

	public function getDataList()
	{
		$cari =trim($this->input->post("cari"));

		$where = " where id is not null ";

		if(!empty($cari))
		{
			$where .= " and ( 
							name like '%{$cari}%' or
							username like '%{$cari}%' or
							no_hp like '%{$cari}%' or
							address like '%{$cari}%' 

				) ";
		}

		$getData=$this->select_data("user"," {$where} order by name asc")->result();
		$data=array();

		$no=1;
		foreach ($getData as $key => $value) {

			$value->action ="";

			$value->action .=" <button class='btn btn-danger btn-sm btnDelete' onClick=myData.getDelete('$value->id') title='Hapus' ><i class=' fa fa-trash'></i></button>";
			$value->action .=" <button class='btn btn-warning btn-sm btnEdit' id='btnEdit".$no."' onClick=myData.getEdit('btnEdit".$no."') data-id='".$value->id."' data-name='".$value->name."' data-address='{$value->address}'  data-phoneNumber='{$value->no_hp}' data-idGroup='{$value->id_group}' data-username='{$value->username}'  title='Edit' ><i class=' fa fa-pencil' ></i></button>";

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
