<body class="timeline-body">
    <script>
        $(document).ready(function() {
            $('.fa-picture-o').click(function() {
                $('#postImg').trigger('click')
            })
            $('#file-upload').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#file-upload')[0].files[0].name;
                $(this).prev('label').text(file);
            });
        })
    </script>
    <?php foreach($user as $u): ?>
    <div class="container mt-5" id="editProfileContainer">
        <div class="card p-5">
            <div class="display-4">Edit Profile</div>
            <hr>
            <?php echo form_open('UserController/edit/'.$u['id']) ?>
            <div class="text-left">
                <div class="form-group">
                    <label for="">First Name</label>
                    <input type="text" name="fname" id="" class="form-control col-sm-6" placeholder="" aria-describedby="helpId">
                    <small class="text-danger"><?php echo form_error('fname') ?></small>
                </div>
                <div class="form-group">
                    <label for="">Last Name</label>
                    <input type="text" name="lname" id="" class="form-control col-sm-6" placeholder="" aria-describedby="helpId">
                    <small class="text-danger"><?php echo form_error('lname') ?></small>
                </div>
                <div class="form-group">
                    <label for="">Current Password</label>
                    <input type="password" name="currPass" id="" class="form-control col-sm-6" placeholder="" aria-describedby="helpId">
                    <small class="text-danger"><?php echo form_error('currPass') ?></small>
                </div>
                <div class="form-group">
                    <label for="">New Password</label>
                    <input type="password" name="newPass" id="" class="form-control col-sm-6" placeholder="" aria-describedby="helpId">
                    <small class="text-danger"><?php echo form_error('newPass') ?></small>
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" name="ConfPass" id="" class="form-control col-sm-6" placeholder="" aria-describedby="helpId">
                    <small class="text-danger"><?php echo form_error('ConfPass') ?></small>
                </div>
                <hr>
                <div style="cursor: pointer;">
                    <i class="fa fa-picture-o fa-lg" aria-hidden="true"></i>
                    <label for="file-upload" style="cursor: pointer;">
                        Upload Image
                    </label>
                    <input type="file" id="file-upload" name='userfile' style="display:none;">
                    <small class="text-danger"><?php echo form_error('userfile') ?></small>
                </div>
                <button class="btn btn-light float-right" type="submit">Confirm</button>
            </div>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</body>