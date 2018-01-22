<div class="ui two column doubling stackable grid">

	<div class="four wide column">
		<div class="ui stacked segments">
            <div class="ui segment">
				<p><i class="icon industry"></i> Statistik</p>
			</div>
			<div class="ui segment">
				<a href="<?php echo base_url('for_admin/kategori'); ?>"><p><i class="icon tags"></i> Kategori</p></a>
			</div>
			<div class="ui segment">
				<a href="<?php echo base_url('for_admin/pengguna'); ?>"><p><i class="icon user"></i> User</p></a>
			</div>
		</div>
	</div>
	<div class="twelve wide column">
		<div class="ui segments">
			<div class="ui purple segment">
				<h2 class="ui left floated header">Statistik Pengguna</h2>
  				<div class="ui clearing divider"></div>

                  <div class="ui two column doubling stackable grid">
                    <div class="eight wide column">
                        <h4>Pengguna Picked Terbanyak</h4>
                        <table class="ui celled table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>PERINGKAT</th>
                                    <th>USER</th>
                                    <th>TOTAL PICKED</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach($getUs as $r):?>
                                <tr>
                                    <td><?=$i;?></td>
                                    <td><?=$r->first_name.' '.$r->last_name;?></td>
                                    <td><?=$r->jml_picked;?> Picked Gambar</td>
                                </tr>
                                <?php $i++; endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="eight wide column">
                        <h4>Gambar dipicked Terbanyak</h4>
                        <table class="ui celled table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>PERINGKAT</th>
                                    <th>GAMBAR</th>
                                    <th>TOTAL PICKED</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach($getPick as $r):?>
                                <tr>
                                    <td><?=$i;?></td>
                                    <td><a href='<?=base_url("galeri_detail/{$r->url_slug}");?>'><?=$r->nama;?></a></td>
                                    <td><?=$r->jml_picked;?> Picked</td>
                                </tr>
                                <?php $i++; endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="eight wide column">
                        <h4>Kategori Terpopuler</h4>
                        <table class="ui celled table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>PERINGKAT</th>
                                    <th>KATEGORI</th>
                                    <th>TOTAL GAMBAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach($getCat as $r):?>
                                <tr>
                                    <td><?=$i;?></td>
                                    <td><?=$r->nama;?></td>
                                    <td><?=$r->jumlah;?> digunakan</td>
                                </tr>
                                <?php $i++; endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="eight wide column">
                        <h4>Gambar Terpopuler</h4>
                        <table class="ui celled table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>PERINGKAT</th>
                                    <th>GAMBAR</th>
                                    <th>TOTAL VIEWER</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach($getImg as $r):?>
                                <tr>
                                    <td><?=$i;?></td>
                                    <td><?=$r->nama;?></td>
                                    <td><?=$r->viewer;?> pengunjung</td>
                                </tr>
                                <?php $i++; endforeach;?>
                            </tbody>
                        </table>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    
    </div>
</div>