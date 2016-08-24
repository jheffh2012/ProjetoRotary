<div class="container" cg-busy="{promise:null,templateUrl:js/angular/custom-template.html,message:'buscando dados',backdrop:true,delay:0,minDuration:0}">
	<h2 style="background-color: #EEE9E9; border-bottom-style: solid; border-bottom-color: #483D8B; color: #0000FF">{{titulo}}</h2>
	<div class="row">
		<label for="inputDistrito" class="col-sm-1 control-label">Distrito:</label>
		<div class="col-sm-4">
			<input type="text" ng-model="filtroDistrito" placeholder="Selecione o Distrito" uib-typeahead="distrito as distrito.descricao for distrito in distritos | filter:{descricao:$viewValue}" typeahead-loading="loadingDistritos" typeahead-no-results="noResultsDistritos" class="form-control" id="inputDistrito"typeahead-min-length="0" autocomplete="off">
			<i ng-show="loadingDistritos" class="glyphicon-refresh"></i>
			<div ng-show="noResultsDistritos">
				<i class="glyphicon glyphicon-remove">Não Existem dados</i>
			</div>
		</div>
		<div class="col-sm-2">
			<button class="btn btn-primary form-control" ng-click="getPercapitas(filtroDistrito.iddistritos)">Buscar Percapitas</button>
		</div>
	</div>
	<div class="row" style="height: 10px">
		
	</div>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th class="col-xs-5" ng-click="sort('nome')">Cidades
				<span class="glyphicon sort-icon" ng-show="sortKey=='nome'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</th>
				<th class="col-xs-1" ng-click="sort('clubes')">Clubes
				<span class="glyphicon sort-icon" ng-show="sortKey=='clubes'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</th>
				<th class="col-xs-1" ng-click="sort('associados')">Associados
				<span class="glyphicon sort-icon" ng-show="sortKey=='associados'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</th>
				<th class="col-xs-1" ng-click="sort('populacao')">População
				<span class="glyphicon sort-icon" ng-show="sortKey=='populacao'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</th>
				<th class="col-xs-1" ng-click="sort('percapita')">Percapita
				<span class="glyphicon sort-icon" ng-show="sortKey=='percapita'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr dir-paginate="p in percapitas | filter:searchText | orderBy: sortKey: reverse |itemsPerPage:20">
				<td>{{p.cidade}}</td>
				<td style="text-align: right;">{{p.clubes}}</td>
				<td style="text-align: right;">{{p.associados}}</td>
				<td style="text-align: right;">{{p.populacao}}</td>
				<td style="text-align: right;">{{p.percapita}}</td>
			</tr>
			<tr>
				<td><strong>Total:</strong></td>
				<td style="text-align: right;"><strong>{{totaliza.clubes}}</strong></td>
				<td style="text-align: right;"><strong>{{totaliza.associados}}</strong></td>
				<td style="text-align: right;"><strong>{{totaliza.populacao}}</strong></td>
				<td style="text-align: right;"><strong>{{totaliza.percapita}}</strong></td>
			</tr>
		</tbody>
	</table>
	<div class="row" style="height: 10px">
		
	</div>
	
	<!-- <div class="row">
		Média: {{media}}
	</div> -->
	<div class="row col-sm-12">
		<dir-pagination-controls template-url="js/angular/dirPagination.tpl.html" class="col-sm-6" max-size="5" direction-links="true" boundary-links="true">
		</dir-pagination-controls>
	</div>
	<div ng-if="titulo == 'Percapitas' && total.total > 0">
		<div class="row" style="border-bottom-style: inset;">
			<div class="col-sm-3" style="font-size: 17px;">
				Cidades Sem Rotary
			</div>
			<div class="col-sm-2" style="text-align: right; font-size: 17px;">
				{{total.semrotary}}
			</div>
			<div class="col-sm-2" style="text-align: right; font-size: 17px;">
				{{total.percsemrotary}} %
			</div>
		</div>

		<div class="row" style="border-bottom-style: inset;">
			<div class="col-sm-3" style="font-size: 17px;">
				Cidades com Rotary
			</div>
			<div class="col-sm-2" style="text-align: right; font-size: 17px;">
				{{total.comrotary}}
			</div>
			<div class="col-sm-2" style="text-align: right; font-size: 17px;">
				{{total.perccomrotary}} %
			</div>
		</div>
		<div class="row" style="border-bottom-style: inset;">
			<div class="col-sm-3" style="font-size: 17px;">
				Total de Cidades
			</div>
			<div class="col-sm-2" style="text-align: right; font-size: 17px;">
				{{total.total}}
			</div>
			<div class="col-sm-2" style="text-align: right; font-size: 17px;">
				100.00 %
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3" style="font-size: 17px;">
				Percapita Média
			</div>
			<div class="col-sm-2" style="text-align: right; font-size: 17px;">
				{{totaliza.percapita}}
			</div>
		</div>
	</div>
</div>