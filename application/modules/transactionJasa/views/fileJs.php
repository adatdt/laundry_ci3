<script type="text/javascript">
	class MyData{

		actionAdd(id=""){
					
			$.ajax({
				url: "<?= site_url() ?>transactionJasa/actionAdd",
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
				url: "<?= site_url() ?>transactionJasa/getHargaJasa",
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
				url: "<?= site_url() ?>transactionJasa/getHargaLayanan",
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
											<input type="text" autocomplete = "off"  class="form-control datepicker" id="tanggalPengambilan" placeholder="Tanggal Ambil" name="tanggalPengambilan"   >
										</div>
							`						
							$("#tanggalPengambilanHtml").html(tanggalPengambilan);
							$("#jamPengambilanHtml").html(jamPengambilan);						
						}
					}

					$('.datepicker').datepicker({
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

		numberWithCommas(x) {
		    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}				

	}
</script>