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
        <!--        <div class="col-12 offset-xl-2 col-xl-8 p-0">-->
        <div class="col-12 p-0">
            <div class="jumbotron bg-jumbotron-province m-0">
                <h1 class="center-titles special-title animated py-5"><?php echo $province->name ?></h1>
            </div>
        </div>
        <div class="col-12 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8">
            <h1 class="center-titles special-title my-5 mx-3">Información sobre <?php echo $province->name ?></h1>
        </div>
        <div class="offset-1 col-10 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8">
            <div class="jumbotron jumbotron-description">
                <p class="lead text-primary my-0">
                    <?php echo $province->description ?>
                </p>
            </div>
        </div>
        <div class="col-12 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8">
            <a href="/noticias/<?php echo $province->map_code ?>" class="href-special-title"><h1
                        class="center-titles special-title my-5 mx-3">Noticias sobre <?php echo $province->name ?></h1>
            </a>
        </div>
        <?php if (!empty($news)): ?>
        <div class="offset-1 col-10 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8">
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
        </div>
        <?php else: ?>
            <div class="col-12 p-0 offset-md-1 col-md-10 offset-xl-4 col-xl-4 text-center">
                <div class="jumbotron jumbotron-description">
                    <p class="lead text-primary my-0">
                        Sin noticias
                    </p>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-12 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8">
            <a href="/monumentos/<?php echo $province->map_code ?>" class="href-special-title"><h1
                        class="center-titles special-title my-5 mx-3">Monumentos de <?php echo $province->name ?></h1>
            </a>
        </div>
        <?php if (!empty($monuments)): ?>
            <div class="col-12 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8">
                <div id="carouselMonumentos" class="carousel slide" data-ride="carousel" data-interval="10000">
                    <div class="carousel-inner row w-100 mx-auto">
                        <?php foreach ($monuments as $monument): ?>
                            <div class="carousel-item col-md-4">
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
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselMonumentos" role="button" data-slide="prev">
                        <i class="fa fa-4x fa-caret-left text-success pt-4" aria-hidden="true"></i>
                        <span class="sr-only">Previous</span>

                    </a>
                    <a class="carousel-control-next" href="#carouselMonumentos" role="button" data-slide="next">
                        <i class="fa fa-4x fa-caret-right text-success pt-4" aria-hidden="true"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="col-12 p-0 offset-md-1 col-md-10 offset-xl-4 col-xl-4 text-center">
                <div class="jumbotron jumbotron-description">
                    <p class="lead text-primary my-0">
                        Sin monumentos
                    </p>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-12 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8">
            <a href="/gastronomias/<?php echo $province->map_code ?>" class="href-special-title"><h1
                        class="center-titles special-title my-5 mx-3">Gastronomía de <?php echo $province->name ?></h1>
            </a>
        </div>
        <?php if (!empty($gastronomies)): ?>
            <div class="col-12 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8">
                <div id="carouselGastronomia" class="carousel slide" data-ride="carousel" data-interval="10000">
                    <div class="carousel-inner row w-100 mx-auto">
                        <?php foreach ($gastronomies as $gastronomy): ?>
                            <div class="carousel-item col-md-4">
                                <a href="/gastronomia/<?php echo $gastronomy->id ."/".$gastronomy->url;?>" class="card-url">
                                    <div class="card card-gastronomy bg-secondary text-white mb-4 border-primary">
                                        <div class="card-img-block">
                                            <img class="card-img-top" src="/assets/img/gastronomies/<?php echo ($gastronomy->image_url != null) ? $gastronomy->image_url : 'not-found-1024-768.jpg'; ?>" alt="Card image cap">
                                        </div>
                                        <div class="card-body pt-0 ">
                                            <h4 class="card-title mt-4"><?php echo $gastronomy->name;?></h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselGastronomia" role="button" data-slide="prev">
                        <i class="fa fa-4x fa-caret-left text-primary pt-4" aria-hidden="true"></i>
                        <span class="sr-only">Previous</span>

                    </a>
                    <a class="carousel-control-next" href="#carouselGastronomia" role="button" data-slide="next">
                        <i class="fa fa-4x fa-caret-right text-primary pt-4" aria-hidden="true"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="col-12 p-0 offset-md-1 col-md-10 offset-xl-4 col-xl-4 text-center">
                <div class="jumbotron jumbotron-description">
                    <p class="lead text-primary my-0">
                        Sin gastronomia
                    </p>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-12 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8">
            <h1 class="center-titles special-title my-5 mx-3">Galería fotográfica</h1>
        </div>
        <?php if (!empty($galleries)): ?>
        <div class="col-12 p-0 offset-xl-2 col-xl-8">
            <ul class="gridder text-center mb-5">
                <?php foreach ($galleries as $gallery): ?>
                    <li class="gridder-list" data-griddercontent="<?php echo "#" . $gallery->id; ?>">
                        <img src="<?php echo "/assets/img/province/" . $gallery->value_thumb; ?>" class="img-fluid">
                    </li>

                <?php endforeach; ?>
            </ul>

            <?php foreach ($galleries as $gallery): ?>
            <div id="<?php echo $gallery->id; ?>" class="gridder-content py-3">
                <div class="row">
                    <div class="col-xl-7">
                        <img src="/assets/img/province/<?php echo ($gallery->value != null) ? $gallery->value : 'not-found-1024-768.jpg'; ?>" class="img-fluid"/>
                    </div>
                    <div class="col-xl-5 text-left pr-5">
                        <h3><?php echo $gallery->name; ?></h3>
                        <p><?php echo $gallery->description; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 p-0 mb-5 offset-md-1 col-md-10 offset-xl-4 col-xl-4 text-center">
                    <div class="jumbotron jumbotron-description">
                        <p class="lead text-primary my-0">
                            Sin galeria
                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php $provinceValues = json_encode($province);
        echo "<script>var province = $provinceValues</script>";
        ?>
    </div>
</div>


