<form class="form-group">
	<div class="container">
		<div class="row">
			<label for="inputDistrito" class="col-sm-1 control-label">Distrito:</label>
			<div class="col-sm-2">
				<input type="text" ng-model="filtroDistrito" placeholder="Selecione o Distrito" uib-typeahead="distrito as distrito.descricao for distrito in distritos | filter:{descricao:$viewValue}" typeahead-loading="loadingDistritos" typeahead-no-results="noResultsDistritos" class="form-control" id="inputDistrito" typeahead-min-length="0" autocomplete="off">
				<i ng-show="loadingDistritos" class="glyphicon-refresh"></i>
				<div ng-show="noResultsDistritos">
					<i class="glyphicon glyphicon-remove">Não Existem dados</i>
				</div>
			</div>
			<div class="col-sm-2">
				<p class="input-group">
          			<input type="text" class="form-control" uib-datepicker-popup="{{format}}" ng-model="dt" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true" close-text="Close" alt-input-formats="altInputFormats" />
          			<span class="input-group-btn">
            			<button type="button" class="btn btn-default" ng-click="open1()"><i class="glyphicon glyphicon-calendar"></i></button>
          			</span>
        		</p>
    		</div>
    		<div class="col-sm-2">
				<button ng-disabled="!filtroDistrito.iddistritos || !dt" class="btn btn-primary form-control" ng-click="getClubesDistrito(filtroDistrito.iddistritos)">Buscar Clubes</button>				
			</div>
		</div>
	</div>
	<div style="height: 10px;"></div>
	<div class="table-responsive container">
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
					<th class="col-sm-3">Sócios</th>
				</tr>
			</thead>
			<tbody>
				<tr dir-paginate="c in clubes | orderBy: sortKey: reverse |itemsPerPage:20">
					<td>{{c.clube}}</td>
					<td>{{c.distrito}}</td>
					<td>{{c.cidade}}</td>
					<td style="text-align: right;">{{c.populacao}}</td>
					<td>
						<input type="text" ng-model="c.associados" class="form-control"></input>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="row col-sm-12">
			<dir-pagination-controls template-url="js/angular/dirPagination.tpl.html" class="col-sm-6" max-size="5" direction-links="true" boundary-links="true">
			</dir-pagination-controls>
		</div>
	</div>
	<div style="height: 10px;">
		<div class="row">
			<div class="col-sm-2">
				<button ng-disabled="(!dt) || !filtroDistrito.descricao" class="btn btn-success form-control" ng-click="salvarClubesSocios()">Salvar</button>
			</div>
			<div class="col-sm-2">
				<a href="#/clubes" class="btn btn-default form-control">Cancelar</a>
			</div>
		</div>		
	</div>
</form>