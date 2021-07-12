<body class="timeline-body">
    <?php foreach($posts as $post): ?>
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
                    <div class="col-sm-1">
                        <h5 class="card-title mt-3 ml-n4">@<?php echo $post->post_user ?></h5>
                    </div>
                    <div class="col-sm-10 mt-3 ml-n4"><a href="#" class="badge badge-light"><?php echo $post->created_at ?></a></div>
                </div>
                <p class="card-text">Feeling motivated</p>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <a href="<?php echo base_url() ?>index.php/post">
        <div class="post-icon-bg" data-toggle="modal" data-target="#postId">
            <div class="position-fixed" style="bottom: 4rem; right: 7rem;">
                <i class="fa fa-pencil fa-2x" aria-hidden="true"></i>
            </div>
        </div>
    </a>
</body>