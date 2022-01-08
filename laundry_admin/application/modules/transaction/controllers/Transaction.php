<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	

class Transaction extends MY_Controller{
	public function __construct(){
		parent::__construct();
		is_login();
		$this->load->model("TransactionModel","transaction");
	}

	public function index(){   

		
        $data = array(
            'title'    => 'Transaksi',
            'content'  => 'index',            

        );

		$this->load->view('default', $data);
	}

	public function getDataList()
	{

		$data=$this->transaction->getDataList();
		
		echo json_encode($data);


	}

	public function actionAdd()
	{
		$name=trim($this->input->post("name"));

		$checkName=$this->transaction->select_data("operator", " where upper(name)=upper('{$name}')");

		if(empty($name))
		{
			$res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
		}
		else if($checkName->num_rows()>0)
		{
			$res=array("code"=>0, "message"=>'Nama Sudah Ada ');
		}
		else
		{
			$this->db->trans_begin();

			$data=array("name"=>$name);

			$this->transaction->insert_data("operator",$data);

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $res=array("code"=>0, "message"=>'Gagal Simpan Data ');
            }
            else 
            {
                $this->db->trans_commit();
                $res=array("code"=>1, "message"=>'Berhasil Simpan data ');
            }


		}

		echo json_encode($res);
	}


	public function actionEdit()
	{
		$name=trim($this->input->post("nameEdit"));
		$id=trim($this->input->post("idEdit"));

		$checkName=$this->transaction->select_data("operator", " where upper(name)=upper('{$name}') and id<>{$id}");

		if(empty($name) or empty($id))
		{
			$res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
		}
		else if($checkName->num_rows()>0)
		{
			$res=array("code"=>0, "message"=>'Nama Sudah Ada ');
		}
		else
		{
			$this->db->trans_begin();

			$data=array("name"=>$name);
			
			$this->transaction->update_data("operator",$data, " id=$id");
            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $res=array("code"=>0, "message"=>'Gagal Edit Data ');
            }
            else 
            {
                $this->db->trans_commit();
                $res=array("code"=>1, "message"=>'Berhasil Edit data ');
            }


		}

		echo json_encode($res);
	}

	public function actionUpdate()
	{
		$id=trim($this->input->post("idUpdate"));

		if(empty($id))
		{
			$res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
		}
		else
		{
			$this->db->trans_begin();


			$dataUpdate=array("status"=>2,
							  "updated_on"=>date("Y-m-d H:i:s"),
							  "updated_by"=>'admin'
								);

			$this->transaction->update_data("transaction",$dataUpdate,"id=$id");

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $res=array("code"=>0, "message"=>'Gagal Proses Data ');
            }
            else 
            {
                $this->db->trans_commit();
                $res=array("code"=>1, "message"=>'Berhasil Proses data ');
            }


		}

		echo json_encode($res);
	}	

	public function downloadExcel()
	{
			$dateFrom=$this->input->get("dateFrom");
			$dateTo=$this->input->get("dateTo");

			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet->setCellValue('A1', 'No');
			$sheet->setCellValue('B1', 'Kode Trsansaksi');
			$sheet->setCellValue('C1', 'Tanggal Trsansaksi');
			$sheet->setCellValue('D1', 'No Hp');
			$sheet->setCellValue('E1', 'Email');
			$sheet->setCellValue('F1', 'Status');
			
			$transaksi = $this->transaction->downloadExcel();
			$no = 1;
			$x = 2;
			foreach($transaksi as $row)
			{
				$sheet->setCellValue('A'.$x, $no++);
				$sheet->setCellValue('B'.$x, $row->transaction_code);
				$sheet->setCellValue('C'.$x, $row->created_on);
				$sheet->setCellValue('D'.$x, $row->no_hp);
				$sheet->setCellValue('E'.$x, $row->email);
				$sheet->setCellValue('F'.$x, $row->status);
				$x++;
			}
			$writer = new Xlsx($spreadsheet);
			$filename = 'laporan-Transaksi tanggal '.$dateFrom.'-'.$dateTo;
			
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');


	}

	public function getDetail(){

		$trxCode=$this->input->post("trxCode");

		$getDetail=$this->transaction->getDetail($trxCode);
		echo json_encode($getDetail);
	}

}
