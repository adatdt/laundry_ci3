
<div class="row" >
	
	<div class="col-md-11" style="padding-top: 20px"></div>
	<div class="col-md-11 ">

		<button class='btn btn-success btn-sm ' id="btnExcel">Excel</button>
		<p></p>
		<p></p>
		<div class="d-flex flex-row-reverse">

			<div class="p-2 form-inline">
			  	

			<!-- 	  <label class="sr-only" for="inlineFormInputName2">Name</label>
				  <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Jane Doe">

				   -->
				<div class="input-group mb-2 mr-sm-2">

				   	<div class="input-group-prepend">
				    	<span class="input-group-text">Tanggal</span>
				    </div>
				    <input type="text" class="form-control date" id="dateFrom" placeholder="status" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">
				    <div class="input-group-prepend">
				    	<span class="input-group-text">S/d</span>
				    </div>
				    <input type="text" class="form-control date" id="dateTo" placeholder="status" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">

				</div>	


				<div class="input-group mb-2 mr-sm-2">

				   	<div class="input-group-prepend">
				    	<span class="input-group-text">Status</span>
				    </div>
				    <select class="form-control" id="status">
				    	<option value="">Pilih</option>
				    	<option value="0">Menunggu Pembayaran</option>
				    	<option value="1">Dibayar</option>
				    	<option value="2">Sukses</option>
				    </select>

				</div>	


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
			            <th>Kode Transaksi</th>
			            <th>Tanggal Teransaksi</th>
			            <th>No Hp</th>
			            <th>Email</th>
			            <th>Status</th>
			            <th>Aksi</th>
			        </tr>
			    </thead>
			</table>
		</div>
	</div>

</div>

<!-- Modal  Update-->
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditTitle"></h5>
            </div>

            <div class="modal-body">
                	                
					<div class="row">
						<div class="col-md-12 text-center">								
							Apakah anda Yakin Ingin Mengubah status Menjadi sukses
							<input type="hidden" name="idUpdate" id="idUpdate">
						</div>

					</div>
		
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="updateData"> Proses</button>
            </div>
            </form>
        </div>
    </div>
</div> 		


<!-- Modal  Detail-->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditTitle"></h5>
            </div>

            <div class="modal-body">
                	                
					<div class="row" id="contentDetail"></div>
		
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
            </form>
        </div>
    </div>
</div> 		



<?php include "fileJs.php" ?>
<script type="text/javascript">
	
	let myData= new MyData();
	
	function numberWithCommas(x) {
	    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}	
	

	$(document).ready( function () {

		myData.getData();

		$('#dateFrom').datepicker({

			uiLibrary: 'bootstrap4',
			format: "yyyy-mm-dd",
			autoclose:true
		});

		$('#dateTo').datepicker({

			 uiLibrary: 'bootstrap4',
			 format: "yyyy-mm-dd",
			 autoclose:true
		});


		$("#btnCari").on("click",function(){
			
			$('#table_id').DataTable().ajax.reload();
		});

	    $("#btnAdd").on("click",function(){

	    	$('#modalAdd').modal('show')
	    	// $('.modal').modal('hide')
			// $('.modal-backdrop').remove();
	    });

	    $("#updateData").on("click",function(){
	    	var data ={idUpdate:$("#idUpdate").val()};
	    	var url ="<?= site_url()?>transaction/actionUpdate";
	    	myData.actionUpdate(data, url)
	    });

	    $("#btnExcel").on("click",function(){

		    var cari=$("#cari").val();
		    var dateFrom=$("#dateFrom").val();
		    var dateTo=$("#dateTo").val();
		    var status=$("#status").val();

	    	window.location = `<?= site_url()?>transaction/downloadExcel?cari=${cari}&dateFrom=${dateFrom}&dateTo=${dateTo}&status=${status}`;
	    })	    	    

	} );
</script>