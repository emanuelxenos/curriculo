<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Gerando Curriculum - Autor: Emanuel Xenos</title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			font-family: "Trebuchet MS";
		}
		header{
			height: 50px;
			background-color: #000;
		}
		header h1{
			color: #fff;
			margin-left: 2%;
			line-height: 50px;
		}
		.container{
			width: 700px;
			margin: auto;
		}
		fieldset{
			padding: 10px;
		}
		.sucesso{
			text-align :center;
			padding: 5px;
			background-color: #7CFC00;
			color: #fff;
		}
		.erro{
			text-align:center;
			padding: 5px;
			background-color: red;
			color: #fff;
		}
		.cg{
			width: 650px;
		}
		.cg2{
			width: 470px;
		}
		.img{
			float: right;
			margin-right: 15px;
			cursor: pointer;
			width: 113pt;
			height: 153pt;
			border-radius: 5px;
		}
		input[type=text]{
			padding: 2px;
		}
		label,input{
			margin: 5px;
		}
		input[type=submit]{
			background-color: #000;
			color: #fff;
			padding: 5px;
			border-radius: 5px; 
		}
		a{
			background-color: #000;
			color: #fff;
			padding: 5px;
			border-radius: 5px; 
			text-decoration: none;
		}
		textarea{
			width: 650px;
			height: 200px;
			padding: 5px;
		}
	</style>
</head>
<body>
<header>
	<h1>Gerando Curriculum - Autor: Emanuel Xenos</h1>
</header>
<div class="form">
	<form action="gerarword.php" enctype="multipart/form-data" method="post">
	<div class="container">
		<fieldset >
			<legend><h2>Dados Pessoais</h2></legend>
			<label for="img"><img src="imagens/default.jpg" id="output" class="img" width="200"></label>
			<label for="nome">Nome Completo:</label><br/>
			<input type="text" placeholder="Exmp.: Fulano Beltrano De Tal" required name="nome" class="cg2" id="nome"><br/>
	        <label for="naturalidade">Naturalidade:</label><br/>
	        <input type="text" placeholder="Exmp.: Canaíbense" required name="naturalidade" class="cg2" id="naturalidade"><br/>
	        <label for="endereco">Endereço:</label><br/>
	        <input type="text" placeholder="Exmp.: Presidente kennedy" required name="endereco" class="cg2" id="endereco"><br/>
	        <label for="bairro">Bairro:</label><br/>
	        <input type="text" placeholder="Exmp.: Centro" name="bairro" required class="cg2" id="bairro"><br/>
	        <label for="cidade">Cidade:</label><br/>
	        <input type="text" placeholder="Exmp.: Carnaíba-Pe" required name="cidade" class="cg" id="cidade"><br/>
	        <label for="idade">Idade:</label><br/>
	        <input type="text" placeholder="Exmp.: 21 Anos" required name="idade" class="cg" id="idade"><br/>
	        <label for="escv">Estado Civil:</label><br/>
	        <input type="text" placeholder="Exmp.: Solteiro" required name="escv" class="cg" id="escv"><br/>
	        <label for="telefone">Telefone:</label><br/>
	        <input type="text" placeholder="Exmp.: (87).9-9999-9999" name="telefone" class="cg" id="telefone"><br/>
	        <label for="cnh">CNH:</label><br/>
	        <input type="text" placeholder="" name="cnh" class="cg" id="cnh"><br/>
	        <input type="file" id="img" style="display: none;" name="imagem" accept="image/jpeg,image/png" onchange='openFile(event)'/>
		</fieldset>
		<fieldset>
			<legend><h2>Escolaridade</h2></legend>
			<label>Instituição:</label><br/>
			<input type="text" placeholder="Exmp.: Escola João Gomes Dos Reis" required class="cg" name="instituicao"/><br/>
			<label>Concluiu:</label><br/>
			<input type="text" placeholder="Exmp.: Ensino Médio Completo" required class="cg" name="concluiu"/><br/>
			<label>Cidade da Instituição:</label><br/>
			<input type="text" placeholder="Exmp.: Carnaíba-Pe" required class="cg" name="cidadeins">
		</fieldset>
		<fieldset>
			<legend><h2>Cursos</h2></legend>
			<textarea name="cursos"></textarea>
		</fieldset>
		<fieldset>
			<legend><h2>Experiências Profissionais</h2></legend>
			<textarea name="experiencia"></textarea>
		</fieldset>
		<fieldset>
			<legend><h2>Objetivo Profissional</h2></legend>
			<textarea name="objetivo">Tenho interesse em trabalhar na função que me ingressarem e se possível crescer e conquistar novas funções de acordo com as oportunidades. Conquistar amizades e cumprir com as normas da empresa. Pretendo cumprir fazendo bem minha função e adquirir mais conhecimento com profissionais amigos de trabalho.</textarea>
		</fieldset>
		<input type="submit" name="enviar" value="Gerar Documento"/><a href="procurar.php">Procurar Arquivo</a>
	</div>
	</form>
	<?php
		if (isset($_GET['msg'])) {
			echo "<div class='sucesso'>Documento gerado com sucesso!</div>";
		}
	?>
</div>
<script>
		  var openFile = function(event) {
		    var input = event.target;

		    var reader = new FileReader();
		    reader.onload = function(){
		      var dataURL = reader.result;
		      var output = document.getElementById('output');
		      output.src = dataURL;
		    };
		    reader.readAsDataURL(input.files[0]);
		  };
		</script>
</body>
</html>