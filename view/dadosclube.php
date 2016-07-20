<form class="form-group" name="formClube">
	<h2 style="background-color: #EEE9E9; border-bottom-style: solid; border-bottom-color: #483D8B; color: #0000FF">{{titulo}}</h2>
	<div class="row">
		<label for="inputDistrito" class="col-sm-1 control-label">Distrito:</label>
		<div class="col-sm-5">
			<input type="text" ng-model="clube.distrito" placeholder="Selecione o Distrito" uib-typeahead="distrito as distrito.descricao for distrito in distritos | filter:{descricao:$viewValue}" typeahead-loading="loadingDistritos" typeahead-no-results="noResultsDistritos" class="form-control" id="inputDistrito" name="inputDistrito" ng-required="true" typeahead-min-length="0" typeahead-on-select="onSelect($item, $model, $label, $event)">
			<i ng-show="loadingDistritos" class="glyphicon-refresh"></i>
			<div ng-show="noResultsDistritos">
				<i class="glyphicon glyphicon-remove">Não Existem dados</i>
			</div>
		</div>
		<label for="inputCidades" class="col-sm-1 control-label">Cidade:</label>
		<div class="col-sm-5">
			<input type="text" ng-model="clube.cidade" placeholder="Selecione a cidade" uib-typeahead="c as c.descricao for c in cidades | filter:{descricao:$viewValue}" typeahead-loading="loadingCidades" typeahead-no-results="noResults" class="form-control" id="inputCidades" name="inputCidades" typeahead-on-select="onSelectClubesCidades($item, $model, $label, $event)" ng-required="true" typeahead-min-length="0">
			<i ng-show="loadingCidades" class="glyphicon-refresh"></i>
			<div ng-show="noResults">
				<i class="glyphicon glyphicon-remove">Não Existem dados</i>
			</div>
		</div>
	</div>
	<div style="height: 10px;">

	</div>
	<div class="row">
		<label class="col-sm-1" for="inputDescricao">Nome:</label>
		<div class="col-sm-11">
			<input type="text" ng-model="clube.descricao" id="inputDescricao" name="inputDescricao" class="form-control" ng-required="true"/>
		</div>
	</div>
	<div style="height: 10px;">
	
	</div>
</form>
<div class="row" ng-if="!clube.distrito.iddistritos && formClube.inputDistrito.$dirty">
	<div class="alert alert-danger">
		Informe um distrito válido!
	</div>
</div>
<div class="row" ng-if="!clube.cidade.descricao && formClube.inputCidades.$dirty">
	<div class="alert alert-danger">
		Informe uma cidade válida!
	</div>
</div>
<div class="row" ng-if="!clube.descricao && formClube.inputDescricao.$dirty">
	<div class="alert alert-danger">
		Informe o nome do Clube!
	</div>
</div>
<div class="row">
	<div class="col-sm-2">
		<button class="btn btn-success form-control" ng-click="salvarClube()" ng-disabled="!clube.distrito.iddistritos || !clube.cidade.descricao || !clube.descricao || !clube.descricao.length > 0">Salvar</button>
	</div>
	<div class="col-sm-2">
		<a href="#/clubes" class="btn btn-default form-control">Cancelar</a>
	</div>
</div>
<div style="height: 10px;">
	
</div>
<table ng-if="sociosclube && sociosclube.length > 0" class="table table-bordered">
	<thead>
		<tr>
			<th class="col-sm-4" ng-click="sort('data')">Data
				<span class="glyphicon sort-icon" ng-show="sortKey=='descricao'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
			</th>
			<th class="col-sm-4" ng-click="sort('socios')">Sócios
				<span class="glyphicon sort-icon" ng-show="sortKey=='descricao'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
			</th>
			<th class="col-sm-2"></th>
		</tr>
	</thead>
	<tbody>
		<tr dir-paginate="sc in sociosclube | filter:searchText | orderBy: sortKey: reverse |itemsPerPage:20">
			<td>{{sc.data}}</td>
			<td>{{sc.socios}}</td>
			<td>
				<a class="btn btn-danger pull-center form-control" ng-click="deleteSociosClube(sc.id)">Deletar</a>
			</td>
		</tr>
	</tbody>
</table>
<div class="row col-sm-12">
	<dir-pagination-controls template-url="js/angular/dirPagination.tpl.html" class="col-sm-6" max-size="5" direction-links="true" boundary-links="true">
	</dir-pagination-controls>
</div>
<div class="row" ng-if="clubescidade && clubescidade.length > 0">
	<h3>Clubes dessa mesma cidade:</h3>
	<div class="col-sm-12" ng-repeat="cc in clubescidade">
		<a class="label label-default">{{cc.clube}}</a>
	</div>
</div>