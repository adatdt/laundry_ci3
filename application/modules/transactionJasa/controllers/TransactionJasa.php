<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class TransactionJasa extends MY_Controller{
	public function __construct(){
		parent::__construct();
        is_login();

        $this->load->model('TransactionJasaModel','transaction');
	}

	public function index($kategori=""){   

        if($this->input->is_ajax_request()){
            
            $rows = $this->transaction->dataList($kategori);
            echo json_encode($rows);
            exit;
        }

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
            'transaction' => $this->transaction->contentDetail(" where user_transaction='adi' ")
        );

		$this->load->view('default', $data);
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

        $hargaPengantaran=$this->input->post("hargaPengantaran");
        $hargaPengambilan=$this->input->post("hargaPengambilan");
        $tanggalPengambilan=$this->input->post("tanggalPengambilan"); 
        $jamPengambilan=$this->input->post("jamPengambilan");


        $this->form_validation->set_rules("dataJasa"," Jenis Jasa","required");
        $this->form_validation->set_rules("noHp"," No Hp","required");
        $this->form_validation->set_rules("address"," Alamat ","required");
        $this->form_validation->set_rules("tohar","Total Harga","required");

        if(!empty($hargaPengambilan))
        {
            $this->form_validation->set_rules("tanggalPengambilan"," Tanggal Pengambilan ","required");
            $this->form_validation->set_rules("jamPengambilan","jam Pengambilan","required");
        }

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
            'status'=>1,
            'user_transaction'=>"adi",
            'created_by'=>'admin',
            'created_on'=>date("Y-m-d H:i:s"),
        );

        $dataTransactionDetail=array(
            'transaction_code'=>$trxDate,
            'status_proces'=>1,
            'status'=>1,
            'created_by'=>'admin',
            'created_on'=>date("Y-m-d H:i:s"),
        );        

        if ($this->form_validation->run() == FALSE)
        {
            $res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
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

    public function contentDetail()
    {
        $data=$this->transaction->contentDetail();
        echo json_encode($data);

    }

}
