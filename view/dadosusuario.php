<form class="form-group">
	<h2 style="background-color: #EEE9E9; border-bottom-style: solid; border-bottom-color: #483D8B; color: #0000FF">{{titulo}}</h2>
	<div class="row">
		<label for="inputNome" class="col-sm-1 control-label">Nome:</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="inputNome" ng-model="usuario.nome" placeholder="Digite o Nome"></input>
		</div>
		<label for="inputUsuario" class="col-sm-1 control-label">Usuário:</label>
		<div class="col-sm-5">
			<div class="col-sm-10">
				<input type="text" class="form-control" id="inputUsuario" ng-model="usuario.usuario" placeholder="Digite o Usuário" ng-change="userExists()"></input>
			</div>
			<div class="col-sm-2" ng-if="usuario.usuario.length > 0">
				<span ng-class="{'glyphicon glyphicon-remove':usuariovalido.retorno, 'glyphicon glyphicon-ok':!usuariovalido.retorno}"></span>
			</div>
		</div>
	</div>
	<div style="height: 10px;">

	</div>
	<div class="row" ng-if="!usuario.idusuario">
		<label class="col-sm-1" for="inputSenha">Senha:</label>
		<div class="col-sm-5">
			<input type="password" placeholder="Insira a senha" ng-model="usuario.senha" id="inputSenha" class="form-control"/>
		</div>
		<label class="col-sm-1" for="inputConfirmaSenha">Confirma:</label>
		<div class="col-sm-5">
			<input type="password" placeholder="Confirme a senha" ng-model="usuario.confirmasenha" id="inputConfirmaSenha" class="form-control"/>
		</div>
	</div>
	<div style="height: 10px;">

	</div>
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-3">
			<input type="checkbox" class="col-sm-2" ng-model="usuario.admin">
			<label style="font-weight: bold;">Administrador</label>

		</div>
	</div>
	<div style="height: 10px;">

	</div>
	<div class="row">
		<label for="inputDistrito" class="col-sm-1 control-label">Distrito:</label>
		<div class="col-sm-5">
			<input type="text" ng-model="distrito" placeholder="Selecione o Distrito" uib-typeahead="distrito as distrito.descricao for distrito in selecionadistritos | filter:{descricao:$viewValue}" typeahead-loading="loadingDistritos" typeahead-no-results="noResultsDistritos" class="form-control" id="inputDistrito">
			<i ng-show="loadingDistritos" class="glyphicon-refresh"></i>
			<div ng-show="noResultsDistritos">
				<i class="glyphicon glyphicon-remove">Não Existem dados</i>
			</div>
		</div>
		<div class="col-sm-2">
			<button class="btn btn-primary form-control" ng-click="adicionaDistrito(distrito)">Adicionar</button>
		</div>		
	</div>
	<div style="height: 10px;">

	</div>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th class="col-sm-10" ng-click="sort('descricao')">Distrito
					<span class="glyphicon sort-icon" ng-show="sortKey=='descricao'" ng-class="{'glyphicon glyphicon-triangle-top':reverse, 'glyphicon glyphicon-triangle-bottom':!reverse}" aria-hidden="true"></span>
				</th>
				<th class="col-sm-2">
					
				</th>
			</tr>
		</thead>
		<tbody>
			<tr dir-paginate="d in usuario.distritos | filter:searchText | orderBy: sortKey: reverse |itemsPerPage:20">
				<td>{{d.descricao}}</td>
				<td>
					<button class="btn btn-danger form-control" ng-click="deletaDistrito(d.iddistritos)">Deletar</button>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="row col-sm-12">
		<dir-pagination-controls template-url="js/angular/dirPagination.tpl.html" class="col-sm-6" max-size="5" direction-links="true" boundary-links="true">
	</dir-pagination-controls>
</div>
<div style="height: 10px;">
	
</div>
<div class="row">
	<div class="col-sm-4">

	</div>
	<div class="col-sm-2">
		<button class="btn btn-success form-control" ng-click="salvarUsuario()">Salvar</button>
	</div>
	<div class="col-sm-2">
		<a href="#/usuarios" class="btn btn-danger form-control">Cancelar</a>
	</div>
</div>
</form>