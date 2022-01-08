<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<!-- metas -->
		<meta charset="utf-8">
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<style media="screen">
			body{
				margin: 0; padding: 0;
			}
			*{
				font-family: 'arial', sans-serif;
			}
			.table1{
				border-collapse: collapse;
				background-image: url('{{ asset("assets/bgmail.png") }}');
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
				max-width: 800px;
			}
			.space_top{
				padding: 40px 0 30px 0;
			}
			.space_bottom{
				padding: 30px 30px 30px 30px;
			}
			.logo_top{
				max-width: 300px;
				width: 280px;
				padding: 0 10px 0 10px;
			}
		</style>
	</head>
	<body>
		<table align="center" border="1" cellpadding="0" cellspacing="0" width="75%" class="table1">
			<!-- topo -->
			<tr>
				<td align="center" class="space_top">
					<a href="https://procurovagas.com.br/">
						<img src="{{ asset("assets/lt.png") }}" alt="ProcuroVagas" width="280" class="logo_top" height="auto"/>
					</a>
				</td>
			</tr>
			<!-- corpo -->
			<tr>
				<td bgcolor="#ffffff">
					<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td align="center">
								<h2>Procuro Vagas informa</h2>
							</td>
						</tr>
						<tr>
							<td align="left">
								<table border="0" cellpadding="10" cellspacing="0" width="100%">
									<tr>
										<td align="left">
											<h2>{{ $title_e }}</h2>
											<p><b>Nome:</b> {{ $name_e }}</p>
											<p><b>Mensagem: </b> {{ $description_e }}</p>
											<p><b>Email:</b> {{ $email_e }}</p>
											<p><b>Quando:</b> {{ $date_e }}</p>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<!-- rodapé -->
			<tr>
				<td class="space_bottom">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td align="left">
								© 2021 Copyright | todos os direitos reservados a <br>
								<a href="https://procurovagas.com.br/">Procuro Vagas</a>
							</td>
							<td align="right">
								<table border="0" cellpadding="10" cellspacing="0">
									<tr>
										<td>
											<a href="https://web.facebook.com/iliontecnologia/">
												<img src="{{ asset("assets/fb.png") }}" alt="Facebook" width="38" height="38" border="0"/>
											</a>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
