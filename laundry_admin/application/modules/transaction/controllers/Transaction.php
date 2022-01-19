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

        $productJasa=$this->transaction->select_data("product_service", "  ")->result();
        $dataJasa[0]="Pilih";
        foreach ($productJasa as $key => $value) {
            $dataJasa[$value->id]= $value->name;
        }


        $jasaAntar=$this->transaction->select_data("service", " where service_code='LY-0001' ")->result();
        $dataJasaAntar[0]="Pilih";
        foreach ($jasaAntar as $key => $value) {
            $dataJasaAntar[$value->id]= $value->name;
        }        


        $jasaJemput=$this->transaction->select_data("service", " where service_code='LY-0002' ")->result();
        $dataJasaJemput[0]="Pilih";
        foreach ($jasaJemput as $key => $value) {
            $dataJasaJemput[$value->id]= $value->name;
        }        		
		
        $data = array(
            'title'    => 'Transaksi',
            'content'  => 'index',   
            'dataJasa'=>$dataJasa,
            'dataJam'=>$this->jam(),
            'dataJasaAntar'=>$dataJasaAntar,
            'dataJasaJemput'=>$dataJasaJemput,			         

        );

		$this->load->view('default', $data);
	}

	public function getDataList()
	{

		$data=$this->transaction->getDataList();
		
		echo json_encode($data);


	}
	public function detailRowChild()
	{
		$transactionCode=$this->input->post('transactionCode');
		
		$data=$this->transaction->detailRowChild($transactionCode);
		echo json_encode($data);
	}

    public function actionAdd()
    {

        $dataJasa=$this->input->post("dataJasa");
        $dataJasaAntar=$this->input->post("dataJasaAntar");
        $dataJasaJemput=$this->input->post("dataJasaJemput");
        $noHp=$this->input->post("noHp");
        $address=$this->input->post("address");
        $hargaJasa=$this->input->post("hargaJasa");
        $tohar=$this->input->post("tohar");
        $email=$this->input->post("email");
		$name=$this->input->post("name");

        $hargaPengantaran=$this->input->post("hargaPengantaran");
        $hargaPengambilan=$this->input->post("hargaPengambilan");
        $tanggalPengambilan=$this->input->post("tanggalPengambilan"); 
        $jamPengambilan=$this->input->post("jamPengambilan");


        $this->form_validation->set_rules("dataJasa"," Jenis Jasa","required");
        $this->form_validation->set_rules("noHp"," No Hp","required");
        $this->form_validation->set_rules("address"," Alamat ","required");
        $this->form_validation->set_rules("tohar","Total Harga","required");
		$this->form_validation->set_rules("name","Nama","required");

        if(!empty($hargaPengambilan))
        {
            $this->form_validation->set_rules("tanggalPengambilan"," Tanggal Pengambilan ","required");
            $this->form_validation->set_rules("jamPengambilan","jam Pengambilan","required");
        }

		$this->form_validation->set_message('required','%s harus diisi!');


        $trxDate='TRX-'.date("YmdHis");
        $dataTransaction=array(
            'transaction_code'=>$trxDate,
            'id_product_service'=>$dataJasa,
            'id_service_delivery'=>$dataJasaAntar,
            'id_service_pickup'=>$dataJasaJemput,
            'no_hp'=>$noHp,
            'address'=>$address,
            'price_product_service'=>$hargaJasa,
            'total_amount'=>$tohar,
            'email'=>$email,
            'price_service_delivery'=>$hargaPengantaran,
            'price_service_pickup'=>$hargaPengambilan,
            'date_pickup'=>$tanggalPengambilan ,
            'time_pickup'=>$jamPengambilan,
			'user_transaction'=>$name,
            'status'=>1,
			'status_proces'=>1,
			'status_payment'=>1,
            'created_by'=>$this->session->userdata('username'),
            'created_on'=>date("Y-m-d H:i:s"),
        );

        $dataTransactionDetail=array(
            'transaction_code'=>$trxDate,
            'status_proces'=>1,
            'status'=>1,
            'created_by'=>'admin',
            'created_on'=>date("Y-m-d H:i:s"),
        );        

		// print_r($dataTransaction); exit;
		if(empty($dataJasa)|| $dataJasa==0 )
		{
			$res=array("code"=>0, "message"=>"Data Jasa Harus diisi");
		}
        else if ($this->form_validation->run() == FALSE)
        {
            $res=array("code"=>0, "message"=>validation_errors());
        }
        else
        {
            $this->db->trans_begin();

            $this->transaction->insert_data("transaction_service",$dataTransaction);
            $this->transaction->insert_data("transaction_service_detail",$dataTransactionDetail);

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $res=array("code"=>0, "message"=>'Gagal Input data ');
            }
            else
            {
                $this->db->trans_commit();            
                $res=array("code"=>1, "message"=>'Berhasil input data ');
            }
        }


        echo json_encode($res);   
    }



	public function actionEdit()
	{
		$transactionCode=$this->input->post('transactionCode');
		$statusPoces=$this->input->post('statusPoces');
		$totalWeight=$this->input->post('totalWeight');
		$totalAmount=$this->input->post('totalAmount');
		$statusPayment=$this->input->post('statusPayment');
		


		$data=array(
			"status_proces"=>$statusPoces,
			"status_payment"=>$statusPayment,
			"total_weight"=>$totalWeight,
			"total_amount"=>$totalAmount,
			"updated_on"=>date('Y-m-d H:i:s'),
			"updated_by"=>$this->session->userdata("username")
		);

		// print_r($data); exit;


		$updateDetail=array(
			"status"=>'0',
			"updated_on"=>date('Y-m-d H:i:s'),
			"updated_by"=>$this->session->userdata("username")
		);		

		$insertDetail=array(
			"status"=>'1',
			"transaction_code"=>$transactionCode,
			"status_proces"=>$statusPoces,
			"created_on"=>date('Y-m-d H:i:s'),
			"created_by"=>$this->session->userdata("username")
		);				

		$this->form_validation->set_rules("transactionCode"," Nomer transaksi","required");
		$this->form_validation->set_rules("statusPoces"," Status Proses","required");
		$this->form_validation->set_rules("totalWeight"," Total Berat","required");
		$this->form_validation->set_rules("totalAmount"," Total Harga","required");

		$this->form_validation->set_message('required','%s harus diisi!');

		if ($this->form_validation->run() === false) {
			$res=array("code"=>0, "message"=>validation_errors());
        }
		else
		{
			$this->db->trans_begin();
			
			$this->transaction->update_data("transaction_service",$data, " transaction_code='{$transactionCode}'");
			$this->transaction->update_data("transaction_service_detail",$updateDetail, " transaction_code='{$transactionCode}' and status=1 ");
			$this->transaction->insert_data("transaction_service_detail",$insertDetail);
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
    public function getHargaJasa()
    {
        $id=$this->input->post("id");
        $getDetail=$this->transaction->select_data("product_service"," where id={$id}" )->row();
        
        if($getDetail)
        {
            $data=array(
                            "detail"=>$getDetail,
                            "harga"=>$getDetail->price
                        );
        }
        else
        {
            $data=array(
                "detail"=>array(),
                "harga"=>0
            );
        }

        echo json_encode($data);
    } 

    public function getHargaLayanan()
    {
        $id=$this->input->post("id");
        $getDetail=$this->transaction->select_data("service"," where id={$id}" )->row();
        
        if($getDetail)
        {
            $data=array(
                            "detail"=>$getDetail,
                            "harga"=>$getDetail->price
                        );
        }
        else
        {
            $data=array(
                "detail"=>array(),
                "harga"=>0
            );
        }

        echo json_encode($data);
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
    public function jam()
    {
        $jam=0;
        $dataJam[""]="Pilih";
        for($i=0; $i<24;$i++)
        {
            $printf = sprintf("%'.02d", $i);
            $dataJam[$printf.":00"]=$printf.":00";
        }

        return $dataJam;

    }	

}
