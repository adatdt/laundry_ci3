<script type="text/javascript">
	class MyData{

		getData(){

			$.ajax({
				url: "<?= site_url() ?>payment",
				dataType: "json",
				type:"post",
				success:function(data){

					var html =``

					html +=`
							<!-- Modal -->
							<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							    <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
							        <div class="modal-content">
							            <div class="modal-header">
							                <h5 class="modal-title" id="exampleModalLongTitle">Detail Transaksi No. <span id="order_code_title"></span></h5>
							                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							                    <span aria-hidden="true">&times;</span>
							                </button>
							            </div>
							            <div class="modal-body">

							            	<div class="row" >
							            		<div class="col-md-12" id="gridDetail"></div>
							            		<div class="col-md-12" id="totalGrid"></div>
							            		<div class="col-md-12" id="formUpload"></div>
							            	</div>							                

							            </div>

							        </div>
							    </div>
							</div> 
							`

					if(data.code==1)
					{
						var x = data.data;
						for(var i=0; i<x.length; i++)
						{

							html +=` 

									<div class="col-md-12">	
										<div class="card bot-pad" >
										  	<div class="card-body">
										  	<div class='row'>
										  		<div class='col-md-2' >
											    	<h5 class="card-title">No Pesanana</h5>
											    	<p class="card-text">
											    		${x[i].order_code}
											    	</p>
										    	</div>

										    	<div class='col-md-2' >
											    	<h5 class="card-title">Status</h5>
											    	<p class="card-text">
											    		${x[i].status_payment}
											    	</p>
										    	</div>

										    	<div class='col-md-3' >
											    	<h5 class="card-title">Tanggal Checkout</h5>
											    	<p class="card-text">
											    		${x[i].created_on}
											    	</p>
										    	</div>


										    	<div class='col-md-3' >
											    	<h5 class="card-title">Total Barang</h5>
											    	<p class="card-text">
											    		${x[i].total_barang}
											    	</p>
										    	</div>						

										    	<div class='col-md-2' >
											    	<h5 class="card-title">Total Harga</h5>
											    	<p class="card-text">Rp. 
											    		${myData.numberWithCommas(x[i].total_harga)}
											    	</p>
										    	</div>															    								    	

										    	</div>

										    	${x[i].action}
										  	</div>
										</div>
									</div>
							`
						}

					}
					else
					{
						html +=`

							<div class="container p-3 my-3 border" align='center'>
							  	<p>Tidak ada Riwayat Transaksi</p>
							</div>
						`
					}					


					$("#catalogProduct").html(html);

					$(".detail").on("click",function(){
						$(".modal").modal({backdrop: 'static', keyboard: false, show:true})
						$("#order_code_title").html($(this).attr("data-orderCode"))
						myData.detailData($(this).attr("data-orderCode"))
						console.log(data.order_code);

					})					

				}
			});
		}

		detailData(order_code)
		{

			$.ajax({
				url: "<?= site_url() ?>payment/detailData",
				dataType: "json",
				type:"post",
				data:"order_code="+order_code,
				success:function(data){

					// console.log(data);
					var x=data.dataDetail;
					var html=``
					html +=`

						<table class="table table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Gambar</th>
									<th>Nama Kue</th>
									<th>Jumlah</th>
									<th>Harga</th>
									<th>Total Harga</th>
								</tr>
							<thead>`
					var no=1;

					var total_item=0;
					for(var i=0 ; i<x.length; i++)
					{

						html +=`<tbody>
								<tr>
									<td>${no}</td>
									<td><img src="<?= base_url()?>assets/img/${x[i].path}" width="100px" /></td>
									<td>${x[i].name}</td>
									<td>${x[i].total_product}</td>
									<td>${myData.numberWithCommas(x[i].price)}</td>
									<td>${myData.numberWithCommas(x[i].total_amount)}</td>
								</tr>							
							<tbody`
						no++;

						total_item += parseInt(x[i].total_product);
					}

					html +=`</table>`;

					$("#gridDetail").html(html)


					var totalDataCheckout=data.totalDataCheckout 
					var detailPayment=data.detailPayment

					totalDataCheckout.total_item=total_item;
					myData.totalAmount(totalDataCheckout)
					if(totalDataCheckout.status_payment !=2)
					{

						myData.formUpload(totalDataCheckout)
					}
					else
					{
						myData.rincianPembayaran(detailPayment);	
					}

				}
			});

		}


		totalAmount(data)
		{
			// console.log(data)
			var html=``
			var toharPayment=parseInt(data.total_amount)+parseInt(data.kurir_fare);

			html +=` 

					<div class="col-md-12">	
						<div class="card bot-pad" >									  	
						  	<div class="card-body">
						    	<h5 class="card-title">Total Keseluruhan</h5>
						    	<div class='row'>

						    		<div class="col-md-12">
						    			<p>Jasa Kirim : <span id="kurir" data-kurir="" >${data.kurir_name}</span></p>
						    			<p>Harga Ongkir : Rp. <span id="fareKurir" data-fareKurir="" >${myData.numberWithCommas(data.kurir_fare)} </span></p>
						    			<p>Total Qty : ${data.total_item}</p>
						    			<p>Total Harga : Rp. <span id="tohar" data-total="">${myData.numberWithCommas(data.total_amount)}<span></p>
						    			<p>Total Bayar : Rp. <span id="tohar" data-total="">${myData.numberWithCommas(toharPayment)}<span></p>


						    		</div>									    		

						    	</div>
						    	
						  	</div>
						</div>
					</div>
			`					
				
			$("#totalGrid").html(html)		

		}

		formUpload(data)
		{

			var html=``

			html +=` 

					<div class="col-md-12">	
						<div class="card bot-pad" >									  	
						  	<div class="card-body">
						    	<h5 class="card-title">Upload Bukti Pembayaran</h5>

						    	<form action="<?= site_url()?>payment/savePayment" method="post" id="form-submit" enctype="multipart/form-data">
						    	<div class='row'>

						    		<div class="col-md-6">


									 	<div class="form-group">
									    	<label for="bankName">Nama Bank Tujuan</label>
									    	<select class="form-control" id="bankName" name="bankName" >
									    		<option value="">Pilih</option>
									    		<option value="bni">BNI</option>
									    		<option value="mandiri">MANDIRI</option>
									    		<option value="bca">BCA</option>
									    	</select>
									  	</div>

									  	<div class="form-group">
									    	<label for="accountUser">Bank Rekening Anda</label>
									    	<input type="input" class="form-control" id="accountUser" name="accountUser" placeholder="Contoh BNI" >
									  	</div>									  	

									  	<div class="form-group">
									    	<label for="amount">Total Yang dibayar</label>
									    	<input type="input" class="form-control" id="amount" name="amount" placeholder="Total Yang dibayar" onkeypress="return isNumberKey(event)">
									  	</div>




						    		</div>		

						    		<div class="col-md-6">

									  	<div class="form-group">
									    	<label for="noRek">No Transfer Tujuan</label>
									    	<input type="input" class="form-control" id="noRek" name="noRek" placeholder="No Trasfer Tujuan" readonly>
									  	</div>

									  	<div class="form-group">
									    	<label for="noAccountBankUser">No. Rekening Anda </label>
									    	<input type="input" class="form-control" id="noAccountBankUser" name="noAccountBankUser" placeholder="No. Rekening Anda" onkeypress="return isNumberKey(event)">
									  	</div>	

									  	<div class="form-group">
									    	<label for="accountName">Nama Pemilik Rekening Anda</label>
									    	<input type="input" class="form-control" id="accountName" name="accountName" placeholder="Nama Pemilik Rekening Anda" >
									    	<input type="hidden" class="form-control" name="order_code" value="${data.order_code}">
									  	</div>	

									  	<div class="form-group">
									    	<label for="imageFile">Bukti Pembayaran</label>
									    	<input type="file" class="form-control-file" id="imageFile" name="imageFile" >
									  	</div>								  										  	

						    		</div>		

						    		<div class="col-md-12">
						    			<button class="btn btn-primary detail pull-right" id="bayar" >Bayar</button>
						    		</div>						    									    		

						    	</div>
						    	</form>
						  	</div>
						</div>
					</div>
			`					
				
			$("#formUpload").html(html)

			$("#bankName").on("change", function(){

				var getData=myData.getRekening($(this).val());
				$("#noRek").val(getData);
					
			})	

			$("#form-submit").submit(function(e){
			    $('#registration').modal('show');
			    return false;
			});	

			$("#bayar").on("click",function(){

				// var dataForm=$("#form-submit").serialize();
				var url = $("#form-submit").attr("action");
				var sendData=new FormData(document.getElementById("form-submit"))

				myData.savePayment(sendData,url)

			})			

		}

		rincianPembayaran(data)
		{

			var html=``

			html +=` 

					<div class="col-md-12">	
						<div class="card bot-pad" >									  	
						  	<div class="card-body">
						    	<h5 class="card-title">Upload Bukti Pembayaran</h5>

						    	<div class='row'>

						    		<div class="col-md-4">

										<div class="card bot-pad" >									  	
										  	<div class="card-body">
										    	<h5 class="card-title">Kode Pembayaran</h5>
										    	<p>${data.payment_code}</p>
										    	
										  	</div>
										</div>

						    		</div>	

						    		<div class="col-md-4">

										<div class="card bot-pad" >									  	
										  	<div class="card-body">
										    	<h5 class="card-title">Bank Tujuan</h5>
										    	<p>${data.bank_name_destination}</p>
										    	
										  	</div>
										</div>

						    		</div>		

						    		<div class="col-md-4">

										<div class="card bot-pad" >									  	
										  	<div class="card-body">
										    	<h5 class="card-title">Total ditransfer</h5>
										    	<p>Rp. ${myData.numberWithCommas(data.total_payment)}</p>
										    	
										  	</div>
										</div>

						    		</div>		

						    		<div class="col-md-4">

										<div class="card bot-pad" >									  	
										  	<div class="card-body">
										    	<h5 class="card-title">Bukti Pembayaran</h5>
										    	<p>
										    		<img src="<?php base_url()?>${data.path}" width="150px" >
										    	</p>
										    	
										  	</div>
										</div>

						    		</div>								    								    							    			

						    	</div>
						  	</div>
						</div>
					</div>
			`					
				
			$("#formUpload").html(html)

						

		}		

		savePayment(data,url)
		{

			$.ajax({
				url: url,
				dataType: "json",
				type:"post",
				data:data,
				contentType:false,
          		cache:false,
          		processData:false,
				beforeSend :function()
				{					
					$('.modal-content').block({
		                message: '<h4>Processing</h4>'
		                // css: { border: '3px solid #a00' }
		            });
				},          		
				success:function(x){
					if(x.code==1)
					{
						toastr.success(x.message,'Berhasil');
						$('.modal-content').unblock();
						$(".modal").modal("hide");
						$(".modal-backdrop").remove();
						myData.getData();
						
					}
					else
					{
						toastr.error(x.message,'gagal');
						$('.modal-content').unblock();

					}

				}
			});


		}

		getRekening(param)
		{
			if (param=='bni') 
			{
				return '056777000000'
			}
			else if(param=='bca')
			{
				return '096777000000'	
			}
			else if(param=='mandiri')
			{
				return '0786777000000'	
			}
			else
			{
				return ""
			}
		}

		numberWithCommas(x) {
		    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}				


	}


</script>