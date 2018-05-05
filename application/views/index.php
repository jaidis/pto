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
        <div class="col-12 offset-md-1 col-md-10 py-3">
            <div class="jumbotron bg-jumbotron-main">
<!--<h1 class="display-3 text-white text-center h1-jumbo animated">Portal Turismo y Ocio</h1>-->
                <div class="offset-1 col-10 offset-md-3 col-md-6">
                    <img src="/assets/img/pto.png" class="img-fluid h1-jumbo animated" style="opacity:0;">
                </div>
                <p class="lead text-white animated" id="p-jumbo">Bienvenido/a al Portal Turismo y Ocio, aquí encontrarás
                    toda la información sobre los monumentos y la gastronomía típica de las provincias de españolas.
                    Desde el equipo del Portal Turismo y Ocio te invitamos a registrarte para que puedas dar tu opinión
                    sobre los monumentos que ya has visitado y así ayudar a otros visitantes para que puedan visitar
                    dicho escenario. Además te mantendremos informado de las últimas noticias que se publican diriamente
                    sobre eventos de ocio y turismo, ¡No te las pierdas!
                </p>
            </div>
        </div>
        <div class="col-12 my-5">
            <h1 class="display-3 text-center text-primary">Últimas Noticias</h1>
        </div>
        <div class="col-12 offset-md-1 col-md-10">
            <div class="list-group">
                <?php
                foreach ($news as $new):
                ?>
                <a href="<?php echo $new->url;?>" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="img-div">
                        <img class="img-thumbnail img-news" src="/assets/img/news/<?php echo ($new->image_url != null) ? $new->image_url : 'not-found-1024-768.jpg'; ?>" alt="" width="200">
                    </div>
                    <div>
                        <div class="d-flex justify-content-between">
                            <h3 class=" text-primary"><?php echo $new->title;?></h3>
                        </div>
                        <p class="mb-1 lead text-primary text-justify"><?php echo $new->subtitle;?></p>
                        <p class="text-muted mt-2 text-right"><?php echo $new->date_creation;?></p>
                    </div>
                </a>
                <?php
                endforeach;
                ?>
            </div>
        </div>
        <div class="col-12 offset-lg-4 col-lg-4 my-5">
            <a href="/noticias"><button class="btn btn-primary btn-lg btn-block">Ver más noticias</button></a>
        </div>
    </div>
    <div class="row d-none d-md-block mx-0">
        <div class="col-12 p-0">
            <div id="carouselPortal" class="carousel slide carousel-fade" data-ride="carousel" data-interval="10000">
                <div class="carousel-inner " role="listbox">
                    <?php
                    foreach ($carousel as $key=>$variable):
                        ?>
                        <div class="carousel-item <?php echo ($key == 0)? 'active': ''?>">
                            <img src="/assets/img/carousel/<?php echo ($variable->image_url != null) ? $variable->image_url : 'not-found-1920-450.jpg'; ?>" alt="responsive image" class="d-block img-fluid">
                            <!-- <div class="carousel-caption justify-content-center align-items-center"> -->
                            <div class="carousel-caption ">
                                <div>
                                    <h1 class="fadeInDown animated custom-font"><?php echo $variable->title;?></h1>
                                    <p class="lead fadeInUp animated"><?php echo $variable->subtitle;?></p>
                                    <a href="<?php echo $variable->url;?>">
                                        <span class="btn btn-primary slideInUp animated"">Saber más</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
                <!-- /.carousel-inner -->
                <a class="carousel-control-prev" href="#carouselPortal" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselPortal" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- /.carousel -->
        </div>
    </div>
</div>


