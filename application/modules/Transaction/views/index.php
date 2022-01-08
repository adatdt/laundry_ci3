<div class="row" id="catalogProduct">

	<div class="col-md-6">

		<div class="input-group ">
		  	<div class="input-group-append">
		    	<span class="input-group-text" >No. Transaksi</span>
		  	</div>
		  	<input type="text" class="form-control" placeholder="Nomer Transaksi" id="noTrans" >
		</div>

	</div>

	<div class="col-md-6">
		
		<div class="input-group ">
		  	<div class="input-group-append">
		    	<span class="input-group-text" >Email</span>
		  	</div>
		  	<input type="email" class="form-control" placeholder="Email" id="email"  >
		  	<div class="input-group-append">
		    	<button class="btn btn-success" id="cari" ><i class="fa fa-search"></i> Cari </button>
		  	</div>
		</div>
			
	</div>	

	<div class="col-md-12" id="detail"> <br>	</div>
	<div class="col-md-12" id="formUpload"> <br>	</div>

												
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

		$("#cari").on("click",function(){
			var param={noTrans:$("#noTrans").val(), email:$("#email").val()}
			myData.getData(param);
		})



	});
</script>