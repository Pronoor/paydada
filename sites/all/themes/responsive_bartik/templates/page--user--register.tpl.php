
<div style="float:right" class="pronoor_logo"><img src="<?php print $logo; ?>" alt="Paydada Pay" ><span style="
    padding-left: 62px;
">Powered by</span></div>
<div id="auth_box" class="register" style='width:500px'>
  <div id="top_part">
    <h1 id="the_logo">
      <a href="<?php print url('<front>'); ?>">
          Paydada<sub>&trade;</sub>
      </a>
    </h1>
  </div>
 
  <div id="middle_part">
    <h2 class="title"><?php print $title; ?></h2>

    <?php print $messages; ?>
    
    <?php print render($page['content']); ?>
  </div>

  <div id="bottom_part">
    <div class="login_link">
      <?php print l(t('Login'), 'user/login'); ?>
    </div>

    <div class="password_link">
      <?php print l(t('Forgot your password?'), 'user/password'); ?>
    </div>

    <div class="back_link">
      <a href="<?php print url('<front>'); ?>">&larr; <?php print t('Back'); ?> <?php print $site_name; ?></a>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type='text/javascript'>
jQuery(window).load(function() {
	jQuery(".field-phone").insertAfter(".form-item-mail");
	
	
	
    jQuery("#edit-field-ip-und-0-value").val("<?php echo $_SERVER['REMOTE_ADDR'];?>");
 
});
</script>
<style>
.field-house_number,.field-surname_prefix,.field-title{display:none}
#field-ip-add-more-wrapper{display:none}
</style>