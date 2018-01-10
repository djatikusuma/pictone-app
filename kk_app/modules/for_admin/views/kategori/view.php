<div class="ui two column doubling stackable grid">

	<div class="four wide column">
		<div class="ui stacked segments">
			<div class="ui segment">
				<p><i class="icon tags"></i> Kategori</p>
			</div>
			<div class="ui segment">
				<a href="<?php echo base_url('for_admin/pengguna'); ?>"><p><i class="icon user"></i> User</p></a>
			</div>
		</div>
	</div>
	<div class="twelve wide column">
		<div class="ui segments">
			<div class="ui purple segment">
				<h2 class="ui left floated header">Manajemen Kategori</h2>
				<div class="ui right floated">
					<a class="circular ui icon button green" href="#" id="kategori">
					  <i class="icon plus"></i> Tambah
					</a>
				</div>
  				<div class="ui clearing divider"></div>
				
				<table id="example" class="ui celled table" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th>NO</th>
			                <th>KATEGORI</th>
			                <th>DESKRIPSI</th>
			                <th>DIBUAT</th>
			                <th width="15%">AKSI</th>
			            </tr>
			        </thead>
			        <tfoot>
			            <tr>
			                <th>NO</th>
			                <th>KATEGORI</th>
			                <th>DESKRIPSI</th>
			                <th>DIBUAT</th>
			                <th>AKSI</th>
			            </tr>
			        </tfoot>
			        <tbody>
			        <?php $i=1; foreach ($categories as $c):?>
			            <tr>
			                <td><?=$i ?></td>
			                <td><?=$c->nama ?></td>
			                <td><?=$c->deskripsi ?></td>
			                <td class="timeago" title="<?php echo $c->dibuat; ?>"></td>
			                <td class="ui center aligned">
								<button class="circular ui icon tiny button teal" id="edit-cat" data-id="<?=$c->id ?>" data-nama="<?=$c->nama ?>" data-desc="<?=$c->deskripsi ?>">
								  <i class="icon pencil"></i>
								</button>

								<button data-id="<?=$c->id; ?>" data-title="<?=$c->nama; ?>" id="dl-btn-cat" class="circular ui icon tiny button red">
								  <i class="icon trash"></i>
								</button>
			                </td>
			            </tr>
			        <?php $i++; endforeach; ?>
			        </tbody>
			    </table>

			</div>
		</div>
	</div>

</div>

<div class="ui small modal kategori">
  <i class="close icon"></i>
  <div class="header">
   	<h2>MANAJEMEN KATEGORI</h2>
  </div>
  <div class="content">
    <div class="description" id="tampil-modal">
    	<form class="ui form" id="form-cat" action="<?=base_url('for_admin/kategori/store'); ?>" method="post" accept-charset="utf-8">
			<div class="field">
				<label for="Kategori">Kategori</label>
				 <input type="text" placeholder="Nama Kategori" name="nama" id="nama" required>
			</div>
			<div class="field">
				<label for="Deskripsi">Deskripsi</label>
				<textarea name="deskripsi" id="desc" cols="30" rows="10" placeholder="Deskripsi Kategori"></textarea>
			</div>
			<div class="field">
				<button type="submit" name="submit" class="ui inverted green button" id="btn-modal">Tambah Kategori</button>
			</div>
		</form>
    </div>
  </div>
</div>