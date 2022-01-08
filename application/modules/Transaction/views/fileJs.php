<script type="text/javascript">
	class MyData{

		getData(data){
					
			$.ajax({
				url: "<?= site_url() ?>transaction",
				dataType: "json",
				data:data,
				type:"post",
				beforeSend : function()
				{
					$(".getCard").empty()
				},
				success:function(x){

					console.log(x)
					var html =``
					if(x.code==1)
					{
						// toastr.success(x.message,'Berhasil');
						// $('.modal').modal('hide')
						// $('.modal-backdrop').remove();
						html +=myData.getCardDetail(x.data);

						if(x.data.status==0)
						{
							myData.formUpload(x.data);
						}


					}
					else
					{
						toastr.error(x.message,'gagal');
					}

					$('#exampleModalCenter').unblock();
					$(html).insertAfter($("#detail"));



				}
			});				
		}

		getCardDetail(data)
		{

			var html=`

					<div class="col-md-4 getCard">	
						<div class="card bot-pad" >

						  	<div class="card-body">
						    	<h5 class="card-title">NO Transaksi</h5>
						    	<p class="card-text">
						    		 ${data.transaction_code}
						    	</p>
						  	</div>
						</div>
					</div>

					<div class="col-md-4 getCard" >	
						<div class="card bot-pad" >

						  	<div class="card-body">
						    	<h5 class="card-title">Tanggal Transaksi</h5>
						    	<p class="card-text">
						    		 ${data.created_on}
						    	</p>
						  	</div>
						</div>
					</div>

					<div class="col-md-4 getCard" >	
						<div class="card bot-pad" >

						  	<div class="card-body">
						    	<h5 class="card-title">Email Pemesan</h5>
						    	<p class="card-text">
						    		 ${data.email}
						    	</p>
						  	</div>
						</div>
					</div>

					<div class="col-md-4 getCard" >	
						<div class="card bot-pad" >

						  	<div class="card-body">
						    	<h5 class="card-title">Nama Pulsa/ Paket</h5>
						    	<p class="card-text">
						    		 ${data.product_name}
						    	</p>
						  	</div>
						</div>
					</div>

					<div class="col-md-4 getCard">	
						<div class="card bot-pad" >

						  	<div class="card-body">
						    	<h5 class="card-title">Harga </h5>
						    	<p class="card-text">
						    		 ${numberWithCommas(data.price)}
						    	</p>
						  	</div>
						</div>
					</div>					

					<div class="col-md-4 getCard">	
						<div class="card bot-pad" >

						  	<div class="card-body">
						    	<h5 class="card-title">Status </h5>
						    	<p class="card-text" id="statusData">
						    		 ${data.status_name}
						    	</p>
						  	</div>
						</div>
					</div>					


			`

			

					
			return html
		}

		formUpload(data){

			var html =``
			html +=`



					<div class="card bot-pad" >

					  	<div class="card-body">
					    	<h5 class="card-title">Upload File Pembayaran </h5>
					    	<p class="card-text">
					    		<form id="form-submit" action="<?= site_url()?>transaction/actionUpload" method="post" enctype="multipart/form-data">
					    			<div class="row">
					    				<div class="col-md-6">
					    					<div class="form-group row">
											    <label for="UploadFile" class="col-sm-4 col-form-label">File :</label>
											    <div class="col-sm-8"> 
											      <input type="file" class="form-control-file" id="UploadFile" placeholder="Masukan File" name="UploadFile">
											    </div>
											</div>

					    					<div class="form-group row">
											    <label for="bankTransfer" class="col-sm-4 col-form-label">Bank Transfer :</label>
											    <div class="col-sm-8"> 
											      <input type="text" class="form-control" id="bankTransfer" placeholder="Nama Bank Transfer" name="bankTransfer">
											      <input type="hidden" id="transactionCode" name="transactionCode" value="${data.transaction_code}">
											    </div>
											</div>

					    					<div class="form-group row">
											    <label for="accountNumber" class="col-sm-4 col-form-label">No Rek :</label>
											    <div class="col-sm-8"> 
											      <input type="text" class="form-control" id="accountNumber" placeholder="No Rekening" name="accountNumber">
											    </div>
											</div>																						

					    					<div class="form-group row">
											    <label for="accounNumberDestination" class="col-sm-4 col-form-label">No Rek Tujuan :</label>
											    <div class="col-sm-8"> 
											      <input type="text" class="form-control" id="accounNumberDestination" placeholder="Nama Bank Tujuan" name="accounNumberDestination" readonly>
											    </div>
											</div>

		


					    				</div>

					    				<div class="col-md-6">
					    					<div class="form-group row">
											    <label for="nominal" class="col-sm-4 col-form-label">Masukan Nominal :</label>
											    <div class="col-sm-8">
											      <input type="text" class="form-control" id="nominal" placeholder="Masukan Angka Transfer" name="nominal" onkeypress='return isNumberKey(event)'>
											    </div>
											</div>

											<div class="form-group row">
											    <label for="accountName" class="col-sm-4 col-form-label">Atas Nama :</label>
											    <div class="col-sm-8">
											      <input type="text" class="form-control" id="accountName" placeholder="Masukan File" name="accountName">
											    </div>
											</div>



					    					<div class="form-group row">
											    <label for="bankDestination" class="col-sm-4 col-form-label">Bank Tujuan :</label>
											    <div class="col-sm-8"> 
											      <select class="form-control" id="bankDestination"  name="bankDestination">
											      		<option value="">Pilih</option>
											      		<option value="BCA">BCA</option>
											      		<option value="BNI">BNI</option>
											      		<option value="Mandiri">Mandiri</option>
											      		<option value="OVO">OVO</option>
											      		<option value="Link Aja">Link Aja</option> 
											      </select>
											    </div>
											</div>																												


					    				</div>

					    				<div class="col-md-12">
					    					<div class="btn btn-success pull-right" id="saveData"> Simpan </div>
					    				</div>

					    			</div>
					    		</form>
					    	</p>
					  	</div>
					</div>


			`;
				

			$("#formUpload").html(html);
			$("#saveData").on("click", function(){

				var url = $("#form-submit").attr("action");
				var sendData=new FormData(document.getElementById("form-submit"))
				myData.actionUpload(sendData,url)

			})

			$("#bankDestination").on("change",function(){
				var getData=$("#bankDestination").val();
				var accountNumber ="";

				if(getData=='BCA')
				{
					accountNumber +="086778888";
				}
				else if(getData=='BNI')
				{
					accountNumber +="082678888";	
				}
				else if(getData=='Mandiri')
				{
					accountNumber +="089877888";		
				}
				else if(getData=='OVO')
				{
					accountNumber +="0899009888";	
				}
				else if(getData=='Link Aja')
				{
					accountNumber +="0899009888";		
				}
				else
				{
					accountNumber ="";
				}

				$("#accounNumberDestination").val(accountNumber);


			})
		}

		actionUpload(data,url)
		{
			$.ajax({
				url: url,
				dataType: "json",
				data:data,
				type:"post",
				contentType:false,
          		cache:false,
          		processData:false,
				beforeSend : function()
				{
					$('#formUpload').block({
		                message: '<h4>Processing</h4>'
		                // css: { border: '3px solid #a00' }
		            });
				},
				success:function(x){

					console.log(x)
					if(x.code==1)
					{
						toastr.success(x.message,'Berhasil');
						// $('.modal').modal('hide')
						// $('.modal-backdrop').remove();
						$("#statusData").html("<span class='badge badge-warning'> Dibayar </span>");
						$('#formUpload').hide();
					}
					else
					{
						toastr.error(x.message,'gagal');
					}

					$('#formUpload').unblock();
				}
			});		
		}

		numberWithCommas(x) {
		    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}				

	}
</script>