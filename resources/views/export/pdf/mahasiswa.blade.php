<h3>Data Mahasiswa</h3>
<br>
<br>
<table border="1" width="100%" style="border-collapse: collapse;">
	<tr>
		<th>KODE MAHASISWA</th>
		<th>NAMA LENGKAP</th>
		<th>JENIS KELAMIN</th>
		<th>AVG NILAI</th>
	</tr>
	@foreach ($data as $key)
		<tr>
			<td>{{$key->mhs_code}}</td>
			<td>{{$key->mhs_nama}}</td>
			<td>{{$key->mhs_kelamin}}</td>
			<td>{{$key->rata2nilai()}}</td>
		</tr>
	@endforeach
</table>