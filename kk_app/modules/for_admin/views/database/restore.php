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
				<a href="<?php echo base_url('for_admin/pengguna'); ?>"><p><i class="icon user"></i> User</p></a>
			</div>
            <div class="ui segment">
				<p><i class="icon book"></i> Database</p>
			</div>
		</div>
	</div>
	<div class="twelve wide column">
		<div class="ui segments">
			<div class="ui purple segment">
				<h2 class="ui left floated header">Manajemen Database</h2>
  				<div class="ui clearing divider"></div>
				
                    <?php if($this->session->flashdata('dberror') == 1): ?>
                        <div class="notifs" style="padding-bottom: 20px">
                            <div class="ui icon <?php echo $this->session->flashdata('alert'); ?> message">
                                <i class="<?php echo $this->session->flashdata('icon'); ?> icon"></i>
                                <div class="content">
                                    <div class="header">
                                        <?php echo $this->session->flashdata('msg') ?>
                                    </div>
                                </div>
                            </div> 
                        </div>     
                    <?php endif; ?>

                    <h4>Restore Database Pictone</h4>
                    <a id="restore" href="#" class="circular ui icon button orange fluid">
                        Restore
                    </a>            
                </div>

			</div>
		</div>
	</div>

</div>

<!-- Modal Khusus User Login -->
<div class="ui small modal restore">
  <i class="close icon"></i>
  <div class="header">
   	<h2>MANAJEMEN PENGGUNA</h2>
  </div>
  <div class="content">
    <div class="description" id="tampil-modal">
    	<form class="ui form" id="form-restore" 
                action="<?=base_url('for_admin/database/restore'); ?>" 
                method="post" enctype="multipart/form-data">
			    <div class="field" id="upload_pict">
                    <div class="ui action input">
                        <input type="text" placeholder="Pilih File SQL" readonly>
                        <input type="file" name="datafile">
                        <div class="ui icon button">
                            <i class="attach icon"></i>
                        </div>
                    </div>
                </div>

				<div class="field">
					<button type="submit" name="submit" class="ui inverted red button" id="btn-modal">Restore</button>
				</div>
		</form>
    </div>
  </div>
</div>