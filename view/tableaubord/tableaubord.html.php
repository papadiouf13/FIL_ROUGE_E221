<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="css/styletableaubord.css">

	<title>FIL ROUGE</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
    <?php
    require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
    ?>
	</section>
	<!-- SIDEBAR -->
    <!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="recherche...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>TABLEAU DE BORD</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">TABLEAU DE BORD</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="<?= WEB_ROUTE . "?controller=articleVenteController&view=article_list" ?>">Home</a>
						</li>
					</ul>
				</div>
				<!-- <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a> -->
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>1020</h3>
						<p>Utilisateur</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>2834</h3>
						<p>Client</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>3456000 CFA</h3>
						<p>Total Vendu</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>LISTE UTILISATEUR</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>USER</th>
								<th>TELEPHONE</th>
								<th>ADRESSE</th>
                                <th>PHOTO</th>
							</tr>
						</thead>
						<tbody>
                        <?php
                        foreach ($user as $key => $value) : ?>
                            <tr>
                                
                                <td><?= $value["prenomU"]." ".$value["nomU"] ?></td>
                                <td><?= $value["telephoneU"] ?></td>
                                <td><?= $value["adresseU"] ?></td>
                                <td>
                                    <div class="imag">
                                         <img src="<?= WEB_ROUTE . '/images/utilisateur/' . $value['photoU'] ?>" alt="" class="imag">
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
						</tbody>
					</table>
                    <div class="nbrepage__product">
            <nav class="nav__pagination" aria-label="Page navigation example">
                <ul class="justify__product">
                    <?php
                    if (isset($nbrPage)) :


                    ?>
                        <?php for ($i = 1; $i <= $nbrPage; $i++) : ?>
                            <li class="page__product"><a class="page-link" href="<?= WEB_ROUTE . '?controller=tableaubord&view=tableaubord&page=' . $i ?>">
                                    <?= $i ?></a></li>
                        <?php endfor; ?>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
				</div>
				<div class="todo">
					LOUMA FI WARRA DEF LAY XALLATT
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="js/scripttableau.js"></script>
</body>
</html>