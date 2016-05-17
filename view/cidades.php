<form class="form-group">
	<div class="container">
		<!-- <div class="row">
			<div class="col-xs-10">
				<input type="text" ng-model="searchText" placeholder="Digite o Filtro de Pesquisa" class="form-control"></input>
			</div>
			<div class="col-xs-2">
				<button class="btn btn-primary form-control" ng-click="carregarPaises()">Filtrar</button>
			</div>
		</div -->
		<div class="row">			
			<label for="inputPais" class="col-sm-1 control-label">Pais:</label>
			<div class="col-sm-3">
				<input type="text" ng-model="filtroPaises" placeholder="Selecione o País" uib-typeahead="pais as pais.nome for pais in paises | filter:{nome:$viewValue}" typeahead-loading="loadingPaises" typeahead-no-results="noResultsPais" class="form-control" id="inputPais">
				<i ng-show="loadingPaises" class="glyphicon-refresh"></i>
				<div ng-show="noResultsPais">
					<i class="glyphicon glyphicon-remove">Não Existem dados</i>
				</div>		
			</div>				
			<label for="inputEstado" class="col-sm-1 control-label">Estado:</label>
			<div class="col-sm-5">
				<input type="text" ng-model="filtroEstados" placeholder="Selecione o Estado" uib-typeahead="est as est.estado for est in estados | filter:{estado:$viewValue}" typeahead-loading="loadingEstados" typeahead-no-results="noResults" class="form-control" id="inputEstado" ng-focus="carregarEstados(filtroPaises.id)">
				<i ng-show="loadingEstados" class="glyphicon-refresh"></i>
				<div ng-show="noResults">
					<i class="glyphicon glyphicon-remove">Não Existem dados</i>
				</div>
			</div>
			<div class="col-sm-2">
				<button class="btn btn-primary form-control" ng-click="getCidades(filtroEstados.idestados)">Pesquisar</button>
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
						<span class="glyphicon sort-icon" ng-show="sortKey=='descricao'" ng-class="{'glyphicon glyphicon-chevron-up':reverse, 'glyphicon glyphicon-chevron-down':!reverse}"></span>
					</th>
					<th class="col-xs-2" style="text-align: center">UF</th>
					<th class="col-xs-2" style="text-align: center">Nome Estado</th>
					<th class="col-xs-2" style="text-align: center">População</th>
				</tr>
			</thead>
			<tbody>
				<tr dir-paginate="c in cidades | filter: searchText | orderBy: sortKey: reverse | itemsPerPage:10">
					<td>{{c.descricao}}</td>
					<td>{{c.sigla}}</td>
					<td>{{c.estado}}</td>
					<td style="text-align: right;">{{c.populacao}}</td>
				</tr>
			</tbody>
		</table>
		<div class="row col-sm-12">
			<dir-pagination-controls template-url="js/angular/dirPagination.tpl.html" class="col-sm-6" max-size="5" direction-links="true" boundary-links="true">
			</dir-pagination-controls>
		</div>
	</div>
</form>