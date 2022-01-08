<script type="text/javascript">
	class MyData{

		getData()
		{
			$('#table_id').DataTable({

		    	ajax :{
		    		url:"<?=site_url()?>transaction/getDataList",
		    		datatype: "json",
		    		type:"post",
		    		data:function(e){
		    			e.cari=$("#cari").val();
		    			e.dateFrom=$("#dateFrom").val();
		    			e.dateTo=$("#dateTo").val();
		    			e.status=$("#status").val();
		    		},
		    		dataSrc:"data",
		    	},
		    	columns:[
		    			{data:'transaction_code', className:'text-left'},
		    			// {data:'need_number',className:'text-center'},
		    			{data:'created_on', className:'text-center'},
		    			{data:'no_hp', className:'text-center'},
		    			{data:'email', className:'text-center'},
		    			{data:'status', className:'text-center'},
		    			{data:'action', className:'text-center'}
		    	],
		    	searching:false,
		    	fnDrawCallback: function()
	            {
	                var countTotal=this.fnSettings().fnRecordsTotal();
	                if(countTotal)
	                {
	                    $('#btnExcel').prop('disabled',false);
	                }
	                else
	                {
	                    $('#btnExcel').prop('disabled',true);
	                }
	            }
		    });


		    // var countTotal=$("#table_id").html( this.fnSettings().fnRecordsTotal() );
		    // console.log(countTotal);

		}

		getUpdateStatus(id)
		{
			$(document).ready(function(){

				$("#idUpdate").val(id);
				$('#modalUpdate').modal('show');
			})

		}			
		actionUpdate(data, url)
		{
			$.ajax({
				url: url,
				dataType: "json",
				data:data,
				type:"post",
				beforeSend : function()
				{
					$("#modalUpdate").block({
		                message: '<h4>Processing</h4>'
		            });
				},
				success:function(x){

					console.log(x)
					// var html =``
					if(x.code==1)
					{
						toastr.success(x.message,'Berhasil');
						$('.modal').modal('hide')
						$('.modal-backdrop').remove();
						$('#table_id').DataTable().ajax.reload();

					}
					else
					{
						toastr.error(x.message,'gagal');
					}

					$('#modalUpdate').unblock();

				}
			});		
		}	

		getDetail(trxCode)
		{

			$.ajax({
				url: "<?= site_url()?>transaction/getDetail",
				dataType: "json",
				data:"trxCode="+trxCode,
				type:"post",
				// beforeSend : function()
				// {
				// 	$("#modalDelete").block({
		  //               message: '<h4>Processing</h4>'
		  //           });
				// },
				success:function(x){

					var html="";
					for(var i=0; i<x.length; i++)
					{
						html +=myData.getDetailCard(x[i]);
					}

					$("#contentDetail").html(html);

					$('#modalDetail').modal('show');


				}

			})							

		}


		getDetailCard(data)
		{
			console.log(data);

			var html =`

				<div class="col-md-4 getCard ">	
					<div class="card bot-pad " >

					  	<div class="card-body bg-primary text-white">
					    	<h5 class="card-title">Kode Transaksi</h5>
					    	<p class="card-text">
					    		 ${data.transaction_code}
					    	</p>
					  	</div>
					</div>
				</div>

				<div class="col-md-4 getCard">	
					<div class="card bot-pad card-primary" >

					  	<div class="card-body">
					    	<h5 class="card-title">Nama Produk</h5>
					    	<p class="card-text">
					    		 ${data.name}
					    	</p>
					  	</div>
					</div>
				</div>			

				<div class="col-md-4 getCard">	
					<div class="card bot-pad card-primary" >

					  	<div class="card-body">
					    	<h5 class="card-title">Email</h5>
					    	<p class="card-text">
					    		 ${data.email}
					    	</p>
					  	</div>
					</div>
				</div>								

				<div class="col-md-4 getCard">	
					<div class="card bot-pad" >

					  	<div class="card-body">
					    	<h5 class="card-title">Harga</h5>
					    	<p class="card-text">
					    		 Rp. ${numberWithCommas(data.price)}
					    	</p>
					  	</div>
					</div>
				</div>				

				<div class="col-md-4 getCard">	
					<div class="card bot-pad" >

					  	<div class="card-body">
					    	<h5 class="card-title">Tanggal Transaksi</h5>
					    	<p class="card-text">
					    		 ${data.tanggal_transaksi}
					    	</p>
					  	</div>
					</div>
				</div>

				<div class="col-md-4 getCard">	
					<div class="card bot-pad" >

					  	<div class="card-body">
					    	<h5 class="card-title">Status</h5>
					    	<p class="card-text">
					    		 ${data.status}
					    	</p>
					  	</div>
					</div>
				</div>

				<div class="col-md-4 getCard">	
					<div class="card bot-pad" >

					  	<div class="card-body">
					    	<h5 class="card-title">Kode Pembayaran</h5>
					    	<p class="card-text">
					    		 ${data.payment_code}
					    	</p>
					  	</div>
					</div>
				</div>	

				<div class="col-md-4 getCard">	
					<div class="card bot-pad" >

					  	<div class="card-body">
					    	<h5 class="card-title">Tanggal Bayar</h5>
					    	<p class="card-text">
					    		 ${data.tanggal_bayar}
					    	</p>
					  	</div>
					</div>
				</div>		

				<div class="col-md-4 getCard">	
					<div class="card bot-pad" >

					  	<div class="card-body">
					    	<h5 class="card-title">Biaya ditransafer</h5>
					    	<p class="card-text">
					    		 ${data.total_transfer}
					    	</p>
					  	</div>
					</div>
				</div>

				<div class="col-md-4 getCard">	
					<div class="card bot-pad" >

					  	<div class="card-body">
					    	<h5 class="card-title">Bukti Pembayaran</h5>
					    	<p class="card-text">
					    		 ${data.path}
					    	</p>
					  	</div>
					</div>
				</div>

				<div class="col-md-12 ">
					<hr>
				</div>																																

			`

			return html
		}			
	}
</script>