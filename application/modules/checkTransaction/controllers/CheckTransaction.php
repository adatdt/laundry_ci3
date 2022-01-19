<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class CheckTransaction extends MY_Controller{
	public function __construct(){
		parent::__construct();

        $this->load->model('checkTransactionModel','transaction');
	}

	public function index($kategori=""){   

        if($this->input->is_ajax_request()){
            
            $rows = $this->transaction->dataList();
            echo json_encode($rows);
            exit;
        }


        $data = array(
            'title'    => 'Cek Transaksi',
            'content'  => 'index'

        );

		$this->load->view('default', $data);
	}

    public function actionUpload()
    {

        $bankTransfer=$this->input->post("bankTransfer");
        $accountName=$this->input->post("accountName");
        $nominal=$this->input->post("nominal");
        $transactionCode=$this->input->post("transactionCode");
        $accounNumberDestination=$this->input->post("accounNumberDestination");
        $bankDestination=$this->input->post("bankDestination");
        $accountNumber =$this->input->post("accountNumber");
        $filename = $_FILES['UploadFile']['name'];


        $checking_format_file[]=0;
        $nama_baru="";
        if(!empty($filename))
        {
            $lokasi = $_FILES['UploadFile']['tmp_name'];
            $extensi = pathinfo($filename, PATHINFO_EXTENSION); // mengambil extensi file yg di upload 
            $nama_baru="img-".date("YmdHis").".".$extensi;

            // strtoupper($extensi)<>"JPG"?$checking_format_file[]=1:"";

            if(strtoupper($extensi)=="JPG" or strtoupper($extensi)=="PNG" or strtoupper($extensi)=="JPEG")
            {
                $checking_format_file[]=0;                
            }
            else
            {
                $checking_format_file[]=1;
            }

        }

        // path kirim data
        $path_file="./counter_pulsa_admin/uploads/".$nama_baru;


        if(empty($bankTransfer) or empty($accountName) or empty($nominal) or empty($transactionCode) or empty($accounNumberDestination) or empty($bankDestination) or empty($accountNumber) )
        {
            $res=array("code"=>0, "message"=>'data Masih ada yang Kosong' ,"data"=>$bankTransfer."-".$accountName."-".$nominal."-".$transactionCode."-".$accounNumberDestination."-".$bankDestination."-".$accountNumber);
        }
        else if(empty($filename))
        {
            $res=array("code"=>0, "message"=>'Bukti gambar Masih Kosong');   
        }
        else if(array_sum($checking_format_file)>0)
        {
            $res=array("code"=>0, "message"=>'Format harus jpg atau png');    
        }
        else
        {

            $paymentCode="PYM-".date("YmdHis");


            $insertPayment=array(
                "transaction_code"=>$transactionCode,
                "amount"=>$nominal,
                "payment_code"=>$paymentCode,
                "path"=>"./uploads/".$nama_baru,
                "bank_name"=>$bankTransfer,
                "account_name"=>$accountName,
                "account_number"=>$accountNumber,
                "account_number_destination"=>$accounNumberDestination,
                "bank_name_destination"=>$bankDestination                
            );

            $updateTransaction=array(
                "status"=>1,
                "updated_on"=>date("Y-m-d H:i:s")
            );

            $this->transaction->insert_data("payment", $insertPayment);
            $this->transaction->update_data("transaction",$updateTransaction," transaction_code='{$transactionCode}' ");

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $res=array("code"=>0, "message"=>'Pembayaran Gagal');
            }
            else
            {
                $this->db->trans_commit();                
                $res=array("code"=>1, "message"=>'Pembayaran Berhasil');
                // Menyimpan path 
                move_uploaded_file($lokasi,$path_file); 
            }               
        }

        echo json_encode($res);
    }

}
