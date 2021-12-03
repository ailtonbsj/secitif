<?php
require_once('../Connections/link1.php');

if(isset($_GET["tipo"]))
{
	switch($_GET["tipo"])
	{
		case "1":
			$sql1 = "UPDATE minicursos SET titulo = '" . $_GET["titulo"];
			$sql1.= "' WHERE cod_curso = '". $_GET["codigo"] ."'";
			$sql1 = strip_tags($sql1);
		break;
		case "2":
			$sql1 = "UPDATE minicursos SET total_vagas='";
			$sql1.= $_GET["total"] ."',vagas_disponiveis='";
			$sql1.= $_GET["disp"] ."' WHERE cod_curso='" . $_GET["codigo"] . "'";
		break;
		case "3":
			$sql1 = "DELETE FROM datas WHERE id_datas=" . $_GET["id"];
		break;
		case "4":
			$sql1 = "INSERT INTO datas VALUES(NULL,'" . $_GET["dia"];
			$sql1.= "','" . $_GET["inicio"] . "','". $_GET["fim"] ."','";
			$sql1.= $_GET["local"] . "','". $_GET["codigo"] ."')";
		break;
		case "5":
			$sql1 = "UPDATE minicursos SET descricao='". $_GET["descr"] ."' WHERE cod_curso='". $_GET["codigo"] ."'";
			$sql1 = strip_tags($sql1);
		break;
		case "6":
			$sql1 = "INSERT INTO minicursos_professores VALUES('". $_GET["codigo"];
			$sql1.= "','". $_GET["email"] ."')";
		break;
		case "7":
			$sql1 = "DELETE FROM minicursos_professores ";
			$sql1.= "WHERE cod_curso='". $_GET["codigo"];
			$sql1.="' AND email_professor='". $_GET["email"] ."'";
			echo $sql1;
		break;
		case "8":
			$sql1 = "UPDATE minicursos SET evento='". $_GET["evt"] ."' WHERE cod_curso='". $_GET["codigo"] ."'";
		break;
		case "9":
			$sql2 = "DELETE FROM datas WHERE cod_curso='". $_GET["codigo"] ."';";
			$sql3 = "DELETE FROM minicursos_professores WHERE cod_curso='". $_GET["codigo"] ."';";
			$sql1 = "DELETE FROM minicursos WHERE cod_curso='". $_GET["codigo"] ."';";
			mysql_query($sql2,$link1);
			mysql_query($sql3,$link1);
			mysql_query($sql1,$link1);
			header("Location:system_cursos.php?option=listcurso");
			exit;
		break;
	}
	mysql_query($sql1,$link1);
	header("Location:system_cursos.php?option=detalhecurso&curso=" . $_GET["codigo"]);
}

?>
