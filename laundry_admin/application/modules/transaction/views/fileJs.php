<script type="text/javascript">
	class MyData{

		getData()
		{
			var dt=$('#table_id').DataTable({

		    	ajax :{
		    		url:"<?=site_url()?>transaction/getDataList",
		    		datatype: "json",
		    		type:"post",
		    		data:function(e){
		    			e.cari=$("#cari").val();
		    			e.dateFrom=$("#dateFrom").val();
		    			e.dateTo=$("#dateTo").val();
		    			e.status=$("#status").val();
						e.statusProces=$("#statusProces").val();
		    		},
		    		dataSrc:"data",
		    	},
		    	columns:[
						{
							"class":          "details-control",
							"orderable":      false,
							"data":           'icon',
							"defaultContent": ""
						},	
						{data:'transaction_code', className:'text-left'},
						{data:'created_on', className:'text-left'},
						{data:'no_hp', className:'text-right'},
						{data:'email', className:'text-center'},
						{data:'status_payment2', className:'text-center'},
						{data:'status_proces2', className:'text-left'},
						{data:'product_service_name', className:'text-left'},
						{data:'total_weight', className:'text-right'},
						{data:'total_amount', className:'text-right'},

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

			// Array to track the ids of the details displayed rows
			var detailRows = [];
			
			$('#table_id tbody').on( 'click', 'tr td.details-control', function () {
				var tr = $(this).closest('tr');
				var td = $(this).closest('td');
				var row = dt.row( tr );
				var idx = $.inArray( tr.attr('id'), detailRows );

				if ( row.child.isShown() ) {
					tr.removeClass( 'details' );
					row.child.hide();
					// Remove from the 'open' array
					detailRows.splice( idx, 1 );
					td.html('<span  class="badge badge-success"><i class="fa fa-plus" aria-hidden="true"></i></span>');

				}
				else {
					tr.addClass( 'details' );
					row.child( myData.format( row.data() ) ).show();
					td.html('<span  class="badge badge-danger"><i class="fa fa-minus" aria-hidden="true"></i></span>'); 
					
					myData.detailRowChild(row.data().transaction_code)

					// Add to the 'open' array
					if ( idx === -1 ) {
						detailRows.push( tr.attr('id') );
					}
				}

				$(`#btnEdit${row.data().transaction_code}`).on("click",function(){
					myData.actionEdit(row.data().transaction_code)
				})
				
				$(`#totalWeight${row.data().transaction_code}`).keyup(function(){

					let price_product_service=row.data().price_product_service;
					let price_service_delivery=row.data().price_service_delivery;
					let price_service_pickup=row.data().price_service_pickup;
					let weight = $(this).val();
					let a = parseInt(price_product_service) * parseInt(weight) 
					let b = parseInt(price_service_delivery) * parseInt(weight)
					let c = parseInt(price_service_pickup) * parseInt(weight)

					let total = a+ b+ c;
					$("#totalAmount"+row.data().transaction_code).val(isNaN(total)?0:total)
					
				})

			} );

			// On each draw, loop over the `detailRows` array and show any child rows
			dt.on( 'draw', function () {
				$.each( detailRows, function ( i, id ) {
					$('#'+id+' td.details-control').trigger( 'click' );
				} );
			} );			


		    // var countTotal=$("#table_id").html( this.fnSettings().fnRecordsTotal() );
		    // console.log(countTotal);

		}

		format ( d ) {
			// console.log(d);
			let html =`
			
				<div class="card">
					<div class="card-header">
						Detail Transaksi ${d.transaction_code}
					</div>
					<div class="card-body" >
						<div class="row" id="card_body_${d.transaction_code}">
							<div class="col-sm-4 form-group">
								<label>Nama</label>
								: <span id="textName${d.transaction_code}">${d.user_transaction}</span>
							</div>
							<div class="col-sm-4 form-group">
								<label>Alamat</label>
								: <span id="textAddress${d.transaction_code}"></span>
							</div>			
							<div class="col-sm-4 form-group">
								<label>Nama Layanan Antar</label>
								: <span id="textLayananAntar${d.transaction_code}"></span>
							</div>					
							<div class="col-sm-4 form-group">
								<label>Harga Layanan Antar</label>
								: <span id="textPriceDelivery${d.transaction_code}"></span>
							</div>		
							<div class="col-sm-4 form-group">
								<label>Nama Layanan Jemput</label>
								: <span id="textLayananJemput${d.transaction_code}"></span>
							</div>
							<div class="col-sm-4 form-group">
								<label>Harga Layanan Jemput</label>
								: <span id="textPricePickup${d.transaction_code}"></span>
							</div>
							<div class="col-sm-12 "></div>
							<div class="col-sm-4 form-group">
								
									<label>Status Proses</label>
									<select type="text" class="form-control" name="statusProces" id="statusProces${d.transaction_code}"  >
										<option value="" >Pilih</option>
										<option value="1" ${d.status_proces==1?"selected":""} >Order</option>
										<option value="2" ${d.status_proces==2?"selected":""} >Penjemputan</option>
										<option value="3" ${d.status_proces==3?"selected":""} >Proses</option>
										<option value="4" ${d.status_proces==4?"selected":""} >Pengiriman</option>
										<option value="5" ${d.status_proces==5?"selected":""}>Selesai</option>
										<option value="6" ${d.status_proces==6?"selected":""}>Tidak Valid</option>
									</select>
																																																														
							</div>							
							<div class="col-sm-4 form-group">
								
								<label>Total Berat</label>
								<input type="number" min=1 class="form-control" name="totalWeight"  placeholder="Total Berat"  id="totalWeight${d.transaction_code}">
																																																													
							</div>
							<div class="col-sm-4 form-group">
								
									<label>Total Harga</label>
									<input type="text" class="form-control" name="totalAmount"  placeholder="Total Harga"  readonly id="totalAmount${d.transaction_code}" >
																																				 																										
							</div>
							<div class="col-sm-12 form-group"></div>
							<div class="col-sm-4 form-group">
								
								<label>Status Pembayaran</label>
								<select type="text" class="form-control" name="statusProces" id="statusSelectBayar${d.transaction_code}"  >
									<option value="" >Pilih</option>
									<option value="1" ${d.status_payment==1?"selected":""} >Belum</option>
									<option value="2" ${d.status_payment==2?"selected":""} >Dibayar</option>
								</select>
																																				 																										
							</div>

						</div>
						<div class="btn btn-success pull-right" id="btnEdit${d.transaction_code}" >EDIT</div>
					</div>
				</div>			
			
			`
			return html;
		}
		
		detailRowChild(transactionCode)
		{
			$.ajax({
				url: "<?= site_url()?>transaction/detailRowChild",
				dataType: "json",
				data:"transactionCode="+transactionCode,
				type:"post",
				beforeSend : function()
				{
					$("#card_body_"+transactionCode).block({
		                message: '<h4>Processing</h4>'
		            });
				},
				success:function(x){
					console.log(x)
					
					$(`#textAddress${transactionCode}`).html(x.address);
					$(`#textLayananAntar${transactionCode}`).html(x.layanan_antar);
					$(`#textPriceDelivery${transactionCode}`).html(x.price_service_delivery);
					$(`#textLayananJemput${transactionCode}`).html(x.layanan_jemput);
					$(`#textPricePickup${transactionCode}`).html(x.price_service_pickup);
					$(`#totalWeight${transactionCode}`).val(x.total_weight);
					$(`#totalAmount${transactionCode}`).val(x.total_amount);

					$(`#td_penjemputan_${transactionCode}`).html(x.status_proces2);
					$(`#td_total_amount${transactionCode}`).html(x.total_amount2);
					$(`#td_total_weight${transactionCode}`).html(x.total_weight2);

					let selectStatusProcess=`	
						<option value="" >Pilih</option>
						<option value="1" ${x.status_proces==1?"selected":""} >Order</option>
						<option value="2" ${x.status_proces==2?"selected":""} >Penjemputan</option>
						<option value="3" ${x.status_proces==3?"selected":""} >Proses</option>
						<option value="4" ${x.status_proces==4?"selected":""} >Pengiriman</option>
						<option value="5" ${x.status_proces==5?"selected":""}>Selesai</option>
						<option value="6" ${x.status_proces==6?"selected":""}>Tidak Valid</option>
					`

					let selectStatusPayment=`	
						<option value="" >Pilih</option>
						<option value="1" ${x.status_payment==1?"selected":""} >Belum</option>
						<option value="2" ${x.status_payment==2?"selected":""} >Dibayar</option>
					`					
					
					$(`#statusProces${transactionCode}`).html(selectStatusProcess);
					$(`#statusSelectBayar${transactionCode}`).html(selectStatusPayment);
					
					$("#card_body_"+transactionCode).unblock();

				}
			});	
		}

		getUpdateStatus(id)
		{
			$(document).ready(function(){

				$("#idUpdate").val(id);
				$('#modalUpdate').modal('show');
			})

		}			
		actionEdit(transactionCode)
		{
			let data={

				transactionCode:transactionCode,
				statusPoces:$(`#statusProces${transactionCode}`).val(),
				totalWeight:$(`#totalWeight${transactionCode}`).val(),
				totalAmount:$(`#totalAmount${transactionCode}`).val(),
				statusPayment:$(`#statusSelectBayar${transactionCode}`).val(),
			}

			$.ajax({
				url: "<?= site_url()?>transaction/actionEdit",
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


					if(x.code==1)
					{
						toastr.success(x.message,'Berhasil');
						myData.detailRowChild(transactionCode);


					}
					else
					{
						toastr.error(x.message,'Berhasil');
					}


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
			// console.log(data);

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
		actionAdd(id=""){
					
			$.ajax({
				url: "<?= site_url() ?>transaction/actionAdd",
				dataType: "json",
				data:$("#formData").serialize(),
				type:"post",
				beforeSend : function()
				{
					$('#exampleModalCenter').block({
						message: '<h4>Processing</h4>'
						// css: { border: '3px solid #a00' }
					});
				},
				success:function(x){

					// console.log(x)
					if(x.code==1)
					{
						toastr.success(x.message,'Berhasil');
						$('.modal').modal('hide')
						$('.modal-backdrop').remove();

						$("input[name*='dataJasa']").val("");
						$("input[name*='dataJasaAntar']").val("");
						$("input[name*='dataJasaJemput']").val("");
						$("input[name*='noHp']").val("");
						$("input[name*='address']").val("");
						$("input[name*='hargaJasa']").val("");
						$("input[name*='tohar']").val("");
						$("input[name*='email']").val("");
						$("input[name*='hargaPengantaran']").val("");
						$("input[name*='hargaPengambilan']").val("");
						$("input[name*='tanggalPengambilan']").html(""); 
						$("input[name*='jamPengambilan']").html("");		
						
						
					}
					else
					{
						toastr.error(x.message,'gagal');
					}

					$('#exampleModalCenter').unblock();
				}
			});				
		}

		getHargaJasa(data)
		{
			$.ajax({
				url: "<?= site_url() ?>transaction/getHargaJasa",
				dataType: "json",
				data:data,
				type:"post",
				success:function(x){
					console.log(x);
					$("#hargaJasa").val(x.harga);
					let totalHarga = parseInt(x.harga) + parseInt($("#hargaPengambilan").val()) + parseInt($("#hargaPengantaran").val()) 
					$("#tohar").val(totalHarga);
				}
			})
		}

		getHargaLayanan(data)
		{
			$.ajax({
				url: "<?= site_url() ?>transaction/getHargaLayanan",
				dataType: "json",
				data:data.data,
				type:"post",
				success:function(x){
					console.log(x.harga);

					if(data.type=='antar')
					{
						$("#hargaPengantaran").val(x.harga);
						let totalHarga = parseInt($("#hargaJasa").val()) + parseInt($("#hargaPengambilan").val()) + parseInt(x.harga) 
						$("#tohar").val(totalHarga);
					}
					else
					{
						$("#hargaPengambilan").val(x.harga);
						let totalHarga = parseInt($("#hargaJasa").val()) + parseInt(x.harga) + parseInt($("#hargaPengantaran").val()) 
						$("#tohar").val(totalHarga);

						if(x.harga==0)
						{
							$("#tanggalPengambilanHtml").html("");
							$("#jamPengambilanHtml").html("");		
						}
						else
						{

							let jamPengambilan =`
										<label for="email" class="col-sm-4 col-form-label ">Jam Pengambilan <span class="wajib">*</span></label>
										<div class="col-sm-4">
											<?= form_dropdown("jamPengambilan",$dataJam,"",' class="form-control " id="jamPengambilan"  ') ?>
										</div>
							`
							let tanggalPengambilan =`
										<label for="email" class="col-sm-4 col-form-label">Tanggal Pengambilan <span class="wajib">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control datepicker" id="tanggalPengambilan"" placeholder="status" autocomplete="off" >											
										</div>
							`						
							$("#tanggalPengambilanHtml").html(tanggalPengambilan);
							$("#jamPengambilanHtml").html(jamPengambilan);						
						}
					}

					$('.datepicker').datepicker({
						uiLibrary: 'bootstrap4',
						format: 'yyyy-mm-dd',
						todayHighlight:'TRUE',
						autoclose: true
					});					
				}
			})
		}		

		contentDetail(data)
		{

			$.ajax({
				url: "<?= site_url() ?>transactionJasa/contentDetail",
				dataType: "json",
				// data:data,
				type:"post",
				success:function(x){
					console.log(x);
				}
			})

		}
		
	}
</script>