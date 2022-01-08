<script type="text/javascript">
	class MyData{

		actionAdd(id=""){
					
			$.ajax({
				url: "<?= site_url() ?>productPulsa/actionAdd",
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

					console.log(x)
					if(x.code==1)
					{
						toastr.success(x.message,'Berhasil');
						$('.modal').modal('hide')
						$('.modal-backdrop').remove();
					}
					else
					{
						toastr.error(x.message,'gagal');
					}

					$('#exampleModalCenter').unblock();
				}
			});				
		}

		getDetail(data)
		{
			$.ajax({
				url: "<?= site_url() ?>productPulsa/getDetail",
				dataType: "json",
				data:data,
				type:"post",
				success:function(x){

					var contentPulsa="";
					var contentPaketData="";


					for(var i=0; i<x.data.length; i++)
					{
						if(x.data[i].id_category==2)
						{

							contentPaketData +=myData.contentDetail(x.data[i]);
						}
						else
						{

							contentPulsa +=myData.contentDetail(x.data[i]);
						}
					}

					$("#pulsa"+x.contentId).html(contentPulsa);
					$("#paketData"+x.contentId).html(contentPaketData);
					$(".subDetail").on("click", function(){

						$(".modal").modal({backdrop: 'static', keyboard: false, show:true})
						$("#exampleModalLongTitle").html($(this).attr("data-categoryName")+" "+$(this).attr("data-operatorName"));

						$("#price").val($(this).attr("data-price"));
						$("#saldo").val($(this).attr("data-saldo"));
						$("#productId").val($(this).attr("data-productId"));

					})
				}
			})
		}

		contentDetail(data)
		{
			console.log(data);
			var html =`

			<div class="card " >
			  	<div class="card-body">
			    	<h5 class="card-title">Saldo : ${numberWithCommas(data.saldo)} ${data.type==null?"":data.type}</h5>
			    	<p class="card-text">Harga : Rp ${numberWithCommas(data.price)}</p>
			    	<p>${data.description}</p>
			    	<button class="btn btn-success addChart subDetail pull-right" data-operatorName="${data.operator_name}" data-price="${data.price}" data-saldo="${data.saldo} ${data.type==null?"":data.type}" data-categoryName="${data.category_name}" data-productId="${data.id}" >Beli</button>
			  	</div>
			</div>
			<br>

			`;

			return html;
		}

		numberWithCommas(x) {
		    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}				

	}
</script>