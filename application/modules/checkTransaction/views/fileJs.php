<script type="text/javascript">
	class MyData{

		getData(data){
					
			$.ajax({
				url: "<?= site_url() ?>checkTransaction",
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
						html +=myData.getCardDetail(x.data,x.tracking);

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

		getCardDetail(data, tracking)
		{

			let dataTracking=``;

			tracking.forEach(element => {
				dataTracking +=`
					<li class="step0 active allstep text-right" >
						<span style="padding-button:3px; padding-left:3px; padding-right:3px; border-radius:6px; background-color:#5bc0de; color:white;">${element.name}</span>						
					</li>
				`
			});

			var html=`

					<div class="col-md-4 getCard ">	
						<div class="card bot-pad bg-dark text-white" >

						  	<div class="card-body">
						    	<h5 class="card-title">NO Transaksi</h5>
						    	<p class="card-text">
						    		 ${data.transaction_code}
						    	</p>
						  	</div>
						</div>
					</div>

					<div class="col-md-4 getCard" >	
						<div class="card bot-pad bg-light" >

						  	<div class="card-body">
						    	<h5 class="card-title">Tanggal Transaksi</h5>
						    	<p class="card-text">
						    		 ${data.created_on}
						    	</p>
						  	</div>
						</div>
					</div>

					<div class="col-md-4 getCard" >	
						<div class="card bot-pad bg-light" >

						  	<div class="card-body">
						    	<h5 class="card-title">Tipe Jasa</h5>
						    	<p class="card-text">
									${data.layanan_prodak}
						    	</p>
						  	</div>
						</div>
					</div>

					<div class="col-md-4 getCard">	
						<div class="card bot-pad bg-light" >

						  	<div class="card-body">
						    	<h5 class="card-title">Total Harga </h5>
						    	<p class="card-text">
						    		Rp. ${data.total_amount}
						    	</p>
						  	</div>
						</div>
					</div>					

					<div class="col-md-12 getCard">	
						<div class="card bot-pad bg-light" >

						  	<div class="card-body">
						    	<h5 class="card-title">Status Tracking</h5>
						    	<p class="card-text" id="statusData"></p>
								<div class="progress-track">
									<ul id="progressbar">
										${dataTracking}
									</ul>
								</div>

						  	</div>
						</div>
					</div>					


			`

			

					
			return html
		}

		numberWithCommas(x) {
		    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}				

	}
</script>