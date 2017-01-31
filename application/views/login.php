<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Haz que suceda!</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/animate.min.css'); ?>" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/creative.css'); ?>" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '1729054797349935',
            cookie     : true,
            xfbml      : true,
            version    : 'v2.8'
        });
        FB.AppEvents.logPageView();
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">Haz que suceda!</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#" data-toggle="modal" data-target="#myModal">Ingresar</a>
                </li>
                <li>
                    <a class="page-scroll" href="registroemprendedor" >Quiero ser emprendedor</a>
                </li>
                <li>
                    <a class="page-scroll" href="registroinversor" >Quiero ser inversor</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">Contacto</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<header>
    <div class="header-content">
        <div class="header-content-inner">
            <h1>Haz que suceda!</h1>
            <hr>
            <p>Bienvenido al sitio donde aquellos con grandes ideas y aquellos con la capacidad de concretarlas se encuentran.</p>
            <a href="#services" class="btn btn-primary btn-xl page-scroll">Conocer un poco más</a>
        </div>
    </div>
</header>

<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">¿De qué se trata todo esto?</h2>
                <hr class="primary">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-1 col-md-offset-2 col-lg-2 col-md-4 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-lightbulb-o wow bounceIn text-primary"></i>
                    <h3>Soy emprendedor</h3>
                    <p class="text-muted">Tengo una gran idea.</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-money wow bounceIn text-primary" data-wow-delay=".1s"></i>
                    <h3>Necesito financiación</h3>
                    <p class="text-muted">Para poder poner en marcha mi idea.</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-comments-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                    <h3>Nos encontramos</h3>
                    <p class="text-muted">Y charlamos sobre tu idea.</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-briefcase wow bounceIn text-primary" data-wow-delay=".2s"></i>
                    <h3>Busco un proyecto</h3>
                    <p class="text-muted">En el cual invertir.</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-user wow bounceIn text-primary" data-wow-delay=".3s"></i>
                    <h3>Soy inversor</h3>
                    <p class="text-muted">Tengo dinero y me gustaría invertirlo en grandes proyectos.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="no-padding" id="portfolio">
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="col-lg-4 col-sm-6">
                <a href="#" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/portfolio/1.jpg'); ?>" class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Rubro
                            </div>
                            <div class="project-name">
                                Industrial
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a href="#" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/portfolio/2.jpg'); ?>" class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Rubro
                            </div>
                            <div class="project-name">
                                Franquicias
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a href="#" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/portfolio/3.jpg'); ?>" class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Rubro
                            </div>
                            <div class="project-name">
                                Económico
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a href="#" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/portfolio/4.jpg'); ?>" class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Rubro
                            </div>
                            <div class="project-name">
                                Agropecuario
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a href="#" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/portfolio/5.jpg'); ?>" class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Rubro
                            </div>
                            <div class="project-name">
                                Servicios
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a href="#" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/portfolio/6.jpg'); ?>" class="img-responsive" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Rubro
                            </div>
                            <div class="project-name">
                                Manufacturas
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <br>
                <br>
                <h3 class="section-heading">¡Y muchos rubros más!</h3>
                <br>
                <br>
            </div>
        </div>
    </div>
</section>

<section class="bg-primary" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">El equipo de trabajo</h2>
                <hr class="light">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" align="center">
            <div class="col-sm-6">
                <img class="img-circle img-responsive img-center" src="../uploads/fran.jpg" style="max-height: 345px">
                <h2>Francisco Fischer</h2>
                <p>Estudiante de Ingeniería de Sistemas en Universidad Católica de Córdoba.</p>
                <h4>
                    <a href="https://www.linkedin.com/in/francisco-fischer-73993978" style="color: black" target="_blank">
                        Sobre Fran...
                    </a>
                </h4>
            </div>
            <div class="col-sm-6">
                <img class="img-circle img-responsive img-center" src="../uploads/caro.jpg" style="max-height: 345px">
                <h2>Carolina Bottino</h2>
                <p>Estudiante de Ingeniería de Sistemas en Universidad Católica de Córdoba.</p>
                <h4>
                    <a href="https://www.linkedin.com/in/carolina-bottino-5214309b" style="color: black" target="_blank">
                        Sobre Caro...
                    </a>
                </h4>
        </div>
        </div>
    </div>
</section>

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <h2 class="section-heading">¡Nos mantengamos en contacto!</h2>
                <hr class="primary">
                <p>Tu opinión nos interesa. Si tenés una sugerencia, no dudes en hacernosla llegar!</p>
            </div>
            <div class="col-lg-4 col-lg-offset-2 text-center">
                <i class="fa fa-facebook-square fa-3x wow bounceIn"></i>
                <p><a href="https://www.facebook.com/hqsinstitucional" target="_blank">página de facebook</a></p>
            </div>
            <div class="col-lg-4 text-center">
                <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                <p><a href="mailto:soporte@hazquesuceda.org" target="_blank">soporte@hazquesuceda.org</a></p>
            </div>
        </div>
    </div>
</section>

<div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Inicia sesión</h4>
                </div>
                <?php echo validation_errors(); ?>
                <?php echo form_open('login'); ?>
                <div class="modal-body">
                    <label for="username">Usuario:</label>
                    <input type="text" name="username" id="username" class="form-control input-lg-12" placeholder="Usuario" tabindex="1">
                    <br/>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control input-lg-12" placeholder="Contraseña" tabindex="1">
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal">Volver</a>
                    <input type="submit" class="btn btn-default wow tada" value="Vamos!"/>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!--<fb:login-button-->
<!--    scope="public_profile,email"-->
<!--    onlogin="checkLoginState();">-->
<!--</fb:login-button>-->


<script>
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });

    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    }
</script>

<!-- jQuery -->
<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

<!-- Plugin JavaScript -->
<script src="<?php echo base_url('assets/js/jquery.easing.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.fittext.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/wow.min.js'); ?>"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url('assets/js/creative.js'); ?>"></script>

</body>

</html>
