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
            <form action="<?= site_url()?>service/actionEdit" method="post" id="formDataEdit">
            <div class="modal-body">
                
                
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nama Product<span style="color: red">*</span> </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nameEdit" placeholder="Nama" name="name"  required>
                                <input type="hidden"  id="idEdit" placeholder="Nama" name="idEdit"  required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Harga<span style="color: red">*</span> </label>
                            <div class="col-sm-9">
                                <input type="number" min=0 class="form-control" id="priceEdit" placeholder="Harga" name="price"  required onkeypress="return isNumberKey(event)" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Berat<span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" min=0 class="form-control" id="unitWeightEdit" placeholder="Ukuran Tipe" name="unitWeight"  required onkeypress="return isNumberKey(event)"> 
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Keterangan<span style="color: red">*</span> </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="descriptionEdit" placeholder="Keterangan" name="description"  required>
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
