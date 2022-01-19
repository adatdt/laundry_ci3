
<div class="row" >
	
	<div class="col-md-11" style="padding-top: 20px"></div>
	<div class="col-md-11 ">

		<button class='btn btn-success btn-sm ' id="btnAdd">Tambah</button>
		<p></p>
		<p></p>
		<div class="d-flex flex-row-reverse">

			<div class="p-2 form-inline">
			  	

			<!-- 	  <label class="sr-only" for="inlineFormInputName2">Name</label>
				  <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Jane Doe">

				   -->

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
			            <th>Nama Product</th>
						<th>Link</th>
						<th>Urutan</th>
			            <th>Status</th>
			            <th>Aksi</th>
			        </tr>
			    </thead>
			</table>
		</div>
	</div>

</div>

<?php include "add.php" ?>
<?php include "edit.php" ?>
<?php include "delete.php" ?>
<?php include "fileJs.php" ?>

<script type="text/javascript">


	function isNumberKey(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}

	let myData= new MyData();


	$(document).ready( function () {

		myData.getData();

		$("#btnCari").on("click",function(){
			
			$('#table_id').DataTable().ajax.reload();
		});

	    $("#btnAdd").on("click",function(){

	    	$('#modalAdd').modal('show')
	    	// $('.modal').modal('hide')
			// $('.modal-backdrop').remove();
	    });

	    $("#saveAdd").on("click",function(){
	    	var data =$("#formData").serialize();
	    	var url =$("#formData").attr("action");
	    	myData.actionAdd(data, url)
	    });

	    $("#saveEdit").on("click",function(){
	    	var data =$("#formDataEdit").serialize();
	    	var url =$("#formDataEdit").attr("action");
	    	myData.actionEdit(data, url)
	    });

	    $("#delete").on("click",function(){
	    	var data ={
						idDelate:$("#idDelete").val(),
						statusDelate:$("#statusDelate").val()
					};	    	
	    	myData.actionDelete(data)
	    });	    	    

	} );
</script>