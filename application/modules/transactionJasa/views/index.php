<style>
	.wajib{
		color:red
	}
</style>
<div class="row" id="catalogProduct">

	<div class="col-md-12 ">
		<button class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter" >Tambah Transaksi</button>
	</div>	
	<div class="col-md-12 ">
		<p><p>
	</div>
	<div class="col-md-12 ">
		<p><hr><p>
	</div>
	<div class="col-md-12 ">	
		<div class="row">		
			
			<div class="col-md-12">
				<h3>Riwayat Transaksi</h3>
			</div>
			<?php $id=1; foreach($transaction as $key=>$value) { ?>
				<div class="col-md-4">	


					<div class="card text-white bg-dark bot-pad" >
						<div class="card-body">
							<h5 class="card-title">Tanggal Transaksi : <?= $value->created_on ?></h5>
							<span class="card-text" style="font-size:13px;">		
								<br>Jenis Jasa : <?= $value->layanan_prodak ?>
								<br>Total Berat : <?= $value->total_weight ?>
								<br>Harga Layanan Jasa : <?= $value->price_product_service ?> 
								<br>Harga Pengambilan Jasa : <?= $value->price_service_pickup ?> (<?= $value->service_pengambilan ?>)
								<br>Harga Pengantaran Jasa : <?= $value->price_service_delivery ?> (<?= $value->service_pengiriman ?>)
								<br>Total Harga : <?= $value->total_amount ?> 
								<br>Status : <?= $value->status_process ?> 	
								<p></p>	
								<p class="pull-right">Kode Transaksi <?= $value->transaction_code ?> </p>						
							</span>
							<p></p>
						</div>
					</div>

					<p></p>

				</div>
			<?php $id++;} ?>
		</div>
	</div>
	

												
	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <form action="<?= site_url()?>transactionJasa/actionAdd" method="post" id="formData">
	            <div class="modal-body">
	                	                
						<div class="row">
							<div class="col-md-6">
								
								<div class="form-group row">
								    <label for="noHp" class="col-sm-4 col-form-label">Jenis Jasa <span class="wajib">*</span></label>
								    <div class="col-sm-8">
								    	<?= form_dropdown("dataJasa",$dataJasa,"",' class="form-control" id="dataJasa" ') ?>
								    </div>
								</div>

								<div class="form-group row">
								    <label for="saldo" class="col-sm-4 col-form-label">Pengantaran</label>
								    <div class="col-sm-8">
										<?= form_dropdown("dataJasaAntar",$dataJasaAntar,"",' class="form-control" id="dataJasaAntar" ') ?>
								    </div>
								</div>

								<div class="form-group row">
								    <label for="saldo" class="col-sm-4 col-form-label">Pengambilan</label>
								    <div class="col-sm-8">
										<?= form_dropdown("dataJasaJemput",$dataJasaJemput,"",' class="form-control" id="dataJasaJemput" ') ?>
								    </div>
								</div>	

								<div class="form-group row" id="tanggalPengambilanHtml"></div>									

								<div class="form-group row">
									<label for="noHp" class="col-sm-4 col-form-label">No. Hp <span class="wajib">*</span></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="noHp" placeholder="No Hp" name="noHp"  required>
								    </div>
								</div>		
								
								<div class="form-group row">
									<label for="noHp" class="col-sm-4 col-form-label">Alamat <span class="wajib">*</span></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="address" placeholder="Alamat" name="address"  required>
								    </div>
								</div>										
								

							</div>	
							<div class="col-md-6">
								
								<div class="form-group row">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="hargaJasa" placeholder="Harga" name="hargaJasa" readonly="" value="0" required>
								    </div>
								</div>

								<div class="form-group row">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="hargaPengantaran" placeholder="Harga" name="hargaPengantaran" readonly="" value="0" required>
									</div>
									
								</div>			

								<div class="form-group row">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="hargaPengambilan" placeholder="Harga" name="hargaPengambilan" readonly="" value="0" required>
								    </div>
								</div>

								<div class="form-group row" id="jamPengambilanHtml" ></div>

								
								<div class="form-group row">
									<label for="email" class="col-sm-4 col-form-label">Total Harga</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="tohar" placeholder="Total Harga" name="tohar" readonly value="0" >
									</div>
								</div>									
								<div class="form-group row">
									<label for="email" class="col-sm-4 col-form-label">Email</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="email" placeholder="Email" name="email" >
								    </div>
								</div>	
								

							</div>										

						</div>
						<div style="color:red "><i>
							Perhatian :<br>
							Harga yang ada di form adalah harga per 1kg, harga akan berubah pada saat penimbangan dan akan di bulatkan oleh admin* 
						</i></div>					
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
	                <button type="button" class="btn btn-success" id="bayar">Kirim</button>
	            </div>
	            </form>
	        </div>
	    </div>
	</div> 	


</div>

<?php include("fileJs.php"); ?>

<script type="text/javascript">
	function isNumberKey(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}

	function numberWithCommas(x) {
	    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}	

	let myData= new MyData();
	$(document).ready(function(){

		// myData.getData();
		$(".detail").on("click", function()
		{
			var id= $(this).attr("data-id");
			var idOperator= $(this).attr("data-idOperator");

			$(`#tabData${id}`).toggle("slow");
			myData.getDetail({idOperator:idOperator, contentId:id});
		});

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

		

	});
</script>