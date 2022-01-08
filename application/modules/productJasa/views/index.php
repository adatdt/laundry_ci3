<div class="row" id="catalogProduct">

	<?php $id=1; foreach($category as $key=>$value) { ?>
		<div class="col-md-6">	

			<div class="card text-white bg-dark bot-pad" >
			  	<div class="card-body">
			    	<h5 class="card-title"><?= $value->name ?></h5>
			    	<p class="card-text">
						<p><?= $value->description ?> </p>
						<p class="pull-right">Rp. <?= $value->price ?> <?= $value->unit_weight ?>Kg </span></p>
						
					</p>
			    	<p></p>
			  	</div>
			</div>

			<p></p>

		</div>
	<?php $id++;} ?>
	

												
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
	            <form action="<?= site_url()?>productPulsa/actionAdd" method="post" id="formData">
	            <div class="modal-body">
	                
	                
						<div class="row">
							<div class="col-md-6">
								
								<div class="form-group row">
								    <label for="noHp" class="col-sm-3 col-form-label">No Hp :</label>
								    <div class="col-sm-9">
								      <input type="text" class="form-control" id="noHp" placeholder="08XXX" name="noHp"  required>
								      <input type="hidden" id="productId" name="productId"  required >
								    </div>
								</div>

								<div class="form-group row">
								    <label for="saldo" class="col-sm-3 col-form-label">Saldo :</label>
								    <div class="col-sm-9">
								      <input type="text" class="form-control" id="saldo" placeholder="Saldo" name="saldo" readonly="" required>
								    </div>
								</div>

							</div>

							<div class="col-md-6">
								
								<div class="form-group row">
								    <label for="price" class="col-sm-3 col-form-label">Tarif :</label>
								    <div class="col-sm-9">
								      <input type="text" class="form-control" id="price" placeholder="Tarif" name="price" readonly="" required>
								    </div>
								</div>

								<div class="form-group row">
								    <label for="email" class="col-sm-3 col-form-label">Email :</label>
								    <div class="col-sm-9">
								      <input type="text" class="form-control" id="email" placeholder="Email" name="email"  required>
								    </div>
								</div>							

							</div>						

						</div>
						<div style="color:red "><i>Cara dan Konfirmasi pembayaran akan di kirim melalui email anda* </i></div>					
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
	                <button type="button" class="btn btn-success" id="bayar"> bayar</button>
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

	});
</script>