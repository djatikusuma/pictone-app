<?php use YoHang88\LetterAvatar\LetterAvatar; $img = new LetterAvatar($user['first_name'].' '.$user['last_name']); ?>

<div class="ui segment">
	<div class="ui items">
  		<div class="item">
   			<div class="ui small circular image">
      			<img src="<?=$img;?>">
    		</div>
    		<div class="content">
      			<h2 class="ui header teal"><?=$user['first_name'].' '.$user['last_name'];?></h2>
      			<div class="description">
        			<p>Telah bergabung sejak <?=date('Y-m-d H:i:s', $user['created_on']);?></p>
      			</div>
      			<div class="extra">
							<h5 class="ui header blue"><i class="icon envelope"></i> Email : <?=$user['email'];?></h5>
							<h5 class="ui header blue"><i class="icon home"></i> Company : <?=$user['company'];?></h5>
      			</div>
      		</div>
    	</div>
  	</div>
</div>

<div class="ui tabular menu" style="background:#eee;color:white">
  		<a href="<?=$this->uri->segment(2)==null ? '#' : base_url('profile');?>" class="<?=$this->uri->segment(2)==null ? 'active' : '';?> item">FEED</a>
 			<a href="<?=$this->uri->segment(2)=='picked' ? '#' : base_url('profile/picked');?>" class="<?=$this->uri->segment(2)=='picked' ? 'active' : '';?> item">PICKED</a>
	</div>
  <?php if(sizeof($galeris) > 0) :?>
  <div class="ui three column doubling stackable masonry grid">
	
	<?php foreach ($galeris as $g):
		  $ext = $this->Post_model->get_user($g->id_user)->row();
		  $avatar = new LetterAvatar($ext->first_name.' '.$ext->last_name);
	?>
	<div class="column">
  		<div class="ui fluid special cards link">
  			<div class="card">
		        <div class="content">
		          <div class="right floated meta timeago" title="<?php echo $g->dibuat; ?>"></div>
		          <img class="ui avatar image" src="<?=$avatar;?>"> <?=$ext->first_name;?>
		        </div>
		        <div class="blurring dimmable image">
			      <div class="ui dimmer">
			        <div class="content">
			          <div class="center">
			            <a style="color: #fff;padding: 30%" href="<?=base_url("galeri_detail/{$g->url_slug}") ?>"><p><?=substr($g->deskripsi, 0, 240);?></p></a>
			          </div>
			        </div>
			      </div>
			      <img src="<?=base_url("kk_uploads/galeri/{$g->file_img}"); ?>">
			    </div>

		        <div class="content">
              <?php $cek = $this->Post_model->read('picked', array('id_user' => $this->session->userdata('user_id'), 'id_galeri' => $g->id_galeri));
                    $c = $this->Post_model->read('picked', array('id_galeri' => $g->id_galeri)); ?>
                    <i class="hand pointer outline icon"></i> <?=$c->num_rows();?>
              <?php if ($this->ion_auth->logged_in()): ?>
                <?php if($cek->num_rows() == 1) : ?>
                        <a href="<?php echo base_url("beranda/unpicked/{$g->id_galeri}"); ?>" class="right floated">
                          Unpicked
                        </a>		
                <?php else: ?>
                        <a href="<?php echo base_url("beranda/picked/{$g->id_galeri}"); ?>" class="right floated">
                          Picked
                        </a> 
                <?php endif; ?>
              <?php endif;?>         
		        </div>
		    <?php if(($g->id_user === $this->session->userdata('user_id')) || ($this->session->userdata('user_id') == 1)) : ?>
		        <div class="content">
		          <span class="right floated">
		            <button class="circular ui icon button teal" data-id="<?=$g->id_galeri; ?>" data-nama="<?=$g->nama; ?>" data-desc="<?=$g->deskripsi; ?>" data-cat="<?=$g->id_kategori; ?>" data-img="<?=base_url("kk_uploads/galeri/{$g->file_img}"); ?>" id="edit-gal">
					  <i class="icon pencil"></i>
					</button>
		          </span>
		          <span class="left floated">
		            <button data-id="<?=$g->id_galeri; ?>" data-title="<?=$g->nama; ?>" id="dl-btn" class="circular ui icon button red">
					  <i class="icon trash"></i>
					</button>
		          </span>
		        </div>
		    <?php endif; ?>
		    </div>
		</div>
  	</div>
	<?php endforeach; ?>

  </div>
  <?php else: ?>
  	<div class="ui fluid segment">
  		Belum ada galeri diunggah
  	</div>
  <?php endif; ?>