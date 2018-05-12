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
<!--        revisar columnas en modo movil -->
        <div class="offset-1 col-10 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8">
            <div class="jumbotron m-0 bg-white py-3" style="border: #2c3e50 0.075rem solid;">
            <p class="lead text-primary my-0">
                <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A illum omnis sed. Consequatur et iusto numquam, provident quas rem repellendus reprehenderit sunt suscipit voluptatem! Culpa illum incidunt labore sit tempore.</span><span>Aliquid beatae, blanditiis consectetur culpa, cumque deserunt dignissimos dolores doloribus exercitationem, iste iure laborum molestiae omnis perspiciatis quae repellendus reprehenderit similique tempora unde voluptatem. Amet dignissimos eum laborum praesentium voluptate?</span><span>Assumenda dignissimos distinctio et inventore magnam mollitia nostrum praesentium reiciendis, rem voluptatum? Architecto dolorem doloribus eaque earum facere fugit in laboriosam laudantium officia perferendis porro quas reprehenderit repudiandae, sapiente tempore?</span><span>Aliquid aut dicta earum enim exercitationem fuga id ipsam magni minus nihil nisi nulla quas ratione, ut voluptas? Aspernatur blanditiis culpa distinctio fuga illo in modi molestias nemo nobis voluptas.</span><span>Aliquid eveniet fugiat nostrum voluptatem voluptatum. Architecto autem, consectetur culpa cupiditate, dolorem eius eos esse incidunt iste laudantium maiores nihil obcaecati omnis optio porro quaerat quia quidem rerum, unde voluptatem?</span>
            </p>
            </div>
        </div>
        <div class="col-12 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8">
            <h1 class="center-titles special-title my-5 mx-3">Noticias sobre <?php echo $province->name ?></h1>
        </div>
        <div class="offset-1 col-10 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8">
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
                                <h3 class="text-primary text-title"><?php echo $new->title;?></h3>
                            </div>
                            <p class="mb-1 lead text-primary"><?php echo $new->subtitle;?></p>
                            <p class="text-muted mt-2 text-right"><?php echo $new->date_creation;?></p>
                        </div>
                    </a>
                <?php
                endforeach;
                ?>
            </div>
        </div>
        <div class="col-12 offset-lg-4 col-lg-4 offset-xl-5 col-xl-2 my-5">
            <a href="/noticias"><button class="btn btn-primary btn-lg btn-block">Ver más noticias</button></a>
        </div>
        <div class="col-12 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8">
            <h1 class="center-titles special-title my-5 mx-3">Monumentos de <?php echo $province->name ?></h1>
        </div>
        <div class="col-12 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8">
            <div id="carouselMonumentos" class="carousel slide" data-ride="carousel" data-interval="10000">
                <div class="carousel-inner row w-100 mx-auto">
                    <div class="carousel-item col-md-4 active">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="https://placehold.it/800x600/f44242/fff"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card 1</h4>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-md-4 ">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="https://placehold.it/800x600/418cf4/fff"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card 2</h4>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-md-4 ">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="https://placehold.it/800x600/3ed846/fff"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card 3</h4>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-md-4 ">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="https://placehold.it/800x600/42ebf4/fff"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card 4</h4>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-md-4 ">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="https://placehold.it/800x600/f49b41/fff"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card 5</h4>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-md-4 ">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="https://placehold.it/800x600/f4f141/fff"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card 6</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselMonumentos" role="button" data-slide="prev">
                    <i class="fa fa-4x fa-caret-left text-primary pt-4" aria-hidden="true"></i>
                    <span class="sr-only">Previous</span>

                </a>
                <a class="carousel-control-next" href="#carouselMonumentos" role="button" data-slide="next">
                    <i class="fa fa-4x fa-caret-right text-primary pt-4" aria-hidden="true"></i>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-12 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8">
            <h1 class="center-titles special-title my-5 mx-3">Gastronomía de <?php echo $province->name ?></h1>
        </div>
        <div class="col-12 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8">
            <div id="carouselGastronomia" class="carousel slide" data-ride="carousel" data-interval="10000">
                <div class="carousel-inner row w-100 mx-auto">
                    <div class="carousel-item col-md-4 active">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="https://placehold.it/800x600/f44242/fff"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card 1</h4>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-md-4 ">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="https://placehold.it/800x600/418cf4/fff"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card 2</h4>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-md-4 ">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="https://placehold.it/800x600/3ed846/fff"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card 3</h4>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-md-4 ">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="https://placehold.it/800x600/42ebf4/fff"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card 4</h4>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-md-4 ">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="https://placehold.it/800x600/f49b41/fff"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card 5</h4>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-md-4 ">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="https://placehold.it/800x600/f4f141/fff"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card 6</h4>
                            </div>
                        </div>
                    </div>
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
        <div class="col-12 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8">
            <h1 class="center-titles special-title my-5 mx-3">Galería fotográfica</h1>
        </div>
        <div class="col-12 offset-xl-2 col-xl-8 text-center">
<!--            arreglar las fotos, se pueden adaptar quitando reglas css-->
            <ul class="gridder">
                <li class="gridder-list" data-griddercontent="#gridder-content-1">
                    <img src="http://fakeimg.pl/300/200/?text=1" class="img-fluid">
                </li><!--
                --><li class="gridder-list" data-griddercontent="#gridder-content-2">
                    <img src="http://fakeimg.pl/300/200/?text=2" class="img-fluid">
                </li><!--
                --><li class="gridder-list" data-griddercontent="#gridder-content-3">
                    <img src="http://fakeimg.pl/300/200/?text=3" class="img-fluid">
                </li><!--
                --><li class="gridder-list" data-griddercontent="#gridder-content-4">
                    <img src="http://fakeimg.pl/300/200/?text=4" class="img-fluid">
                </li><!--
                --><li class="gridder-list" data-griddercontent="#gridder-content-5">
                    <img src="http://fakeimg.pl/300/200/?text=5" class="img-fluid">
                </li><!--
                --><li class="gridder-list" data-griddercontent="#gridder-content-6">
                    <img src="http://fakeimg.pl/300/200/?text=6" class="img-fluid">
                </li><!--
                -->
            </ul>
            <div id="gridder-content-1" class="gridder-content py-3">
                <div class="row">
                    <div class="col-xl-7">
                        <img src="http://fakeimg.pl/800/800/?text=1" class="img-fluid" />
                    </div>
                    <div class="col-xl-5 text-left pr-5">
                        <h2>Item 1</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                    </div>
                </div>
            </div>
            <div id="gridder-content-2" class="gridder-content">
                <div class="row">
                    <div class="col-xl-7">
                        <img src="http://fakeimg.pl/600/600/?text=2" class="img-fluid" />
                    </div>
                    <div class="col-xl-5 text-left pr-5">
                        <h2>Item 2</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                    </div>
                </div>
            </div>
            <div id="gridder-content-3" class="gridder-content">
                <div class="row">
                    <div class="col-xl-7">
                        <img src="http://fakeimg.pl/600/600/?text=3" class="img-fluid" />
                    </div>
                    <div class="col-xl-5 text-left pr-5">
                        <h2>Item 3</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                    </div>
                </div>
            </div>
            <div id="gridder-content-4" class="gridder-content">
                <div class="row">
                    <div class="col-xl-7">
                        <img src="http://fakeimg.pl/600/600/?text=4" class="img-fluid" />
                    </div>
                    <div class="col-xl-5 text-left pr-5">
                        <h2>Item 4</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                    </div>
                </div>
            </div>
            <div id="gridder-content-5" class="gridder-content">
                <div class="row">
                    <div class="col-xl-7">
                        <img src="http://fakeimg.pl/600/600/?text=5" class="img-fluid" />
                    </div>
                    <div class="col-xl-5 text-left pr-5">
                        <h2>Item 5</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                    </div>
                </div>
            </div>
            <div id="gridder-content-6" class="gridder-content">
                <div class="row">
                    <div class="col-xl-7">
                        <img src="http://fakeimg.pl/600/600/?text=6" class="img-fluid" />
                    </div>
                    <div class="col-xl-5 text-left pr-5">
                        <h2>Item 6</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ex augue, hendrerit sed gravida ut, mattis vel tortor. Duis hendrerit sagittis bibendum. Fusce massa risus, hendrerit et est vitae, convallis accumsan ipsum. Integer vitae erat mattis, ornare tortor nec, luctus turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse finibus fermentum consectetur. Nulla vestibulum, diam ut finibus dictum, justo felis blandit mi, sed rhoncus tortor augue vitae orci. Fusce semper eu ante ut faucibus.</p>
                    </div>
                </div>
            </div>
        </div>
        <?php $provinceValues = json_encode($province);
        echo "<script>var province = $provinceValues</script>";
        ?>
    </div>
</div>


