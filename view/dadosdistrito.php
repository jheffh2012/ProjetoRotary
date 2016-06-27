<form class="form-group">
	<div class="row">
		<label class="col-sm-1" for="inputDescricao">Nome:</label>
		<div class="col-sm-11">
			<input type="text" ng-model="distrito.descricao" class="form-control"/>
		</div>
	</div>
	<div style="height: 10px;">
		
	</div>
	<div class="row">
		<label for="inputPais" class="col-sm-1 control-label">Pais:</label>
		<div class="col-sm-2">
			<input type="text" ng-model="filtroPaises" placeholder="Selecione o País" uib-typeahead="pais as pais.nome for pais in paises | filter:{nome:$viewValue}" typeahead-loading="loadingPaises" typeahead-no-results="noResultsPais" class="form-control" id="inputPais">
			<i ng-show="loadingPaises" class="glyphicon-refresh"></i>
			<div ng-show="noResultsPais">
				<i class="glyphicon glyphicon-remove">Não Existem dados</i>
			</div>
		</div>
		<label for="inputEstado" class="col-sm-1 control-label">Estado:</label>
		<div class="col-sm-3">
			<input type="text" ng-model="filtroEstados" placeholder="Selecione o Estado" uib-typeahead="est as est.estado for est in estados | filter:{estado:$viewValue}" typeahead-loading="loadingEstados" typeahead-no-results="noResults" class="form-control" id="inputEstado" ng-focus="getEstados(filtroPaises.id)">
			<i ng-show="loadingEstados" class="glyphicon-refresh"></i>
			<div ng-show="noResults">
				<i class="glyphicon glyphicon-remove">Não Existem dados</i>
			</div>
		</div>
		<label for="inputCidades" class="col-sm-1 control-label">Cidade:</label>
		<div class="col-sm-4">
			<input type="text" ng-model="filtroCidades" placeholder="Selecione a cidade" uib-typeahead="c as c.descricao for c in cidades | filter:{descricao:$viewValue}" typeahead-loading="loadingCidades" typeahead-no-results="noResults" class="form-control" id="inputCidades" ng-focus="getCidades(filtroEstados.idestados)">
			<i ng-show="loadingCidades" class="glyphicon-refresh"></i>
			<div ng-show="noResults">
				<i class="glyphicon glyphicon-remove">Não Existem dados</i>
			</div>
		</div>
	</div>
	<div style="height: 10px;">
		
	</div>
	<div class="row">
		<div class="col-sm-2">
			<button ng-click="incluirCidade(filtroCidades.idcidades)" ng-disabled="!filtroCidades.descricao" class="btn btn-primary form-control">Incluir Cidade</button>
		</div>
		<div class="col-sm-3">
			<button ng-click="incluirCidadesEstado(filtroEstados.idestados)" ng-disabled="!filtroEstados.idestados || filtroCidades.descricao" class="btn btn-primary form-control">Incluir Cidades do Estado</button>
		</div>
	</div>
	<div style="height: 10px;">
		
	</div>
	<div class="row">
		<div class="col-sm-12">
			<input type="text" class="form-control" ng-model="searchText"></input>
		</div>	
	</div>

	<div style="height: 10px;">
		
	</div>

	<div class="row">
		<div class="table-responsive container">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="col-xs-4" style="text-align: center" ng-click="sort('descricao')">Cidade
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
						<th class="col-xs-2">Excluir</th>
					</tr>
				</thead>
				<tbody>
					<tr dir-paginate="c in distrito.cidades | filter: searchText | orderBy : sortKey : reverse | itemsPerPage:20">
						<td>{{c.descricao}}</td>
						<td>{{c.sigla}}</td>
						<td>{{c.estado}}</td>
						<td style="text-align: right;">{{c.populacao}}</td>
						<td>
							<button class="btn btn-danger form-control" ng-click="deletarCidadeDistrito(c.idcidades)">Excluir</button>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="row">
				<dir-pagination-controls template-url="js/angular/dirPagination.tpl.html" class="col-sm-6" max-size="5" direction-links="true" boundary-links="true">
				</dir-pagination-controls>
			</div>
			<div class="row">
				<div class="col-sm-2">
					<button class="btn btn-success form-control" ng-click="salvarDistrito()">Salvar</button>
				</div>
				<div class="col-sm-2">
					<a href="#/distritos" class="btn btn-default form-control">Cancelar</a>
				</div>
			</div>
		</div>
	</div>
</form>