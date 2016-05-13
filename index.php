<!DOCTYPE html>
<html>
<head>
	<title>Rotary - Controle de Clubes</title>
	<meta charset="UTF-8">

	<script type="text/javascript" src="js/jquery/jquery-1.12.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
	<script type="text/javascript" src="js/angular/angular.min.js"></script>
	<script type="text/javascript" src="js/angular/ui-bootstrap.min.js"></script>
	<script type="text/javascript" src="js/angular/angular-sanitize.min.js"></script>
	<script type="text/javascript" src="js/angular/angular-route.min.js"></script>
	<script type="text/javascript" src="js/angular/angular-scroll.min.js"></script>
	<script type="text/javascript" src="js/app.module.js"></script>
	<!-- Serviços -->
	<script type="text/javascript" src="js/services/paises.js"></script>

	<!-- Controller -->
	<script type="text/javascript" src="js/controllers/pais.js"></script>
</head>
<body ng-app="rotary">
	<nav class="navbar navbar-default">
		<ul class="nav navbar-nav">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#/paises">Países</a></li>
					<li><a href="#">Estados</a></li>
					<li><a href="#">Cidades</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="#">Distritos</a></li>
					<li><a href="#">Clubes</a></li>
				</ul>
			</li>
			<li><a href="#">Home <span class="sr-only">(current)</span></a></li>
			<li><a href="#">Percapta</a></li>
			<li><a href="#">Maiores Clubes do Distrito</a></li>
			<li><a href="#">Cidades Sem Rotary</a></li>
		</ul>
	</nav>
	<div class="row"></div>

	<div class="container" ng-view>
		
	</div>

</body>
</html>