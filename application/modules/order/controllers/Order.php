<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Order extends MY_Controller{
	public function __construct(){
		parent::__construct();

        $this->load->model('orderModel');
	}

	public function index(){   
        if($this->input->is_ajax_request()){
            $rows = $this->orderModel->dataList();
            echo json_encode($rows);
            exit;
        }

        $getKurir=$this->orderModel->select_data("kurir", " order by name asc " )->result();
        $dataKurir[""]="Pilih";
        foreach ($getKurir as $key => $value) {
            $dataKurir[$value->id]=$value->name;
        }

        $data = array(
            'title'    => 'Keranjang',
            'content'  => 'index',
            'kurir' =>$dataKurir,

        );

		$this->load->view('default', $data);
	}

    public function updateChart()
    {
        $idProduct=$this->input->post('id');
        $order_code=$this->input->post('order_code');
        $total=$this->input->post('total');

        $checkStatusPayment=$this->orderModel->select_data('order_product', " where order_code='{$order_code}' and status_payment=0 ");

        if($checkStatusPayment->num_rows()<1)
        {
            $res=array("code"=>0, "message"=>'Gagal Update Qty');
        }
        else
        {

            $this->db->trans_begin();

            $this->orderModel->delete_data('order_product_detail', array('order_code'=>$order_code, 'id_product'=>$idProduct) );
            $getProduct=$this->orderModel->select_data('product'," where id={$idProduct} ")->row();

            for ($i=0; $i <$total ; $i++) { 
                
                $insertData=array(

                    'order_code'=>$order_code,
                    'id_product'=>$idProduct,
                    'price'=>$getProduct->price
                );

                $this->orderModel->insert_data('order_product_detail',$insertData);
            }

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $res=array("code"=>0, "message"=>'Gagal Update Qty');
            }
            else
            {
                $this->db->trans_commit();
                $countChart=$this->orderModel->select_data('order_product_detail'," where order_code='{$order_code}' ")->num_rows();
                $this->session->set_userdata(array('countProduct'=>$countChart));
                $res=array("code"=>1, "message"=>'Berhasil Update Qty',"data"=>$countChart);
            }
        }


        echo json_encode($res);
    }

    public function saveCheckout()
    {
        $order_code=$this->input->post("order_code");
        $total_amount=$this->input->post("total_amount");
        $kurir_id=$this->input->post("kurir");
        $kurir_fare=$this->input->post("kurir_fare");

        $checkOrderProduct=$this->orderModel->select_data("order_product", " where order_code='{$order_code}' and status_payment=0 ");

        if($checkOrderProduct->num_rows()<1)
        {
            $res=array("code"=>0, "message"=>'Anda sudah melakukan Checkout di keranjang belanja ini');
        }
        else
        {

            $this->db->trans_begin();

            $insertData=array(
                "order_code"=>$order_code,
                "kurir_id"=>$kurir_id,
                "total_amount"=>$total_amount,
                "kurir_fare"=>$kurir_fare,
                "created_on"=>date('Y-m-d H:i:s')
            );

            $updateData=array(
                'status_payment'=>1
            );

            $this->orderModel->insert_data("checkout",$insertData);
            $this->orderModel->update_data("order_product",$updateData," order_code='{$order_code}' " );


            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $res=array("code"=>0, "message"=>'Gagal Update Qty');
            }
            else
            {
                $this->db->trans_commit();

                $getOrder=$this->orderModel->select_data('order_product'," where status_payment=0");

                if($getOrder->num_rows()>0)
                {                
                    $countChart=$this->orderModel->select_data('order_product_detail'," where order_code='{$getOrder->row()->order_code}' ")->num_rows();
                    $this->session->set_userdata(array('countProduct'=>$countChart));
                }
                else
                {
                    $countChart=0;
                    $this->session->set_userdata(array('countProduct'=>$countChart));   
                }
                
                $res=array("code"=>1, "message"=>'Berhasil Update Qty',"data"=>$countChart);
            }
        }



        echo json_encode($res);
    }    

    public function updateKurir()
    {
        $id=$this->input->post('id');

        
        if(!empty($id))
        {
            $checkKurir=$this->orderModel->select_data("kurir", " where id={$id} ");
            $data=$checkKurir->row();
        }
        else
        {
            $data=array("fare"=>0);
        }

        echo json_encode($data);
    }

    public function deleteChart(){
        $order_code=$this->input->post('order_code');
        $id_product=$this->input->post('id_product');


        $this->db->trans_begin();
        
        $this->orderModel->delete_data("order_product_detail", array('id_product'=>$id_product,'order_code'=>$order_code));

        $checkIsset=$this->orderModel->select_data("order_product_detail"," where order_code='{$order_code}' ");

        if($checkIsset->num_rows()<1)
        {
            $this->orderModel->delete_data("order_product",array('order_code'=>$order_code));
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $res=array("code"=>0, "message"=>'Gagal Hapus item');
        }
        else
        {
            $this->db->trans_commit();
            

            $getOrder=$this->orderModel->select_data('order_product'," where status_payment=0");

            if($getOrder->num_rows()>0)
            {                
                $countChart=$this->orderModel->select_data('order_product_detail'," where order_code='{$getOrder->row()->order_code}' ")->num_rows();
                $this->session->set_userdata(array('countProduct'=>$countChart));
            }
            else
            {
                $countChart=0;
                $this->session->set_userdata(array('countProduct'=>$countChart));   
            }

            $res=array("code"=>1, "message"=>'Berhasil Hapus item', "data"=>$countChart);
        }

        echo json_encode($res);        

    }

}
