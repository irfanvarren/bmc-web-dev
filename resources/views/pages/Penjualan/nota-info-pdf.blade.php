<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title> BMC | Detail Nota </title>
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<style>
		*, ::after, ::before {
			box-sizing: border-box;
		}
		.text-center{
			text-align:center;
		}
		table{
			margin:0 !important;
		}
		.table{
			border-collapse:collapse;
			width:100%;
		}
		.table.table-bordered tr td,.table.table-bordered tr th{
			border:1px solid #dedede;
			padding:4px 2.5px;
		}
		html{
			margin:0 15px !important;
			width:100%;
			font-size:12px;

		}
		.container{
			max-width: 1366px;display: block;margin:0 auto;
		}
		.mt-1{
			margin-top:5px;
		}
		.mt-2{
			margin-top:10px;
		}
		.mt-2{
			margin-top:15px;
		}
		.text-right{
			text-align:right;
		}
		.text-center{
			text-align: center;
		}
		.w-50{
			width:50% !important;
		}
		.center{
			display: block;
			margin:0 auto;
		}
		.signature{
			height:20px;
			line-height: 1;
		}
		.card{border:1px solid black;height:45%;padding:10px 15px;margin-top:1.4%;}
	</style>
</head>
<body>
	<div class="container">
		@foreach($all_detail_penjualan as $detail_penjualan)
		
		<div class="card">
			<div>
				<table class="table">
					<tr>
						<td>	
							<div>
								<strong>Bless Me Cosmetic</strong>
							</div>
							<div>
								<strong>BMC</strong>
							</div>
						</td>
						<td class="text-right">
							<div>PONTIANAK</div>
						</td>
					</tr>
				</table>


			</div>
			<div class="text-center">
				<h2 style="margin:0;margin-top:-15px;">NOTA PENJUALAN</h2>
			</div>
			<div>
				<hr style="margin:5px;">
			</div>
			<div>
				<table class="table">
					<tr>
						<td>
							<div>
								<strong>No Transaksi : {{$id_penjualan}} </strong>
							</div>
							
							<div>
								Cash / Kredit : {{$all_penjualan[0]['metode_pembayaran']}} / JT : 14
							</div>
						</td>
						<td>
							<!-- <div>
								Kode Pelanggan : {{$all_penjualan[0]['id_toko_pelanggan']}}
							</div> -->
							<div>
								Nama Toko : {{$nama_toko[0]['nama_toko_pelanggan']}}
							</div>
							<div>
								Alamat Toko : {{$all_penjualan[0]['alamat_toko_pelanggan']}}
							</div>
						</td>
						<td style="text-align:right;">
							<div>
								Tanggal : {{$all_penjualan[0]['tanggal_kirim']}}
							</div>
							<div>
								Disc :  {{$all_penjualan[0]['diskon']."%"}}
							</div>
							<!-- <div>
								Alamat : {{$all_penjualan[0]['alamat_toko_pelanggan']}}
							</div> -->
						</td>
					</tr>
				</table>
			</div>
			<div class="mt-1">
				<table class="table table-bordered mt-2 text-center">
					<thead>
						<tr>
							<th style="width:30px;"> No </th>
							<th> Nama Barang </th>
							<th> Qty </th>
							<th> Harga Barang </th>
							<th> Satuan </th>
							<th> DSC % </th>
							<th> DSC RP </th>
							<th> Total Harga </th>
						</tr>
					</thead>
					<tbody>
						<?php $row = 1;$subtotal = 0;$all_diskon = 0?>
						@foreach($detail_penjualan as $adp)
						<tr>
							<td style="width:30px;">{{$row++}}</td>
							<td>{{$adp->nama_barang}}</td>
							<td>{{$adp->jumlah_barang}}</td>
							<td>{{ number_format($adp->harga_barang,0,',','.')}}</td>
							<td> {{$adp->satuan}} </td>
							<td> {{$adp->diskon."%"}} </td>
							<td>{{number_format(($adp->diskon*($adp->harga_barang*$adp->jumlah_barang)/100),0,',','.')}}</td>
							<td>{{ number_format($adp->jumlah_barang*$adp->harga_barang,0,',','.')}}</td>
						</tr>
						<?php
						$subtotal += $adp->jumlah_barang*$adp->harga_barang;
						$all_diskon += $adp->diskon*($adp->harga_barang*$adp->jumlah_barang)/100;
						?>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="mt-1">
				<table class="table">
					<tr>
						<td style="width:75%;font-size:10px;">
							<font> CATATAN : </font> <br>
							<font> 1. Barang yang sudah dibeli tidak dapat dikembalikan kecuali dengan perjanjian  </font> <br>
							<font> 2. Pembayaran melalu transfer/cek/giro dianggap lunas jika sudah memasuki rekening kami </font>
						</td>
						<td style="float:right;font-size:10px;">
							<table>
								<tr>
									<th class="text-right"> SUB JUMLAH </th>
									<th class="text-right"> : {{ "Rp.".number_format($subtotal,0,',','.')}} </th>
								</tr>
								<tr>
									<th class="text-right"> DISC </th>
									<th class="text-right"> : {{ "Rp.".number_format((($subtotal*$all_penjualan[0]['diskon'])/100),0,',','.')}}  </th>
								</tr>
								<tr>
									<th class="text-right"> TOTAL </th>
									<th class="text-right"> : {{ "Rp.".number_format(($subtotal-(($subtotal*$all_penjualan[0]['diskon'])/100)-$all_diskon),0,',','.')}} </th>
								</tr>
							</table>
						</td>
					</tr>

				</table>
			</div>
			<div>
				<table class="table">
					<tr>
						<td class="text-center">
							<div class="center w-50">
								<div>
									<font><b> Penerima </b></font>
								</div>
								<div class="signature">

								</div>
								<div>
									<font>{{$nama_toko[0]['nama_toko_pelanggan']}}</font>
								</div>
								<div>
									<font>_______________________</font>
								</div>
							</div>
						</td>
						<td class="text-center">
							<div class="center w-50">
								<div>
									<font><b> Penjual </b></font>
								</div>
								<div class="signature">

								</div>
								<div>
									<font>BMC</font>
								</div>
								<div>
									<font>_______________________</font>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="card" style="background-color:#d9fffd;">
			<div>
				<table class="table">
					<tr>
						<td>	
							<div>
								<strong>Bless Me Cosmetic</strong>
							</div>
							<div>
								<strong>BMC</strong>
							</div>
						</td>
						<td class="text-right">
							<div>PONTIANAK</div>
						</td>
					</tr>
				</table>


			</div>
			<div class="text-center">
				<h2 style="margin:0;margin-top:-15px;">NOTA PENJUALAN</h2>
			</div>
			<div>
				<hr style="margin:5px;">
			</div>
			<div>
				<table class="table">
					<tr>
						<td>
							<div>
								<strong>No Transaksi : {{$id_penjualan}} </strong>
							</div>
							
							<div>
								Cash / Kredit : {{$all_penjualan[0]['metode_pembayaran']}} / JT : 14
							</div>
						</td>
						<td>
							<!-- <div>
								Kode Pelanggan : {{$all_penjualan[0]['id_toko_pelanggan']}}
							</div> -->
							<div>
								Nama Toko : {{$nama_toko[0]['nama_toko_pelanggan']}}
							</div>
							<div>
								Alamat Toko : {{$all_penjualan[0]['alamat_toko_pelanggan']}}
							</div>
						
						</td>
						<td style="text-align:right;">
							<div>
								Tanggal : {{$all_penjualan[0]['tanggal_kirim']}}
							</div>
							<div>
								Disc :  {{$all_penjualan[0]['diskon']."%"}}
							</div>
							<!-- <div>
								Alamat : {{$all_penjualan[0]['alamat_toko_pelanggan']}}
							</div> -->
						</td>
					</tr>
				</table>
			</div>
			<div class="mt-1">
				<table class="table table-bordered mt-2 text-center">
					<thead>
						<tr>
							<th style="width:30px;"> No </th>
							<th> Nama Barang </th>
							<th> Qty </th>
							<th> Harga Barang </th>
							<th> Satuan </th>
							<th> DSC % </th>
							<th> DSC RP </th>
							<th> Total Harga </th>
						</tr>
					</thead>
					<tbody>
						<?php $row = 1;$subtotal = 0;$all_diskon = 0?>
						@foreach($detail_penjualan as $adp)
						<tr>
							<td style="width:30px;">{{$row++}}</td>
							<td>{{$adp->nama_barang}}</td>
							<td>{{$adp->jumlah_barang}}</td>
							<td>{{ number_format($adp->harga_barang,0,',','.')}}</td>
							<td> {{$adp->satuan}} </td>
							<td> {{$adp->diskon."%"}} </td>
							<td>{{number_format(($adp->diskon*($adp->harga_barang*$adp->jumlah_barang)/100),0,',','.')}}</td>
							<td>{{ number_format($adp->jumlah_barang*$adp->harga_barang,0,',','.')}}</td>
						</tr>
						<?php
						$subtotal += $adp->jumlah_barang*$adp->harga_barang;
						$all_diskon += $adp->diskon*($adp->harga_barang*$adp->jumlah_barang)/100;
						?>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="mt-1">
				<table class="table">
					<tr>
						<td style="width:75%;font-size:10px;">
							<font> CATATAN : </font> <br>
							<font> 1. Barang yang sudah dibeli tidak dapat dikembalikan kecuali dengan perjanjian  </font> <br>
							<font> 2. Pembayaran melalu transfer/cek/giro dianggap lunas jika sudah memasuki rekening kami </font>
						</td>
						<td style="float:right;font-size:10px;">
							<table>
								<tr>
									<th class="text-right"> SUB JUMLAH </th>
									<th class="text-right"> : {{ "Rp.".number_format($subtotal,0,',','.')}} </th>
								</tr>
								<tr>
									<th class="text-right"> DISC </th>
									<th class="text-right"> : {{ "Rp.".number_format((($subtotal*$all_penjualan[0]['diskon'])/100),0,',','.')}} </th>
								</tr>
								<tr>
									<th class="text-right"> TOTAL </th>
									<th class="text-right"> : {{ "Rp.".number_format(($subtotal-(($subtotal*$all_penjualan[0]['diskon'])/100)-$all_diskon),0,',','.')}} </th>
								</tr>
							</table>
						</td>
					</tr>

				</table>
			</div>
			<div>
				<table class="table">
					<tr>
						<td class="text-center">
							<div class="center w-50">
								<div>
									<font><b> Penerima </b></font>
								</div>
								<div class="signature">

								</div>
								<div>
									<font>{{$nama_toko[0]['nama_toko_pelanggan']}}</font>
								</div>
								<div>
									<font>_______________________</font>
								</div>
							</div>
						</td>
						<td class="text-center">
							<div class="center w-50">
								<div>
									<font><b> Penjual </b></font>
								</div>
								<div class="signature">

								</div>
								<div>
									<font>BMC</font>
								</div>
								<div>
									<font>_______________________</font>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	
		@endforeach
	</div>
</body>
<script>
	window.print();
</script>
</html>