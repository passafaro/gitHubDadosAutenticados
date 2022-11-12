<?php

		// get dados usuário autenticado
        $ch01 = curl_init("https://api.github.com/user");
		curl_setopt($ch01, CURLOPT_HTTPHEADER, array("User-Agent: <usuario>","Accept: application/vnd.github.v3+json"));
		curl_setopt($ch01, CURLOPT_USERPWD, "<usuario>:<token>");
		curl_setopt($ch01, CURLOPT_RETURNTRANSFER, TRUE);
		$res01 =  curl_exec($ch01) ;	
		curl_close($ch01);
		$dadosUsuario = json_decode($res01);
		
		// get lista Repositórios autenticado
        $ch02 = curl_init("https://api.github.com/user/repos");
		curl_setopt($ch02, CURLOPT_HTTPHEADER, array("User-Agent: <usuario>","Accept: application/vnd.github.v3+json"));
		curl_setopt($ch02, CURLOPT_USERPWD, "<usuario>:<token>");
		curl_setopt($ch02, CURLOPT_RETURNTRANSFER, TRUE);
		$res02 =  curl_exec($ch02) ;	
		curl_close($ch02);
		$listaRepositorios = json_decode($res02);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Alessandro Passafaro</title>

	<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

	<link rel="stylesheet" href="estilos.css">

</head>
<body>

	<div class="container-fluid" id="caixaLinkRepositorio">
		<div class="container ">

			<div class="row justify-content-center">
				<div class="col-12 col-sm-8 col-md-8 col-lg-8" >
					<h1>Projetos GitHub</h1>
					<p class="descricaoProjeto">Dados do usuário e lista os repositórios que o usuário autenticado tem permissão para acessar.</p>
				</div>
			</div>

			<div class="row justify-content-center">
				<div class="col-12 col-sm-10 ">
					<div class="fotoPerfil" style="background-image: url('<?php echo $dadosUsuario->avatar_url ?>');"></div>
				</div>
				<div class="col-12 col-sm-10 ">
					<?php echo  $dadosUsuario->html_url.'<br>'.
								$dadosUsuario->name.'<br>'.
								$dadosUsuario->location.'<br>'.
								$dadosUsuario->email ?>
				</div>
			</div>

			<div class="row justify-content-center cards-repositorio" >
				<div class="row">

					<?php 
					foreach($listaRepositorios as $itemRepositorio){ 
						if($itemRepositorio->owner->login == "passafaro" and $itemRepositorio->visibility == "public"){  
					?>

					<div class="col-12 col-lg-4 cards-repositorio-item">
						<div class="card">
						<div class="card-body">
							<h3 class="card-title align-bottom"><?php echo $itemRepositorio->name; ?></h3>
							<p class="card-text"><?php echo $itemRepositorio->description ?></p>
							<a target="_blank"  class="bt-visualizar" href="<?php echo $itemRepositorio->html_url ?>" class="btn btn-primary">Link repositorio</a>
						</div>
						</div>
					</div>
					
					<?php } }  ?>

				</div>
			</div>


		</div>
	</div>



	<div class="container-fluid" id="caixaLinkDocumentacao">
		<div class="container"> 			
			<div class="row justify-content-center">
				<div>11/2022</div>
			</div>
		</div>
	</div>




</body>
</html>
	