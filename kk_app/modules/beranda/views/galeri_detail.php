<?php use YoHang88\LetterAvatar\LetterAvatar;
	$ext = $this->Post_model->get_user($galeri['id_user'])->row();
  $avatar = new LetterAvatar($ext->first_name.' '.$ext->last_name);
  $this->Post_model->viewer('galeri', array('viewer' => (int)$galeri['viewer']+1), array('id' => $galeri['id']));
?>
<div class="ui grid">
  <div class="four column row">
    <div class="three wide column">&nbsp;</div>
    <div class="ten wide column ui clearing segment">
		<h2 class="ui header center aligned">
			<?=$galeri['nama'] ?>
		</h2>
		<div class="content">
			<img class="ui fluid image rounded" src="<?=base_url("kk_uploads/galeri/{$galeri['file_img']}") ?>">
		</div>
		<div class="ui clearing divider"></div>
    <span class="ui left floated text"><img class="ui avatar image" src="<?=$avatar;?>"> <b><?=$ext->first_name.' '.$ext->last_name;?></b></span>
   
    <div class="ui right floated button">
      <?php $cek = $this->Post_model->read('picked', array('id_user' => $this->session->userdata('user_id'), 'id_galeri' => $galeri['id']));
            $c = $this->Post_model->read('picked', array('id_galeri' => $galeri['id'])); ?>
            <i class="hand pointer outline icon"></i> <?=$c->num_rows();?>
      <?php if ($this->ion_auth->logged_in()): ?>
        <?php if($cek->num_rows() == 1) : ?>
              <a href="<?php echo base_url("beranda/unpicked/{$galeri['id']}"); ?>" class="right floated">
                Unpicked
              </a>		
        <?php else: ?>
              <a href="<?php echo base_url("beranda/picked/{$galeri['id']}"); ?>" class="right floated">
                Picked
              </a> 
        <?php endif; ?>         
      <?php endif; ?> 
    </div>

    <div class="ui clearing divider"></div>
        <div class="description">
        	<b>
            <h4>
                <?=$galeri['deskripsi'] ?>
            </h4>   
          </b>

          <p>
            <?php $wn = array('red','blue','yellow','green','purple','violet','brown','pink','olive','teal');
                    if(!empty($get_tags)) : ?>
              <?php $sp = explode(",", $get_tags);
                    foreach ($sp as $tag) : ?>
                    <a href="<?=base_url("beranda/tag?q=".slug($tag))?>">
                      <div class="ui <?=$wn[mt_rand(0, count($wn)-1)]?> horizontal label"><?=$tag?></div>
                    </a>
              <?php endforeach; ?>
            <?php endif; ?>
          </p>
        </div>
        
          <h4 class="ui horizontal divider header">
            <i class="comments icon"></i>
            Komentar
          </h4>
            <!-- <div class="description">
                <div id="disqus_thread"></div>
            </div> -->

          <?php foreach ($get_komentar as $kom) : 
              $img = new LetterAvatar($kom->nama_lengkap);?>
            <div class="ui threaded comments">
              <div class="comment">
                <a class="avatar">
                  <img src="<?=$img;?>">
                </a>
                <div class="content">
                  <span class="author"><?=$kom->nama_lengkap;?></span>
                  <div class="metadata">
                    <div class="date timeago" title="<?=$kom->tanggal; ?>"></div>
                    
                    <?php if($kom->id_user == $this->session->userdata('user_id') || ($this->session->userdata('user_id') == 1)):?>
                      <span class="author float right">
                        <button id="dl-btn-komentar" data-id="<?=$kom->id_kom;?>" data-title="<?=$kom->teks_komentar;?>" class="circular ui icon button red tiny">X</button>
                      </span>
                    <?php endif;?>
                  </div>
                  <div class="text">
                    <p><?=$kom->teks_komentar; ?></p>
                  </div>
                  <!-- <div class="actions">
                    <a class="reply">Reply</a>
                  </div> -->
                </div>
              </div>
            </div>
          <?php endforeach;?>
        <?php if ($this->ion_auth->logged_in()) : ?>
            <?php if(count($get_komentar) < 1) : ?>
              <div class="description">
                  <div class="ui success message">
                    <div class="header">
                      Jadi yang pertama memberikan komentar apresiasi :) 
                    </div>
                  </div>
              </div>
              <br><br>
            <?php endif; ?>
            
            <form class="ui form" method="POST" action="<?=base_url("beranda/komentar_post") ?>">
              <input type="hidden" name="id_galeri" value="<?=$galeri['id'] ?>">
              <input type="hidden" name="url_slug" value="<?=$galeri['url_slug'] ?>">
              <div class="field">
                <textarea name="teks_komentar" id="teks_komentar" cols="30" rows="2"></textarea>
              </div>
              <button type="submit" class="ui primary submit labeled icon button">
                <i class="icon edit"></i> Kirim Komentar
              </button>
            </form>
        <?php else: ?>
            <div class="description">
                <div class="ui warning message">
                  <div class="header">
                    Kamu harus Sign In/Sign Up untuk bisa berkomentar!
                  </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
  </div>
</div>