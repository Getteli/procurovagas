<!-- layout onde esse conteudo sera apresentado -->
@extends('default')

<!-- conteudo -->
@section('content')
	<nav aria-label="breadcrumb" class="mt-5">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('index')}}">Início</a></li>
			<li class="breadcrumb-item active-bc" aria-current="page">Como criar uma vaga de emprego ?</li>
		</ol>
	</nav>
	<div class="container cardstyle mt-5 mb-5">
		<h1 class="display-6">Cadastrar vaga de emprego</h1>
		<div class="container p-5 justify">
			<h2 class="subtitle">
				cadastre sua vaga diretamente conosco
			</h2>
			<p>
				Ao cadastrar sua vaga, ela ficará sendo exibida conforme os dados e informações que você preencheu até a <b>data limite</b> determinada por você mesmo. Até o momento presente, estamos aceitando e-mails de todos os tipos, porém pode ocorrer de uma análise de tempos em tempos para conferir se a vaga é valida e a empresa também. Tome cuidado e colabore, não faça vagas fraudulentas.
			</p>
			<!-- form -->
			<div class="container row">
				<div class="col-lg-7 col-md-12">
					<!-- notifications -->
					@if(Session::has('message'))
						<div class="alert alert-{{ Session::get('message')['type'] }}" role="alert">
							<h4 class="alert-heading">{{ Session::get('message')['title'] }}</h4>
							<p>{{ Session::get('message')['message'] }}</p>
							@if(isset(Session::get('message')['messagetwo']))
								<hr>
								<p class="mb-0">{{ Session::get('message')['messagetwo'] }}</p>
							@endif
						</div>
					@endif
					<div class="alert alert-info alert-sm border-info shadow-sm">
						<i class="bi bi-info-circle-fill text-info me-2"></i>As informações da empresa e recrutador não serão exibidas.
					</div>
					<form action="{{route('create.vaga.manually')}}" method="POST">
						@csrf
						<div class="row row-cols-md-2 row-cols-1 g-3 box-separate mt-3">
							<div class="col">
								<i class="bi bi-info-lg information" title="seu cnpj precisa ser válido E sem caracter especial. Caso não busque os dados, continue preenchendo manualmente"></i>
								<label for="inputCnpj" class="form-label">CNPJ</label>
								<i class="required">*</i>
								<input type="text" id="inputCnpj" name="cnpj" maxlength="19" class="form-control" placeholder="00000000000100" required value="{{old('cnpj')}}">
							</div>
							<div class="col">
								<label for="inputEmail" class="form-label">Email</label>
								<i class="required">*</i>
								<input type="email" id="inputEmail" name="email" maxlength="80" class="form-control" placeholder="empresa@gmail.." required value="{{old('email')}}">
							</div>
							<div class="col">
								<i class="bi bi-info-lg information" title="caso não deseje colocar o nome, pode colocar o nome da empresa"></i>
								<label for="inputNome" class="form-label">Nome Recrutador</label>
								<i class="required">*</i>
								<input type="text" id="inputNome" name="nomeRecrutador" maxlength="50" class="form-control" placeholder="Seu nome" required value="{{old('nomeRecrutador')}}">
							</div>
							<div class="col">
								<label for="inputRSocial" class="form-label">Razão social</label>
								<i class="required">*</i>
								<input type="text" id="inputRSocial" name="razaoSocial" maxlength="60" class="form-control" placeholder="Nome Empresa.." required value="{{old('razaoSocial')}}">
							</div>
							<div class="col">
								<i class="bi bi-info-lg information" title="caso não escolha o estado, será exibido de todo o Brasil"></i>
								<label for="inputState" class="form-label">Estado</label>
								<select id="inputState" name="state" class="form-select">
									<option value="">Escolha</option>
									<option>...</option>
								</select>
							</div>
							<div class="col">
								<i class="bi bi-info-lg information" title="escolha o estado primeiro"></i>
								<label for="inputCity" class="form-label">Cidade</label>
								<select id="inputCity" name="city" class="form-select">
									<option value="">Escolha o estado</option>
								</select>
							</div>
							<div class="col">
								<label for="inputCep" class="form-label">CEP</label>
								<i class="required">*</i>
								<input type="text" id="inputCep" name="cep" maxlength="13" class="form-control" placeholder="00000-000" required value="{{old('cep')}}">
							</div>
							<div class="col">
								<label for="inputLogradouro" class="form-label">Logradouro</label>
								<i class="required">*</i>
								<input type="text" id="inputLogradouro" name="logradouro" maxlength="100" class="form-control" placeholder="rua tal..." required value="{{old('logradouro')}}">
							</div>
							<div class="col">
								<label for="inputComplemento" class="form-label">Complemento/n°</label>
								<i class="required">*</i>
								<input type="text" id="inputComplemento" name="complemento" maxlength="45" class="form-control" placeholder="quadra X, lote Y..." required value="{{old('complemento')}}">
							</div>
							<div class="col">
								<label for="inputBairro" class="form-label">Bairro</label>
								<i class="required">*</i>
								<input type="text" id="inputBairro" name="bairro" maxlength="45" class="form-control" placeholder="Bairro" required value="{{old('bairro')}}">
							</div>
							<div class="col-md-12">
								<label for="inputAboutEmpresa" class="form-label">Sobre a empresa</label>
								<textarea id="inputAboutEmpresa" name="aboutEmpresa" maxlength="16777215" class="form-control" placeholder="Descreva brevemente a empresa">{{old('aboutEmpresa')}}</textarea>
							</div>
						</div>
						<div class="alert alert-info alert-sm border-info shadow-sm mt-3">
							<i class="bi bi-info-circle-fill text-info me-2"></i>Preencha as informações da vaga. Quanto mais detalhada melhor para a busca.
						</div>
						<div class="row row-cols-md-2 row-cols-1 g-3 box-separate mt-3">
							<div class="col">
								<label for="inputTipoVaga" class="form-label">Tipo de vaga</label>
								<i class="required">*</i>
								<select id="inputTipoVaga" name="tipoVaga" class="form-select" required>
									<option value="" selected>Escolha...</option>
                                    @foreach($tipoVaga::list() as $key => $item)
                                        <option value="{{ $key }}" {{ (old('tipoVaga') == $key ? "selected" : "" ) }}>{{ $item }}</option>
                                    @endforeach
								</select>
							</div>
							<div class="col">
								<i class="bi bi-info-lg information" title="Caso não coloque nada, o valor atribuido será 1"></i>
								<label for="inputNVaga" class="form-label">N° de vagas</label>
								<i class="required">*</i>
								<input type="number" id="inputNVaga" name="nVaga" min="1" class="form-control" value="{{old('nVaga')}}" required>
							</div>
							<div class="col">
								<label for="inputCargo" class="form-label">Cargo</label>
								<i class="required">*</i>
								<input type="text" id="inputCargo" name="cargo" maxlength="50" class="form-control" value="{{old('cargo')}}" placeholder="Gerente/Desenvolvedor/..." required>
							</div>
							<div class="col">
								<label for="inputFormaTrabalho" class="form-label">Forma de trabalho</label>
								<i class="required">*</i>
								<select id="inputFormaTrabalho" name="formaTrabalho" class="form-select" required>
									<option value="">Escolha...</option>
                                    @foreach($formaTrabalho::list() as $key => $item)
                                        <option value="{{ $key }}" {{ (old('formaTrabalho') == $key ? "selected" : "" ) }}>{{ $item }}</option>
                                    @endforeach
								</select>
							</div>
							<div class="col">
								<i class="bi bi-info-lg information" title="Coloque a data em que deseja parar de veicular a vaga. Depois desta data, sua vaga será deletada."></i>
								<label for="inputTempoVaga" class="form-label">Divulgar vaga até</label>
								<i class="required">*</i>
								<input type="date" id="inputTempoVaga" name="tempoVaga" class="form-control" value="{{old('tempoVaga')}}" placeholder="dd/mm/aa" required>
							</div>
							<div class="col-md-12">
								<label for="inputDescVaga" class="form-label">Descrição da vaga</label>
								<i class="required">*</i>
								<textarea id="inputDescVaga" name="descVaga" maxlength="4294967295" class="form-control" placeholder="Descreva a vaga" required>{{old('descVaga')}}</textarea>
							</div>
							<div class="col-md-12">
								<label for="inputQualDese" class="form-label">Qualificação desejada</label>
								<i class="required">*</i>
								<textarea id="inputQualDese" name="qualificacao" maxlength="4294967295" class="form-control" placeholder="Descreva o que deseja do candidato" required>{{old('qualificacao')}}</textarea>
							</div>
							<div class="col">
								<i class="bi bi-info-lg information" title="Valores abaixo de 1.000,00, coloque o 0 na frente"></i>
								<label for="inputRemuneracao">Remuneração</label>
								<i class="required">*</i>
								<div class="input-group">
									<div class="input-group-text">R$</div>
									<input type="text" class="form-control" name="remuneracao" value="{{old('remuneracao')}}" id="inputRemuneracao" placeholder="" required>
								</div>
							</div>
							<div class="col">
								<i class="bi bi-info-lg information" title="Hora formatada em 00:00 AM/PM"></i>
								<label for="inputTempoVaga" class="form-label">Jornada</label>
								<i class="required">*</i>
								<div class="input-group">
									<input type="time" id="inputJornadaInicio" name="jornadaInicio" value="{{old('jornadaInicio')}}" class="form-control" required>
									<input type="time" id="inputJornadaFim" name="jornadaFim" value="{{old('jornadaFim')}}" class="form-control" required>
								</div>
							</div>
							<div class="col-md-12">
								<label for="inputBeneficios" class="form-label">Benefícios</label>
								<i class="required">*</i>
								<textarea id="inputBeneficios" name="beneficios" maxlength="16777215" class="form-control" placeholder="VA;VR;Auxílio creche;..." required>{{old('beneficios')}}</textarea>
							</div>
							<div class="col-md-12 d-md-flex justify-content-end">
								<button class="btn black-90 text-white" type="submit">CRIAR VAGA</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-lg-5 col-md-12">
				</div>
			</div>

		</div>
	</div>
@endsection

<!-- scripts -->
@section('scripts')
	<script src="https://cdn.rawgit.com/lagden/vanilla-masker/lagden/build/vanilla-masker.min.js"></script>
	<script src="{{ asset('js/cnpj.js') }}"></script>
	<script src="{{ asset('js/cidade-estado.js') }}"></script>
	<script language="JavaScript" type="text/javascript" charset="utf-8">
		new dgCidadesEstados({
			cidade: document.getElementById('inputCity'),
			estado: document.getElementById('inputState'),
			estadoVal: "{{ old('state') }}",
			cidadeVal: "{{ old('city') }}"
		})
	</script>
@endsection


<!-- page active -->
@section('criarvaga') active @endsection