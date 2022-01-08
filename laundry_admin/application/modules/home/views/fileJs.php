<script type="text/javascript">
	class MyData{

		actionEdit(data, url)
		{
			$.ajax({
				url: url,
				dataType: "json",
				data:data,
				type:"post",
				beforeSend : function()
				{
					$("#formData").block({
		                message: '<h4>Processing</h4>'
		            });
				},
				success:function(x){

					console.log(x)
					// var html =``
					if(x.code==1)
					{
						toastr.success(x.message,'Berhasil');

						var dataUser= x.data;

						$("#name").val(dataUser.name);
    					$("#phoneNumber").val(dataUser.no_hp);
    					$("#address").val(dataUser.address);							

					}
					else
					{
						toastr.error(x.message,'gagal');
					}

					$('#formData').unblock();

				}
			});		
		}

		changePassword(data, url)
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
	}
</script>