<?php use YoHang88\LetterAvatar\LetterAvatar; ?>
<?php if ($this->ion_auth->logged_in()):?>
	<div class="ui container main">
		<form action="<?=base_url('beranda/filter')?>" method="POST">
			<div class="ui form">
			  <div class="fields">
			    <div class="field">
				    <label>Minat Kategori</label>
				    <select multiple="" name="filter[]" class="ui dropdown">
				      <option value="">-- Pilih Kategori --</option>
				      <?php foreach ($categories as $c):?>
				      	<option value="<?=$c->id; ?>"
							<?php for ($i=0; $i < sizeof($f); $i++) { 
								if ($c->id === $f[$i]->id_kategori)
									echo "selected";
							}  ?>
				      		><?=$c->nama; ?></option>
				      <?php endforeach; ?>
				    </select>
				</div>

				<div class="field">
				    <label>&nbsp;</label>
					<button class="circular ui icon button purple">
					  <i class="icon filter"></i> Filter
					</button>
				</div>
			  </div>
			</div>
		</form>
	</div>
<?php endif; ?>
 
 <div class="ui grid">
	 <div class="three wide column">
			<div class="ui segment">
						<p class="ui center aligned"><b>TRENDING TAGS</b></p>
						
						<div class="ui divided selection list">
						<?php $wn = array('red','blue','yellow','green','purple','violet','brown','pink','olive','teal');
						 foreach ($trend as $tg) : ?>
							<a class="item" href="<?=base_url("beranda/tag?q=".slug($tg->nm_tags))?>">
								<div class="ui <?=$wn[mt_rand(0, count($wn)-1)]?> horizontal label left aligned"><?=$tg->nm_tags?></div>
								<br><?=$tg->jml_tags?> gambar
							</a>
						<?php endforeach; ?>
						</div>
			</div>
	 </div>
	 <div class="thirteen wide column">
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
			            <a style="color: #fff;padding: 30%" href="<?=base_url("galeri_detail/{$g->url_slug}") ?>"><p><?=substr($g->deskripsi, 0, 100);?></p></a>
			          </div>
			        </div>
			      </div>
			      <img src="<?=base_url("kk_uploads/galeri/{$g->file_img}"); ?>">
			    </div>

					<div class="content">
						<?php $cek = $this->Post_model->read('picked', array('id_user' => $this->session->userdata('user_id'), 'id_galeri' => $g->id));
									$c = $this->Post_model->read('picked', array('id_galeri' => $g->id)); ?>
									<i class="hand pointer outline icon"></i> <?=$c->num_rows();?>
						<?php if ($this->ion_auth->logged_in()): ?>
							<?php if($cek->num_rows() == 1) : ?>
										<a href="<?php echo base_url("beranda/unpicked/{$g->id}"); ?>" class="right floated">
											Unpicked
										</a>		
							<?php else: ?>
										<a href="<?php echo base_url("beranda/picked/{$g->id}"); ?>" class="right floated">
											Picked
										</a> 
							<?php endif; ?>         
						<?php endif; ?>         
					</div>
		    <?php if(($g->id_user === $this->session->userdata('user_id')) || ($this->session->userdata('user_id') == 1)) : ?>
		        <div class="content">
		          <span class="right floated">
		            <button class="circular ui icon button teal" data-id="<?=$g->id; ?>" data-nama="<?=$g->nama; ?>" data-desc="<?=$g->deskripsi; ?>" data-cat="<?=$g->id_kategori; ?>" data-img="<?=base_url("kk_uploads/galeri/{$g->file_img}"); ?>" id="edit-gal">
					  <i class="icon pencil"></i>
					</button>
		          </span>
		          <span class="left floated">
		            <button data-id="<?=$g->id; ?>" data-title="<?=$g->nama; ?>" id="dl-btn" class="circular ui icon button red">
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
	 </div>
 </div>


  