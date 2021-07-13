<body class="timeline-body">
    <?php if ($posts == 0) : ?>
        <div class="card container mt-5">
            <div class="card-body text-center">
                <h4 class="card-title">Nothing to display here</h4>
                <p class="card-text">Post an image for everyone to show!</p>
            </div>
        </div>
    <?php else : ?>
        <?php foreach ($posts as $post) : ?>
            <div class="container bg-white mt-5 mb-5">
                <div class="mx-auto" style="width: 55rem; height: 100%; min-width: 30rem; min-height: 30rem;">
                    <img src="<?php echo base_url() ?>assets/post/<?php echo $post->post_img ?>" style="height: 100vh;" class="img-fluid" alt="">
                </div>
                <div class="post-caption text-dark bg-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <img src="<?php echo base_url() ?>assets/avatar/<?php echo $post->user_avatar ?>" class="card img-fluid rounded-circle" alt="">
                            </div>
                            <div class="col-sm-3">
                                <div class="h6 ml-n4"><?php echo $post->first_name . ' ' . $post->last_name ?></div>
                                <a href="<?php echo base_url() ?>index.php/profile/<?php echo $post->user_id ?>"><small class="card-title mt-3 ml-n4">@<?php echo $post->post_user ?></small></a>
                                <span class="badge badge-light ml-2"><?php echo $post->created_at; ?></span>
                            </div>
                        </div>
                        <p class="card-text"><?php echo $post->post_caption ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <a href="<?php echo base_url() ?>index.php/post">
        <div class="post-icon-bg" data-toggle="modal" data-target="#postId">
            <div class="position-fixed" style="bottom: 4rem; right: 7rem;">
                <i class="fa fa-pencil fa-2x" aria-hidden="true"></i>
            </div>
        </div>
    </a>
</body>