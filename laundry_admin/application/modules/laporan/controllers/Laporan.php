<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Laporan extends MY_Controller{
	public function __construct(){
		parent::__construct();
		is_login();
		$this->load->model("laporanModel","laporan");
	}

	public function index(){   

		
        $data = array(
            'title'    => 'Laporan',
            'content'  => 'index',            

        );

		$this->load->view('default', $data);
	}

	public function getDataList()
	{

		$data=$this->laporan->getDataList();
		
		echo json_encode($data);


	}

	public function downloadPdf()
	{
	
		$data["data"]=$this->laporan->getDataListPdf();
		$data["dateTo"]=trim($this->input->get("dateTo"));
		$data['dateFrom'] =trim($this->input->get("dateFrom"));


		// print_r($data); exit;
		$this->load->view('laporan/pdf',$data);
	

	}


}
