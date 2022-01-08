
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
			            <th>Nama</th>
			            <th>Username</th>
			            <th>alamat</th>
			            <th>No Hp</th>
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
	            <form action="<?= site_url()?>user/actionAdd" method="post" id="formData">
	            <div class="modal-body">
	                
	                
						<div class="row">
							<div class="col-md-6">
								
								<div class="form-group row">
								    <label for="name" class="col-sm-4 col-form-label">Nama<span style="color: red">*</span> :</label>
								    <div class="col-sm-8">
								      <input type="text" class="form-control" id="name" placeholder="Nama" name="name"  required>
								    </div>
								</div>

							</div>

							<div class="col-md-6">
								
								<div class="form-group row">
								    <label for="name" class="col-sm-4 col-form-label">Username<span style="color: red">*</span> :</label>
								    <div class="col-sm-8">
								      <input type="text" class="form-control" id="username" placeholder="Username" name="username"  required>
								    </div>
								</div>

							</div>
			

							<div class="col-md-6">
								
								<div class="form-group row">
								    <label for="name" class="col-sm-4 col-form-label">Password<span style="color: red">*</span> :</label>
								    <div class="col-sm-8">
								      <input type="password" class="form-control" id="password" placeholder="Password" name="password"  required>
								    </div>
								</div>

							</div>

							<div class="col-md-6">
								
								<div class="form-group row">
								    <label for="name" class="col-sm-4 col-form-label">No Hp<span style="color: red">*</span> :</label>
								    <div class="col-sm-8">
								      <input type="text" class="form-control" id="phoneNumber" placeholder="No HP" name="phoneNumber"  required>
								    </div>
								</div>

							</div>							

							<div class="col-md-6">
								
								<div class="form-group row">
								    <label for="name" class="col-sm-4 col-form-label">Alamat<span style="color: red">*</span> :</label>
								    <div class="col-sm-8">
								      <input type="text" class="form-control" id="address" placeholder="Alamat" name="address"  required>
								    </div>
								</div>

							</div>														

							<div class="col-md-6">
								
								<div class="form-group row">
								    <label for="name" class="col-sm-4 col-form-label">group<span style="color: red">*</span> :</label>
								    <div class="col-sm-8">
								      <select  class="form-control" id="idGroup" name="idGroup"  required>
								      		<option value="">Pilih</option>
								      		<option value="1">Admin</option>
								      </select>
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
	            <form action="<?= site_url()?>user/actionEdit" method="post" id="formDataEdit">
	            <div class="modal-body">
	                
	                
					<div class="row">
						<div class="col-md-6">
							
							<div class="form-group row">
							    <label for="name" class="col-sm-4 col-form-label">Nama<span style="color: red">*</span> :</label>
							    <div class="col-sm-8">
							      <input type="text" class="form-control" id="nameEdit" placeholder="Nama" name="nameEdit"  required>
							      <input type="hidden" id="idEdit" name="idEdit"  required>
							    </div>
							</div>

						</div>

						<div class="col-md-6">
							
							<div class="form-group row">
							    <label for="name" class="col-sm-4 col-form-label">Username<span style="color: red">*</span> :</label>
							    <div class="col-sm-8">
							      <input type="text" class="form-control" id="usernameEdit" placeholder="Username" name="username"  required readonly>
							    </div>
							</div>

						</div>
		

						<div class="col-md-6">
							
							<div class="form-group row">
							    <label for="name" class="col-sm-4 col-form-label">No Hp<span style="color: red">*</span> :</label>
							    <div class="col-sm-8">
							      <input type="text" class="form-control" id="phoneNumberEdit" placeholder="No HP" name="phoneNumberEdit"  required>
							    </div>
							</div>

						</div>							

						<div class="col-md-6">
							
							<div class="form-group row">
							    <label for="name" class="col-sm-4 col-form-label">Alamat<span style="color: red">*</span> :</label>
							    <div class="col-sm-8">
							      <input type="text" class="form-control" id="addressEdit" placeholder="Alamat" name="addressEdit"  required>
							    </div>
							</div>

						</div>														

						<div class="col-md-6">
							
							<div class="form-group row">
							    <label for="name" class="col-sm-4 col-form-label">group<span style="color: red">*</span> :</label>
							    <div class="col-sm-8">
							      <select  class="form-control" id="idGroupEdit" name="idGroupEdit"  required>
							      		<option value="">Pilih</option>
							      		<option value="1">Admin</option>
							      </select>
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
	    	var url ="<?= site_url()?>user/actionDelete";
	    	myData.actionDelete(data, url)
	    });	    	    

	} );
</script>