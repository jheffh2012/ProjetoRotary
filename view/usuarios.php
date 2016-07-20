<form class="form-group">
	<div class="table-responsive">
		<h2 style="background-color: #EEE9E9; border-bottom-style: solid; border-bottom-color: #483D8B; color: #0000FF">{{titulo}}</h2>
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
		<div class="row">
			<div class="col-sm-2">
				<button class="form-control btn btn-success" ng-click="insertUsuario()">Incluir</button>
			</div>
		</div>
		<div class="container" style="height: 10px">
			
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="col-sm-8" ng-click="sort('nome')">Pais
					<span class="glyphicon sort-icon" ng-show="sortKey=='nome'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
					</th>
					<th class="col-sm-2"></th>
				</tr>
			</thead>
			<tbody>
				<tr dir-paginate="u in usuarios | filter:searchText | orderBy: sortKey: reverse |itemsPerPage:20">
					<td>{{u.nome}}</td>
					<td>
						<div class="col-sm-6">
							<button class="form-control btn btn-primary" ng-click="editaUsuario(u.idusuario)">Alterar</button>
						</div>
						<div class="col-sm-6">
							<button class="form-control btn btn-danger">Excluir</button>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="row col-sm-12">
			<dir-pagination-controls template-url="js/angular/dirPagination.tpl.html" class="col-sm-6" max-size="5" direction-links="true" boundary-links="true">
			</dir-pagination-controls>
		</div>
	</div>
</form>