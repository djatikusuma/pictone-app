<div class="ui two column doubling stackable grid">

	<div class="four wide column">
		<div class="ui stacked segments">
			<div class="ui segment">
				<a href="<?php echo base_url('for_admin'); ?>"><p><i class="icon industry"></i> Statistik</p></a>
			</div>
			<div class="ui segment">
				<a href="<?php echo base_url('for_admin/kategori'); ?>"><p><i class="icon tags"></i> Kategori</p></a>
			</div>
			<div class="ui segment">
				<p><i class="icon user"></i> User</p>
			</div>
			<div class="ui segment">
				<a href="<?php echo base_url('for_admin/database'); ?>"><p><i class="icon book"></i> Database</p></a>
			</div>
		</div>
	</div>
	<div class="twelve wide column">
		<div class="ui segments">
			<div class="ui purple segment">
				<h2 class="ui left floated header">Manajemen Pengguna</h2>
				<div class="ui right floated">
					<a class="circular ui icon button green" href="#" id="users">
					  <i class="icon plus"></i> Tambah
					</a>
				</div>
  				<div class="ui clearing divider"></div>
				
				<table id="example" class="ui celled table" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th>NO</th>
			                <th>EMAIL</th>
			                <th>NAMA</th>
			                <th>TERAKHIR SIGNIN</th>
			                <th>STATUS</th>
			                <th width="15%">AKSI</th>
			            </tr>
			        </thead>
			        <tfoot>
			            <tr>
			                <th>NO</th>
			                <th>EMAIL</th>
			                <th>NAMA</th>
			                <th>TERAKHIR SIGNIN</th>
			                <th>STATUS</th>
			                <th width="15%">AKSI</th>
			            </tr>
			        </tfoot>
			        <tbody>
			        <?php $i=1; foreach ($users as $u):?>
			            <tr>
			                <td><?=$i ?></td>
			                <td><?=$u->email ?></td>
			                <td><?=$u->first_name.' '.$u->last_name ?></td>
			                <td class="timeago" title="<?php echo $u->last_login!=null ? date('Y-m-d H:i:s', $u->last_login) : 'Belum Login' ?>"></td>
			                <td><?=$u->active == 1 ? '<span class="ui label green">Active</span>' : '<span class="ui label red">Suspend</span>' ?></td>
			                <td class="ui center aligned">
			                <?php if ($u->id != 1) : ?>
								<button class="circular ui icon tiny button teal" id="edit-user" data-id="<?=$u->id ?>" data-email="<?=$u->email ?>" data-first_name="<?=$u->first_name ?>" data-last_name="<?=$u->last_name ?>" data-phone="<?=$u->phone ?>">
								  <i class="icon pencil"></i>
								</button>

								<button data-id="<?=$u->id; ?>" data-title="<?=$u->username; ?>" id="dl-btn-user" class="circular ui icon tiny button red">
								  <i class="icon trash"></i>
								</button>
							<?php endif; ?>
			                </td>
			            </tr>
			        <?php $i++; endforeach; ?>
			        </tbody>
			    </table>

			</div>
		</div>
	</div>

</div>

<div class="ui small modal users">
  <i class="close icon"></i>
  <div class="header">
   	<h2>MANAJEMEN PENGGUNA</h2>
  </div>
  <div class="content">
    <div class="description" id="tampil-modal">
    	<form class="ui form" id="form-user" action="<?=base_url('for_admin/pengguna/store'); ?>" method="post" accept-charset="utf-8">
			    <div class="field">
				    <label>Nama</label>
				    <div class="two fields">
				      <div class="field">
				        <div class="ui icon input">
						  <input type="text" placeholder="Nama Depan" id="first_name" name="first_name" required>
						  <i class="user icon"></i>
						</div>
				      </div>
				      <div class="field">
				        <div class="ui icon input">
						  <input type="text" placeholder="Nama Belakang" id="last_name" name="last_name" required>
						  <i class="user icon"></i>
						</div>
				      </div>
				    </div>
			    </div>

			    <div class="field">
  					<label for="email">Email</label>
			        <div class="ui fluid icon input">
					  <input type="text" placeholder="Email" id="email" name="email" required>
					  <i class="envelope icon"></i>
					</div>
				</div>

				<div class="field">
  					<label for="phone">No Handphone</label>
			        <div class="ui fluid icon input">
					  <input type="text" placeholder="No Handphone" id="phone" name="phone" required>
					  <i class="phone icon"></i>
					</div>
				</div>

				<div class="field">
  					<label for="password" id="password">Password</label>
			        <div class="ui fluid icon input">
					  <input type="password" placeholder="Password" name="password">
					  <i class="key icon"></i>
					</div>
				</div>

				<div class="field">
					<button type="submit" name="submit" class="ui inverted red button" id="btn-modal">Tambah</button>
				</div>
			</form>
    </div>
  </div>
</div>