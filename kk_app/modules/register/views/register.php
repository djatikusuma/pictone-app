<div class="ui grid">
  <div class="four column row">
        <div class="three wide column">&nbsp;</div>
        <div class="ten wide column ui segment">
            <h2 class="ui header teal aligned center">
                <div class="content">
                    Register
                </div>
            </h2>
            <div class="content">
            <div class="notifs" style="padding-bottom: 20px">
                  <div class="ui icon danger message">
                        <i class="info icon"></i>
                        <div class="content">
                              <?php echo $message;?>
                        </div>
                  </div> 
            </div> 

<?php echo form_open("register", 'class="ui form"');?>

      <div class="field">
            <label for="first_name"><?php echo lang('create_user_fname_label', 'first_name');?></label>
            <?php echo form_input($first_name);?>
      </div>
      <div class="field">
            <label for="last_name"><?php echo lang('create_user_lname_label', 'last_name');?></label>
            <?php echo form_input($last_name);?>
      </div>
      
      <?php
      if($identity_column!=='email') {
          echo '<p>';
          echo lang('create_user_identity_label', 'identity');
          echo '<br />';
          echo form_error('identity');
          echo form_input($identity);
          echo '</p>';
      }
      ?>

      <div class="field">
            <label for="company"><?php echo lang('create_user_company_label', 'company');?></label>
            <?php echo form_input($company);?>
      </div>

      <div class="field">
            <label for="email"><?php echo lang('create_user_email_label', 'email');?></label>
            <?php echo form_input($email);?>
      </div>

      <div class="field">
            <label for="phone"><?php echo lang('create_user_phone_label', 'phone');?></label>
            <?php echo form_input($phone);?>
      </div>

      <div class="field">
            <label for="password"><?php echo lang('create_user_password_label', 'password');?></label>
            <?php echo form_input($password);?>
      </div>

      <div class="field">
            <label for="password_confirm"><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></label>
            <?php echo form_input($password_confirm);?>
      </div>


      <p><?php echo form_submit('submit', lang('create_user_submit_btn'), 'class="ui fluid large blue submit button"');?></p>

<?php echo form_close();?>
            </div>
            </div>
            </div>
            </div>


