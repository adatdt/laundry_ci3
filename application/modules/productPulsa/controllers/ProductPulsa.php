<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class ProductPulsa extends MY_Controller{
	public function __construct(){
		parent::__construct();

        $this->load->model('productPulsaModel','product');
	}

	public function index($kategori=""){   

        if($this->input->is_ajax_request()){
            
            $rows = $this->product->dataList($kategori);
            echo json_encode($rows);
            exit;
        }


        $data = array(
            'title'    => 'Product',
            'content'  => 'index',
            'category' => $this->product->select_data("operator", "  ")->result()

        );

		$this->load->view('default', $data);
	}

    public function actionAdd()
    {
        $productId=$this->input->post("productId");
        $saldo=$this->input->post("saldo");
        $price=$this->input->post("price");
        $noHp=$this->input->post("noHp");
        $email=$this->input->post("email");

        if(empty($productId) or empty($saldo) or empty($price) or empty($noHp) or empty($email))
        {
            $res=array("code"=>0, "message"=>'Data Masih ada yang kosong ');
        }
        else
        {

            $trxCode="TRX-".date('YmdHis');

            $insertTransaction=array(
                "transaction_code"=>$trxCode,
                "email"=>$email,
                "no_hp"=>$noHp,
                "status"=>0
            );  

            $insertTransactionDetail=array(
                "transaction_code"=>$trxCode,
                "id_product"=>$productId,
                "price"=>$price
            );  


            $this->db->trans_begin();

            $this->product->insert_data("transaction", $insertTransaction);
            $this->product->insert_data("transaction_detail", $insertTransactionDetail);

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $res=array("code"=>0, "message"=>'Gagal Update ');
            }
            else
            {

                $config = [
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8',
                    'protocol'  => 'smtp',
                    'smtp_host' => 'smtp.gmail.com',
                    'smtp_user' => 'tugaskelompoknuri@gmail.com',  // Email gmail
                    'smtp_pass'   => 'Nusa_Mandiri',  // Password gmail
                    'smtp_crypto' => 'ssl',
                    'smtp_port'   => 465,
                    'crlf'    => "\r\n",
                    'newline' => "\r\n"
                ];


                // Load library email dan konfigurasinya
                $this->load->library('email', $config);

                // Email dan nama pengirim
                $this->email->from('no-reply@masrud.com', 'nusa-mandiri');

                // Email penerima
                $this->email->to($email); // Ganti dengan email tujuan

                // Lampiran email, isi dengan url/path file
                // $this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

                // Subject email
                $this->email->subject('Pembayaran Pulsa');

                $detail=array("transactionCode"=>$trxCode, "total"=>$price );

                $email=$this->load->view('email',$detail,true);
                // Isi email
                $this->email->message($email);

                if ($this->email->send()) {
                    $this->db->trans_commit();
                    $res=array("code"=>1, "message"=>'Berhasil Update Silahkan check email anda untuk cara Pembayaran ');
                } 
                else 
                {
                    $this->db->trans_rollback();
                    $res=array("code"=>0, "message"=>'Email Salah ');
                }


            }
        }


        echo json_encode($res);   
    }


    public function getDetail()
    {
        $idOperator=$this->input->post("idOperator");
        $contentId=$this->input->post("contentId");

        // $getDataProduct=$this->product->select_data("product", "where id_operator='{$idOperator}' order by saldo asc " )->result();
        $getDataProduct=$this->product->getDetail($idOperator);
        
        $data=array("data"=>$getDataProduct,
                    "contentId"=>$contentId
                    );

        echo json_encode($data);
    } 

}
