<?php
/**
 * Created by PhpStorm.
 * User: jaidis
 * Date: 29/04/18
 * Time: 17:54
 */
?>
<div class="container-fluid p-0">
    <div class="row bg-main m-0 p-0">
        <div class="offset-1 col-10 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8 my-5">
            <div class="list-group">
                <?php
                foreach ($news as $new):
                    ?>
                    <a href="/noticia/<?php echo $new->id ."/".$new->url;?>" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="img-div">
                            <img class="img-thumbnail img-news" src="/assets/img/news/<?php echo ($new->image_url != null) ? $new->image_url : 'not-found-1024-768.jpg'; ?>" alt="">
                        </div>
                        <div>
                            <div class="d-flex justify-content-between">
                                <h3 class="text-primary text-title"><?php echo $new->title;?></h3>
                            </div>
                            <p class="mb-1 lead text-primary d-none d-xl-flex"><?php echo $new->subtitle;?></p>
                            <p class="text-muted mt-2 text-left"><?php echo $new->fecha; ?></p>
                        </div>
                    </a>
                <?php
                endforeach;
                ?>
            </div>
            <div class="col-12 text-center mt-5">
                <?php echo $pagination ?>
            </div>
        </div>
    </div>
</div>


