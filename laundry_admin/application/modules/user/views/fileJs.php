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
						{data:'email', className:'text-left'},
		    			{data:'status',className:'text-center'},
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
				var email=$(`#${id}`).attr("data-email");

				$("#idEdit").val(getId);
				$("#nameEdit").val(getName);

				$("#addressEdit").val(address);
				$("#phoneNumberEdit").val(phoneNumber);
				$("#usernameEdit").val(username);
				$("#emailEdit").val(email);


				$("#idGroupEdit").val(idGroup);

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

		getDelete_16102022(id)
		{
			$(document).ready(function(){

				$("#idDelete").val(id);
				$('#modalDelete').modal('show');
			})

		}
		getDelete(id, status)
		{
			$(document).ready(function(){

				let pesanData ="";
				let buttondeleteTxt=""
				
				switch (status) {
					case '-5':
						 pesanData +=` Apakah anda Yakin ingin Menghapus data ini `
						 buttondeleteTxt ="Hapus"
					break;
					case '0':
						pesanData +=` Apakah anda Yakin ingin Nonaktifkan Data Ini `
						buttondeleteTxt="Non Aktifkan"
					break;
					default:
						pesanData +=` Apakah anda Yakin ingin Aktifkan Data Ini `
						buttondeleteTxt ="Aktifkan"
						break;
				}

				$("#idDelete").val(id);
				$("#statusDelete").val(status);
				$("#pesanData").html(pesanData);
				$("#delete").html(buttondeleteTxt);
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