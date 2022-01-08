<script type="text/javascript">
	class MyData{

		getData()
		{
			$('#table_id').DataTable({

		    	ajax :{
		    		url:"<?=site_url()?>user/getDataList",
		    		datatype: "json",
		    		type:"post",
		    		data:function(e){
		    			e.cari=$("#cari").val();
		    		},
		    		dataSrc:"data",
		    	},
		    	columns:[
		    			{data:'name', className:'text-left'},
		    			{data:'username', className:'text-left'},
		    			{data:'address', className:'text-left'},
		    			{data:'no_hp', className:'text-left'},
		    			// {data:'need_number',className:'text-center'},
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

				var address=$(`#${id}`).attr("data-address");
				var phoneNumber=$(`#${id}`).attr("data-phoneNumber");
				var idGroup=$(`#${id}`).attr("data-idGroup");
				var username=$(`#${id}`).attr("data-username");

				$("#idEdit").val(getId);
				$("#nameEdit").val(getName);

				$("#addressEdit").val(address);
				$("#phoneNumberEdit").val(phoneNumber);
				$("#usernameEdit").val(username);

				var groupHtml=`
					<option value="">Pilih</option>
					<option value="1" selected>Admin</option>

				`
				$("#idGroupEdit").html(groupHtml);

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