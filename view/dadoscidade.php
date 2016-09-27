<form class="form-group" name="formClube">
	<h2 style="background-color: #EEE9E9; border-bottom-style: solid; border-bottom-color: #483D8B; color: #0000FF">{{titulo}}</h2>
	<div class="row">
		<label for="inputEstado" class="col-sm-1 control-label">Estado:</label>
		<div class="col-sm-2">
			<input type="text" ng-model="cidade.estado" placeholder="Selecione o Estado" uib-typeahead="est as est.estado for est in estados | filter:{estado:$viewValue}" typeahead-loading="loadingEstados" typeahead-no-results="noResults" class="form-control" id="inputEstado" typeahead-min-length="0" autocomplete="off">
			<i ng-show="loadingEstados" class="glyphicon-refresh"></i>
			<div ng-show="noResults">
				<i class="glyphicon glyphicon-remove">Não Existem dados</i>
			</div>
		</div>
		<label class="col-sm-1" for="inputDescricao">Nome:</label>
		<div class="col-sm-5">
			<input type="text" ng-model="cidade.descricao" id="inputDescricao" name="inputDescricao" class="form-control" ng-required="true"/>
		</div>
		<label class="col-sm-1" for="inputPopulacao">População:</label>
		<div class="col-sm-2">
			<input type="number" ng-model="cidade.populacao" id="inputPopulacao" name="inputPopulacao" class="form-control" ng-required="true"/>
		</div>
	</div>
</form>
<div class="row" ng-if="!cidade.estado.idestados && formClube.inputEstado.$dirty">
	<div class="alert alert-danger">
		Informe um estado válido!
	</div>
</div>
<div class="row" ng-if="!cidade.descricao && formClube.inputDescricao.$dirty">
	<div class="alert alert-danger">
		Informe o nome do Clube!
	</div>
</div>
<div class="row">
	<div class="col-sm-2">
		<button class="btn btn-success form-control" ng-click="salvarCidade()" ng-disabled="!cidade.estado.idestados || !cidade.descricao.length > 0">Salvar</button>
	</div>
	<div class="col-sm-2">
		<a href="#/cidades" class="btn btn-default form-control">Cancelar</a>
	</div>
</div>