<!-- Setting CSS bagian header/ kop -->
<style type="text/css">
    .my-img{

        height:50px;
        width: 100px        
    }

    .my-table {

      border-collapse: collapse;
      width: 100%;
    }

    .my-table td, .my-table th {
      /*border: 1px solid #ddd;*/
      border: 1px solid grey;
      padding: 5px;
      font-size: 14px;
    }


    .my-table th {
      padding-top: 5px;
      padding-bottom: 5px;
      padding-left: 5px;
      padding-right: 5px;
      text-align: left;
      /*background-color: #4CAF50;*/
      /*color: white;*/
    }

    .font-small{
        font-size: 10px;
    }        
    .my-table-content td {
        padding :5px 10px 5px 10px;

    } 

    .my-table-content{
        padding-left: 50px;
    }

    .headerTable th{

        text-align: center;
        padding:5px;
        background: #ddd; 
        /*color: white;*/
    }
</style>
<!-- Setting Margin header/ kop -->
<page backtop="14mm" backbottom="14mm" backleft="15mm" backright="10mm">
  <!--  -->

<page_header>

    <p style=" text-align: center; ">

        <h4 >
            <span style="padding-bottom:50px;" >Laporan Tanggal <?= $dateFrom ?> s/d  <?= $dateTo ?> </span>
            <p></p>
            <p></p>
            <p></p>
            
        </h4>
    </p>    
  <!-- <div style="text-align: center; font-size: 20px;"></div> -->
</page_header>
<page_footer>
    Halaman [[page_cu]]/[[page_nb]]
</page_footer>
 

    <?php 

        $rowDataDibayar="";
        $rowDataBelumDibayar="";

        $totalDataDibayar=0;
        $totalTransactionDataDibayar=0;

        $totalDataBelumDibayar=0;
        $totalTransactionDataBelumDibayar=0;

        $no1=1;
        foreach ($data['dataDibayar'] as $key => $value) {

            $rowDataDibayar .="<tr>
                        <td>${no1}</td>
                        <td>{$value->transaction_date}</td>
                        <td align='right'>".$value->product_service_name."</td>
                        <td align='right'>".formatUang($value->total_transaction)."</td>
                        <td align='right'>".formatUang($value->total)."</td>
                    </tr>";

            $totalDataDibayar = $totalDataDibayar + $value->total;
            $totalTransactionDataDibayar = $totalTransactionDataDibayar + $value->total_transaction;
            $no1++;
        }

        $no2=1;
        foreach ($data['dataBelumDibayar'] as $key => $value) {

            $rowDataBelumDibayar .="<tr>
                        <td>{$no2}</td>
                        <td>{$value->transaction_date}</td>
                        <td>{$value->product_service_name}</td>
                        <td align='right'>".formatUang($value->total_transaction)."</td>
                        <td align='right'>".formatUang($value->total)."</td>
                    </tr>";

                $totalDataBelumDibayar = $totalDataBelumDibayar + $value->total;
                $totalTransactionDataBelumDibayar = $totalTransactionDataBelumDibayar + $value->total_transaction;
            $no2++;
        };		        

    ?>
    <table class="my-table font-small my-table-content" border="1">
        <thead>
            <tr>
                <th>no</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Jasa</th>
                <th>Total Transaksi</th>
                <th>Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="5">Status Sudah Bayar </td>
            </tr>
                <?= $rowDataDibayar ?>
            <tr>
                <td colspan="3">Total </td>
                <td align='right'><?= formatUang($totalTransactionDataDibayar) ?></td>
                <td align='right'><?= formatUang($totalDataDibayar) ?></td>
            </tr>
            <tr>
                <td colspan="5"> </td>
            </tr>
            <tr>
                <td colspan="5">Status Belum Bayar </td>
            </tr>
                <?= $rowDataBelumDibayar ?>
            <tr>
                <td colspan="3">Total </td>
                <td align='right'><?= formatUang($totalTransactionDataBelumDibayar) ?></td>
                <td align='right'>
                    <?= formatUang($totalDataBelumDibayar) ?>
                </td>
            </tr>
            <tr>
                <th colspan="3">Grand Total </th>
                <td align='right'><?= formatUang($totalTransactionDataBelumDibayar + $totalTransactionDataDibayar) ?></td>
                <td align='right'><?= formatUang($totalDataBelumDibayar + $totalDataDibayar) ?></td>
            </tr>										
        </tbody>
    </table>
 
</page>


<!-- Memanggil fungsi bawaan HTML2PDF -->
<?php




	$content = ob_get_clean();
	 // include 'html2pdf_v4.03/html2pdf.class.php';
	 try
	{
	  // setting paper
        
	    $html2pdf = new Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en', false, 'UTF-8', array(10, 10, 10,10,10,10));
	    $html2pdf->pdf->SetDisplayMode('fullpage');
	    $html2pdf->writeHTML($content);
	    $html2pdf->Output('Transaction date.pdf');
	}
	catch(HTML2PDF_exception $e) {
	    echo $e;
	    exit;
	}


   
	
?>
