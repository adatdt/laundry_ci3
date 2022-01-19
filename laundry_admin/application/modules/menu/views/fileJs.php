<script type="text/javascript">
	class MyData{

		getData()
		{
			$('#table_id').DataTable({

		    	ajax :{
		    		url:"<?=site_url()?>menu/getDataList",
		    		datatype: "json",
		    		type:"post",
		    		data:function(e){
		    			e.cari=$("#cari").val();
		    		},
		    		dataSrc:"data",
		    	},


		    	columns:[
		    			{data:'name', className:'text-left'},
						{data:'url', className:'text-left'},
						{data:'ordering', className:'text-left'},
		    			{data:'status',className:'text-right'},
		    			{data:'action', className:'text-center'}
		    	],
		    	searching:false,
				language: {
                            "aria": {
                                "sortAscending": ": activate to sort column ascending",
                                "sortDescending": ": activate to sort column descending"
                            },
                            "processing": "Proses.....",
                            "emptyTable": "Tidak ada data",
                            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                            "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                            "infoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                            "lengthMenu": "Menampilkan _MENU_",
                            "search": "Pencarian :",
                            "zeroRecords": "Tidak ditemukan data yang sesuai",
                            "paginate": {
                                "previous": "Sebelumnya",
                                "next": "Selanjutnya",
                                "last": "Terakhir",
                                "first": "Pertama"
                            }
                        },				
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
				var getLink=$(`#${id}`).attr("data-url");
				var getOrdering=$(`#${id}`).attr("data-ordering");
				
				$("#idEdit").val(getId);
				$("#nameEdit").val(getName);
				$("#linkEdit").val(getLink);
				$("#orderingEdit").val(getOrdering);

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
				$("#statusDelate").val(status);
				$("#pesanData").html(pesanData);
				$("#delete").html(buttondeleteTxt);
				$('#modalDelete').modal('show');
			})

		}			
		actionDelete(data)		
		{
			var url ="<?= site_url()?>menu/actionDelete";
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