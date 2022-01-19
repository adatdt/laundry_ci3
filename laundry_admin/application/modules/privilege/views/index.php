
<style>
	.switch {
		position: relative;
		display: inline-block;
		width: 60px;
		height: 34px;
		}

		.switch input { 
		opacity: 0;
		width: 0;
		height: 0;
		}

		.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ccc;
		-webkit-transition: .4s;
		transition: .4s;
		}

		.slider:before {
		position: absolute;
		content: "";
		height: 26px;
		width: 26px;
		left: 4px;
		bottom: 4px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
		}

		input:checked + .slider {
		background-color: #2196F3;
		}

		input:focus + .slider {
		box-shadow: 0 0 1px #2196F3;
		}

		input:checked + .slider:before {
		-webkit-transform: translateX(26px);
		-ms-transform: translateX(26px);
		transform: translateX(26px);
		}

		/* Rounded sliders */
		.slider.round {
		border-radius: 34px;
		}

		.slider.round:before {
		border-radius: 50%;
		}
</style>
<div class="row" >
	
	<div class="col-md-11" style="padding-top: 20px"></div>
	<div class="col-md-11 ">

		<p></p>
		<p></p>
		<div class="d-flex flex-row-reverse">

			<div class="p-2 form-inline">
			  	

			<!-- 	  <label class="sr-only" for="inlineFormInputName2">Name</label>
				  <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Jane Doe">

				   -->

				<label class="sr-only" for="cari">Cari</label>
				<div class="input-group mb-2 mr-sm-2">

					<div class="input-group mb-2">
						<div class="input-group-prepend">
						<div class="input-group-text">Group</div>
						</div>
						<?= form_dropdown("group",$group,"",'class="form-control" id="group" ') ?>
					</div>					
					
				</div>
				

					
			</div>
		</div>

		<div class="table-responsive" id="dataPrivilege">
			 <table id="table_id" class="table table-striped " align="center">
			    <thead>
			        <tr>
			            <th>Nama Product</th>
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

		$("#group").on("change",function(){
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