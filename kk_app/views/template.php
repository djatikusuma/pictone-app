<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?=base_url('kk_assets/css/');?>semantic.min.css" rel="stylesheet">
    <link href="<?=base_url('kk_assets/css/');?>custom.css" rel="stylesheet">

</head>
<body>

	<div class="ui borderless main menu custom_navbar">
	    <div class="ui container custom_navbar">
	      <a href="<?=base_url('') ?>"><img class="logo" src="<?=base_url('kk_assets/img/');?>_logo.png"></a>
		  <?php if ($this->ion_auth->logged_in()):?>
	      <a href="<?=base_url('/');?>" class="item"><i class="icon home"></i> Home</a>
	      <!-- <a href="#" class="item"><i class="icon tags"></i> Tags</a> -->
	      <a href="#" class="item" id="post"><i class="icon camera"></i> Share</a>
	      <?php echo $this->ion_auth->is_admin() ? '<a href="'.base_url('for_admin').'" class="item"><i class="icon desktop"></i> Admin Panel</a>' : '' ?>
		  <div class="ui fluid right floated item">
		  	
		  		<div class="ui icon input">		 
		  			<form action="<?=base_url('beranda/search'); ?>" method="GET"> 	
					  <input type="text" placeholder="Search..." name="q">
					</form>
				</div>
		  </div>

	      <div class="ui right floated dropdown item" style="color: #fff">
	        <?=$user['first_name'].' '.$user['last_name']; ?> <i class="dropdown icon"></i>
	        <div class="menu">
	          <a href="<?=base_url('pengaturan'); ?>" class="item"><i class="icon settings"></i> Pengaturan</a>
	          <a href="<?=base_url('profile'); ?>" class="item"><i class="icon user"></i> Profile</a>
	          <div class="divider"></div>
	          <a href="<?=base_url('signout'); ?>" class="item"><i class="icon sign out"></i> Logout</a>
	          
	        </div>
	      </div>
	      <?php else: ?>
	      	<div class="ui right floated item">
	      			<a href="#" class="circular ui icon button green" id="signin">
					  <i class="icon sign in"></i>  Sign In
					</a>
					
					<div style="margin-left: 10px"></div>

	      			<a href="#" class="circular ui icon button orange" id="signup">
					  <i class="icon add user"></i>  Sign Up
					</a>
	      	</div>
		  <?php endif; ?>
	    </div>
	</div>

	<div class="ui container">
		<?php if($this->session->flashdata('error') == 1): ?>
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

		<?=$content;?>
	</div>
	
<?php if ($this->ion_auth->logged_in()):?>
	<!-- Modal Khusus User Login -->
	<div class="ui small modal share">
	  <i class="close icon"></i>
	  <div class="header">
	    Share Picture
	  </div>
	  <div class="image content">
	    <div class="ui medium image">
	      <img src="<?=base_url('kk_assets/img/white-image.png');?>" id="showgambar"/>
	    </div>
		
		<form id="form-gal" action="<?=base_url('beranda/store'); ?>" class="ui fluid form" method="POST" enctype="multipart/form-data">
	    <div class="description" style="margin-left: 10px" id="tampil-modal">
	        <div class="ui header">Share you best picture</div>
        	<div class="field" id="upload_pict">
	        	<div class="ui action input">
				  <input type="text" placeholder="Pilih Gambar Terbaik" readonly>
				  <input type="file" name="featured_image" id="inputgambar">
				  <div class="ui icon button">
				    <i class="attach icon"></i>
				  </div>
				</div>
	        </div>

	        <div class="field">
	        	<label for="">Nama Gambar</label>
	        	<input type="text" name="nama" id="nama">
	        </div>

	        <div class="field">
	        	<label for="">Deskripsi Gambar</label>
	        	<textarea name="deskripsi" id="desc" cols="30" rows="10"></textarea>
	        </div>

				<div class="field">
					<label for="">Kategori</label>
					<select name="id_kategori" id="id_kategori">
							<option value="">-- Pilih Kategori --</option>
							<?php foreach ($categories as $c):?>
								<option value="<?=$c->id; ?>"><?=$c->nama; ?></option>
							<?php endforeach; ?>
						</select>
				</div>
				<div class="field">
					<label for="">Tags <small style="color:red">(pisahkan dengan koma " , ")</small></label>
					<select name="tags[]" multiple="" class="ui search fluid dropdown">
						<?php foreach ($tags as $tg) : ?>
							<option value="<?=$tg->nm_tags?>"><?=$tg->nm_tags?></option>
						<?php endforeach; ?>
					</select>
				</div>
	    </div>
	  </div>
	  <div class="actions">
	    <div class="ui red deny button">
	      Cancel
	    </div>
	    <button type="submit" class="ui positive right labeled icon button" id="btn-share">
	      Share Pict
	      <i class="camera icon"></i>
	    </button>
	  </div>
	  </form>
	</div>
	<!-- end user login -->
<?php else:?>
	<!-- Modal Khusus non Login -->
	<div class="ui small modal signin">
	  <i class="close icon"></i>
	  <div class="header">
	    <img class="ui centered medium image" src="<?=base_url('kk_assets/img/'); ?>_logo.png">
	  </div>
	  <div class="content">
	    <div class="description">
	    	<form class="ui form" action="<?=base_url('signin'); ?>" method="post" accept-charset="utf-8">
  				<div class="field">
  					<label for="Username">Username/Email</label>
			        <div class="ui fluid icon input">
					  <input type="text" placeholder="Username/Email" name="identity" required>
					  <i class="user icon"></i>
					</div>
				</div>
				<div class="field">
					<label for="password">Password</label>
					<div class="ui fluid icon input">
					  <input type="password" placeholder="Password" name="password" required>
					  <i class="key icon"></i>
					</div>
				</div>
				<div class="inline field">
				    <div class="ui checkbox">
				      <input type="checkbox" name="remember" value="1"  id="remember" class="hidden">
				      <label>Remember me</label>
				    </div>
				</div>
				<div class="field">
					<button type="submit" name="submit" class="fluid ui inverted blue button"><i class="icon sign in"></i> Sign In</button>
				</div>
			</form>
	    </div>
	  </div>
	</div>

	<!-- pendaftaran modal -->
	<div class="ui small modal signup">
	  <i class="close icon"></i>
	  <div class="header">
	    <img class="ui centered medium image" src="<?=base_url('kk_assets/img/'); ?>_logo.png">
	  </div>
	  <div class="content">
	    <div class="description">
	    	<form class="ui form" action="<?=base_url('signup'); ?>" method="post" accept-charset="utf-8">
			    <div class="field">
				    <label>Nama</label>
				    <div class="two fields">
				      <div class="field">
				        <div class="ui icon input">
						  <input type="text" placeholder="Nama Depan" name="first_name" required>
						  <i class="user icon"></i>
						</div>
				      </div>
				      <div class="field">
				        <div class="ui icon input">
						  <input type="text" placeholder="Nama Belakang" name="last_name" required>
						  <i class="user icon"></i>
						</div>
				      </div>
				    </div>
			    </div>

			    <div class="field">
  					<label for="email">Email</label>
			        <div class="ui fluid icon input">
					  <input type="text" placeholder="Email" name="email" required>
					  <i class="envelope icon"></i>
					</div>
				</div>

				<div class="field">
  					<label for="phone">No Handphone</label>
			        <div class="ui fluid icon input">
					  <input type="text" placeholder="No Handphone" name="phone" required>
					  <i class="phone icon"></i>
					</div>
				</div>

				<div class="field">
  					<label for="password">Password</label>
			        <div class="ui fluid icon input">
					  <input type="password" placeholder="Password" name="password" required>
					  <i class="key icon"></i>
					</div>
				</div>

				<div class="field">
  					<label for="password_confirm">Ulangi Password</label>
			        <div class="ui fluid icon input">
					  <input type="password" placeholder="Ulangi Password" name="password_confirm" required>
					  <i class="key icon"></i>
					</div>
				</div>

				<div class="field">
					<button type="submit" name="submit" class="fluid ui inverted red button"><i class="icon add user"></i> Sign Up</button>
				</div>
			</form>
	    </div>
	  </div>
	</div>
	<!-- end non user login -->
<?php endif; ?>

	<script src="<?=base_url('kk_assets/library/');?>jquery.min.js"></script>
    <script src="<?=base_url('kk_assets/css/');?>semantic.min.js"></script>
    <script src="<?=base_url('kk_assets/library/');?>sweetalert.min.js"></script>
    <script src="<?=base_url('kk_assets/library/');?>jquery.dataTables.min.js"></script>
    <script src="<?=base_url('kk_assets/library/');?>dataTables.semanticui.min.js"></script>
    <script src="<?=base_url('kk_assets/library/');?>jquery.livequery.js"></script>
    <script src="<?=base_url('kk_assets/library/');?>jquery.timeago.js"></script>
    <script id="dsq-count-scr" src="//pictone.disqus.com/count.js" async></script>
		
    <script>
    	// sweet alert
    	$(document).on("click","#dl-btn", function(e){
		  e.preventDefault();
		  var id=$(this).attr("data-id");
		  var post_title = $(this).attr("data-title");
		  var abc = "<?=base_url('beranda/delete/'); ?>"+id;

		    swal({
			  title: "Apakah kamu yakin akan menghapus ini?",
			  text: "Kamu akan menghapus ["+post_title+"]",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			  closeOnConfirm: false,
        	  closeOnCancel: false
			})
			.then((willDelete) => {
			  if (willDelete) {
			    swal("Gambar berhasil dihapus", {
			      icon: "success",
			    });
			    setTimeout(function(){ window.location.href = abc; }, 1000);
			  } else {
			    swal("Hapus Gambar dibatalkan", {
			      icon: "success",
			    });
			  }
			});
		});

		$(document).on("click","#dl-btn-cat", function(e){
		  e.preventDefault();
		  var id=$(this).attr("data-id");
		  var cat_title = $(this).attr("data-title");
		  var abc = "<?=base_url("for_admin/kategori/delete/"); ?>"+id;

		    swal({
			  title: "Apakah kamu yakin akan menghapus ini?",
			  text: "Kamu akan menghapus ["+cat_title+"]",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			  closeOnConfirm: false,
        	  closeOnCancel: false
			})
			.then((willDelete) => {
			  if (willDelete) {
			    swal("Kategori berhasil dihapus", {
			      icon: "success",
			    });
			    setTimeout(function(){ window.location.href = abc; }, 1000);
			  } else {
			    swal("Hapus Kategori dibatalkan", {
			      icon: "success",
			    });
			  }
			});
		});

		$(document).on("click","#dl-btn-user", function(e){
		  e.preventDefault();
		  var id=$(this).attr("data-id");
		  var user_title = $(this).attr("data-title");
		  var abc = "<?=base_url("for_admin/pengguna/delete/"); ?>"+id;

		    swal({
			  title: "Apakah kamu yakin akan menghapus ini?",
			  text: "Kamu akan menghapus ["+user_title+"]",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			  closeOnConfirm: false,
        	  closeOnCancel: false
			})
			.then((willDelete) => {
			  if (willDelete) {
			    swal("Pengguna berhasil dihapus", {
			      icon: "success",
			    });
			    setTimeout(function(){ window.location.href = abc; }, 1000);
			  } else {
			    swal("Hapus Pengguna dibatalkan", {
			      icon: "success",
			    });
			  }
			});
		});

		$(document).on("click","#dl-btn-komentar", function(e){
		  e.preventDefault();
		  var id=$(this).attr("data-id");
		  var user_title = $(this).attr("data-title");
		  var abc = "<?=base_url("beranda/komentar_delete/"); ?>"+id;

		    swal({
			  title: "Apakah kamu yakin akan menghapus ini?",
			  text: "Kamu akan menghapus ["+user_title+"]",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			  closeOnConfirm: false,
        	  closeOnCancel: false
			})
			.then((willDelete) => {
			  if (willDelete) {
			    swal("Komentar berhasil dihapus", {
			      icon: "success",
			    });
			    setTimeout(function(){ window.location.href = abc; }, 1000);
			  } else {
			    swal("Hapus Komentar dibatalkan", {
			      icon: "success",
			    });
			  }
			});
		});


	  $(document)
	    .ready(function() {
	      $('.ui.checkbox')
			  .checkbox()
			;
	      // fix main menu to page on passing
	      $('.main.menu').visibility({
	        type: 'fixed'
	      });

          $('select.dropdown')
		    .dropdown()
		  ;

		  	$('.special.cards .image').dimmer({
			  on: 'hover'
			});
	      
	      /*$('.overlay').visibility({
	        type: 'fixed',
	        offset: 80
	      });*/
			$('.ui.dropdown').dropdown({
				allowAdditions: true,
			});

	      	$("input:text").click(function() {
			  $(this).parent().find("input:file").click();
			});

			$('input:file', '.ui.action.input')
			  .on('change', function(e) {
			    var name = e.target.files[0].name;
			    $('input:text', $(e.target).parent()).val(name);
			});

	      // lazy load images
	      $('.image').visibility({
	        type: 'image',
	        transition: 'vertical flip in',
	        duration: 500
	      });

	      // show dropdown on hover
	      $('.main.menu  .ui.dropdown').dropdown({
	        on: 'hover'
	      });
	    })
	  ;

	$(function(){
		$("#post").click(function(){
			$(".ui.small.modal.share").modal('show');
		});
		$(".ui.small.modal.share").modal({
			closable: true
		});

		// modal login
		$("#signin").click(function(){
			$(".ui.small.modal.signin").modal('show');
		});
		$(".ui.small.modal.signin").modal({
			closable: true
		});

		// modal register
		$("#signup").click(function(){
			$(".ui.small.modal.signup").modal('show');
		});
		$(".ui.small.modal.signup").modal({
			closable: true
		});

		// modal kategori
		$("#kategori").click(function(){
			$(".ui.small.modal.kategori").modal('show');
		});
		$(".ui.small.modal.kategori").modal({
			closable: true
		});

		// modal pengguna
		$("#users").click(function(){
			$(".ui.small.modal.users").modal('show');
		});
		$(".ui.small.modal.users").modal({
			closable: true
		});
	});

	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#showgambar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputgambar").change(function () {
        readURL(this);
    });

    $(document).ready(function() {
	    $('#example').DataTable();
	} );

	// timeago
	$(document).ready(function(){
		$(".timeago").livequery(function() // LiveQuery 
		{
			$(this).timeago(); // Calling Timeago Funtion 
		});
	});

	$(document).on("click", "#edit-cat", function(){
		$(".ui.small.modal.kategori").modal('show');

		var cat_id	=	$(this).data('id');
		var nm		=	$(this).data('nama');
		var dc		=	$(this).data('desc');

		$('.ui.small.modal.kategori #form-cat').attr('action','<?=base_url('for_admin/kategori/update/'); ?>'+cat_id);
		$("#tampil-modal #nama").val(nm);
		$("#tampil-modal #desc").val(dc);
		$("#tampil-modal #btn-modal").text('Update Kategori');
	});

	$(document).on("click", "#edit-user", function(){
		$(".ui.small.modal.users").modal('show');

		var user_id =	$(this).data('id');
		var fnm     =	$(this).data('first_name');
		var lnm     =	$(this).data('last_name');
		var phone   =	$(this).data('phone');
		var email   =	$(this).data('email');

		$('.ui.small.modal.users #form-user').attr('action','<?=base_url('for_admin/pengguna/update/'); ?>'+user_id);
		$("#tampil-modal #first_name").val(fnm);
		$("#tampil-modal #password").text('Password (Jika diubah)');
		$("#tampil-modal #last_name").val(lnm);
		$("#tampil-modal #phone").val(phone);
		$("#tampil-modal #email").val(email);
		$("#tampil-modal #btn-modal").text('Update Pengguna');
	});

	$(document).on("click", "#set-user", function(){
		$(".ui.small.modal.users").modal('show');

		var user_id =	$(this).data('id');
		var fnm     =	$(this).data('first_name');
		var lnm     =	$(this).data('last_name');
		var phone   =	$(this).data('phone');
		var email   =	$(this).data('email');

		$('.ui.small.modal.users #form-user').attr('action','<?=base_url('pengaturan/update/'); ?>'+user_id);
		$("#tampil-modal #first_name").val(fnm);
		$("#tampil-modal #password").text('Password (Jika diubah)');
		$("#tampil-modal #last_name").val(lnm);
		$("#tampil-modal #phone").val(phone);
		$("#tampil-modal #email").val(email);
		$("#tampil-modal #btn-modal").text('Perbarui');
	});

	$(document).on("click", "#edit-gal", function(){
		$(".ui.small.modal.share").modal('show');

		var gal_id	=	$(this).data('id');
		var nm		=	$(this).data('nama');
		var dc		=	$(this).data('desc');
		var img 	=   $(this).data('img');
		var cat 	=   $(this).data('cat');

		$('.ui.small.modal.share #form-gal').attr('action','<?=base_url('beranda/update/'); ?>'+gal_id);
		$("#tampil-modal #nama").val(nm);
		$("#tampil-modal #desc").val(dc);
		$("#tampil-modal #id_kategori").val(cat);
		$("#showgambar").attr('src',img);
		$('#upload_pict').remove();
		$(".actions #btn-share").text('Update Pict');
	});
	//disqus
	(function() { // DON'T EDIT BELOW THIS LINE
	    var d = document, s = d.createElement('script');
	    s.src = '//pictone.disqus.com/embed.js';
	    s.setAttribute('data-timestamp', +new Date());
	    (d.head || d.body).appendChild(s);
	})();
	
	//  angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
    $(document).ready(function(){setTimeout(function(){$(".notifs").fadeIn('slow');}, 300);});
  	//  angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
    setTimeout(function(){$(".notifs").fadeOut('slow');}, 3000);

	  </script>
</body>
</html>