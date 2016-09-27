<form class="form-group">
	<div class="container">
		<div class="table-responsive container">
			<h2 style="background-color: #EEE9E9; border-bottom-style: solid; border-bottom-color: #483D8B; color: #0000FF">{{titulo}}</h2>
			<div class="row">
				<!-- <label for="inputDistrito" class="col-md-1 control-label">Distrito:</label>
				<div class="col-md-4">
					<input type="text" ng-model="filtroDistrito" placeholder="Selecione o Distrito" uib-typeahead="distrito as distrito.descricao for distrito in distritos | filter:{descricao:$viewValue}" typeahead-loading="loadingDistritos" typeahead-no-results="noResultsDistritos" class="form-control" id="inputDistrito" typeahead-min-length="0" autocomplete="off">
					<i ng-show="loadingDistritos" class="glyphicon-refresh"></i>
					<div ng-show="noResultsDistritos">
						<i class="glyphicon glyphicon-remove">Não Existem dados</i>
					</div>
				</div> -->
				<div class="col-md-2">
					<button class="form-control btn btn-primary" ng-click="getClubesDistrito()">Buscar Clubes</button>
				</div>
			</div>
			<div style="height: 10px;">
				
			</div>	
			<div class="row">
				<label for="inputPesquisar" class="col-md-1 control-label">Filtrar:</label>
				<div class="col-md-11">
					<input id="inputPesquisar" type="text" class="form-control" ng-model="searchText"></input>
				</div>
			</div>
			<div class="container" style="height: 10px">

			</div>
			<div class="row">
				<div class="col-md-2">
					<a href="#/novoclube" class="btn btn-success form-control">Incluir</a>
				</div>
				<div class="col-md-2">
					<a href="#/clubesocios" class="btn btn-primary form-control">Associados</a>
				</div>
			</div>
			<div class="container" style="height: 10px">

			</div>
			<!-- <div class="row" style="border-bottom-style: inset;">
				<div class="col-md-1" ng-click="sort('clube')">
					<button class="form-control btn btn-default">Clube</button>
				</div>
				<div class="col-md-1" ng-click="sort('clube')">
					<span class="btn btn-default glyphicon sort-icon" ng-show="sortKey=='clube'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</div>
				<div class="col-md-1" ng-click="sort('distrito')">
					<button class="form-control btn btn-default">Distrito</button>
				</div>
				<div class="col-md-1" ng-click="sort('distrito')">
					<span class="btn btn-default glyphicon sort-icon" ng-show="sortKey=='distrito'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</div>
				<div class="col-md-1" ng-click="sort('cidade')">
					<button class="form-control btn btn-default">Cidade</button>
				</div>
				<div class="col-md-1" ng-click="sort('cidade')">
					<span class="btn btn-default glyphicon sort-icon" ng-show="sortKey=='cidade'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</div>
				<div class="col-md-2" ng-click="sort('populacao')">
					<button class="form-control btn btn-default">População</button>
				</div>
				<div class="col-md-1" ng-click="sort('populacao')">
					<span class="btn btn-default  glyphicon sort-icon" ng-show="sortKey=='populacao'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</div>
				<div class="col-md-1" ng-click="sort('socios')">
					<button class="form-control btn btn-default">Sócios</button>
				</div>
				<div class="col-md-1" ng-click="sort('socios')">
					<span class="btn btn-default  glyphicon sort-icon" ng-show="sortKey=='socios'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</div>
			</div>-->
			<table class="table table-bordered">
				<tr>
					<th class="col-md-3" ng-click="sort('clube')">Clube
						<span class="glyphicon sort-icon" ng-show="sortKey=='clube'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
					</th>
					<th class="col-md-1" ng-click="sort('distrito')">Distrito
						<span class="glyphicon sort-icon" ng-show="sortKey=='distrito'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
					</th>
					<th class="col-md-2" ng-click="sort('cidade')">Cidade
						<span class="glyphicon sort-icon" ng-show="sortKey=='cidade'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
					</th>
					<th class="col-md-2" ng-click="sort('populacao')">População
						<span class="glyphicon sort-icon" ng-show="sortKey=='populacao'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
					</th>
					<th class="col-md-1" ng-click="sort('socios')">Associados
						<span class="glyphicon sort-icon" ng-show="sortKey=='socios'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
					</th>
					<th class="col-md-3">
						Ações
					</th>
				</tr>
			</table>
			<div class="row container" style="border-bottom-style: inset;" dir-paginate="c in clubes | filter:searchText | orderBy: sortKey: reverse |itemsPerPage:20">
				<div class="col-md-3">
					<h5>{{c.clube}}</h5>
				</div>
				<div class="col-md-1">
					<h5>{{c.distrito}}</h5>
				</div>
				<div class="col-md-2">
					<h5>{{c.cidade}}</h5>
				</div>
				<div class="col-md-2" style="text-align: right;">
					<h5>{{c.populacao}}</h5>
				</div>
				<div class="col-md-1" style="text-align: right;">
					<h5>{{c.socios}}</h5>
				</div>
				<div class="col-md-1">
					<a href="#/editaclube/{{c.idclubes}}" class="btn btn-primary pull-center form-control">Alterar</a>
				</div>
				<div class="col-md-1">
					<a class="btn btn-default pull-center form-control" ng-click="getSociosClube(c)">Sócios</a>
				</div>
				<div class="col-md-1">
					<a class="btn btn-danger pull-center form-control" ng-click="deleteClube(c.idclubes)">Deletar</a>
				</div>
				<div ng-if="c.listasocios && c.listasocios.length > 0">
					<div style="height: 80px;">
					</div>
					<div style="height: 200px;" bar-chart  
						bar-data='c.listasocios'
						bar-x='data'
						bar-y='["socios"]'
						bar-labels='["Sócios"]'
						bar-colors='["#31C0BE"]'
						bar-x-label-format="xLabelFor">
					</div>
					<div style="height: 80px;">
					</div>
				</div>
			</div>
			<!-- <table class="table table-bordered"> -->
				<!-- <thead>
					<tr>
						<th class="col-md-3" ng-click="sort('clube')">Clube
							<span class="glyphicon sort-icon" ng-show="sortKey=='clube'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
						</th>
						<th class="col-md-2" ng-click="sort('distrito')">Distrito
							<span class="glyphicon sort-icon" ng-show="sortKey=='distrito'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
						</th>
						<th class="col-md-2" ng-click="sort('cidade')">Cidade
							<span class="glyphicon sort-icon" ng-show="sortKey=='cidade'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
						</th>
						<th class="col-md-2" ng-click="sort('populacao')">População
							<span class="glyphicon sort-icon" ng-show="sortKey=='populacao'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
						</th>
						<th class="col-md-1"></th>
						<th class="col-md-1"></th>
						<th class="col-md-1"></th>
					</tr>
				</thead> -->
				<!-- <tbody>
					<tr dir-paginate="c in clubes | filter:searchText | orderBy: sortKey: reverse |itemsPerPage:20">
						<td>{{c.clube}}</td>
						<td>{{c.distrito}}</td>
						<td>{{c.cidade}}</td>
						<td style="text-align: right;">{{c.populacao}}</td>
						<td>
							<a href="#/editaclube/{{c.idclubes}}" class="btn btn-primary pull-center form-control">Alterar</a>
						</td>
						<td>
							<a class="btn btn-default pull-center form-control" ng-click="getSociosClube(c)">Sócios</a>
						</td>
						<td>
							<a class="btn btn-danger pull-center form-control" ng-click="deleteClube(c.idclubes)">Deletar</a>
						</td>
					</tr>
				</tbody>
			</table> -->
			<div class="row col-md-12">
				<dir-pagination-controls template-url="js/angular/dirPagination.tpl.html" class="col-md-6" max-size="5" direction-links="true" boundary-links="true">
				</dir-pagination-controls>
			</div>
		</div>
	</div>
</form>