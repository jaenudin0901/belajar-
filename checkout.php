<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
	  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>
<body>
	<div class="container">
		<h3>Data Keranjang</h3>
		<table class="table">
			<thead>
				<th>No </th>
				<th>Produk</th>
				<th>Harga</th>
				<th>Total Harga</th>
			</thead>
			<tbody>
				<tr>
					<td>X</td>
					<td>x</td>
					<td>X</td>
					<td>X</td>
				</tr>
			</tbody>
		</table>
		<h3>Alamat</h3>
		<form method="post">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>Provinsi</label>
						<select class="form-control" name="nama_provinsi">
							
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Kota / Kabupaten</label>
						<select class="form-control" name="nama_distrik">
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Ekspedisi</label>
						<select class="form-control" name="nama_ekpedisi">
						
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Paket</label>
						<select class="form-control" name="nama_paket">
						
						</select>
					</div>
				</div>
			</div>
			<input type="text" name="total_berat" value="1200">
			<input type="text" name="provinsi">
			<input type="text" name="distrik">
			<input type="text" name="tipe">
			<input type="text" name="kodepos">
			<input type="text" name="ekpedisi">
			<input type="text" name="paket">
			<input type="text" name="ongkir">
			<input type="text" name="estimasi">
		</form>
	</div>
<!-- <script src="jquery-3.5.1.min.js"></script> -->

 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script>
	$(document).ready(function(){
		$.ajax({
			type:'post',
			url:'dataprovinsi.php',
			success:function(hasil_provinsi)
			{
				 $("select[name=nama_provinsi]").html(hasil_provinsi);
			}
		});
				$("select[name=nama_provinsi]").on("change", function(){
					// ambil id provinsi yang di pilih dari atribut pribadi
					var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
					$.ajax({
						type:'post',
						url:'datadistrik.php',
						data:'id_provinsi='+id_provinsi_terpilih,
						success:function(hasil_kota)
						{
							$("select[name=nama_distrik]").html(hasil_kota);
						}
					});
			});
		
				$.ajax({
					type:'post',
					url:'dataekpedisi.php',
					success:function(hasil_ekpedisi)
					{
						$("select[name=nama_ekpedisi]").html(hasil_ekpedisi);
					}
				});
		
				$("select[name=nama_ekpedisi]").on("change", function(){
					// mendapatkan ongkir  kirim

					// mendapatkan ekpedisi yang diplih
					var ekpedisi_terpilih = $("select[name=nama_ekpedisi").val();
						
					// mendapatkan id kota yang terpilih
					var distrik_terpilih = $("option:selected","select[name=nama_distrik]").attr("id_distrik");
				

					// mwndapatkan total berat inputan
					var total_berat = $("input[name=total_berat]").val();
					$. ajax ({
						type:'post',
						url:'datapaket.php',
						data:'ekpedisi='+ekpedisi_terpilih+'&kota='+distrik_terpilih+'&berat='+total_berat,
						success:function(hasil_paket)
						{
							// console.log(hasil_paket);
							$("select[name=nama_paket]").html(hasil_paket);
							// letakan nama ekpedisi terpilih di input ekpedisi
							$("input[name=ekpedisi]").val(ekpedisi_terpilih);
						}
});
					});
		
					$("select[name=nama_distrik]").on("change", function(){
						var prov   = $("option:selected", this).attr("nama_provinsi");
						var dist   = $("option:selected", this).attr("nama_distrik");
						var tipe   = $("option:selected", this).attr("tipe");
						var kodepos = $("option:selected", this).attr("kodepos");
						
						$("input[name=provinsi]").val(prov);
						$("input[name=distrik]").val(dist);
						$("input[name=tipe]").val(tipe);
						$("input[name=kodepos]").val(kodepos);
					});
		

					$("select[name=nama_paket]").on("change", function(){
						// var service = $("option:selected", this).attr("service");
						var paket = $("option:selected", this).attr("paket");
						var ongkir = $("option:selected", this).attr("ongkir");
						var etd = $("option:selected", this).attr("etd");
						
						$("input[name=paket]").val(paket);
						$("input[name=ongkir]").val(ongkir);
						$("input[name=estimasi]").val(etd);
					});
				});
</script>
</body>
</html>