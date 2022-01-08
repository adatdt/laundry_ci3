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