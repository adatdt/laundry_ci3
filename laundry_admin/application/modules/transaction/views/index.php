
<div class="row" >
	
	<div class="col-md-12 ">

		<!-- <button class='btn btn-success btn-sm ' id="btnExcel">Excel</button> -->
		<button class='btn btn-success btn-sm ' id="btnAdd">Tambah</button>
		<p></p>
		<p></p>
		<div class="d-flex flex-row-reverse">

			<div class="p-2 form-inline">
			  	

			<!-- 	  <label class="sr-only" for="inlineFormInputName2">Name</label>
				  <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Jane Doe">

				   -->
				<div class="input-group mb-2 mr-sm-2">

				   	<div class="input-group-prepend">
				    	<span class="input-group-text">Tanggal</span>
				    </div>
				    <input type="text" class="form-control date" id="dateFrom" placeholder="status" autocomplete="off" value="<?php echo date('Y-m-d',strtotime('-30 days')); ?>">
				    <div class="input-group-prepend">
				    	<span class="input-group-text">S/d</span>
				    </div>
				    <input type="text" class="form-control date" id="dateTo" placeholder="status" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">

				</div>	


				<div class="input-group mb-2 mr-sm-2">

				   	<div class="input-group-prepend">
				    	<span class="input-group-text">Status Pembayaran</span>
				    </div>
				    <select class="form-control" id="status">
				    	<option value="">Pilih</option>
				    	<option value="1">Belum</option>
				    	<option value="2">Dibayar</option>
				    </select>

				</div>

				<div class="input-group mb-2 mr-sm-2">

					<div class="input-group-prepend">
					<span class="input-group-text">Status Proses</span>
					</div>
					<select type="text" class="form-control"  id="statusProces"  >
						<option value="" >Pilih</option>
						<option value="1"  >Order</option>
						<option value="2" >Penjemputan</option>
						<option value="3" >Proses</option>
						<option value="4" >Pengiriman</option>
						<option value="5" >Selesai</option>
						<option value="6" >Tidak Valid</option>
					</select>
				</div>


				<label class="sr-only" for="cari">Cari</label>
				<div class="input-group mb-2 mr-sm-2">

				    <input type="text" class="form-control" id="cari" placeholder="Cari" autocomplete="off">
				   	<div class="input-group-prepend">
				    	<button class="btn btn-success" id="btnCari">Cari</button>
				    </div>
				</div>



					
			</div>
		</div>

		<div class="table-responsive">
			 <table id="table_id" class="table table-striped " align="center">
			    <thead>
			        <tr>
						<th></th>
			            <th>Kode Transaksi</th>
			            <th>Tanggal Teransaksi</th>
			            <th>No Hp</th>
			            <th>Email</th>
			            <th>Status Pembayaran</th>
						<th>Status Proses</th>
						<th>Nama Layanan</th>
						<th>Total Berat</th>
						<th>Total Tagihan</th>

			        </tr>
			    </thead>
			</table>
		</div>
	</div>

</div>

<?php include "add.php" ?>

<?php include "fileJs.php" ?>
<script type="text/javascript">
	
	let myData= new MyData();
	
	function numberWithCommas(x) {
	    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}	
	

	$(document).ready( function () {

		myData.getData();

		$('#dateFrom').datepicker({

			uiLibrary: 'bootstrap4',
			format: "yyyy-mm-dd",
			autoclose:true
		});

		$('#dateTo').datepicker({

			 uiLibrary: 'bootstrap4',
			 format: "yyyy-mm-dd",
			 autoclose:true
		});


		$("#btnCari").on("click",function(){
			
			$('#table_id').DataTable().ajax.reload();
		});

	    $("#btnAdd").on("click",function(){

	    	$('#modalAdd').modal('show')
	    });

	    $("#updateData").on("click",function(){
	    	var data ={idUpdate:$("#idUpdate").val()};
	    	var url ="<?= site_url()?>transaction/actionUpdate";
	    	myData.actionUpdate(data, url)
	    });

	    $("#btnExcel").on("click",function(){

		    var cari=$("#cari").val();
		    var dateFrom=$("#dateFrom").val();
		    var dateTo=$("#dateTo").val();
		    var status=$("#status").val();

	    	window.location = `<?= site_url()?>transaction/downloadExcel?cari=${cari}&dateFrom=${dateFrom}&dateTo=${dateTo}&status=${status}`;
	    })	   
		
		$("#bayar").on("click", function(){
			myData.actionAdd()
		})

		$("#dataJasa").on("change",function(){
			myData.getHargaJasa({id:$(this).val()})
		})

		$("#dataJasaAntar").on("change",function(){
			myData.getHargaLayanan({
									type:"antar",
									data:{ id:$(this).val()}
								})
		})		

		$("#dataJasaJemput").on("change",function(){
			myData.getHargaLayanan({
									type:"jemput",
									data:{ id:$(this).val()}
								})
		})				

	} );
</script>