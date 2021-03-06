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
            <div class="row p-0">
                <?php
                foreach ($monuments as $key => $monument):
                    ?>
                    <div class="col-md-6 col-xl-4 mt-4 ">
                        <a href="/monumento/<?php echo $monument->id ."/".$monument->url;?>" class="card-url">
                            <div class="card card-monument bg-primary text-white mb-4 border-success">
                            <div class="card-img-block">
                                <img class="card-img-top" src="/assets/img/monuments/<?php echo ($monument->image_url != null) ? $monument->image_url : 'not-found-1024-768.jpg'; ?>" alt="Card image cap">
                            </div>
                            <div class="card-body pt-0 ">
                                <h4 class="card-title mt-4"><?php echo $monument->name;?></h4>
                            </div>
                        </div>
                        </a>
                    </div>
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


