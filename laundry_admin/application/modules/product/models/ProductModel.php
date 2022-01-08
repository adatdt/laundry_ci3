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

class ProductModel extends MY_Model{

	public function __construct() {
		parent::__construct();
	}

	public function getDataList()
	{
		$cari =trim($this->input->post("cari"));

		$where = " where id is not null ";

		if(!empty($cari))
		{
			$where .= " and ( name like '%{$cari}%' ) ";
		}


		$qry="SELECT 
				ct.name as category_name,
			    op.name as operator_name,
				p.* 
			FROM product p 
			left join category ct on p.id_category=ct.id
			left join operator op on p.id_operator=op.id
			order by p.id desc
				";

		$getData=$this->db->query($qry)->result();
		$data=array();

		$no=1;
		foreach ($getData as $key => $value) {

			$value->action ="";
			$value->action .=" <button class='btn btn-danger btn-sm btnDelete' onClick=myData.getDelete('$value->id') title='Hapus' ><i class=' fa fa-trash'></i></button>";
			$value->action .=" <button class='btn btn-warning btn-sm btnEdit' id='btnEdit".$no."' onClick=myData.getEdit('btnEdit".$no."') data-id='".$value->id."' 
				data-name='".$value->name."' 
				data-category='".$value->id_category."'
				data-operator='".$value->id_operator."'
				data-saldo='".$value->saldo."'
				data-price='".$value->price."'
				data-type='".$value->type."'
				data-description='".$value->description."'
				title='Edit' ><i class=' fa fa-pencil' ></i></button>";

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
