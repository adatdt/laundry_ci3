<style>
    .wajib{
        color:red
    }
</style>
<!-- Modal -->
	<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <form action="<?= site_url()?>transactionJasa/actionAdd" method="post" id="formData">
	            <div class="modal-body">
	                	                
						<div class="row">
							<div class="col-md-6">
								
								<div class="form-group row">
								    <label for="noHp" class="col-sm-4 col-form-label">Jenis Jasa <span class="wajib">*</span></label>
								    <div class="col-sm-8">
								    	<?= form_dropdown("dataJasa",$dataJasa,"",' class="form-control" id="dataJasa" ') ?>
								    </div>
								</div>

								<div class="form-group row">
								    <label for="saldo" class="col-sm-4 col-form-label">Pengantaran</label>
								    <div class="col-sm-8">
										<?= form_dropdown("dataJasaAntar",$dataJasaAntar,"",' class="form-control" id="dataJasaAntar" ') ?>
								    </div>
								</div>

								<div class="form-group row">
								    <label for="saldo" class="col-sm-4 col-form-label">Pengambilan</label>
								    <div class="col-sm-8">
										<?= form_dropdown("dataJasaJemput",$dataJasaJemput,"",' class="form-control" id="dataJasaJemput" ') ?>
								    </div>
								</div>	

								<div class="form-group row" id="tanggalPengambilanHtml"></div>									

								<div class="form-group row">
									<label for="noHp" class="col-sm-4 col-form-label">No. Hp <span class="wajib">*</span></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="noHp" placeholder="No Hp" name="noHp"  required>
								    </div>
								</div>		
								
								<div class="form-group row">
									<label for="noHp" class="col-sm-4 col-form-label">Alamat <span class="wajib">*</span></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="address" placeholder="Alamat" name="address"  required>
								    </div>
								</div>

								<div class="form-group row">
									<label for="name" class="col-sm-4 col-form-label">Nama <span class="wajib">*</span></label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="name" placeholder="Nama" name="name"  required>
								    </div>
								</div>                                										
								

							</div>	
							<div class="col-md-6">
								
								<div class="form-group row">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="hargaJasa" placeholder="Harga" name="hargaJasa" readonly="" value="0" required>
								    </div>
								</div>

								<div class="form-group row">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="hargaPengantaran" placeholder="Harga" name="hargaPengantaran" readonly="" value="0" required>
									</div>
									
								</div>			

								<div class="form-group row">
									<div class="col-sm-12">
										<input type="text" class="form-control" id="hargaPengambilan" placeholder="Harga" name="hargaPengambilan" readonly="" value="0" required>
								    </div>
								</div>

								<div class="form-group row" id="jamPengambilanHtml" ></div>

								
								<div class="form-group row">
									<label for="email" class="col-sm-4 col-form-label">Total Harga</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="tohar" placeholder="Total Harga" name="tohar" readonly value="0" >
									</div>
								</div>									
								<div class="form-group row">
									<label for="email" class="col-sm-4 col-form-label">Email</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="email" placeholder="Email" name="email" >
								    </div>
								</div>	
								

							</div>										

						</div>
						<div style="color:red "><i>
							Perhatian :<br>
							Harga yang ada di form adalah harga per 1kg, harga akan berubah pada saat penimbangan dan akan di bulatkan oleh admin* 
						</i></div>					
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
	                <button type="button" class="btn btn-success" id="bayar">Kirim</button>
	            </div>
	            </form>
	        </div>
	    </div>
	</div> 	

