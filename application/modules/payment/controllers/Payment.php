<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Payment extends MY_Controller{
	public function __construct(){
		parent::__construct();

        $this->load->model('paymentModel','payment');
	}

	public function index(){   
        if($this->input->is_ajax_request()){
            $rows = $this->payment->dataList();
            echo json_encode($rows);
            exit;
        }

        $data = array(
            'title'    => 'Pembayaran',
            'content'  => 'index',

        );

		$this->load->view('default', $data);
	}

    public function detailData()
    {
        $order_code=$this->input->post("order_code");
        $data=$this->payment->detailData($order_code);

        echo json_encode($data);

    }

    public function savePayment()
    {
        $bankName=$this->input->post('bankName'); // nama bank yang dituju
        $noRek=$this->input->post('noRek'); // no rekening yang dituju
        $accountUser=$this->input->post('accountUser'); // nama bank user
        $noAccountBankUser=$this->input->post('noAccountBankUser'); // nomer rekening bank user
        $accountName=$this->input->post('accountName'); // nama  user
        $amount=$this->input->post('amount');// total yang di trasfer
        $order_code=$this->input->post('order_code');// total yang di trasfer
        $filename = $_FILES['imageFile']['name'];

        $checking_format_file[]=0;
        $nama_baru="";
        if(!empty($filename))
        {
            $lokasi = $_FILES['imageFile']['tmp_name'];
            $extensi = pathinfo($filename, PATHINFO_EXTENSION); // mengambil extensi file yg di upload 
            $nama_baru="img-".date("YmdHis").".".$extensi;

            // strtoupper($extensi)<>"JPG"?$checking_format_file[]=1:"";

            if(strtoupper($extensi)=="JPG" or strtoupper($extensi)=="PNG")
            {
                $checking_format_file[]=0;                
            }
            else
            {
                $checking_format_file[]=1;
            }

        }

        // path kirim data
        $path_file="./uploads/".$nama_baru;

        $checkStatusPayment=$this->payment->select_data("order_product", "where order_code='{$order_code}' " )->row();

        if (empty($bankName) or empty($noRek) or empty($accountUser) or empty($noAccountBankUser) or empty($accountName) or empty($amount) )
        {
            $res=array("code"=>0, "message"=>'data Masih ada yang Kosong');
        }
        else if($checkStatusPayment->status_payment==2)
        {
            $res=array("code"=>0, "message"=>'Anda sudah melakukan pembayaran');      
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
            $inserPayment=array(
                'payment_code'=>"PY-".date('YmdHis'),
                'order_code'=>$order_code,
                'path'=>$path_file,
                'bank_name_destination'=>$bankName,
                'account_bank_number_destination'=>$noRek,
                'bank_name_user'=>$accountUser,
                'account_bank_user_number'=>$noAccountBankUser,
                'name_account_user'=>$accountName,
                'total_payment'=>$amount,
                'created_on'=>date('Y-m-d H:i:s')
            );

            $updateOrder=array(
                "status_payment"=>2
            );

            $this->db->trans_begin();
            $this->payment->insert_data("payment",$inserPayment);
            $this->payment->update_data("order_product",$updateOrder, " order_code='{$order_code}' ");

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
