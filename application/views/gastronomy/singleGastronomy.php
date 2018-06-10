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
        <div class="offset-1 col-10 p-0 offset-md-1 col-md-10 offset-xl-2 col-xl-8 my-5 bg-white rounded">
            <!-- Post Content Column -->
            <div class="jumbotron jumbotron-description">
                <!-- Title -->
                <h2 class="mt-4 title-news"><?php echo $gastronomies->name; ?></h2>
                <!-- Author -->
                <p class="lead"> Redactado por
                    <span class="text-success">
                        <?php echo $comments_user->first_name .' '.$comments_user->last_name .' - '. $comments_user->username ?>
                    </span>
                </p>
                <hr>
                <!-- Date/Time -->
                <p>Publicado el <?php echo $fecha; ?></p>
                <hr>
                <!-- Preview Image -->
                <span class="text-center">
                    <img class="mx-auto d-block img-fluid rounded" src="/assets/img/gastronomies/<?php echo ($gastronomies->image_url != null) ? $gastronomies->image_url : 'not-found-1024-768.jpg'; ?>" alt="">
                </span>
                <hr>
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <!-- Ingredients Content -->
                        <p class="lead">Ingredientes</p>
                        <hr>
                        <div class="lead">
                            <ul class="">
                                <?php
                                foreach ($ingredients as $ingredient)
                                    echo "<li>$ingredient</li>"
                                ?>
                            </ul>
                        </div>
                        <hr>
                    </div>
                    <div class="col-12 col-lg-8">
                        <!-- Elaboration Content -->
                        <p class="lead">Elaboración</p>
                        <hr>
                        <div class="lead">
                            <?php
                            $total = count($elaboration);
                            foreach ($elaboration as $key => $value)
                            {
                                if ($key+1 == $total)
                                    echo "<div class='lead'>$value</div>";
                                else
                                    echo "<div class='lead'>$value</div><br/>";
                            }
                            ?>
                        </div>
                        <hr>
                    </div>
                </div>
                <!-- Comments Form -->
                <div class="card border-primary my-4">
                    <h5 class="card-header bg-primary text-white">Deja un comentario</h5>
                    <div class="card-body">
                        <form role="form" id="commentForm" autocomplete="off">
                            <div class="form-group">
                                <textarea class="form-control" rows="4" name="message" id="message" ></textarea>
                            </div>
                            <input type="hidden" id="gastronomiesId" name="gastronomiesId" value="<?php echo (!empty($gastronomies->id)) ? $gastronomies->id : '' ; ?>">
                            <input type="hidden" id="activeUser" name="activeUser" value="<?php echo (!empty($user->id)) ? $user->username : '' ; ?>">
                            <input type="hidden" id="activeId" name="activeId" value="<?php echo (!empty($user->id)) ? $user->id : '' ; ?>">
                            <button type="submit" class="btn btn-primary btn-lg" id="commentButton">Enviar comentario</button>
                        </form>
                    </div>
                </div>

                <!-- Single Comment -->
                <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment):?>
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="/assets/img/users/<?php echo ($comment->image_url != null) ? $comment->image_url : 'user.png'; ?>" alt="<?php echo $comment->first_name .' '.$comment->last_name ?>" width="70px">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo $comment->first_name .' '.$comment->last_name ?></h5>
                        <?php echo $comment->message; ?>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                    <div class="media mb-4">
                        <img class="d-flex mr-3 rounded-circle" src="/assets/img/users/logo.png" alt="Portal Turismo y Ocio" width="70px">
                        <div class="media-body">
                            <h5 class="mt-0">Portal Turismo y Ocio</h5>
                            Hola, en estos momentos nadie ha escrito un comentario, por favor, escribe uno y dinos que te ha parecido esta receta.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


