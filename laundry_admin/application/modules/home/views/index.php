
<div class="row" style="background-color: #e9ecef ">

	<div class="col-md-12">
		<h1>Profile</h1>

	</div>
	

	<div class="col-md-3"></div>
	<div class="col-md-6" id="formData">
		
		<div class="form-group row">
		    <label for="name" class="col-sm-4 col-form-label">Nama<span style="color: red">*</span> :</label>
		    <div class="col-sm-8">
		      <input type="text" class="form-control" id="name" placeholder="Nama" name="name"  required value="<?= $detailUser->name ?>">
		    </div>
		</div>


		<div class="form-group row">
		    <label for="name" class="col-sm-4 col-form-label">Username<span style="color: red">*</span> :</label>
		    <div class="col-sm-8">
		      <input type="text" class="form-control" id="username" placeholder="Username" name="username"  value="<?= $detailUser->username ?>" disabled >
		    </div>
		</div>


		<div class="form-group row">
		    <label for="name" class="col-sm-4 col-form-label">No Hp<span style="color: red">*</span> :</label>
		    <div class="col-sm-8">
		      <input type="text" class="form-control" id="phoneNumber" placeholder="No HP" name="phoneNumber"  required value="<?= $detailUser->no_hp ?>">
		    </div>
		</div>		

		<div class="form-group row">
		    <label for="name" class="col-sm-4 col-form-label">Alamat<span style="color: red">*</span> :</label>
		    <div class="col-sm-8">
		      <input type="text" class="form-control" id="address" placeholder="Alamat" name="address"  required value="<?= $detailUser->address ?>">
		    </div>
		</div>

		<div class="btn-toolbar pull-right" role="toolbar" aria-label="Toolbar with button groups">
			
			<div class="btn-group mr-2" role="group" aria-label="First group">
			  	
				<button type="button" class="btn btn-danger" id="changePassword"> Ganti Password</button>
			</div>
			<div class="btn-group mr-2" role="group" aria-label="First group">
			  	
				<button type="button" class="btn btn-success" id="saveAdd"> Simpan</button> 
			</div>
		</div>

	</div>

	<div class="col-md-12" style="padding: 20px"></div>


</div>


<!-- Modal  edit-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditTitle">Ganti Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url()?>home/changePassword" method="post" id="FormChangePassword">
            <div class="modal-body">
                
                
					<div class="row">
						<div class="col-md-12">
							
							<div class="form-group row">
							    <label for="nameEdit" class="col-sm-3 col-form-label">Masukan Password<span style="color: red">*</span> :</label>
							    <div class="col-sm-9">
							      <input type="password" class="form-control" id="password" placeholder="Password" name="password"  required>
							    </div>
							</div>

						</div>

					</div>
		
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="saveChangePassword"> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div> 		


<?php include "fileJs.php" ?>



<script type="text/javascript">

	let myData =new MyData();
	$(document).ready(()=>{
	    $("#saveAdd").on("click",function(){
	    	var data ={	
	    				name:$("#name").val(),
	    				phoneNumber:$("#phoneNumber").val(),
	    				address:$("#address").val()
	    			};

	    	var url ="<?= site_url()?>home/actionEdit";    	
	    	myData.actionEdit(data, url)
	    });	

	    $("#changePassword").on("click",function(){

	    	$('#modalEdit').modal('show')
	    	// $('.modal').modal('hide')
			// $('.modal-backdrop').remove();
	    });	    


	    $("#saveChangePassword").on("click",function(){
	    	var data =$("#FormChangePassword").serialize();
	    	var url =$("#FormChangePassword").attr("action");
	    	myData.changePassword(data, url)
	    });
	})

</script>
