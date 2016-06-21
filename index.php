<!DOCTYPE html>
<html>
<head>
	<title>Rotary - Controle de Clubes</title>
	<meta charset="UTF-8">

	<script type="text/javascript" src="js/jquery/jquery-1.12.3.min.js"></script>
	<!-- <link rel="stylesheet" type="text/css" href="js/jquery/jquery.datatables.min.css"> -->
	<!-- <script type="text/javascript" src="js/jquery/jquery.datatables.min.js"></script> -->
	<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
	<script type="text/javascript" src="js/angular/angular.min.js"></script>
	<script type="text/javascript" src="js/angular/ui-bootstrap.min.js"></script>
	<script type="text/javascript" src="js/angular/angular-sanitize.min.js"></script>
	<script type="text/javascript" src="js/angular/angular-route.min.js"></script>
	<script type="text/javascript" src="js/angular/angular-scroll.min.js"></script>
	<script type="text/javascript" src="js/angular/dirPagination.js"></script>

	<script type="text/javascript" src="js/app.module.js"></script>
	<script type="text/javascript" src="js/angular/angular-locale_pt-br.js"></script>
	<!-- Serviços -->
	<script type="text/javascript" src="js/services/paises.js"></script>
	<script type="text/javascript" src="js/services/estado.js"></script>
	<script type="text/javascript" src="js/services/cidade.js"></script>
	<script type="text/javascript" src="js/services/distrito.js"></script>
	<script type="text/javascript" src="js/services/clube.js"></script>
	<script type="text/javascript" src="js/services/relatorio.js"></script>
	<script type="text/javascript" src="js/services/usuario.js"></script>

	<!-- Controller -->
	<script type="text/javascript" src="js/controllers/pais.js"></script>
	<script type="text/javascript" src="js/controllers/estado.js"></script>
	<script type="text/javascript" src="js/controllers/cidade.js"></script>
	<script type="text/javascript" src="js/controllers/distrito.js"></script>
	<script type="text/javascript" src="js/controllers/novodistrito.js"></script>
	<script type="text/javascript" src="js/controllers/editadistrito.js"></script>
	<script type="text/javascript" src="js/controllers/clube.js"></script>
	<script type="text/javascript" src="js/controllers/novoclube.js"></script>
	<script type="text/javascript" src="js/controllers/editaclube.js"></script>
	<script type="text/javascript" src="js/controllers/clubesocio.js"></script>
	<script type="text/javascript" src="js/controllers/melhorespercapitas.js"></script>
	<script type="text/javascript" src="js/controllers/melhorarpercapitas.js"></script>
	<script type="text/javascript" src="js/controllers/maioresclubes.js"></script>
	<script type="text/javascript" src="js/controllers/menoresclubes.js"></script>
	<script type="text/javascript" src="js/controllers/atualizapopulacao.js"></script>
</head>
<body ng-app="rotary">
	<nav class="navbar navbar-default">
		<ul class="nav navbar-nav">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#/paises">Países</a></li>
					<li><a href="#/estados">Estados</a></li>
					<li><a href="#/cidades">Cidades</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="#/distritos">Distritos</a></li>
					<li><a href="#/clubes">Clubes</a></li>		
				</ul>
			</li>
			<li><a href="#">Home <span class="sr-only">(current)</span></a></li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Percapita <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#/melhorespercapitas">Melhores</a></li>
					<li><a href="#/melhorarpercapitas">Melhorar</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clubes <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#/maioresclubes">Maiores Clubes</a></li>
					<li><a href="#/menoresclubes">Menores Clubes</a></li>
				</ul>
			</li>
			
			<li><a href="#">Cidades Sem Rotary</a></li>
		</ul>
	</nav>
	<div class="row"></div>

	<div class="container" ng-view>
		
	</div>

</body>
</html>