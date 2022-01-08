<div class="row" id="catalogProduct"></div>

<?php include("fileJs.php"); ?>

<script type="text/javascript">
	function isNumberKey(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}

	let myData= new MyData();
	$(document).ready(function(){

		myData.getData();

	});
</script>