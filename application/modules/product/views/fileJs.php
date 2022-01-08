<script type="text/javascript">
	class MyData{

		getData(){

			$.ajax({
				// url: "<?= site_url() ?>product",
				url: window.location.href ,
				dataType: "json",
				type:"post",
				success:function(data){

					let x = data.data;
					var html =``

					if(data.code==1)
					{

						for(var i=0; i<x.length; i++)
						{

							html +=` 

									<div class="col-md-4">	
										<div class="card bot-pad" >
											${x[i].path}
										  	<div class="card-body">
										    	<h5 class="card-title">${x[i].name}</h5>
										    	<p class="card-text">
										    		${x[i].description}
										    	</p>
										    	<p>Harga : Rp. ${myData.numberWithCommas(x[i].price)}</p>
										    	<a href="#" class="btn btn-primary addChart" data-id="${x[i].id}" >Tambahkan<i class="fa fa-shopping-cart fa-2x pull-left" aria-hidden="true" style="color: #fd6861;"></i></a>
										  	</div>
										</div>
									</div>
							`
						}
					}
					else
					{
						html +=`

							<div class="container p-3 my-3 border" align="center">
							  	<p>Tidak ada data</p>
							</div>
						`
					}


						html +=`													
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
												</div>


								            </div>
								            <div class="modal-footer">
								                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
								                <button type="button" class="btn btn-success" id="chart"> Checkout</button>
								            </div>
								        </div>
								    </div>
								</div> `;						      	
											    


					$("#catalogProduct").html(html);
					$(".addChart").on("click",function(){
						myData.addChart($(this).data('id'));

						
					})
				}
			});
		}

		addChart(id){
					
			$.ajax({
				url: "<?= site_url() ?>product/addChart",
				dataType: "json",
				data:"id="+id,
				type:"post",
				success:function(x){

					if(x.code==1)
					{
						toastr.success('Berhasil', 'Tambah Item');
						$("#countChart").html(x.data)
					}
					else
					{
						toastr.error('gagal', 'gagal Tambah Item');
					}
				}
			});				
		}

		numberWithCommas(x) {
		    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}				

	}
</script>