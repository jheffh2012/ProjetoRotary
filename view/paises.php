<div class="table-responsive container">
	<div class="row">			
		<div>
			<label for="inputPesquisar" class="col-sm-1 control-label">Filtrar:</label>
			<div class="col-sm-11">
				<input id="inputPesquisar" type="text" class="form-control" ng-model="searchText"></input>
			</div>
		</div>
	</div>
	<div class="container" style="height: 10px">
		
	</div>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th class="col-xs-5" ng-click="sort('nome')">Pais
				<span class="glyphicon sort-icon" ng-show="sortKey=='nome'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</th>
				<th class="col-xs-2">Status</th>
			</tr>
		</thead>
		<tbody>
			<tr dir-paginate="p in paises | filter:searchText | orderBy: sortKey: reverse |itemsPerPage:10">
				<td>{{p.nome}}</td>
				<td>
					<a ng-show="{{p.STATUS == 0}}" class="btn btn-primary pull-center form-control">Ativar</a>
					<a ng-show="{{p.STATUS == 1}}" class="btn btn-danger pull-center form-control">Inativar</a>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="row col-sm-12">
		<dir-pagination-controls template-url="js/angular/dirPagination.tpl.html" class="col-sm-6" max-size="5" direction-links="true" boundary-links="true">
		</dir-pagination-controls>
	</div>
</div>