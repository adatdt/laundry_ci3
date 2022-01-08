<script type="text/javascript">
	class MyData{

		getData(){

			$.ajax({
				url: "<?= site_url() ?>order",
				dataType: "json",
				type:"post",
				success:function(x){
					var html =``
					if(x.code==1)
					{

						let getData=x.data
						var totalHarga=0;
						var totalQty=0;
						for(var i=0; i<getData.length; i++)
						{

							html +=` 

									<div class="col-md-12">	
										<div class="card bot-pad" >									  	
										  	<div class="card-body">
										    	<h5 class="card-title">${getData[i].name}</h5>
										    	<div class='row'>

										    		<div class="col-md-8">
										    			<img  src="<?=base_url()?>assets/img/${getData[i].path}" width='200px'>
										    		</div>

										    		<div class="col-md-4">
										    			<p>Harga : Rp. <span id='harga${i}'>${myData.numberWithCommas(getData[i].price)}</span></p>
										    			<p>Jumlah Qty : <span id='jumlahQty${i}'>${getData[i].total_product}</span></p>
										    			<p>Subtotal Harga : Rp. <spanid='subtotal${i}'>${myData.numberWithCommas(getData[i].total_amount)}</span></p>
										    			

												      	
												      	<div class="input-group mb-2">
													        <div class="input-group-prepend">
													          	<button class="btn btn-danger btn-update" data-id='${i}' data-name='min'> - </button>
													        </div>

													        <div class="col-xs-2">        
														        <input type="text" class="form-control " id="updateChart${i}"  value='${getData[i].total_product}'  onkeypress="return isNumberKey(event)" >
													    	</div>

													        <div class="input-group-prepend">
													          	<button class="btn btn-danger btn-update" data-id='${i}' data-name='plus'>+</button>
													        </div>

												      	</div>
												      	<button class="btn btn-primary addChart" data-idProd='${getData[i].id}' data-orderCode='${getData[i].order_code}' data-id='${i}'>Update</button>

												      	<button class="btn btn-danger deleteChart" data-idProd='${getData[i].id}' data-orderCode='${getData[i].order_code}' data-prodName='${getData[i].name}' >Hapus</button>
												    


										    		</div>									    		

										    	</div>
										    	
										  	</div>
										</div>
									</div>
							`

							totalQty += parseInt(getData[i].total_product);
							totalHarga += parseInt(getData[i].total_amount);
						}								      	
											    

						html +=` 

								<div class="col-md-12">	
									<div class="card bot-pad" >									  	
									  	<div class="card-body">
									    	<h5 class="card-title">Total Keseluruhan</h5>
									    	<div class='row'>

									    		<div class="col-md-12">

									    			<p>
									    				<div class="form-group mb-2">
													    	<label for="exampleFormControlSelect1">Kurir</label>
													    	<?= form_dropdown("kurir",$kurir,""," class='form-control' id='kurir' ") ?>
													  	</div>
													 </p>
									    			<p>Harga Ongkir : <span id="fareKurir" data-fareKurir="" >Rp. - </span></p>
									    			<p>Total Qty : ${totalQty}</p>
									    			<p>Total Harga : Rp. <span id="tohar" data-total="${totalHarga}">${myData.numberWithCommas(totalHarga)}<span></p>


													<!-- Button trigger modal -->
													<button type="button" class="btn btn-primary pull-right" id="lanjutPembayaran" data-target="#exampleModalCenter" data-backdrop="static" data-keyboard="false">
													      Lanjut Pembayaran
													</button>


													<!-- Modal -->
													<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
													    <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
													        <div class="modal-content">
													            <div class="modal-header">
													                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
													                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
													                    <span aria-hidden="true">&times;</span>
													                </button>
													            </div>
													            <div class="modal-body">
													                
																	<div class="row">
																		<div class="col-4">
																		    <div class="list-group" id="list-tab" role="tablist">
																		      	<a class="list-group-item list-group-item-action active" id="list-bni-list" data-toggle="list" href="#list-bni" role="tab" aria-controls="home">
																		      		<img src="<?= base_url()?>assets/img/bni.png" / width='100px' height='50px'> 
																		      	</a>
																		      	<a class="list-group-item list-group-item-action" id="list-mandiri-list" data-toggle="list" href="#list-mandiri" role="tab" aria-controls="profile">

																					<img src="<?= base_url()?>assets/img/mandiri.jpg" / width='100px' height='50px'>
																		      	</a>

																		      	<a class="list-group-item list-group-item-action" id="list-bca-list" data-toggle="list" href="#list-bca" role="tab" aria-controls="messages">
																					<img src="<?= base_url()?>assets/img/bca.jpg" / width='100px' height='50px'>
																		      	</a>

																		    </div>
																		</div>
																		<div class="col-8">
																		    <div class="tab-content" id="nav-tabContent">
																		      	<div class="tab-pane fade show active" id="list-bni" role="tabpanel" aria-labelledby="list-bni-list">
																		      		Anda bisa melakukan Pembayaran melalui bank dengan No.
																		      		Rekening BNI : <b>056777000000</b>

																		      	</div>
																		      	<div class="tab-pane fade" id="list-mandiri" role="tabpanel" aria-labelledby="list-mandiri-list">
																		      			Anda bisa melakukan Pembayaran melalui bank dengan No.Rekening Mandiri : <b>0786777000000</b>
																		      	</div>
																		      	<div class="tab-pane fade" id="list-bca" role="tabpanel" aria-labelledby="list-bca-list">
																		      			Anda bisa melakukan Pembayaran melalui bank dengan No.Rekening BCA : <b>096777000000</b>

																		      	</div>

																		    </div>
																		 </div>
																	</div>


													            </div>
													            <div class="modal-footer">
													                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
													                <button type="button" class="btn btn-success" id="checkout" data-orderCode='${getData[0].order_code}'> Checkout</button>
													            </div>
													        </div>
													    </div>
													</div>										      	
											    

									    		</div>									    		

									    	</div>
									    	
									  	</div>
									</div>
								</div>
						`					
						
					}
					else
					{
						html +=`

							<div class="container p-3 my-3 border" align="center">
							  	<p>Tidak ada keranjang belanja.</p>
							</div>
						`
					}

					$("#catalogProduct").html(html);
					
					$(".btn-update").on("click",function(){
												
						var param={id:$(this).attr("data-id"), name:$(this).attr("data-name")}
						myData.chartUpdate(param)
					})

					$(".addChart").on("click",function(){
						
						var getId=$(this).attr("data-id");
						var param={id:$(this).attr("data-idProd"), order_code:$(this).attr("data-orderCode"), total:$("#updateChart"+getId).val()}
						myData.actionUpdate(param)
					})

					$(".deleteChart").on("click",function(){

						var param={id_product:$(this).attr("data-idProd"), order_code:$(this).attr("data-orderCode")}

						var prodName=$(this).attr("data-prodName");

						bootbox.confirm({
						    message: "Apakah Anda yakin Ingin Menghapus <b>"+prodName+"</b> dari keranjang",
						    buttons: {
						        confirm: {
						            label: 'Hapus',
						            className: 'btn-success'
						        },
						        cancel: {
						            label: 'Batal',
						            className: 'btn-danger'
						        }
						    },
						    callback: function (result) {
						        // console.log('This was logged in the callback: ' + result);
						        if(result)
						        {
						        	myData.deleteChart(param)
						        }
						    }
						});
						
						
					})

					$("#checkout").on("click",function(){
						var param={
									order_code:$(this).attr("data-orderCode"),
									kurir :$("#kurir").val(),
									kurir_fare :$("#fareKurir").attr("data-fareKurir"),
									total_amount:$("#tohar").attr("data-total"),

								}												
						myData.saveCheckout(param);
					})


					$("#kurir").on("change",function(){
						var param={id:$(this).val()}
						myData.updateKurir(param);
					})

					$("#lanjutPembayaran").on("click",function(){
						var kurir=$("#kurir").val();
						if(kurir=="" || kurir==undefined)
						{
							toastr.error( "Kurir Belum dipilih",'gagal');
						}
						else
						{							
							$(".modal").modal({backdrop: 'static', keyboard: false, show:true})
						}						
					})					
				}
			});
		}


		chartUpdate(data)
		{
			if(data.name=='plus')
			{
				$("#updateChart"+data.id).val(parseInt($("#updateChart"+data.id).val())+1);
			}
			else
			{
				var getUpdateChart =$("#updateChart"+data.id).val();
				if(getUpdateChart<=1)
				{
					$("#updateChart"+data.id).val(1);
				}
				else
				{
					$("#updateChart"+data.id).val(parseInt(getUpdateChart)-1);
				}
			}

		}

		actionUpdate(data)
		{

			$.ajax({
				url: "<?= site_url() ?>order/updateChart",
				dataType: "json",
				data:data,
				type:"post",
				success:function(x){
					if(x.code==1)
					{
						toastr.success('Berhasil', x.message);
						$("#countChart").html(x.data)
						myData.getData();
					}
					else
					{
						toastr.error('gagal', x.message);
						myData.getData();
					}
				}
			});			

		}
		saveCheckout(data)
		{
			$.ajax({
				url: "<?= site_url() ?>order/saveCheckout",
				dataType: "json",
				data:data,
				type:"post",
				beforeSend :function()
				{
					
					$('#exampleModalCenter').block({
		                message: '<h4>Processing</h4>'
		                // css: { border: '3px solid #a00' }
		            });
				},
				success:function(x){
					if(x.code==1)
					{
						toastr.success(x.message,'Berhasil');
						console.log(x);
						
						$('#exampleModalCenter').unblock();
						window.open("<?= site_url()?>payment", '_blank');
						$('#myModal').modal('hide')
						$('.modal-backdrop').remove();
						$("#countChart").html(x.data)
						myData.getData();
					}
					else
					{
						toastr.error( x.message,'gagal');
						$('#exampleModalCenter').unblock();
					}
				}
			});	

		}

		updateKurir(data)
		{
			$.ajax({
				url: "<?= site_url() ?>order/updateKurir",
				dataType: "json",
				data:data,
				type:"post",
				success:function(x){

					$('#exampleModalCenter').unblock();
					$("#fareKurir").html(myData.numberWithCommas(x.fare))
					$('#fareKurir').attr('data-fareKurir',x.fare);
					$("#tohar").html(myData.numberWithCommas(parseInt(x.fare)+parseInt($("#tohar").attr("data-total"))))
						

				}
			})
		}

		deleteChart(data)
		{
			$.ajax({
				url: "<?= site_url() ?>order/deleteChart",
				dataType: "json",
				data:data,
				type:"post",
				success:function(x){
						
					if(x.code==1)
					{
						toastr.success(x.message,'Berhasil');	
						$("#countChart").html(x.data)				
						myData.getData();
					}
					else
					{
						toastr.error( x.message,'gagal');
					}
				}
			})
		}		

		numberWithCommas(x) {
		    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}						

	}
</script>