<?php
/**
 * Created by PhpStorm.
 * User: jaidis
 * Date: 29/04/18
 * Time: 17:54
 */
?>
<div class="container p-0">
    <div class="row bg-main m-0 p-0">
        <div class="offset-1 col-10 p-0 my-5 bg-white rounded">
            <div class="jumbotron jumbotron-description" id="monuments">
                <h2 class="mt-4 title-news"><?php echo $monuments->name; ?></h2>
                <p class="lead"> Redactado por
                    <span class="text-success">
                        <?php echo $comments_user->first_name .' '.$comments_user->last_name .' - '. $comments_user->username ?>
                    </span>
                </p>
                <hr>
                <p>Publicado el <?php echo $fecha; ?></p>
                <hr>
                <span class="text-center">
                    <img class="mx-auto d-block img-fluid rounded" src="/assets/img/monuments/<?php echo ($monuments->image_url != null) ? $monuments->image_url : 'not-found-1024-768.jpg'; ?>" alt="">
                </span>
                <hr>
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <p class="lead">Información</p>
                        <hr>
                        <div class="lead">
                            <span class="">Año creación</span>
                            <ul class="mt-2">
                                <li><?php echo ($monuments->year)? $monuments->year: 'No disponible' ?></li>
                            </ul>
                            <span class="">Coordenadas aproximadas</span>
                            <ul class="mt-2">
                                <li><?php echo ($monuments->coordenate_x)? $monuments->coordenate_x: 'No disponible' ?></li>
                                <li><?php echo ($monuments->coordenate_y)? $monuments->coordenate_y: 'No disponible' ?></li>
                            </ul>
                            <?php if (!empty($monuments->web)):?>
                            <span class="">Web oficial</span>
                            <ul class="mt-2" style="list-style: none;">
                                <li><a href="http://<?php echo $monuments->web; ?>"><button class="btn btn-primary">Ir al sitio web</button></a></li>
                            </ul>
                            <?php endif; ?>
                        </div>
                        <hr>
                    </div>
                    <div class="col-12 col-lg-8">
                        <p class="lead">Descripción</p>
                        <hr>
                        <div class="lead">
                            <?php
                            $total = count($description);
                            foreach ($description as $key => $value)
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
                <div class="card border-primary my-4">
                    <h5 class="card-header bg-primary text-white">Deja un comentario</h5>
                    <div class="card-body">
                        <form role="form" id="commentForm" autocomplete="off">
                            <div class="form-group">
                                <textarea class="form-control" rows="4" name="message" id="message" ></textarea>
                            </div>
                            <input type="hidden" id="monumentsId" name="monumentsId" value="<?php echo (!empty($monuments->id)) ? $monuments->id : '' ; ?>">
                            <input type="hidden" id="activeUser" name="activeUser" value="<?php echo (!empty($user->id)) ? $user->username : '' ; ?>">
                            <input type="hidden" id="activeId" name="activeId" value="<?php echo (!empty($user->id)) ? $user->id : '' ; ?>">
                            <button type="submit" class="btn btn-primary btn-lg" id="commentButton">Enviar comentario</button>
                        </form>
                    </div>
                </div>
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


