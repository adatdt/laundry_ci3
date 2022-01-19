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
                            <label for="name" class="col-sm-3 col-form-label">Nama Product<span style="color: red">*</span> </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" placeholder="Nama" name="name"  required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Harga<span style="color: red">*</span> </label>
                            <div class="col-sm-9">
                                <input type="number" min=0 class="form-control" id="price" placeholder="Harga" name="price"  required onkeypress="return isNumberKey(event)" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Berat<span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" min=0 class="form-control" id="unitWeight" placeholder="Ukuran Tipe" name="unitWeight"  required onkeypress="return isNumberKey(event)"> 
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Keterangan<span style="color: red">*</span> </label>
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
