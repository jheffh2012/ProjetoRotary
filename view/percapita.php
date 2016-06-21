<div class="container">
	<h2 style="background-color: #EEE9E9; border-bottom-style: solid; border-bottom-color: #483D8B; color: #0000FF">{{titulo}}</h2>
	<div class="row">
		<label for="inputDistrito" class="col-sm-1 control-label">Distrito:</label>
		<div class="col-sm-4">
			<input type="text" ng-model="filtroDistrito" placeholder="Selecione o Distrito" uib-typeahead="distrito as distrito.descricao for distrito in distritos | filter:{descricao:$viewValue}" typeahead-loading="loadingDistritos" typeahead-no-results="noResultsDistritos" class="form-control" id="inputDistrito">
			<i ng-show="loadingDistritos" class="glyphicon-refresh"></i>
			<div ng-show="noResultsDistritos">
				<i class="glyphicon glyphicon-remove">Não Existem dados</i>
			</div>
		</div>
		<div class="col-sm-2">
			<button class="btn btn-primary form-control" ng-click="getPercapitas(filtroDistrito.iddistritos)">Buscar Percapitas</button>
		</div>
	</div>
	<div class="row" style="height: 10px">
		
	</div>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th class="col-xs-5" ng-click="sort('nome')">Cidades
				<span class="glyphicon sort-icon" ng-show="sortKey=='nome'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</th>
				<th class="col-xs-1" ng-click="sort('clubes')">Clubes
				<span class="glyphicon sort-icon" ng-show="sortKey=='clubes'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</th>
				<th class="col-xs-1" ng-click="sort('associados')">Sócios
				<span class="glyphicon sort-icon" ng-show="sortKey=='associados'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</th>
				<th class="col-xs-1" ng-click="sort('populacao')">População
				<span class="glyphicon sort-icon" ng-show="sortKey=='populacao'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</th>
				<th class="col-xs-1" ng-click="sort('percapita')">Percapita
				<span class="glyphicon sort-icon" ng-show="sortKey=='percapita'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</th>
				<th class="col-xs-1" ng-click="sort('media')">Média
				<span class="glyphicon sort-icon" ng-show="sortKey=='media'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr dir-paginate="p in percapitas | filter:searchText | orderBy: sortKey: reverse |itemsPerPage:10">
				<td>{{p.cidade}}</td>
				<td style="text-align: right;">{{p.clubes}}</td>
				<td style="text-align: right;">{{p.associados}}</td>
				<td style="text-align: right;">{{p.populacao}}</td>
				<td style="text-align: right;">{{p.percapita}}</td>
				<td style="text-align: right;">{{p.media}}</td>
			</tr>
		</tbody>
	</table>
	<div class="row col-sm-12">
		<dir-pagination-controls template-url="js/angular/dirPagination.tpl.html" class="col-sm-6" max-size="5" direction-links="true" boundary-links="true">
		</dir-pagination-controls>
	</div>
</div>