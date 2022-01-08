
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
			            <th>Kategory</th>
			            <th>Operator</th>
			            <th>Saldo</th>
			            <th>Harga</th>
			            <th>Ukuran Tipe</th>
			            <th>Keterangan</th>
			            <th>Aksi</th>
			        </tr>
			    </thead>
			</table>
		</div>
	</div>

</div>


	<!-- Modal  add-->
	<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="modalAddTitle">Tambah <?= $title ?></h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <form action="<?= site_url()?>product/actionAdd" method="post" id="formData">
	            <div class="modal-body">
	                
	                
						<div class="row">
							<div class="col-md-12">
								
								<div class="form-group row">
								    <label for="name" class="col-sm-3 col-form-label">Nama Product<span style="color: red">*</span> :</label>
								    <div class="col-sm-9">
								      <input type="text" class="form-control" id="name" placeholder="Nama" name="name"  required>
								    </div>
								</div>

								<div class="form-group row">
								    <label for="name" class="col-sm-3 col-form-label">Kategori<span style="color: red">*</span> :</label>
								    <div class="col-sm-9">
								      <?= form_dropdown("category",$category,"",' class="form-control" id="category"   required ') ?>
								    </div>
								</div>

								<div class="form-group row">
								    <label for="name" class="col-sm-3 col-form-label">Operator<span style="color: red">*</span> :</label>
								    <div class="col-sm-9">
								      <?= form_dropdown("operator",$operator,"",' class="form-control" id="operator"  required ') ?>
								    </div>
								</div>		

								<div class="form-group row">
								    <label for="name" class="col-sm-3 col-form-label">Saldo<span style="color: red">*</span> :</label>
								    <div class="col-sm-9">
								      <input type="text" class="form-control" id="saldo" placeholder="Saldo" name="saldo"  required onkeypress="return isNumberKey(event)" >
								    </div>
								</div>

								<div class="form-group row">
								    <label for="name" class="col-sm-3 col-form-label">Harga<span style="color: red">*</span> :</label>
								    <div class="col-sm-9">
								      <input type="text" class="form-control" id="price" placeholder="Harga" name="price"  required onkeypress="return isNumberKey(event)" >
								    </div>
								</div>

								<div class="form-group row">
								    <label for="name" class="col-sm-3 col-form-label">Ukuran Type :</label>
								    <div class="col-sm-9">
								      <input type="text" class="form-control" id="type" placeholder="Ukuran Tipe" name="type"  required>
								    </div>
								</div>

								<div class="form-group row">
								    <label for="name" class="col-sm-3 col-form-label">Keterangan<span style="color: red">*</span> :</label>
								    <div class="col-sm-9">
								      <input type="text" class="form-control" id="description" placeholder="Keterangan" name="description"  required>
								    </div>
								</div>																			


							</div>

						</div>
			
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
	                <button type="button" class="btn btn-success" id="saveAdd"> Simpan</button>
	            </div>
	            </form>
	        </div>
	    </div>
	</div> 	


	<!-- Modal  edit-->
	<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="modalEditTitle">Edit <?= $title ?></h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <form action="<?= site_url()?>product/actionEdit" method="post" id="formDataEdit">
	            <div class="modal-body">
	                
	                
						<div class="row">
							<div class="col-md-12">
								
								<div class="form-group row">
								    <label for="name" class="col-sm-3 col-form-label">Nama Product<span style="color: red">*</span> :</label>
								    <div class="col-sm-9">
								      <input type="text" class="form-control" id="nameEdit" placeholder="Nama" name="nameEdit"  required >
								      <input type="hidden"  id="idEdit" name="idEdit"  required >
								    </div>
								</div>

								<div class="form-group row">
								    <label for="name" class="col-sm-3 col-form-label">Kategori<span style="color: red">*</span> :</label>
								    <div class="col-sm-9">
								      <?= form_dropdown("categoryEdit",$category,"",' class="form-control" id="categoryEdit"   required ') ?>
								    </div>
								</div>

								<div class="form-group row">
								    <label for="name" class="col-sm-3 col-form-label">Operator<span style="color: red">*</span> :</label>
								    <div class="col-sm-9">
								      <?= form_dropdown("operatorEdit",$operator,"",' class="form-control" id="operatorEdit"  required ') ?>
								    </div>
								</div>		

								<div class="form-group row">
								    <label for="name" class="col-sm-3 col-form-label">Saldo<span style="color: red">*</span> :</label>
								    <div class="col-sm-9">
								      <input type="text" class="form-control" id="saldoEdit" placeholder="Saldo" name="saldoEdit"  required onkeypress="return isNumberKey(event)" >
								    </div>
								</div>

								<div class="form-group row">
								    <label for="name" class="col-sm-3 col-form-label">Harga<span style="color: red">*</span> :</label>
								    <div class="col-sm-9">
								      <input type="text" class="form-control" id="priceEdit" placeholder="Harga" name="priceEdit"  required onkeypress="return isNumberKey(event)" >
								    </div>
								</div>

								<div class="form-group row">
								    <label for="name" class="col-sm-3 col-form-label">Ukuran Type :</label>
								    <div class="col-sm-9">
								      <input type="text" class="form-control" id="typeEdit" placeholder="Ukuran Tipe" name="typeEdit"  required>
								    </div>
								</div>

								<div class="form-group row">
								    <label for="name" class="col-sm-3 col-form-label">Keterangan<span style="color: red">*</span> :</label>
								    <div class="col-sm-9">
								      <input type="text" class="form-control" id="descriptionEdit" placeholder="Keterangan" name="descriptionEdit"  required>
								    </div>
								</div>																			


							</div>

						</div>
			
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
	                <button type="button" class="btn btn-success" id="saveEdit"> Simpan</button>
	            </div>
	            </form>
	        </div>
	    </div>
	</div> 		



	<!-- Modal  delete-->
	<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="modalEditTitle"></h5>
	            </div>

	            <div class="modal-body">
	                	                
						<div class="row">
							<div class="col-md-12 text-center">								
								Apakah anda Yakin ingin Menghapus data ini
								<input type="hidden" name="idDelete" id="idDelete">
							</div>

						</div>
			
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
	                <button type="button" class="btn btn-success" id="delete"> Hapus</button>
	            </div>
	            </form>
	        </div>
	    </div>
	</div> 		


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
	    	var data ={idDelete:$("#idDelete").val()};
	    	var url ="<?= site_url()?>product/actionDelete";
	    	myData.actionDelete(data, url)
	    });	    	    

	} );
</script>