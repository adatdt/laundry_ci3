<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Product extends MY_Controller{
	public function __construct(){
		parent::__construct();

        $this->load->model('productModel','product');
	}

	public function index($kategori=""){   

        if($this->input->is_ajax_request()){
            
            $rows = $this->product->dataList($kategori);
            echo json_encode($rows);
            exit;
        }

        // $chariOrder=$this->product->select_data("order_product", " where status_payment=0");
        // if($chariOrder->num_rows()>0)
        // {
        //     $order_code=$chariOrder->row()->order_code;

        //     $count=$this->product->select_data("order_product_detail", " where order_code='{$order_code}' ")->num_rows();
        //     $this->session->set_userdata(array('countProduct'=>$count));
        // }

        $data = array(
            'title'    => 'Product',
            'content'  => 'index',

        );

		$this->load->view('default', $data);
	}

    public function addChart()
    {
        $id=$this->input->post('id');

        $checkOrder=$this->product->select_data("order_product", " where status_payment=0");
        $getHarga=$this->product->select_data("product", " where id={$id}")->row();


        $this->db->trans_begin();

        if($checkOrder->num_rows()>0)
        {
            $orderCode=$checkOrder->row()->order_code;
            
            $inserDetail=array(
                'order_code'=>$orderCode,
                'id_product'=>$id,
                'price'=>$getHarga->price,
            );            
        }
        else
        {
            $orderCode=date('YmdHis');

            $inserHeader=array(
                'order_code'=>$orderCode,
                'status_payment'=>0,
                'created_on'=>date('Y-m-d H:i:s')
            );

            $this->product->insert_data('order_product',$inserHeader);

            $inserDetail=array(
                'order_code'=>$orderCode,
                'id_product'=>$id,
                'price'=>$getHarga->price,                
            );            

        }

        $this->product->insert_data('order_product_detail',$inserDetail);        

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $res=array("code"=>0, "message"=>'Gagal tambah data');
        }
        else
        {
            $this->db->trans_commit();
            $countChart=$this->product->select_data('order_product_detail'," where order_code='{$orderCode}' ")->num_rows();
            $this->session->set_userdata(array('countProduct'=>$countChart));
            $res=array("code"=>1, "message"=>'Berhasil',"data"=>$countChart);
        }

        echo json_encode($res);


    }

}
