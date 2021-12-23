<?php
if(isset($_REQUEST['key']))
    $_SESSION['activation_key'] = $_REQUEST['key'];
?>

<!-- Left Panel Start -->
<div class="">


    <div class="panel-box text">
        <div class="title-font line">ProNoor Directory Password Reset</div>
        <form action="process.php" method="post" name="frm-login" class="form-horizontal">
            <input type="hidden" name="action" value="change_pass">
            <?php if ($_REQUEST['msg'] == "regsucess") { ?>
                <p><div class="err-msg">
                    Thank you for submitting your information. <br />
                    Please check your email for temporary password. Some times the mail goes to your spam box. <br/>
                    ProNoor Directory Team
                </div></p>
            <?php } ?>

            <div class="form-group">
                <label class="control-label col-xs-4">Password</label>
                <div class="col-xs-6">
                    <input type="password" required class="form-control" name="password" id="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-4">Confirm Password</label>
                <div class="col-xs-6">
                    <input type="password" required class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password">
                </div>
            </div>
            <center>
                <button class="btn btn-md btn-primary" type="submit">Login</button>
            </center>
            <?php if ($_REQUEST['status'] == "no") { ?>
                <br/>
                <center><div class="err-msg">Password are not Matching !!</div></center>
            <?php } ?>
        </form>
    </div>
</div>
<!-- Left Panel End -->
<!-- Right Panel Start -->
<div class="panel-right">
</div>
<!-- Right Panel End -->