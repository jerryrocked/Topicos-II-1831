<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
	<link rel="stylesheet" href="css/utilities.css">
	<link rel="stylesheet" href="css/style.css">

	<title>Tienda GameStore</title>
</head>

<body>
	<!-- Navbar -->
	<div class="navbar">
		<div class="container flex">
			<img id="logo" src="https://w7.pngwing.com/pngs/1017/770/png-transparent-bioshock-video-game-logo-game-controllers-video-games-game-angle-white-thumbnail.png">
			<nav>
				<ul>
					<li><a href="#vend"> TABLA VENDEDORES</a></li>
				</ul>
			</nav>
		</div>
	</div>

	<!-- Encabezado -->
	<section class="showcase">
		<div class="container grid">
			<div class="showcase-text">
				<h1>NUESTROS PRODUCTOS</h1>
			</div>
		</div>
	</section>

	<?php
	$N_cod_total = 0;
	session_start();
	if (!isset($_SESSION['vendedor'])) { //si la sesion no esta activa
		$_SESSION['vendedor'] = array();
	}
	if (isset($_GET['insertar'])) {
		$nom = $_GET['Nombre'];
		$n_cod = $_GET['N_cod'];
		$n_mine = $_GET['N_mine'];
		$n_fort = $_GET['N_fort'];

		if (empty($nom) || !is_numeric($n_cod) || !is_numeric($n_mine) || !is_numeric($n_fort)) {
			// if (empty($nom)||empty($n_cod)||empty($n_mine)||empty($n_fort)){
			echo "Rellene todos los campos";
		} else {
			$total_ventas = $n_cod * 34500 + $n_mine * 8800 + $n_fort * 58200;
			$com_cod = $n_cod * 34500 * 0.06;
			$com_mine = $n_mine * 8800 * 0.04;
			$com_fort = $n_fort * 58200 * 0.09;
			$com_total = $com_cod + $com_mine + $com_fort;
			$vendedor = array(
				"Nombre" => $nom,
				"N_cod" => $n_cod,
				"N_mine" => $n_mine,
				"N_fort" => $n_fort,
				"Total_ventas" => $total_ventas,
				"Com_cod" => $com_cod,
				"Com_mine" => $com_mine,
				"Com_fort" => $com_fort,
				"Com_total" => $com_total,
			);
			if (isset($_SESSION['vendedor'][$nom])) {
				echo "Se ha modificado el vendedor con el Nombre " . $nom;
			} else {
				echo "Vendedor Registrado";
			}
			$_SESSION['vendedor'][$nom] = $vendedor;
			print_r($_SESSION['vendedor']);
		}
	} else if (isset($_GET['borrar'])) {
		if (!isset($_GET['nombres'])) {
			echo "No hay vendedores seleccionados";
		} else {
			$nombres = $_GET['nombres'];
			print_r($nom);
			foreach ($_SESSION['vendedor'] as $key => $value) {
				if (in_array($key, $nombres)) {
					unset($_SESSION['vendedor'][$key]);
				}
			}
			echo "Vendedor(es) Borrado(s)";
		}
	}
	?>

	<section class="docs-main my-4">
		<div class="card">
			<div class="row">
				<div class="column">
					<h4 id="rank1">CALL OF DUTY</h4>			
					<img src="https://i.3djuegos.com/juegos/15989/call_of_duty_wwii__united_front/fotos/ficha/call_of_duty_wwii__united_front-4591783.jpg" style="width:100%">
				</div>
				<div class="column">
					<h4 id="rank1">MINECRAFT</h4>
					<img src="https://www.minecraft.net/content/dam/minecraft/home/Games_Subnav_Minecraft-228x350.png" style="width:100%">
				</div>
				<div class="column">
					<h4 id="rank1">FORTNITE</h4>
					<img src="https://www.mobygames.com/images/covers/l/638972-fortnite-battle-royale-xbox-one-front-cover.jpg" style="width:100%">
				</div>
			</div>
		</div>
	</section>


	
	<section class="showcase">
		<div class="container grid">
			<div class="showcase-text">
				<h1 id="vend">INGRESAR VENDEDORES</h1>
			</div>
		</div>
	</section>


	<h1>Ingresar Vendedores</h1>
	<form method="get">
		<br>Nombre
		<input type="text" id="Nombre" name="Nombre">
		<br>Numero Ventas Call of Duty
		<input type="text" id="N_cod" name="N_cod">
		<br>Numero Ventas Minecraft
		<input type="text" id="N_mine" name="N_mine">
		<br>Numero Ventas Fortnite
		<input type="text" id="N_fort" name="N_fort">
		<br>
		<br>
		<button type="submit" name="insertar">Insertar vendedor</button>
		<button type="submit" name="mostrar">Mostrar vendedores</button>
		<button type="submit" name="borrar">Borrar vendedor</button>
		<button type="submit" name="vendedor">Vendedor con mas comision</button>
		<?php
		if (isset($_GET['mostrar'])) {
			if (count($_SESSION['vendedor']) == 0) {
				echo "<p> No hay Vendedores </p>";
			} else {
				echo "<br>";
				echo "<div class='card'>";
				echo "<table class='table1'>";
				echo "<thead>";
				echo "<tr>";
				echo "<th></th>";
				echo "<th title='Field #2'>NOMBRE</th>";
				echo "<th title='Field #2'>NUMERO VENTAS CALL OF DUTY</th>";
				echo "<th title='Field #2'>NUMERO VENTAS MINECRAFT</th>";
				echo "<th title='Field #2'>NUMERO VENTAS FORTNITE</th>";
				echo "<th>TOTAL VENTAS</th>";
				echo "<th>COMISION CALL OF DUTY</th>";
				echo "<th>COMISION MINECRAFT</th>";
				echo "<th>COMISION FORTNITE</th>";
				echo "<th>COMISION TOTAL</th>";
				echo "<th>JUEGO CON MAS COMISION</th>";
				echo "</tr>";
				echo "</thead>";
				foreach ($_SESSION['vendedor'] as $key => $value) {					
					$N_cod_total = $N_cod_total + $value["N_cod"];
		?>
					<tr>
						<td align="center"><input type="checkbox" name="nombres[]" value="<?php echo $key; ?>"></td>
						<td align="center"><?php echo $value["Nombre"]; ?></td>
						<td align="center"><?php echo $value["N_cod"]; ?></td>
						<td align="center"><?php echo $value["N_mine"]; ?></td>
						<td align="center"><?php echo $value["N_fort"]; ?></td>
						<td align="center"><?php echo $value["Total_ventas"]; ?></td>
						<td align="center"><?php echo $value["Com_cod"]; ?></td>
						<td align="center"><?php echo $value["Com_mine"]; ?></td>
						<td align="center"><?php echo $value["Com_fort"]; ?></td>
						<td align="center"><?php echo $value["Com_total"]; ?></td>
						<td align="center"><?php if ($value["Com_cod"] > $value["Com_mine"] && $value["Com_cod"] > $value["Com_fort"]) {
																	echo "<img src= 'https://logos-world.net/imageup/Call_of_Duty/Call_of_Duty_(6).png' height='60'>";
																} else if ($value["Com_mine"] > $value["Com_cod"] && $value["Com_mine"] > $value["Com_fort"]) {
																	echo "<img src= 'https://logos-marcas.com/wp-content/uploads/2020/04/Minecraft-Logo-650x366.png' height='60'>";
																} else {
																	echo "<img src= 'https://logos-marcas.com/wp-content/uploads/2020/12/Fortnite-Logo-650x366.png' height='60'>";
																} ?></td>
					</tr>
		<?php
				}
				
				// echo "</tbody>";
				echo "</table>";
				echo "</div>";
			}
		} else if (isset($_GET['vendedor'])) {
			echo "<br>";
			$_SESSION['vendedor_sorted'] = array();
			$_SESSION['vendedor_sorted'] = $_SESSION['vendedor'];
			array_multisort(array_column($_SESSION['vendedor_sorted'], 'Com_total'), SORT_ASC, $_SESSION['vendedor_sorted']);
			foreach ($_SESSION['vendedor_sorted'] as $key => $value) {
			}?>
				<div class="card">
			 <h1><?php echo $value["Nombre"];?></h1>
			 <br>
			 <h1><?php echo $value["Com_total"];?></h1>
			 </div>
			 <?php

		}
		?>

	</form>

	</section>

	<!-- Footer -->
	<footer class="footer bg-dark py-5">
		<div class="container grid grid-3">
			<div>
				<h1>Tienda GameStore
				</h1>
			</div>
			<div class="social">
				<a href="CalendarioMundial.html"><img class="logo_fifa" src="/images/fifa.png" alt=""></a>
			</div>
		</div>
	</footer>
</body>

</html>