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
					<a href="#/novoclube" class="btn btn-success form-control">Incluir</a>
				</div>
				<div class="col-sm-2">
					<a href="#/clubesocios" class="btn btn-primary form-control">Sócios</a>
				</div>
			</div>
			<div class="container" style="height: 10px">

			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="col-sm-3" ng-click="sort('clube')">Clube
							<span class="glyphicon sort-icon" ng-show="sortKey=='clube'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
						</th>
						<th class="col-sm-2" ng-click="sort('distrito')">Distrito
							<span class="glyphicon sort-icon" ng-show="sortKey=='distrito'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
						</th>
						<th class="col-sm-2" ng-click="sort('cidade')">Cidade
							<span class="glyphicon sort-icon" ng-show="sortKey=='cidade'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
						</th>
						<th class="col-sm-2" ng-click="sort('populacao')">População
							<span class="glyphicon sort-icon" ng-show="sortKey=='populacao'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
						</th>
						<th class="col-sm-1"></th>
						<th class="col-sm-1"></th>
					</tr>
				</thead>
				<tbody>
					<tr dir-paginate="c in clubes | filter:searchText | orderBy: sortKey: reverse |itemsPerPage:20">
						<td>{{c.clube}}</td>
						<td>{{c.distrito}}</td>
						<td>{{c.cidade}}</td>
						<td style="text-align: right;">{{c.populacao}}</td>
						<td>
							<a href="#/editaclube/{{c.idclubes}}" class="btn btn-primary pull-center form-control">Alterar</a>
						</td>
						<td>
							<a class="btn btn-danger pull-center form-control" ng-click="deleteClube(c.idclubes)">Deletar</a>
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