<form class="form-group">
	<div class="row">
		<label for="inputDistrito" class="col-sm-1 control-label">Distrito:</label>
		<div class="col-sm-5">
			<input type="text" ng-model="clube.distrito" placeholder="Selecione o Distrito" uib-typeahead="distrito as distrito.descricao for distrito in distritos | filter:{descricao:$viewValue}" typeahead-loading="loadingDistritos" typeahead-no-results="noResultsDistritos" class="form-control" id="inputDistrito">
			<i ng-show="loadingDistritos" class="glyphicon-refresh"></i>
			<div ng-show="noResultsDistritos">
				<i class="glyphicon glyphicon-remove">Não Existem dados</i>
			</div>
		</div>
		<label for="inputCidades" class="col-sm-1 control-label">Cidade:</label>
		<div class="col-sm-5">
			<input type="text" ng-model="clube.cidade" placeholder="Selecione a cidade" uib-typeahead="c as c.descricao for c in cidades | filter:{descricao:$viewValue}" typeahead-loading="loadingCidades" typeahead-no-results="noResults" class="form-control" id="inputCidades" ng-focus="getCidadesDistrito(clube.distrito.iddistritos)">
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
			<input type="text" ng-model="clube.descricao" id="inputDescricao" class="form-control"/>
		</div>
	</div>
	<div style="height: 10px;">
	
	</div>
	<div class="row">
		<div class="col-sm-2">
			<button class="btn btn-success form-control" ng-click="salvarClube()">Salvar</button>
		</div>
		<div class="col-sm-2">
			<a href="#/clubes" class="btn btn-default form-control">Cancelar</a>
		</div>
	</div>
</form>