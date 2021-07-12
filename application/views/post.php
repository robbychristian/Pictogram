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
    <div class="container mt-5">
        <div class="card">
            <div class="row">
                <div class="col">
                    <div class="card-header">
                        <img class="card-img-top" src="<?php echo base_url() ?>assets/img/post.png" style="height: 45vh; object-fit: cover; object-position: 0 50%" alt="">
                    </div>
                </div>
                <div class="col">
                    <div class="card-body">
                        <?php echo form_open_multipart('PostController/create') ?>
                        <div class="form-group">
                            <label for="">@<?php echo $_SESSION['uname']; ?></label>
                            <textarea name="postbody" id="body" cols="30" class="form-control" rows="10" style="resize:none"></textarea>
                            <div class="row">
                                <div class="col"><small class='text-muted'>255 Character Limit</small></div>
                                <div class="col"><small class='text-danger'><?php echo form_error('postbody') ?></small></div>
                            </div>
                            <hr>
                            <div class="custom-file-upload">
                                <i class="fa fa-picture-o fa-lg" aria-hidden="true"></i>
                                <label for="file-upload">
                                    Upload Image
                                </label>
                                <input type="file" id="file-upload" name='userfile' style="display:none;">
                            </div>
                            <small class='text-danger'><?php echo form_error('userfile') ?></small>
                            <div class="row">
                                <div class="col-9">

                                </div>
                                <div class="col-3" style="margin-top: -2.2rem">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>