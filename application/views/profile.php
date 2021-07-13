<body class='timeline-body'>
    <?php foreach ($user as $u) : ?>
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <br><br><br>
                </div>
                <img class="card-img-top img-fluid rounded-circle mt-n5 ml-5 card" src="<?php echo base_url(); ?>assets/avatar/noimage.jpg" alt="" style="width: 150px; height: 150px;">
                <div class="card-body ml-5 ">
                    <div class="mt-3">
                        <h4 class="card-title"><?php echo $u['first_name'] . ' ' . $u['last_name'] ?></h4>
                        <p class="card-text">@<?php echo $u['user_name'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="container mt-5">
        <?php if ($posts == 0) : ?>
            <div class="card p-5">
                <div class="display-4">Uploaded Photos</div>
                <hr>
                <img class="card-img-top" src="holder.js/100x180/" alt="">
                <div class="card-body text-center">
                    <h4 class="card-title">Nothing to display</h4>
                    <p class="card-text">This user has not uploaded anything yet!</p>
                </div>
            </div>
        <?php else : ?>
            <div class="card p-5">
                <div class="card-title">
                    <div class="display-4">Uploaded Photos</div>
                </div>
                <hr>
                <div class="row row-cols-4 mt-5">
                    <?php foreach ($posts as $post) : ?>
                        <div class="col">
                            <div class="card post-profile" data-toggle="modal" data-target="#id<?php echo $post->id ?>">
                                <img class="card-img-top" src="<?php echo base_url() ?>assets/post/<?php echo $post->post_img ?>" style="height: 300px; object-fit: cover; min-height: 300px" alt="">
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="mx-auto">
                            <div class="modal fade" id="id<?php echo $post->id ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Post number <?php echo $post->id ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card">
                                                <img src="<?php echo base_url() ?>assets/post/<?php echo $post->post_img ?>" class="img-fluid" alt="">
                                                <div class="card-body">
                                                    <p class="card-text"><?php echo $post->post_caption ?></p>
                                                </div>
                                            </div>
                                            <?php if($_SESSION['uname'] == $post->post_user): ?>
                                            <div class="float-right">
                                                <?php echo form_open('PostController/delete/'.$post->id.'/'.$_SESSION['id'].'/'.$post->post_img) ?>
                                                    <button type="submit" class="btn btn-danger">Delete Post</button>
                                                </form>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>