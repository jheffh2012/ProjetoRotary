<div class="container">
	<h2 style="background-color: #EEE9E9; border-bottom-style: solid; border-bottom-color: #483D8B; color: #0000FF">{{titulo}}</h2>
	<div class="row">
		<label for="inputDistrito" class="col-sm-1 control-label">Distrito:</label>
		<div class="col-sm-4">
			<input type="text" ng-model="filtroDistrito" placeholder="Selecione o Distrito" uib-typeahead="distrito as distrito.descricao for distrito in distritos | filter:{descricao:$viewValue}" typeahead-loading="loadingDistritos" typeahead-no-results="noResultsDistritos" class="form-control" id="inputDistrito" typeahead-min-length="0" autocomplete="off">
			<i ng-show="loadingDistritos" class="glyphicon-refresh"></i>
			<div ng-show="noResultsDistritos">
				<i class="glyphicon glyphicon-remove">Não Existem dados</i>
			</div>
		</div>
		<div class="col-sm-2">
			<button class="btn btn-primary form-control" ng-click="getClubes(filtroDistrito.iddistritos)">Buscar Clubes</button>
		</div>
	</div>
	<div class="row" style="height: 10px">
		
	</div>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th class="col-xs-11" ng-click="sort('descricao')">Clubes
				<span class="glyphicon sort-icon" ng-show="sortKey=='descricao'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</th>
				<th class="col-xs-1" ng-click="sort('socios')">Associados
				<span class="glyphicon sort-icon" ng-show="sortKey=='socios'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr dir-paginate="c in clubes | filter:searchText | orderBy: sortKey: reverse |itemsPerPage:20">
				<td style="text-align: left;">{{c.idclubes}} - {{c.descricao}}</td>
				<td style="text-align: right;">{{c.socios}}</td>
			</tr>
		</tbody>
	</table>
	<div class="row col-sm-12">
		<dir-pagination-controls template-url="js/angular/dirPagination.tpl.html" class="col-sm-6" max-size="5" direction-links="true" boundary-links="true">
		</dir-pagination-controls>
	</div>
</div>