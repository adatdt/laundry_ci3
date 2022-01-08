<script type="text/javascript">
	class MyData{

		getData()
		{
			$('#table_id').DataTable({

		    	ajax :{
		    		url:"<?=site_url()?>product/getDataList",
		    		datatype: "json",
		    		type:"post",
		    		data:function(e){
		    			e.cari=$("#cari").val();
		    		},
		    		dataSrc:"data",
		    	},


		    	columns:[
		    			{data:'name', className:'text-left'},
		    			{data:'category_name',className:'text-left'},
		    			{data:'operator_name',className:'text-left'},
		    			{data:'saldo',className:'text-right'},
		    			{data:'price',className:'text-right'},
		    			{data:'type',className:'text-left'},
		    			{data:'description',className:'text-left'},
		    			{data:'action', className:'text-center'}
		    	],
		    	searching:false
		    });

		}
		actionAdd(data, url)
		{
			$.ajax({
				url: url,
				dataType: "json",
				data:data,
				type:"post",
				beforeSend : function()
				{
					$("#modalAdd").block({
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

					$('#modalAdd').unblock();

				}
			});		
		}
		getEdit(id)
		{
			$(document).ready(function(){

				var getId=$(`#${id}`).attr("data-id");
				var getName=$(`#${id}`).attr("data-name");
				var getCategory=$(`#${id}`).attr("data-category");
				var getOperator=$(`#${id}`).attr("data-operator");
				var getSaldo=$(`#${id}`).attr("data-saldo");
				var getPrice=$(`#${id}`).attr("data-price");
				var getType=$(`#${id}`).attr("data-type");
				var getDescription=$(`#${id}`).attr("data-description");

				$("#idEdit").val(getId);
				$("#nameEdit").val(getName);
				$('#categoryEdit').val(getCategory);
				$('#operatorEdit').val(getOperator);
				$('#saldoEdit').val(getSaldo);
				$('#priceEdit').val(getPrice);
				$('#typeEdit').val(getType);
				$('#descriptionEdit').val(getDescription);

				$('#modalEdit').modal('show')
			})

		}
		actionEdit(data, url)
		{
			$.ajax({
				url: url,
				dataType: "json",
				data:data,
				type:"post",
				beforeSend : function()
				{
					$("#modalEdit").block({
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

					$('#modalEdit').unblock();

				}
			});		
		}

		getDelete(id)
		{
			$(document).ready(function(){

				$("#idDelete").val(id);
				$('#modalDelete').modal('show');
			})

		}			
		actionDelete(data, url)
		{
			$.ajax({
				url: url,
				dataType: "json",
				data:data,
				type:"post",
				beforeSend : function()
				{
					$("#modalDelete").block({
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

					$('#modalDelete').unblock();

				}
			});		
		}				
	}
</script>