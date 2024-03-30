<?php 
    require_once("config/connection.php");
    require_once("models/session.php");
    require_once("models/functions.php");
    require_once("views/head.php");
    require_once("views/nav.php");
?>
    <main id="author" class="container position-relative bg-light-trans mx-auto p-4 mb-5">
        <span class="small color-primary text-center w-100 d-block">Learn more about the developer</span>
        <h1 class="text-muted mb-5 font-weight-light h3 px-4 text-center">About Author</h1>
        <section id="author-data" class="row container mx-auto justify-content-center align-items-center">
            <div id="author-portrait" class="col-10 col-md-4 p-5 p-md-2 p-lg-5">
                <img src="assets/img/author-portrait.jpg" class="img-fluid" alt="Author"/>
            </div>
            <div id="author-info" class="col-12 col-md-8 p-5">
                <h4 class="font-weight-light h4">Mihailo Ilić<small class="text-muted font-weight-light"> 41/19</small></h4>
                <p>Hi. I'm a web developer from Serbia. I've recently started studying IT/Web programming at <a href="https://ict.edu.rs/" class="primary-color" target="_blank"><span class="fa fa-graduation-cap"></span> ICT College</a> because I've always been interested in computers and technology.</p>
                <p>Although my skills are limited at this moment, I will continuously try to improve them through my studies, projects etc. You can check my recent projects and learn more about me by visiting my portfolio website.</p>
                <a href="https://mihailoilic.github.io/portfolio/" target="_blank" class="btn btn-primary text-center">My portfolio website</a>
            </div>
        </section>
    </main>
<?php
    require_once("views/footer.php");
?>
