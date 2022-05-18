<?php require_once "../util/funciones.php"; ?>
<header class="u-clearfix u-header u-header" id="sec-e89e" style="background-color: white;">
	<div class="u-clearfix u-sheet u-valign-middle u-sheet-1" >
		<a href="index.php" class="u-image u-logo u-image-1" data-image-width="299" data-image-height="266">
			<img src="../../public/imagenes/logo_merlin.jpg" class="u-logo-image u-logo-image-1" data-image-width="64">
		</a>
		<nav class="u-menu u-menu-dropdown u-offcanvas u-menu-1">
			<div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px;">
				<a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
					<svg>
						<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use>
					</svg>
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
						<defs>
							<symbol id="menu-hamburger" viewBox="0 0 16 16" style="width: 16px; height: 16px;">
								<rect y="1" width="16" height="2"></rect>
								<rect y="7" width="16" height="2"></rect>
								<rect y="13" width="16" height="2"></rect>
							</symbol>
						</defs>
					</svg>
				</a>
			</div>
			<div class="u-custom-menu u-nav-container">
				<ul class="u-nav u-unstyled u-nav-1">
                    <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base active" href="index.php" style="padding: 10px 20px;">Inicio</a></li>
                    <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base active" href="buscarProducto.php" style="padding: 10px 20px;">Productos</a></li>
					<li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base active" href="pedidos.php" style="padding: 10px 20px;">Pedidos</a></li>
					<li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base active" href="editarPerfil.php?correo=<?php echo $_SESSION["user_email"] ?>" style="padding: 10px 20px;">Perfil</a></li>
					<li class="u-nav-item navFont">
						<a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base texto-negro" href="mostrar_carrito.php" style="padding: 10px 20px;">
							Carrito (<?php echo (empty($_SESSION['Carrito'])) ? 0 : contarCarrito(); ?>)
						</a>
					</li>
					<li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base active" href="<?php echo URL_CONTROLADORES ?>logoutController.php" style="padding: 10px 20px;">Cerrar Sesión</a></li>
				</ul>
			</div>
			<div class="u-custom-menu u-nav-container-collapse">
				<div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
					<div class="u-sidenav-overflow">
						<div class="u-menu-close"></div>
						<ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2">
							<li class="u-nav-item"><a class="u-button-style u-nav-link" href="pedidos.php" style="padding: 10px 20px;">Pedidos</a></li>
							<li class="u-nav-item"><a class="u-button-style u-nav-link" href="buscarProducto.php" style="padding: 10px 20px;">Productos</a></li>
							<li class="u-nav-item"><a class="u-button-style u-nav-link" href="editarPerfil.php?correo=<?php echo $_SESSION["user_email"] ?>" style="padding: 10px 20px;">Perfil</a></li>
							<li class="u-nav-item navFont">
								<a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="mostrar_carrito.php" style="padding: 10px 20px;">
									Carrito (<?php echo (empty($_SESSION['Carrito'])) ? 0 : count($_SESSION['Carrito']); ?>)
								</a>
							</li>
							<li class="u-nav-item"><a class="u-button-style u-nav-link" href="<?php echo URL_CERRAR_SESION ?>" style="padding: 10px 20px;">Cerrar Sesión</a></li>
						</ul>
					</div>
				</div>
				<div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
			</div>
		</nav>
	</div>
</header>
