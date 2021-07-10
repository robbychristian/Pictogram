<div class="row">
    <div class="col">
        <img src="<?php echo base_url() ?>assets/img/login.png" class="img-fluid" style="min-width: 35rem; min-height: 35rem;">
    </div>
    <div class="col register-bg">
        <div class="display-4 font-weight-bold text-center mt-5 mb-5">Registration Form</div>
        <?php echo form_open() ?>
            <div class="form-group row ml-5 mr-5 mb-5">
                <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-lg">First Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-lg" id="inputPassword">
                </div>
            </div>
            <div class="form-group row ml-5 mr-5 mb-5">
                <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-lg">Last Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-lg" id="inputPassword">
                </div>
            </div>
            <div class="form-group row ml-5 mr-5 mb-5">
                <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-lg">Email Address</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control form-control-lg" id="inputPassword">
                </div>
            </div>
            <div class="form-group row ml-5 mr-5 mb-5">
                <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-lg">Username</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-lg" id="inputPassword">
                </div>
            </div>
            <div class="form-group row ml-5 mr-5 mb-5">
                <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-lg">Password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control form-control-lg" id="inputPassword">
                </div>
            </div>
            <div class="form-group row ml-5 mr-5 mb-5">
                <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-lg">Confirm Password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control form-control-lg" id="inputPassword">
                </div>
            </div>
            <div class="mx-auto submit-btn-container">
                <button type="submit" class="reg-btn">Submit</button>
            </div>
        </form>
    </div>
</div>