<?php use YoHang88\LetterAvatar\LetterAvatar; ?>

	
	<?php 
		  $avatar = new LetterAvatar($user['first_name'].' '.$user['last_name']);
	?>
	<div class="ui grid">
  	<div class="four column row">
        <div class="three wide column">&nbsp;</div>
        <div class="ten wide column ui segment">
            <h2 class="ui header teal aligned center">
                <div class="content">
                    Pengaturan 
                </div>
            </h2>
            <div class="content">
								<img class="ui small circular centered image" src="<?=$avatar;?>">
								<div class="ui header lime aligned centered">
									<div class="content">
										<a id="set-user" href="#" data-id="<?=$user['id'] ?>" data-email="<?=$user['email'] ?>" data-first_name="<?=$user['first_name'] ?>" data-last_name="<?=$user['last_name'] ?>" data-phone="<?=$user['phone'] ?>">
											Ubah Profil</a>
									</div>
								</div>
							<div class="ui celled list">
							<div class="item">
								<div class="content">
									<div class="header">Nama Lengkap</div>
									<?=$user['first_name'].' '.$user['last_name'];?>
								</div>
							</div>
							<div class="item">
								<div class="content">
									<div class="header">Email</div>
									<?=$user['email'];?>
								</div>
							</div>
							<div class="item">
								<div class="content">
									<div class="header">Nomor Telephone</div>
									<?=$user['phone'];?>
								</div>
							</div>
							<div class="item">
								<div class="content">
									<div class="header">Company</div>
									<?=$user['company'];?>
								</div>
							</div>
						</div>
						</div>	
				</div>
		</div>
	</div>

	<div class="ui small modal users">
  <i class="close icon"></i>
  <div class="header">
   	<h2>UBAH PROFIL</h2>
  </div>
  <div class="content">
    <div class="description" id="tampil-modal">
    	<form class="ui form" id="form-user" action="" method="post" accept-charset="utf-8">
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