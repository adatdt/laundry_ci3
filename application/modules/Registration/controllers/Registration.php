<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Registration extends MY_Controller{
	public function __construct(){
		parent::__construct();

        // $this->load->model('registrationModel','registration');
	}

	public function index(){   

        $data = array(
            'title'    => 'Pendaftaran',
            'content'  => 'index',

        );

		$this->load->view('default', $data);
	}


}
