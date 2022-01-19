<script type="text/javascript">
	class MyData{

		getData(data)
		{
			$.ajax({
				url: "<?= site_url()?>laporan/getDataList",
				dataType: "json",
				data:data,
				type:"post",
				// beforeSend : function()
				// {
				// 	$("#modalAdd").block({
		        //         message: '<h4>Processing</h4>'
		        //     });
				// },
				success:function(x){

					// console.log(x)
					let getTable=myData.getTable(x);
					$("#idTable").html(getTable);
					$("#downloadPdf").show();

				}
			});	

		}

		getTable(x)
		{
			let html="";
			let rowDataDibayar="";
			let rowDataBelumDibayar="";

			let totalDataDibayar=0;
			let totalTransactionDataDibayar=0;

			let totalDataBelumDibayar=0;
			let totalTransactionDataBelumDibayar=0;

			let no1=1;
			x.dataDibayar.forEach(element => {
				rowDataDibayar +=`<tr>
							<td>${no1}</td>
							<td>${element.transaction_date}</td>
							<td>${element.product_service_name}</td>
							<td align='right' >${myData.numberWithCommas(element.total_transaction)}</td>
							<td align='right'>${myData.numberWithCommas(element.total)}</td>
						</tr>`

				totalDataDibayar = totalDataDibayar + parseInt(element.total);
				totalTransactionDataDibayar = totalTransactionDataDibayar + parseInt(element.total_transaction);
				no1++;
			});

			let no2=1;
			x.dataBelumDibayar.forEach(element => {
				rowDataBelumDibayar +=`<tr>
							<td>${no2}</td>
							<td>${element.transaction_date}</td>
							<td>${element.product_service_name}</td>
							<td align='right'>${myData.numberWithCommas(element.total_transaction)}</td>
							<td align='right'>${myData.numberWithCommas(element.total)}</td>
						</tr>`
					totalDataBelumDibayar = totalDataBelumDibayar + parseInt(element.total);
					totalTransactionDataBelumDibayar = totalTransactionDataBelumDibayar + parseInt(element.total_transaction);
				no2++;
			});			

			html +=`
				<table class="table table-bordered ">
					<thead>
						<tr>
							<th>no</th>
							<th>Tanggal Transaksi</th>
							<th>Nama Jasa</th>
							<th>Total Transaksi</th>
							<th>Total Pendapatan</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="5">Status Sudah Bayar </td>
						</tr>
							${rowDataDibayar}
						<tr>
							<td colspan="3">Total </td>
							<td align='right'>${myData.numberWithCommas(totalTransactionDataDibayar)}</td>
							<td align='right'>${myData.numberWithCommas(totalDataDibayar)}</td>
						</tr>
						<tr>
							<td colspan="5"> </td>
						</tr>
						<tr>
							<td colspan="5">Status Belum Bayar </td>
						</tr>
							${rowDataBelumDibayar}
						<tr>
							<td colspan="3">Total </td>
							<td align='right'>${myData.numberWithCommas(totalTransactionDataBelumDibayar)}</td>
							<td align='right'>${myData.numberWithCommas(totalDataBelumDibayar)}</td>
						</tr>
						<tr>
							<th colspan="3">Grand Total </th>
							<td align='right'>${myData.numberWithCommas(totalTransactionDataBelumDibayar + totalTransactionDataDibayar)}</td>
							<td align='right'>${myData.numberWithCommas(totalDataBelumDibayar + totalDataDibayar)}</td>
						</tr>										
					</tbody>
				</table>							
			`

			return html;
		}

		numberWithCommas(x) {
			return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}		
			
	}
</script>