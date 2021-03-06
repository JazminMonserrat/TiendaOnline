<?php
$index = true;
session_start();
require_once "../../conf/env.php";
require_once "../Models/usuario.php";

if (isset($_SESSION['user_email'])) {
  $user = Usuario::buscarUsuarioPorCorreo($_SESSION['user_email']);
}
?>
<!--Apartado de Creacion solo si el usuario a ingresado al sistema-->
<!--Inicio IF php-->

<!DOCTYPE html>
<html style="font-size: 16px;">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="Blooms, For Every Occasion">
  <meta name="description" content="">
  <meta name="page_type" content="np-template-header-footer-from-plugin">
  <title>El Maletín de Merlin - Inicio</title>
  <link rel="stylesheet" href="../../public/css/nicepage.css" media="screen">
  <link rel="stylesheet" href="../../public/css/Iniciar-Sesión.css" media="screen">
  <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
  <link rel="stylesheet" type="text/css" href="../../public/css/bootstrap.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script class="u-script" type="text/javascript" src="../../public/js/nicepage.js" defer=""></script>

  <meta name="generator" content="Nicepage 3.11.0, nicepage.com">
  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
  <script type="text/javascript" src="../../public/js/jquery.1.11.1.js"></script>
  <script type="text/javascript" src="../../public/js/bootstrap.js"></script>
  <script type="text/javascript" src="../../public/js/jquery.isotope.js"></script>
  <script type="text/javascript" src="../../public/js/jqBootstrapValidation.js"></script>

  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "",
      "url": "index.html",
      "logo": "public/imagenes/logo_merlin.jpg"
    }
  </script>
  <meta property="og:title" content="Inicio">
  <meta property="og:type" content="website">
  <meta name="theme-color" content="#478ac9">
  <link rel="canonical" href="index.html">
  <meta property="og:url" content="index.html">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body data-home-page="Iniciar-Sesión.html" data-home-page-title="Iniciar Sesión" class="u-body">
<?php
  if(isset($_SESSION["id_admin"])){
    require_once "menuAdmin.php";
  }else if(isset($_SESSION["id_cliente"])){
    require_once "menuCliente.php";
  }else{
    require_once "menu.php";
  }
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../../public/imagenes/ropa_aesthetic4.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Nuevos productos!!</h5>
        <p>Ven y conoce nuestros productos, desde sudaderas hasta vestidos para dama</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../../public/imagenes/ropa_aesthetic5.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>
    <div class="carousel-item">
      <img src="../../public/imagenes/ropa_aesthetic3.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>
  <section class="-lg -sm -xl -xs u-align-center u-clearfix u-white u-section-1" src="" id="carousel_8155">
    <div class="u-clearfix u-gutter-32 u-layout-wrap u-layout-wrap-1">
      <div class="u-layout">
        <div class="u-layout-row">
          <div class="u-align-center u-border-no-bottom u-border-no-left u-border-no-right u-border-no-top u-container-style u-layout-cell u-left-cell u-size-20 u-white u-layout-cell-1">
            <div class="u-container-layout u-container-layout-1">
              <img class="u-expanded-width u-image u-image-2" src="../../public/imagenes/vestido_frances.PNG" data-image-width="810" data-image-height="1440">
              <h4 class="u-text u-text-custom-color-2 u-text-1">Vestido estilo francés</h4>
            </div>
          </div>
          <div class="u-align-center u-container-style u-layout-cell u-size-20 u-white u-layout-cell-2">
            <div class="u-container-layout u-valign-bottom u-container-layout-2">
              <img class="u-expanded-width u-image u-image-3" src="../../public/imagenes/vestido_pop.PNG" data-image-width="721" data-image-height="1280">
              <h4 class="u-text u-text-custom-color-2 u-text-2">Vestido estilo Pop<br>
              </h4>
            </div>
          </div>
          <div class="u-align-center u-container-style u-layout-cell u-right-cell u-size-20 u-white u-layout-cell-3">
            <div class="u-container-layout u-valign-top u-container-layout-3">
              <img class="u-expanded-width u-image u-image-4" src="../../public/imagenes/camisa_coreana.PNG" data-image-width="1440" data-image-height="810">
              <h4 class="u-text u-text-custom-color-2 u-text-3">Camisa coreana</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-712f">
    <div class="u-clearfix u-sheet u-sheet-1">
      <p class="u-small-text u-text u-text-variant u-text-1">Universidad Veracruzana&nbsp;<br>Desarrollo de Software
      </p>
    </div>
  </footer>
  <!--Fin de Seccion php-->
</body>

</html>