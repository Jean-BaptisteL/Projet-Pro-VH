<?php
ini_set('session.gc_maxlifetime', 7200);
session_start();
$pageTitle = 'Projet Drone';
include_once 'models/users.php';
include_once 'controllers/headerCtrl.php';
include_once 'includes/header.php';
?>
        <div class="row justify-content-around">
            <div class="col-12">
                <article><!--Les 4 dernières tutos/tests/contenus publiés sur le site-->
                    <div class="row articlesPresentation">
                        <image class="col-4" src="assets/img/drone.jpg" />
                        <div class="col-8 articleDescription">
                            <p class="articleTitle">Titre de l'article</p>
                            <p>Premières phrases de l'article</p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
<?php
include_once 'includes/footer.php';