<div class="row">
    <div class="col">
        <img src="<?php echo base_url() ?>assets/img/register.png" class="img-fluid" style="min-width: 35rem; min-height: 35rem;">
    </div>
    <div class="col register-bg">
        <?php if (isset($error)) {
            echo $error;
        } ?>
        <div class="row">
            <div class="col">
                <div class="display-4 font-weight-bold text-center mt-5 mb-5">Login Your Account</div>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col mt-5">
                <?php echo form_open('UserController/login') ?>
                <div class="form-group row mt-5 ml-5 mr-5 mb-5">
                    <label for="inputPassword" class="col-lg-3 col-form-label col-form-label-lg mt-5">Username</label>
                    <div class="col-xl-9">
                        <input type="text" class="form-control form-control-lg mt-5" name="uname">
                        <small id="helpId" class="text-danger"><?php echo form_error('uname') ?></small>
                    </div>
                </div>
                <div class="form-group row ml-5 mr-5 mb-5">
                    <label for="inputPassword" class="col-lg-3 col-form-label col-form-label-lg">Password</label>
                    <div class="col-xl-9">
                        <input type="password" class="form-control form-control-lg" name="pass">
                        <small id="helpId" class="text-danger"><?php echo form_error('pass') ?></small>
                    </div>
                </div>
                <div class="mx-auto submit-btn-container">
                    <button type="submit" class="reg-btn">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>