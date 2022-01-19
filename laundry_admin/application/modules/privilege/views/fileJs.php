<script type="text/javascript">
	class MyData{

		getData()
		{
			$('#table_id').DataTable({

		    	ajax :{
		    		url:"<?=site_url()?>privilege/getDataList",
		    		datatype: "json",
		    		type:"post",
		    		data:function(e){
		    			e.group=$("#group").val();
		    		},
		    		dataSrc:"data",
		    	},


		    	columns:[
		    			{data:'name', className:'text-left'},
		    			{data:'action', className:'text-center'}
		    	],
		    	searching:false,
				iDisplayLength: -1,
				"paging":   false,
				"ordering": false,
				"info":     false,				
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
		actionPrivilege(menuId, groupId,no)
		{
			let valueChecked = 0;
			if ($(`input#valueChecked${no}`).is(':checked')) 
			{
				valueChecked=1;
			}

			let data={
				menuId:menuId,
				groupId:groupId,
				valueChecked:valueChecked
			}
			$.ajax({
				url: "<?= site_url() ?>privilege/actionPrivilege",
				dataType: "json",
				data:data,
				type:"post",
				beforeSend : function()
				{
					$("#table_id").block({
		                message: '<h4>Processing</h4>'
		            });
				},
				success:function(x){

					// console.log(x)
					// var html =``
					
					if(x.code==1)
					{
						toastr.success(x.message,'Berhasil');						

					}
					else
					{
						toastr.error(x.message,'gagal');
					}

					$('#table_id').DataTable().ajax.reload();
					$('#table_id').unblock();

					

				}
			});		
		}

		actionPrivilege_222(menuId, groupId, no)
		{
			let valueChecked = 0;
			if ($(`input#valueChecked${no}`).is(':checked')) 
			{
				valueChecked=1;
			}

			let data={
				menuId:menuId,
				groupId:groupId,
				valueChecked:valueChecked
			}

			console.log(data)
	
		}	

	
					
	}
</script>