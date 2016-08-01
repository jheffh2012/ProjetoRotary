<form class="form-group">
	<div class="container">
	<h2 style="background-color: #EEE9E9; border-bottom-style: solid; border-bottom-color: #483D8B; color: #0000FF">{{titulo}}</h2>
		<!-- <div class="row">
			<div class="col-xs-10">
				<input type="text" ng-model="searchText" placeholder="Digite o Filtro de Pesquisa" class="form-control"></input>
			</div>
			<div class="col-xs-2">
				<button class="btn btn-primary form-control" ng-click="carregarPaises()">Filtrar</button>
			</div>
		</div -->
		<div class="row">			
			<label for="inputDistrito" class="col-sm-1 control-label">Distrito:</label>
			<div class="col-sm-5">
				<input type="text" ng-model="filtroDistrito" placeholder="Selecione o Distrito" uib-typeahead="distrito as distrito.descricao for distrito in distritos | filter:{descricao:$viewValue}" typeahead-loading="loadingDistritos" typeahead-no-results="noResultsDistritos" class="form-control" id="inputDistrito" typeahead-min-length="0" autocomplete="off">
				<i ng-show="loadingDistritos" class="glyphicon-refresh"></i>
				<div ng-show="noResultsDistritos">
					<i class="glyphicon glyphicon-remove">Não Existem dados</i>
				</div>
			</div>
			<div class="col-sm-2">
				<button class="btn btn-success form-control" ng-click="getCidades(filtroDistrito.iddistritos)">Buscar</button>
			</div>
		</div>
		<div class="container" style="min-height: 10px">
		</div>
		<div class="row">			
			<div>
				<label for="inputPesquisar" class="col-sm-1 control-label">Filtrar:</label>
				<div class="col-sm-11">
					<input id="inputPesquisar" type="text" class="form-control" ng-model="searchText"></input>
				</div>
			</div>

		</div>	
	</div>
	<div class="container" style="height: 10px">
				
	</div>
	
	<div class="table-responsive container">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="col-xs-6" style="text-align: center" ng-click="sort('descricao')">Cidade
						<span class="glyphicon sort-icon" ng-show="sortKey=='descricao'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
					</th>
					<th class="col-xs-2" style="text-align: center" ng-click="sort('sigla')">UF
						<span class="glyphicon sort-icon" ng-show="sortKey=='sigla'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
					</th>
					<th class="col-xs-2" style="text-align: center" ng-click="sort('estado')">Nome Estado
						<span class="glyphicon sort-icon" ng-show="sortKey=='estado'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
					</th>
					<th class="col-xs-2" style="text-align: center" ng-click="sort('populacao')">População
						<span class="glyphicon sort-icon" ng-show="sortKey=='populacao'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr dir-paginate="c in cidades | filter: searchText | orderBy: sortKey: reverse | itemsPerPage:20">
					<td>{{c.descricao}}</td>
					<td>{{c.sigla}}</td>
					<td>{{c.estado}}</td>
					<td style="text-align: right;"><input type="text" class="form-control" ng-model="c.populacao"></input></td>
				</tr>
			</tbody>
		</table>
		<div class="row col-sm-12">
			<dir-pagination-controls template-url="js/angular/dirPagination.tpl.html" class="col-sm-6" max-size="5" direction-links="true" boundary-links="true">
			</dir-pagination-controls>
		</div>
		<div class="row">
			<div class="col-sm-2">
				<button ng-click="salvarDados()" class="btn btn-primary form-control">Salvar</button>
			</div>
			<div class="col-sm-2">
				<a href="#/cidades" class="btn btn-danger form-control">Cancelar</a>
			</div>
		</div>
	</div>
</form>