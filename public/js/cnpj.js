document.getElementById("inputCnpj").addEventListener("focusout", function(e) {
	e.preventDefault();
	let cnpj = removeSpecialChar(this.value);
	let razaoSocial = document.getElementById('inputRSocial');
	let email = document.getElementById('inputEmail');
	let state = document.getElementById('inputState');
	let city = document.getElementById('inputCity');
	let cep = document.getElementById('inputCep');
	let bairro = document.getElementById('inputBairro');
	let logradouro = document.getElementById('inputLogradouro');
	let complemento = document.getElementById('inputComplemento');

	if (cnpj.length <= 12) return;

	var request = new Request("/cnpj/"+cnpj, {
		method: "GET"
	});

	fetch(request)
	.then(function(response) {
		response.json()
		.then(function(result) {
			var data = JSON.parse(result);

			if (data.status == "ERROR") {
				showAlert("CNPJ não encontrado", "Pode ter ocorrido algum erro de digitação ou na busca do CNPJ. Tente novamente ou prossiga preenchendo todo os dados manualmente.");
			}
			else
			{
				razaoSocial.value = data.nome;
				email.value = data.email;
				cep.value = data.cep;
				bairro.value = data.bairro;
				logradouro.value = data.logradouro;
				complemento.value = data.complemento;
				state.value = ChangeUf(data.uf);
				state.onchange();
				city.value = ChangeCity( allLowerCaseAndAccents( data.municipio ) );
			}
		})
	  })
	.catch(function(err) {
		showAlert("CNPJ não encontrado", "Pode ter ocorrido algum erro de digitação ou na busca do CNPJ. Tente novamente ou prossiga preenchendo todo os dados manualmente.");
		console.error(err);
	});
});

/**
 * remove caracteres especiais de string numerica
 * @param {string} string 
 * @returns 
 */
function removeSpecialChar(string) {
	return string.replace(/[^a-z0-9]/gi,'');
}

/**
 * remove acentos e deixa tudo em letra minuscula, numa string
 * @param {string} string 
 * @returns 
 */
function allLowerCaseAndAccents(string) {
	string = string.toLowerCase();
	string = string.replace(/[ÀÁÂÃÄÅ]/g,"A");
	string = string.replace(/[àáâãäå]/g,"a");
	string = string.replace(/[ÈÉÊË]/g,"E");
	return string;
}

/**
 * pega a cidade que veio da api do cnpj, compara com as opcoes no select
 * e retorna a opcao correta
 * @param {string} city 
 * @returns 
 */
function ChangeCity(city) {
	for (var option of document.getElementById("inputCity").options) {
		var cityInSelect = allLowerCaseAndAccents(option.value);
		if (cityInSelect == city) {
			option.setAttribute('selected', 'selected');
			return option.value;
		}
	}
}

/**
 * pega o estado que veio da api do cnpj, compara com as opcoes no select
 * e retorna a opcao correta
 * @param {string} uf
 * @returns 
 */
 function ChangeUf(uf) {
	for (var option of document.getElementById("inputState").options) {
		var ufInSelect = option.value;
		if (ufInSelect == uf) {
			option.setAttribute('selected', 'selected');
			return option.value;
		}
	}
}

/**
 * mascara de input - vanilla-mask, script sendo chaamado no criarvaga.blade.php
 * @param {*} masks 
 * @param {*} max 
 * @param {*} event 
 */
function inputHandler(masks, max, event) {
	var c = event.target;
	var v = c.value.replace(/\D/g, '');
	var m = c.value.length > max ? 1 : 0;
	VMasker(c).unMask();
	VMasker(c).maskPattern(masks[m]);
	c.value = VMasker.toPattern(v, masks[m]);
}

// mascara para o campo de remuneracao
var moneyMask = ['9999.99','99999.99'];
var money = document.getElementById('inputRemuneracao');
VMasker(money).maskPattern(moneyMask[0]);
money.addEventListener('input', inputHandler.bind(undefined, moneyMask, 8), false);

// mascara para o campo de cnpj
var docMask = ['99.999.999/9999-99'];
var doc = document.getElementById('inputCnpj');
VMasker(doc).maskPattern(docMask[0]);
doc.addEventListener('input', inputHandler.bind(undefined, docMask, 19), false);