<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CRUD PICTONE</title>
</head>
<body>
	<form action="<?=$this->uri->segment(3) == '' ? base_url('beranda/create') : base_url('beranda/update/'.$id) ?>" method="POST">
		<input type="text" name="nama" value="<?php echo $nama=='' ? '' : $nama; ?>"><br>
		<input type="text" name="deskripsi" value="<?php echo $desc=='' ? '' : $desc; ?>"><br>
		<input type="submit" value="<?=$this->uri->segment(3) == '' ? 'Tambah Kategori' : 'Ubah Kategori' ?>">
		<input type="submit" name="cancel" value="Refresh">
	</form>

	<br><br><br>
	<table border="1">
		<tr>
			<th>ID</th>
			<th>NAMA</th>
			<th>DESKRIPSI</th>
			<th>DIBUAT</th>
			<th>AKSI</th>
		</tr>
		<?php foreach ($row as $r) : ?>
		<tr>
			<td><?=$r->id; ?></td>
			<td><?=$r->nama; ?></td>
			<td><?=$r->deskripsi; ?></td>
			<td><?=$r->dibuat; ?></td>
			<td><?=anchor('beranda/edit/'.$r->id, 'Edit'); ?> | <?=anchor('beranda/delete/'.$r->id, 'Hapus'); ?></td>
		</tr>
		<?php endforeach; ?>
	</table>

</body>
</html> -->