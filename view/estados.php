<form class="form-group">
	<div class="container">
		<div class="row">			
			<label for="inputPais" class="col-sm-1 control-label">Pais:</label>
			<div class="col-sm-3">
				<input type="text" ng-model="filtroPaises" placeholder="Selecione o País" uib-typeahead="pais as pais.nome for pais in paises | filter:{nome:$viewValue}" typeahead-loading="loadingPaises" typeahead-no-results="noResultsPais" class="form-control" id="inputPais">
				<i ng-show="loadingPaises" class="glyphicon-refresh"></i>
				<div ng-show="noResultsPais">
					<i class="glyphicon glyphicon-remove">Não Existem dados</i>
				</div>		
			</div>
			<div class="col-sm-2">
				<button class="btn btn-primary form-control" ng-click="carregarEstados(filtroPaises.id)">Pesquisar</button>
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
					<th class="col-xs-6" style="text-align: left;" ng-click="sort('estado')">Estado
						<span class="glyphicon sort-icon" ng-show="sortKey=='estado'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
					</th>
					<th class="col-xs-2" style="text-align: center" ng-click="sort('sigla')">UF
						<span class="glyphicon sort-icon" ng-show="sortKey=='sigla'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr dir-paginate="e in estados | filter: searchText | orderBy: sortKey: reverse | itemsPerPage:10">
					<td>{{e.estado}}</td>
					<td>{{e.sigla}}</td>
				</tr>
			</tbody>
		</table>
		<div class="row col-sm-12">
			<dir-pagination-controls template-url="js/angular/dirPagination.tpl.html" class="col-sm-6" max-size="5" direction-links="true" boundary-links="true">
			</dir-pagination-controls>
		</div>
	</div>
</form>