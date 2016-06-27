<form class="form-group">
	<div class="container">
		<div class="table-responsive container">
			<div class="row">
				<label for="inputPesquisar" class="col-sm-1 control-label">Filtrar:</label>
				<div class="col-sm-11">
					<input id="inputPesquisar" type="text" class="form-control" ng-model="searchText"></input>
				</div>
			</div>
			<div class="container" style="height: 10px">

			</div>
			<div class="row">
				<div class="col-sm-2">
					<a href="#/novodistrito" class="btn btn-success form-control">Incluir</a>
				</div>
			</div>
			<div class="container" style="height: 10px">

			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="col-sm-8" ng-click="sort('descricao')">Distrito
							<span class="glyphicon sort-icon" ng-show="sortKey=='descricao'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
						</th>
						<th class="col-sm-2"></th>
						<th class="col-sm-2"></th>
					</tr>
				</thead>
				<tbody>
					<tr dir-paginate="d in distritos | filter:searchText | orderBy: sortKey: reverse |itemsPerPage:20">
						<td>{{d.descricao}}</td>
						<td>
							<a href="#/editadistrito/{{d.iddistritos}}" class="btn btn-primary pull-center form-control">Alterar</a>
						</td>
						<td>
							<a class="btn btn-danger pull-center form-control" ng-click="deleteDistrito(d.iddistritos)">Deletar</a>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="row col-sm-12">
				<dir-pagination-controls template-url="js/angular/dirPagination.tpl.html" class="col-sm-6" max-size="5" direction-links="true" boundary-links="true">
				</dir-pagination-controls>
			</div>
		</div>
	</div>
</form>