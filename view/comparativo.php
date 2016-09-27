<div class="container" cg-busy="{promise:null,templateUrl:js/angular/custom-template.html,message:'buscando dados',backdrop:true,delay:0,minDuration:0}">
	<h2 style="background-color: #EEE9E9; border-bottom-style: solid; border-bottom-color: #483D8B; color: #0000FF">{{titulo}}</h2>
	<div class="row">
		<!-- <label for="inputDistrito" class="col-sm-1 control-label">Distrito:</label>
		<div class="col-sm-4">
			<input type="text" ng-model="filtroDistrito" placeholder="Selecione o Distrito" uib-typeahead="distrito as distrito.descricao for distrito in distritos | filter:{descricao:$viewValue}" typeahead-loading="loadingDistritos" typeahead-no-results="noResultsDistritos" class="form-control" id="inputDistrito"typeahead-min-length="0" autocomplete="off">
			<i ng-show="loadingDistritos" class="glyphicon-refresh"></i>
			<div ng-show="noResultsDistritos">
				<i class="glyphicon glyphicon-remove">Não Existem dados</i>
			</div>
		</div> -->
		<div class="col-sm-2">
			<button class="btn btn-primary form-control" ng-click="getComparativo()">Buscar Cidades</button>
		</div>
	</div>
	<div class="row" style="height: 10px">
		
	</div>
	<div class="col-sm-6">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="col-xs-5">Cidades</th>
					<th class="col-xs-1">Associados</th>
					<th class="col-xs-1">População</th>
					<th class="col-xs-1">Percapita</th>
				</tr>
			</thead>
			<tbody>
				<tr dir-paginate="maior in Maiores | filter:searchText | orderBy: sortKey: reverse |itemsPerPage:20">
					<td>{{maior.cidade}}</td>
					<td style="text-align: right;">{{maior.associados}}</td>
					<td style="text-align: right;">{{maior.populacao}}</td>
					<td style="text-align: right;">{{maior.percapita}}</td>
				</tr>
				<tr>
					<td><strong>Total</strong></td>
					<td style="text-align: right;"><strong>{{totalMaiores.associados}}</strong></td>
					<td style="text-align: right;"><strong>{{totalMaiores.populacao}}</strong></td>
					<td style="text-align: right;"><strong>{{totalMaiores.percapita}}</strong></td>
				</tr>
			</tbody>
		</table>	
	</div>
	<div class="col-sm-6">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="col-xs-5">Cidades</th>
					<th class="col-xs-1">Associados</th>
					<th class="col-xs-1">População</th>
					<th class="col-xs-1">Percapita</th>
				</tr>
			</thead>
			<tbody>
				<tr dir-paginate="menor in Menores | filter:searchText | orderBy: sortKey: reverse |itemsPerPage:20">
					<td>{{menor.cidade}}</td>
					<td style="text-align: right;">{{menor.associados}}</td>
					<td style="text-align: right;">{{menor.populacao}}</td>
					<td style="text-align: right;">{{menor.percapita}}</td>
				</tr>
				<tr>
					<td><strong>Total</strong></td>
					<td style="text-align: right;"><strong>{{totalMenores.associados}}</strong></td>
					<td style="text-align: right;"><strong>{{totalMenores.populacao}}</strong></td>
					<td style="text-align: right;"><strong>{{totalMenores.percapita}}</strong></td>
				</tr>
			</tbody>
		</table>	
	</div>

	<div class="row" style="height: 10px">
		
	</div>
	
	<!-- <div class="row">
		Média: {{media}}
	</div> -->
	<div class="row col-sm-12">
		<dir-pagination-controls template-url="js/angular/dirPagination.tpl.html" class="col-sm-6" max-size="5" direction-links="true" boundary-links="true">
		</dir-pagination-controls>
	</div>
</div>