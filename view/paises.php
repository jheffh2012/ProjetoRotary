<div class="table-responsive container">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th class="col-xs-5">Pais</th>
				<th class="col-xs-2">Status</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="p in paises">
				<th>{{p.nome}}</th>
				<th class="col-xs-2">
					<a ng-show="{{p.STATUS == 0}}" class="btn btn-primary pull-center form-control">Ativar</a>
					<a ng-show="{{p.STATUS == 1}}" class="btn btn-danger pull-center form-control">Inativar</a>
				</th>
			</tr>
		</tbody>
	</table>
</div>