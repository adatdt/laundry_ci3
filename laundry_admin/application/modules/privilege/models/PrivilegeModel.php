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

class PrivilegeModel extends MY_Model{

	public function __construct() {
		parent::__construct();
	}

	public function getDataList()
	{
		$group =trim($this->input->post("group"));

		$where = " where status !='-5' ";


		$qry="	SELECT
					* 
				from menu 
				{$where}
				order by ordering asc
				";

		// die($qry); exit;

		$getData=$this->db->query($qry)->result();
		$data=array();

		$no=1;
		foreach ($getData as $key => $value) {

			$value->action =$this->getPrivilege($value->id,$group,$no);


			$data[]=$value;
			$no++;
		}

		return $sendData=array(

							"data"=>$data
						);
	}

	public function getPrivilege($menuId, $groupId,$no)
	{
		$check=$this->select_data("privilege"," where menu_id={$menuId} and status=1 and user_group_id={$groupId} ");

		$returnData='
			<label class="switch">
				<input type="checkbox" id="valueChecked'.$no.'" onChange="myData.actionPrivilege('.$menuId.','.$groupId.','.$no.')" >
				<span class="slider"></span>
			</label>		
		';
		if($check->num_rows()>0)
		{
			$returnData='
				<label class="switch">
					<input type="checkbox" id="valueChecked'.$no.'" checked onChange="myData.actionPrivilege('.$menuId.','.$groupId.','.$no.')" >
					<span class="slider"></span>
				</label>		
			';
		}
		return $returnData;
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
