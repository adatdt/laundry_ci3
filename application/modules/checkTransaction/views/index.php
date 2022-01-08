<style>
	#progressbar {
		margin-bottom: 3vh;
		overflow: hidden;
		color: rgb(252, 103, 49);
		padding-left: 0px;
		margin-top: 3vh
	}

	#progressbar li {
		list-style-type: none;
		font-size: 13px; 
		width: 15%;
		float: left;
		position: relative;
		font-weight: 400;
		color: rgb(160, 159, 159)
	}

	#progressbar .allstep:before {
		content: "";
		color: rgb(252, 103, 49);
		width: 5px;
		height: 5px;
		margin-left: 0px !important
	}


	#progressbar li:before {
		line-height: 29px;
		display: block;
		font-size: 12px;
		background: #ddd;
		border-radius: 50%;
		margin: auto;
		z-index: -1;
		margin-bottom: 1vh
	}

	#progressbar li:after {
		content: '';
		height: 2px;
		background: #ddd;
		position: absolute;
		left: 0%;
		right: 0%;
		margin-bottom: 2vh;
		top: 1px;
		z-index: 1
	}

	.progress-track {
		padding: 0 8%
	}

	#progressbar li:after {
		margin-right: auto
	}

	#progressbar li.active {
		color: black
	}

	#progressbar li.active:before,
	#progressbar li.active:after {
		background: rgb(252, 103, 49)
	}
</style>
<div class="row" id="catalogProduct">

	<div class="col-md-12">

		<div class="input-group ">
		  	<div class="input-group-append">
		    	<span class="input-group-text" >No. Transaksi</span>
		  	</div>
		  	<input type="text" class="form-control" placeholder="Nomer Transaksi" id="noTrans" >
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
			var param={noTrans:$("#noTrans").val()}
			myData.getData(param);
		})



	});
</script>