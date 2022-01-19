<?php

function is_login(){

	$ci =& get_instance();

	$login=$ci->session->userdata("is_login");

	if($login<>1)
	{
		redirect(site_url("login"));
		exit;
	}

} 

function formatUang($number="")
{
	$getUang=empty($number)?0:$number;
	$hasil_rupiah = number_format($getUang,0,',','.');
	return $hasil_rupiah;
}

function getMenu(){

	$ci =& get_instance();


	$qry="
		SELECT m.name,  m.url from menu m 
		join privilege p on m.id=p.menu_id
		where 
			p.user_group_id=".$ci->session->userdata('group')."
			and p.status=1
			and m.status <>'-5'	
			order by m.ordering asc 
	";

	$getMenu=$ci->db->query($qry)->result();
	
	
	if($getMenu)
	{
		return $getMenu;	
	}
	else
	{
		return array();
	}


} 