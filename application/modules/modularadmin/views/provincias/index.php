<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<article class="content dashboard-page">
    <div class="title-block">
        <h1 class="title"> Listado de provincias </h1>
    </div>
    <section class="section">
        <div class="row sameheight-container">
            <div class="col-12">
                <div class="card" data-exclude="xs">
                    <div class="card-block">
                        <div class="title-block">
                            <div class="row">
                                <div class="col-12">
                                    <code>
                                        <?php  foreach ($provincias as $provincia) print_r($provincia); ?>
                                    </code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>