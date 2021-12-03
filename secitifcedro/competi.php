<?php require_once('Connections/link1.php'); ?>
<?php
	mysql_select_db("secitif");
	$sql1 = "SELECT * FROM equipes WHERE pago='T'";
	$busca1 = mysql_query($sql1,$link1);
	while($linha = mysql_fetch_assoc($busca1))
	{
		echo "<h1>". $linha["nome_equipe"] . " (" . $linha["compet"]  . ")</h1>";
		$sql2 = "SELECT usuarios.* FROM equipes_usuarios,usuarios WHERE cod_equipe = '". $linha["cod_equipe"] ."' AND email_usu=email";
		$busca2 = mysql_query($sql2,$link1);
		while($linha2 = mysql_fetch_assoc($busca2))
		{
			echo "<ul>";
			echo "<li>". $linha2["nome"] . " " . $linha2["sobrenome"] ."</li>";
			echo "<li> email: ". $linha2["email"] ."</li>";
			echo "<li> contato: ". $linha2["celular"] ."</li>";
			echo "</ul>";
		}
	}
?>