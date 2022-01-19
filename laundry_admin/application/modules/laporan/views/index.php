
<div class="row" >
	
	<div class="col-md-11" style="padding-top: 20px"></div>
	<div class="col-md-11 ">

	
		<div class="d-flex flex-row-reverse">

			<div class="p-2 form-inline">
			  	
				<div class="input-group mb-2 mr-sm-2">

				<div class="input-group-prepend">
				    	<span class="input-group-text">Tanggal</span>
				    </div>
				    <input type="text" class="form-control date" id="dateFrom" placeholder="status" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">
				    <div class="input-group-prepend">
				    	<span class="input-group-text">S/d</span>
				    </div>
				    <input type="text" class="form-control date" id="dateTo" placeholder="status" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">

				   	<div class="input-group-prepend">
				    	<button class="btn btn-success" id="btnCari">Cari</button>
				    </div>
				</div>

				<div class="input-group mb-2 mr-sm-2" >
					<div class="input-group-prepend">
						<button class='btn btn-danger  ' title="download PDF" id="downloadPdf" style="display:none" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
					</div>
				</div>

						
					
			</div>
		</div>

		<div class="table-responsive" id="idTable"></div>
	</div>

</div>


<?php include "fileJs.php" ?>
<script type="text/javascript">
	
	let myData= new MyData();


	$(document).ready( function () {

		// myData.getData();

		$("#btnCari").on("click",function(){	
			let data = {
				dateFrom:$("#dateFrom").val(),
				dateTo:$("#dateTo").val(),
			}		
			myData.getData(data);
			
		});

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

        $("#downloadPdf").click(function(event){
        
			
			let paramPdf = "dateTo="+document.getElementById('dateTo').value +
			"&dateFrom="+document.getElementById('dateFrom').value
			

			window.open("<?php echo site_url('laporan/downloadPdf?') ?>"+paramPdf)

		});		


	} );
</script>