<!DOCTYPE html>
<html>
<head>
	<title>Rotary - Controle de Clubes</title>
	<meta charset="UTF-8">

	<link rel="stylesheet" type="text/css" href="js/angular/angular-busy.min.css">
	<link rel="stylesheet" type="text/css" href="js/angular/angular-material.min.css">

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
	<script type="text/javascript" src="js/angular/ngStorage.min.js"></script>
	<script type="text/javascript" src="js/angular/spin.min.js"></script>
	<script type="text/javascript" src="js/angular/angular-spinner.min.js"></script>
	<script type="text/javascript" src="js/angular/angular-loading-spinner.js"></script>
	<script type="text/javascript" src="js/angular/raphael-min.js"></script>
	<script type="text/javascript" src="js/angular/morris.min.js"></script>
	<script type="text/javascript" src="js/angular/angular-morris-chart.min.js"></script>
	<script type="text/javascript" src="js/angular/angular-animate.min.js"></script>
	<script type="text/javascript" src="js/angular/angular-aria.min.js"></script>

	<script type="text/javascript" src="js/app.module.js"></script>
	<script type="text/javascript" src="js/angular/angular-locale_pt-br.js"></script>
	<!-- Interceptors -->
	<script type="text/javascript" src="js/interceptors/autenticheader.js"></script>
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
	<script type="text/javascript" src="js/controllers/principal.js"></script>
	<script type="text/javascript" src="js/controllers/novoclube.js"></script>
	<script type="text/javascript" src="js/controllers/editaclube.js"></script>
	<script type="text/javascript" src="js/controllers/clubesocio.js"></script>
	<script type="text/javascript" src="js/controllers/melhorespercapitas.js"></script>
	<script type="text/javascript" src="js/controllers/melhorarpercapitas.js"></script>
	<script type="text/javascript" src="js/controllers/maioresclubes.js"></script>
	<script type="text/javascript" src="js/controllers/menoresclubes.js"></script>
	<script type="text/javascript" src="js/controllers/atualizapopulacao.js"></script>
	<script type="text/javascript" src="js/controllers/usuario.js"></script>
	<script type="text/javascript" src="js/controllers/novousuario.js"></script>
	<script type="text/javascript" src="js/controllers/editausuario.js"></script>
	<script type="text/javascript" src="js/controllers/logout.js"></script>
	<script type="text/javascript" src="js/controllers/cidadesemrotary.js"></script>
	<script type="text/javascript" src="js/controllers/editacidade.js"></script>
	<script type="text/javascript" src="js/controllers/novacidade.js"></script>
	<script type="text/javascript" src="js/controllers/totalpercapitas.js"></script>
	<script type="text/javascript" src="js/controllers/comparativo.js"></script>
	<script type="text/javascript" src="js/controllers/principaldistrito.js"></script>
</head>
<body ng-app="rotary">
	<div data-ng-controller="principalDistritoController">
		<nav class="navbar navbar-default">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<!-- <li><a href="#/paises">Países</a></li>
						<li><a href="#/estados">Estados</a></li> -->
						<li><a href="#/cidades">Cidades</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#/distritos">Distritos</a></li>
						<li><a href="#/clubes">Clubes</a></li>
						<li><a href="#/usuarios">Usuários</a></li>		
					</ul>
				</li>
				<li><a href="#/">Home <span class="sr-only">(current)</span></a></li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Percapita <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#/melhorespercapitas">Melhores</a></li>
						<li><a href="#/melhorarpercapitas">Melhorar</a></li>
						<li><a href="#/totalpercapitas">Total</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clubes <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#/maioresclubes">Maiores Clubes</a></li>
						<li><a href="#/menoresclubes">Menores Clubes</a></li>
					</ul>
				</li>				
				<li>
					<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cidades <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#/semrotary">Cidades Sem Rotary</a></li>
						<li><a href="#/comparativo">Comparativo Entre Maiores e Menores</a></li>
					</ul>
				</li>
				<li style="margin-top: 5px;">
					<div data-ng-if="!selecionar">
						<button class="btn btn-success form-control" data-ng-click="getDistritos()">Gerenciar Distritos</button>
					</div>
					<div data-ng-if="selecionar">
						<input type="text" ng-model="distrito" placeholder="Selecione o Distrito" uib-typeahead="distrito as distrito.descricao for distrito in distritos | filter:{descricao:$viewValue}" typeahead-loading="loadingDistritos" typeahead-no-results="noResultsDistritos" class="form-control" id="inputDistrito" typeahead-min-length="0" autocomplete="off" typeahead-on-select="onSelect($item, $model, $label, $event)">
						<i ng-show="loadingDistritos" class="glyphicon-refresh"></i>
						<div ng-show="noResultsDistritos">
							<i class="glyphicon glyphicon-remove">Não Existem dados</i>
						</div>
					</div>
				</li>
				<li><a>Bem vindo, {{usuarioLogado}}</a></li>
				<li><a href="#/logout">Sair</a></li>
			</ul>
		</nav>
	<span us-spinner="{radius:30, width:8, length: 16}"></span>
		<!-- <div class="row">
			<div class="container">
				<div class="col-md-2" data-ng-if="!selecionar">
					<button class="btn btn-success form-control" data-ng-click="getDistritos()">Buscar Distritos</button>
				</div>
				<div class="col-md-3" data-ng-if="selecionar">
					<input type="text" ng-model="filtroDistrito" placeholder="Selecione o Distrito" uib-typeahead="distrito as distrito.descricao for distrito in distritos | filter:{descricao:$viewValue}" typeahead-loading="loadingDistritos" typeahead-no-results="noResultsDistritos" class="form-control" id="inputDistrito" typeahead-min-length="0" autocomplete="off" typeahead-on-select="onSelect($item, $model, $label, $event)">
					<i ng-show="loadingDistritos" class="glyphicon-refresh"></i>
					<div ng-show="noResultsDistritos">
						<i class="glyphicon glyphicon-remove">Não Existem dados</i>
					</div>
				</div>
			</div>
		</div> -->
	</div>
	<div class="container" ng-view>
		
	</div>

</body>
</html>