<!DOCTYPE html>
<html lang="pt-br">
<head>
	<script type="text/javascript" src="jquery-3.6.1.min.js"></script>
	<meta charset="utf-8"/>
	<title>Listagem de arquivos - Autor: Emanuel Xenos</title>
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
		.form{
			width: 600px;
			margin:5% auto;
		}
		.form label{
			font-size: 1.5em;
			font-weight: bold;
		}
		.form input[type=text],.form input[type=submit]{
			font-size: 1.5em;
		}
		.resultado{
			width: 700px;
			margin: auto;
		}
		.resultado a{
			text-decoration: none;
			color: #fff;
		}
		.ele{
			padding: 5px;
			background-color: #000;
			color: #fff;
			display: block;
			margin:2px;
		}
		.sucesso{
			text-align :center;
			padding: 5px;
			background-color: #7CFC00;
			color: #fff;
		}
		.espaco{
			margin-left: 15px;
		}
		.erro{
			text-align:center;
			padding: 5px;
			background-color: red;
			color: #fff;
		}
		.success{
			text-align:center;
			padding: 5px;
			background-color: #00BFFF;
			color: #fff;
		}
		.btn{
			background-color: #000;
			color: #fff;
			padding: 5px;
			border-radius: 5px; 
			text-decoration: none;
		}
		.none{
			display: none;
		}
		#velha{background:url('imagens/bg3.png') 100% 100% no-repeat; border:1px solid black;width:210px;margin:40px auto;padding:20px;} 
		p{margin-bottom:30px;margin-left: 10px; display: inline-block; text-transform: uppercase; color: white;}
		#img{position: relative;top:20px;left:20px;background-color:rgba(255,255,255,.5);height:50px;width:50px; border-radius: 5px;}
		canvas{background-color: beige;margin:10px;}
	</style>
</head>
<body>
<header>
	<h1>Listagem de arquivos - Autor: <a style="color: white; text-decoration: none;" href="https://instagram.com/emanuelxenos">Emanuel Xenos</a></h1>
</header>
<div class="form">
	<marquee direction='left'>
		Área restrita aos administradores, não mexa, caso contrário. Você será responsabilizado!
	</marquee>
	<div onclick='none();' style="cursor: pointer; font-size: 15pt;" title="Exibe/Oculta URL">👁</div>
	<?php
	array_map('unlink', glob('arquivos/temp/*'));
	exec('ipconfig', $array);
	//print_r($array);
	$ip = explode(':',$array[63]);
	$rs = str_replace(" ", "", $ip[1]);
	echo "<div id='url' class='none'>URL: http://".$rs.":8080/word</div>";
	?>
	<form action="" method="post">
		<label for="nome">Procurar arquivo</label>
		<input type="text" name="nome" id="nome">
		<input type="submit" name="Pesquisar" value="Pesquisar"/>
	</form><br/><hr><br/>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="arquivo[]" multiple />&nbsp&nbsp
		<input type="submit" name="enviar" value="Enviar"/>&nbsp&nbsp
		<a class="btn" href="./">Gerar Outro Documento</a>
	</form>
</div>
<script>
	function clic(ele){
 		var conf = confirm('Você deseja realmente deletar?');
 		if(conf){
 			var data = ele.getAttribute('data');
 			location.replace(data);

 		}
 	}

 	function openWord(ele){
 		var conf = confirm('Você deseja realmente abrir?');
 		if(conf){
 			var data = ele.getAttribute('data');
 			//location.replace(data);
 			$.ajax({
	           url:'execute.php',
	           type:'POST',
	           data:{data:data},
	           success: function(data){
	               //$("#caixa").html(data);
	               console.log(data);
	           },
	           error: function(data){
	                $("#caixa").html("Houve um Erro!");
	           }
	       });
 		}
 	}

	 function reload(){
 		location.replace('http://localhost:8080/word/procurar.php');
 	}

 	function none() {
	   var element = document.getElementById("url");
	   element.classList.toggle("none");
	}

 	function verifica(oEvent){
	var oEvent = oEvent ? oEvent : window.event;
	var tecla = (oEvent.keyCode) ? oEvent.keyCode : oEvent.which;
		if(tecla == 17 || tecla == 44|| tecla == 92){
			alert('Agora  a jiripoca vai piar');
			var velha = document.getElementById('velha');
			velha.style.display='block';
		}
	}

	document.addEventListener("keypress", verifica);
</script>
<div class="resultado">
<?php 
if(isset($_POST['nome'])){
	$nome = $_POST['nome'];
	$qtd = 0;
	foreach (glob("arquivos/*".$nome."*.*") as $ar) {
		$qtd++;
		$nu = substr($ar,9);
		$nd = substr($nu,0,-4);
		echo "<div class='ele'>";
		echo "<a href='arquivos/".substr($ar,9)."' download>".$nd."</a>";
		echo "<a class='erro espaco' onclick='clic(this);' style='cursor:pointer;' data='procurar.php?del=".substr($ar,9)."'>Deletar</a>";
		echo "<a class='success espaco' title='Ao clicar o sistema irá tentar abrir o arquivo' onclick='openWord(this);' style='cursor:pointer;' data='".substr($ar,9)."'>Abrir</a>";
		echo "</div>";
	}
	echo "<script>alert('Foi encontrado um total de: ".$qtd." arquivos')</script>";
}
if(isset($_FILES['arquivo'])){

	if($_FILES['arquivo']['name'][0] == ""){
		echo "<div class='erro'>Não foi enviado nenhum arquivo</div>";
		exit;
	}
	//var_dump($_FILES['arquivo']);
	$qtd = 0;
	if(count($_FILES['arquivo']['tmp_name']) > 0){

		for ($i=0; $i <count($_FILES['arquivo']['tmp_name']) ; $i++) {
			$qtd++;
			$arquivo = $_FILES['arquivo']['name'][$i];
			$ext = explode(".",$arquivo);
			//$extensão = substr($arquivo['arquivo']['name'][$i],-5);

			if($_FILES['arquivo']['type'][$i] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'){

				$nome = substr($arquivo,0,-5)." ".date("d-m-Y").".".$ext[1];

			}elseif ($_FILES['arquivo']['type'] == "application/msword") {
				$nome = substr($arquivo,0,-4)." ".date("d-m-Y").".".$ext[1];
			}else{
				echo "<div class='erro'>Arquivo inválido</div>";
				exit;
			}

			$move = move_uploaded_file($_FILES['arquivo']['tmp_name'][$i], "arquivos/".$nome);

			if($move){
				echo "<div class='sucesso'>Arquivo enviado com sucesso!</div>";
			}else{
				echo "<div class='erro'>Erro! não foi possível enviar o arquivo tente novamente</div>";
			}
		}
		echo "<script>alert('Foi enviado um total de: ".$qtd." arquivos')</script>";
		echo "Foi enviado um total de: ".$qtd." arquivos";
	}
}
if(isset($_GET['del'])){
	$arquivo = $_GET['del'];
	@$del = unlink("arquivos/".$arquivo);

	if($del){
		echo "<div class='sucesso'>Arquivo deletado com sucesso!</div><script>setTimeout(reload,3000)</script>";
	}else{
		echo "<div class='erro'>Erro! não foi possível enviar o arquivo tente nomvamente</div>";
	}
}
 ?>
 </div>
 <div class="velha" id="velha" style="display: none; height: 400px;">
	<p>Vez de:</p>
    <img id="img" src="" alt="">
    <div id="jogo"></div>
 </div>
 <script src="vendor/script.js"></script>
</body>
</html>