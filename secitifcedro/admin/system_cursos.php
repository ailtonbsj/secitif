<?php
session_start();
if(isset($_SESSION["usuario"]))
{
	require_once('../Connections/link1.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Sistema de minicursos</title>
<style type="text/css">
* {
	margin: 0;
}
#wrap {
	background-color:#999;
	width: 590px;
	margin: 0 auto;
}
#topo {
	background-color: #FFF;
	text-align: right;
}
#icones span {
	display: block;
	width: 70px;
	background-color: #CCC;
	text-align:center;
	float:left;
	padding: 5px;
	margin: 2px 2px;
}
#icones span img {
	border: 0;
}
.clear {
	clear: both;
}
a {
	text-decoration: none;
	color: #FFF;
}
form input {
	display: block;
	width: 220px;
	height: 30px;
}
form textarea {
	display: block;
	width: 350px;
	height: 100px;
}
form select {
	width: 340px;
	height: 30px;
}
#area div {
	background-color: #CCC;
	padding: 5px;
	margin: 5px;
}
.titulo {
	color: #000;
}
.titulo:hover {
	text-decoration: underline;
}
.linha:hover {
	background-color: #999;
}
</style>
<script type="text/javascript">
function validaHora(hora)
{
	if(hora.substring(2,3)==":" && hora.substring(5,6)==":")
	{
		HH = hora.substring(0,2);
		mm = hora.substring(3,5);
		ss = hora.substring(6,8);
		if(HH>=0 && HH<=23)
			if(mm>=0 && mm<=59)
				if(ss>=0 && ss<=59)
				{
					return true;
				}
	}
	return false;
}

function deletarProf(nome, email){
	saida = confirm("Tem certeza que deseja deletar o professor:\n\r" + nome);
	if(saida == 1)
		location.href = "system_cursos.php?del=" + email;
}
function deletarLocal(nome, cod){
	saida = confirm("Tem certeza que deseja deletar o Local:\n\r" + nome);
	if(saida==1)
		location.href = "system_cursos.php?dellocal=" + cod;
}
</script>
</head>

<body>
<div id="wrap">
<div id="topo">Bem Vindo, <u><?= $_SESSION["usuario"] ?></u>!!!</div>
<div id="icones">
	<span><a href="system_cursos.php?option=addprof"><img src="images/addprof.png" width="64" height="64" />Adicionar Professor</a></span>
    <span><a href="system_cursos.php?option=listprof"><img src="images/listprof.png" width="64" height="64" />Listar Professores</a></span>
    <span><a href="system_cursos.php?option=addlocal"><img src="images/addlocal.png" width="64" height="64" />Adicionar Local</a></span>
    <span><a href="system_cursos.php?option=listlocal"><img src="images/listlocal.png" width="64" height="64" />Listar Locais</a></span>
    <span><a href="system_cursos.php?option=addcurso"><img src="images/addcurso.png" width="64" height="64" />Adicionar Minicurso</a></span>
    <span><a  href="system_cursos.php?option=listcurso"><img src="images/listcurso.png" width="64" height="64" />Listar Minicursos</a></span>
    <span><a href="index.php?logoff=true"><img src="images/exit.png" width="64" height="64" />Fazer Logoff</a></span>
    <div class="clear"></div>
</div>
<div id="area">
	<?php
		if(isset($_GET["del"]))
		{
			$sql3 = "DELETE FROM professores WHERE email_professor='" . $_GET["del"] . "'";
			mysql_query($sql3,$link1);
			header("Location: system_cursos.php?option=listprof");
		}else if(isset($_GET["dellocal"]))
		{
			$sql7 = "DELETE FROM local WHERE cod_local='". $_GET["dellocal"] ."'";
			mysql_query($sql7,$link1);
			header("Location: system_cursos.php?option=listlocal");
			
		}
		if(isset($_POST["tarefa"]))
		{
			if($_POST["tarefa"]=="addprof")
			{
				$sql2 = "INSERT INTO professores VALUES ('". $_POST["email"] ."', '". $_POST["nome"] ."', '". $_POST["minicv"] ."')";
				$busca2 = mysql_query($sql2,$link1);
				if($busca2 == 0) echo "FALHA AO ADICIONAR PROFESSOR!!!";
				else echo "PROFESSOR ADICIONADO COM SUCESSO!!!";
			}
			if($_POST["tarefa"]=="altprof")
			{
				$sql4 = "UPDATE professores SET email_professor='". $_POST["email"] ."', nome='". $_POST["nome"];
				$sql4 .= "', minicv='". $_POST["minicv"] ."' WHERE email_professor='". $_POST["email_o"] ."'";
				mysql_query($sql4,$link1);
				header("Location: system_cursos.php?option=listprof");
			}
			if($_POST["tarefa"]=="addlocal")
			{
				$sql5 = "INSERT INTO local VALUES (null,'". $_POST["nomelocal"] ."')";
				mysql_query($sql5,$link1);
				header("Location: system_cursos.php?option=listlocal");
			}
			if($_POST["tarefa"]=="altlocal")
			{
				$sql8 = "UPDATE local SET nome_local='". $_POST["nome_local"] ."' WHERE cod_local='". $_POST["cod_local"] ."'";
				mysql_query($sql8,$link1);
				header("Location: system_cursos.php?option=listlocal");
			}
			if($_POST["tarefa"]=="addminicurso")
			{
				if(isset($_POST["cod_curso"]))
				{
					$cod_curso = $_POST["cod_curso"];
					$titulo = $_POST["titulo"];
					$total_vagas = $_POST["total_vagas"];
					$descricao = $_POST["descricao"];
					$categ_curso = $_POST["categ_curso"];
					$sql11 = "INSERT INTO minicursos VALUES ('$cod_curso','$titulo','$total_vagas','$total_vagas','$descricao','$categ_curso')";
					$busca6 = mysql_query($sql11,$link1);
					if($busca6){
						$professores = $_POST["professores"];
						$total_prof = $_POST["total_prof"];
						$prof = explode(",",$professores);
						$sql12 = "INSERT INTO minicursos_professores VALUES ";
						for($x=0;$x<$total_prof;$x++)
						{
							if($x!=$total_prof-1)
								$sql12 .= "('$cod_curso', '" . $prof[$x] . "'), ";
							else
								$sql12 .= "('$cod_curso', '" . $prof[$x] . "');";
						}
						$busca7 = mysql_query($sql12,$link1);
						if($busca7)
						{
							$horario = $_POST["ho"];
							$total_ho = $_POST["total_ho"];
							$horar = explode(";",$horario);
							$sql13 = "INSERT INTO datas VALUES ";
							for($x=0;$x<$total_ho;$x++)
							{
								if($x!=$total_ho-1)
									$sql13 .= $horar[$x] . ", ";
								else
									$sql13 .= $horar[$x] . ";";
							}
							$busca8 = mysql_query($sql13,$link1);
							if($busca8)
								echo "MINICURSO ADICIONADO COM SUCESSO!!!";
							else echo "ERRO!!! FATAL!!!!";
						}
					}
				}
			}
		}
		if(@$_GET["option"]=="addprof")
		{
    ?>
	<div>
   	  <h2>Adicionar Professor</h2>
      <form id="form1" name="form1" method="post" action="">
        <input name="tarefa" type="hidden" value="addprof" />
        <label for="nome">Nome do Professor</label>
        <input type="text" name="nome" id="nome" />
        <label for="email">Email</label>
        <input type="text" name="email" id="email" />
        <label for="minicv">Mini-CV</label>
        <input type="text" name="minicv" id="minicv" />
        <input type="submit" name="button" id="button" value="Adicionar Novo Professor" />
      </form>
	</div>
    <?php
		}
		if(@$_GET["option"]=="listprof")
		{
	?>
    <div>
    	<h2>Lista de Professores</h2>
        <?php
			$sql1 = "SELECT * FROM professores ORDER BY nome ASC";
			$busca1 = mysql_query($sql1,$link1);
			while($linha1 = mysql_fetch_assoc($busca1))
			{
		?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="linha">
          <tr>
            <td width="23%">Nome do Professor</td>
            <td width="71%"><?= $linha1["nome"] ?></td>
            <td width="6%" rowspan="3">
            <a href="javascript:deletarProf('<?= $linha1["nome"] ?>','<?= urlencode($linha1["email_professor"]) ?>');"><img src="images/delete.png" width="32" height="32" border="0" /></a>
            <br />
            <a href="system_cursos.php?option=alterprof&a=<?= urlencode($linha1["nome"]) ?>&b=<?= urlencode($linha1["email_professor"]) ?>&c=<?= urlencode($linha1["minicv"]) ?>"><img src="images/alterar.gif" width="32" height="32" border="0" /></a></td>
          </tr>
          <tr>
            <td>E-mail</td>
            <td><?= $linha1["email_professor"] ?></td>
          </tr>
          <tr>
            <td>Mini-CV</td>
            <td><?= $linha1["minicv"] ?></td>
          </tr>
      </table>
      <hr />
      <?php
			}
	  ?>
    </div>
     <?php
		}
		if(@$_GET["option"]=="addlocal")
		{
	?>
    <div>
   	  <h2>Adicionar Local</h2>
      <form id="form2" name="form2" method="post" action="">
      <input name="tarefa" type="hidden" value="addlocal" />
        <label for="textfield2">Nome do Local</label>
        <input type="text" name="nomelocal" id="textfield2" />
        <input type="submit" name="sumit" id="sumit" value="Adicionar Novo Local" />
      </form>
    </div>
     <?php
		}
		if(@$_GET["option"]=="listlocal")
		{
	?>
    <div>
    	<h2>Lista de Locais</h2>
      <table width="100%" border="1" cellspacing="0" cellpadding="0">
          <tr>
            <td width="19%">Codigo do Local</td>
            <td width="68%">Nome do Local</td>
            <td width="13%">&nbsp;</td>
          </tr>
          <?php
		  	$sql6 = "SELECT * FROM local ORDER BY nome_local ASC";
			$busca3 = mysql_query($sql6,$link1);
			while($linha2 = mysql_fetch_assoc($busca3))
			{
		  ?>
          <tr class="linha">
            <td><?= $linha2["cod_local"] ?></td>
            <td><?= $linha2["nome_local"] ?></td>
            <td><a href="javascript:deletarLocal('<?= $linha2["nome_local"] ?>','<?= urlencode($linha2["cod_local"]) ?>');"><img src="images/delete.png" width="32" height="32" border="0" /></a>
                <a href="system_cursos.php?option=alterlocal&codlocal=<?= urlencode($linha2["cod_local"]) ?>&nomelocal=<?= urlencode($linha2["nome_local"]) ?>"><img src="images/alterar.gif" width="32" height="32" border="0" /></a>
            </td>
          </tr>
          <?php
			}
		  ?>
      </table>
    </div>
     <?php
		}
		if(@$_GET["option"]=="addcurso")
		{
	?>
    <div>
   	  <h2>Adicionar Mini-curso</h2>
      <form name="form3" method="post" id="form3" action="">
      	<input name="tarefa" type="hidden" value="addminicurso" />
        <input name="cod_curso" id="cod_curso" type="hidden" value="<?= date("dmyHis") ?>" />
        <label for="categ_curso">Categoria</label>
        <select name="categ_curso" id="categ_curso">
          <option value="F">FEMECI</option>
          <option value="M">Encontro de Matematica</option>
          <option value="I">Cursos de Informatica</option>
          <option value="P">Palestra</option>
        </select>
        <br />
        <label for="titulo">Nome do Curso</label>
       	<input type="text" name="titulo" id="titulo" /> 
        <label for="total_vagas">Total de vagas</label>
        <input type="text" name="total_vagas" id="total_vagas" />
        <label for="descricao">Descricao</label>
        <textarea name="descricao" id="descricao" cols="45" rows="5"></textarea>
        <input name="professores" type="hidden" value="" />
        <input name="total_prof" type="hidden" value="" />
        <fieldset>
        	<legend>Adicionar Professores</legend>
            <table width="440" border="0" cellspacing="0" cellpadding="0">
          		<tr>
            	<td valign="middle">
                Selecione
                <select name="select_prof" id="select_prof">
				<?php
                    $sql9 = "SELECT * FROM professores ORDER BY nome ASC";
                    $busca4 = mysql_query($sql9,$link1);
                    while($linha3 = mysql_fetch_assoc($busca4))
                    {
                ?>
              	<option value="<?= $linha3["nome"] ?> (<?= $linha3["email_professor"] ?>)"><?= $linha3["nome"] ?> (<?= $linha3["email_professor"] ?>)</option>
				<?php
                    }
                ?>
            	</select>
            	</td>
            	<td>
                	<a href="javascript:addProList(document.form3.select_prof.value);updateList();">
                    <img src="images/add.png" width="32" height="32" border="0" />
                    </a>
                </td>
          		</tr>
          		<tr>
            	<td colspan="2">
            	<div id="lista_prof"></div>
            	</td>
            	</tr>
   			</table>
            <script type="text/javascript">
			/**
    		Algoritmo de lista do Adição e Remoção
    		Autor: José Ailton B. S.
    		*/
			myListProf = new Array();
    		indexProf = 0;
			function addProList(valor){
				for(x=0;x<indexProf;x++){
					if(myListProf[x] == valor){
						alert("Professor ja esta adicionado no curso!!!");
						return 0;
					}
				}
				myListProf[indexProf] = valor;
				indexProf++;
			}
			function removeProList(valor){
				listProfAux = myListProf;
				myListProf = new Array();
				cont=0;
				for(x=0;x<indexProf;x++){
					if(listProfAux[x] == valor) continue;
					myListProf[cont] = listProfAux[x];
					cont++;
				}
				indexProf--;
			}
			function captaMail(valor){
				pos_i = valor.indexOf("(");
				pos_f = valor.indexOf(")");
				return valor.substring(pos_i+1,pos_f);
			}
			listaPro = document.getElementById("lista_prof");
			function updateList(){
				inner = "";
				document.form3.professores.value = "";
				for(x=0;x<indexProf;x++){
					inner += myListProf[x] + "<a href=\"javascript:removeItem('";
					inner += myListProf[x] + "');\"><img src=\"images/del.png\" ";
					inner += "width=\"32\" height=\"32\" border=\"0\" /></a><br />";
					document.form3.professores.value += captaMail(myListProf[x]) + ",";
				}
				document.form3.total_prof.value = indexProf;
				listaPro.innerHTML = inner;
			}
			function removeItem(valor){
				test = confirm("Tem certeza de deseja Remover o Prof. " + valor + "?");
				if(test){
					removeProList(valor);
					updateList();
				}
			}
			</script>
        </fieldset>
        <input name="ho" id="ho" type="hidden" value="" />
        <input name="total_ho" id="total_ho" type="hidden" value="" />
        <fieldset>
   		  <legend>Adicionar Horario</legend>
        	<label for="horario_dia">Selecione o dia</label>
        	<select name="horario_dia" id="horario_dia">
        		<option value="2">Segunda-feira</option>
        		<option value="3">Terca-feira</option>
         		<option value="4">Quarta-feira</option>
         		<option value="5">Quinta-feira</option>
         		<option value="6">Sexta-feira</option>
         	</select><br />
         	<label for="horario_local">Local</label>
         	<select name="horario_local" id="horario_local">
			<?php
				$sql10 = "SELECT * FROM local ORDER BY nome_local ASC";
				$busca5 = mysql_query($sql10,$link1);
				$contador = 0;
				while($linha4 = mysql_fetch_assoc($busca5))
				{
					$locais[$contador][0] = $linha4["cod_local"];
					$locais[$contador][1] = $linha4["nome_local"];
					$contador++;				
            ?>
           	  <option value="<?= $linha4["cod_local"] ?>"><?= $linha4["nome_local"] ?></option>
            <?php
            	}
            ?>
           	</select>
            <br /><br />
            <label>Horario </label><br />
            <input name="horar_" type="radio" style="display: inline; padding: 0; margin: 0; width: 15px;" onclick="updateHor('M');" checked="checked" /> 
            Manha<br />
          <input name="horar_" type="radio" style="display: inline; padding: 0; margin: 0;width: 15px;" onclick="updateHor('T');" /> Tarde<br />
          <br />
          <div style="display: none">
          <label for="horario_inicio">Hora de Inicio</label>
           <input name="horario_inicio" type="text" id="horario_inicio" maxlength="8" />
          <label for="horario_fim">Hora de Termino</label>
           <input name="horario_fim" type="text" id="horario_fim" maxlength="8" />
           <div style="color: #090; font-family: Verdana;">Formato de hora: 23:59:59</div>
           </div>
          <a href="javascript:addLineHora();">
          <img src="images/add.png" width="32" height="32" border="0" />
          </a>
		  <div id="tabela_horario"></div>
          <script type="text/javascript">
		  function updateHor(valor)
		  {
			  if(valor=='M')
			  {
				  document.getElementById('horario_inicio').value='08:00:00';
				  document.getElementById('horario_fim').value='12:00:00';
			  }
			  else if(valor=='T')
			  {
				  document.getElementById('horario_inicio').value='13:30:00';
				  document.getElementById('horario_fim').value='17:30:00';
			  }
		  }
		  updateHor('M');
		  /**
		  Autor: José Ailton B. S.
		  */
		  locais = new Array();
		  <?php
		  	$auxCont = 0;
			while($auxCont<$contador)
			{
				
				echo "locais[".$locais[$auxCont][0]."]= \"" . $locais[$auxCont][1] . "\";\n";
				$auxCont++;
			}
		  ?>		  
		  listHorario = new Array(6);
		  listHorario[0] = new Array(); // Dia
		  listHorario[1] = new Array(); // Hora de inicio
		  listHorario[2] = new Array(); // Hora de fim
		  listHorario[3] = new Array(); // Local
		  listHorario[4] = new Array(); // codigo curso
		  listHorario[5] = new Array(); // codigo_horario
		  indexHorario = 0;
		  function addHorario(dia,inicio,fim,local,curso)
		  {
			  listHorario[0][indexHorario] = dia;
			  listHorario[1][indexHorario] = inicio;
			  listHorario[2][indexHorario] = fim;
			  listHorario[3][indexHorario] = local;
			  listHorario[4][indexHorario] = curso;
			  listHorario[5][indexHorario] = indexHorario;
			  indexHorario++;
		  }
		  function removeHorario(codigo)
		  {
			  auxListHora = listHorario;
			  listHorario = new Array(6);
			  listHorario[0] = new Array(); // Dia
			  listHorario[1] = new Array(); // Hora de inicio
			  listHorario[2] = new Array(); // Hora de fim
			  listHorario[3] = new Array(); // Local
			  listHorario[4] = new Array(); // codigo curso
			  listHorario[5] = new Array(); // codigo_horario
			  contador = 0;
			  for(x=0;x<indexHorario;x++)
			  {
				  if(codigo==auxListHora[5][x]) continue;
				  listHorario[0][contador] = auxListHora[0][x];
				  listHorario[1][contador] = auxListHora[1][x];
				  listHorario[2][contador] = auxListHora[2][x];
				  listHorario[3][contador] = auxListHora[3][x];
				  listHorario[4][contador] = auxListHora[4][x];
				  listHorario[5][contador] = auxListHora[5][x];
				  contador++;
			  }
			  indexHorario--;
		  }
		  function updateCampHora()
		  {
			  horarios = document.getElementById("ho");
			  document.getElementById("total_ho").value = indexHorario;  
			  horarios.value = "";
			  for(x=0;x<indexHorario;x++)
			  {
				  horarios.value += "(NULL,'";
				  horarios.value += listHorario[0][x] + "', '";
				  horarios.value += listHorario[1][x] + "', '";
				  horarios.value += listHorario[2][x] + "', '";
				  horarios.value += listHorario[3][x] + "', '";
				  horarios.value += listHorario[4][x] + "')"
				  horarios.value += ";";
			  }
		  }
		  function updateTable()
		  {
			  tabela = "<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\"><tr bgcolor=\"#FFFFFF\"><td>Dia</td><td>Hora de Inicio</td><td>Hora de Termino</td><td>Local</td><td width=\"32px\">&nbsp;</td></tr>";
			  for(x=0;x<indexHorario;x++)
			  {
				  tabela += "<tr>";
				  tabela += "<td>"+ showDiaSemana(listHorario[0][x]) +"</td>";
				  tabela += "<td>"+ listHorario[1][x] +"</td>";
				  tabela += "<td>"+ listHorario[2][x] +"</td>";
				  tabela += "<td>"+ locais[listHorario[3][x]] +"</td>";
				  tabela += "<td>";
				  tabela += "<a href=\"javascript:removeHorario(";
				  tabela += listHorario[5][x];
				  tabela += ");updateTable()\"><img src=\"images/del.png\" width=\"32\" height=\"32\" border=\"0\" /></a>";
				  tabela += "</tr>";
			  }  
            tabela += "</table>";
			document.getElementById("tabela_horario").innerHTML = tabela;
			updateCampHora();
		  }
		  function showDiaSemana(numb)
		  {
			  switch(numb)
			  {
				  case "2":
				  	return "Segunda-feira";
				  	break;
				  case "3":
				  	return "Terca-feira";
				  	break;
				  case "4":
				  	return "Quarta-feira";
				  	break;
				  case "5":
				  	return "Quinta-feira";
				  	break;
				  case "6":
				  	return "Sexta-feira";
				  	break;
			  }
		  }
		  function addLineHora()
		  {
				dia_hor = document.getElementById("horario_dia").value;
				local_hor = document.getElementById("horario_local").value;
				inicio_hor = document.getElementById("horario_inicio").value;
				fim_hor = document.getElementById("horario_fim").value;
				cod_cur = document.getElementById("cod_curso").value;
				if(validaHora(inicio_hor) && validaHora(fim_hor))
				{
					addHorario(dia_hor,inicio_hor,fim_hor,local_hor,cod_cur);
					updateTable();
				}
				else alert("Formato de Data Invalida!");
				
		  }
		  updateTable();
		  function validaForm3()
		  {
			  opc = confirm("Deseja mesmo cadastrar novo mini-curso?");
			  if(!opc) return false;
			  else
			  {
				  titulo1 = document.form3.titulo.value;
				  total_vagas1 = document.form3.total_vagas.value;
				  descricao1 = document.form3.descricao.value;
				  professores1 = document.form3.professores.value;
				  ho1 = document.form3.ho.value;
				  total_ho1 = document.form3.total_ho.value;
				  if(titulo1 == "")
				  {
					  alert("Campo Nome do Curso invalido!!!");
					  return false;
				  }
				  if(isNaN(parseInt(total_vagas1)))
				  {
					  alert("Campo Total de vagas incorreto!!!");
					  return false;
				  }
				  if(descricao1 == "")
				  {
					  alert("Campo Descricao invalido!!!");
					  return false;
				  }
				  if(professores1 == "")
				  {
					  alert("Adicione professores ao minicurso!");
					  return false;
				  }
				  if(ho1 == "")
				  {
					  alert("Adicione horario ao minicurso!!!");
					  return false;
				  }
				  return true;
			  }
		  }
		  document.form3.onsubmit = validaForm3;
          </script>
        </fieldset>
        <br />
        <input type="submit" value="Cadastrar Novo Mini-curso" />
      </form>      
    </div>
     <?php
		}
		if(@$_GET["option"]=="listcurso")
		{
	?>
    <div>
    	<h2>Lista de Mini-cursos</h2>
      <table width="100%" border="1" cellspacing="0" cellpadding="0">
          <tr bgcolor="#FFFFFF">
            <td>Titulo</td>
            <td width="50px" align="center">Total de Vagas</td>
            <td width="50px" align="center">Vagas Disponiveis</td>
            <td align="center">Evento</td>
            <td width="32px">&nbsp;</td>
          </tr>
          <?php
		  $sql14 = "SELECT * FROM minicursos ORDER BY evento ASC";
		  $busca9 = mysql_query($sql14,$link1);
		  while($linha5 = mysql_fetch_assoc($busca9))
		  {
		  ?>
          <tr class="linha">
            <td>
            <a class="titulo" href="system_cursos.php?option=detalhecurso&curso=<?= $linha5["cod_curso"] ?>"><?= $linha5["titulo"] ?></a>
            </td>
            <td align="center"><?= $linha5["total_vagas"] ?></td>
            <td align="center"><?= $linha5["vagas_disponiveis"] ?></td>
            <td align="center">
				<?php
            	switch($linha5["evento"])
				{
					case "F":
					echo "FEMECI";
					break;
					case "I":
					echo "Informatica";
					break;
					case "M":
					echo "Enc. da Matematica";
					break;
					case "P":
					echo "Palestra";
					break;
				}
				?>
            </td>
            <td><a href="javascript:deletarCurso(<?= $linha5["cod_curso"] ?>)"><img src="images/del.png" width="32" height="32" border="0" /></a></td>
          </tr>
          <?php
		  }
		  ?>
      </table>
    </div>
    <script type="text/javascript">
	function deletarCurso(coud)
	{
		out = confirm("TEM CERTEZA QUE DESEJA MESMO EXCLUIR O MINICURSO!???");
		if(out == true)
		{
		pag = "system_cursos_query.php?tipo=9&codigo=" + coud;
		window.location.href = pag;
		}
		else
		{
			alert("exclusao cancelada!");
		}
	}
	</script>
     <?php
		}
		if(@$_GET["option"]=="alterprof")
		{
	?>
    <div>
    	<h2>Alterar Professor</h2>
      <form id="form4" name="form4" method="post" action="">
        <input name="tarefa" type="hidden" value="altprof" />
        <input name="email_o" type="hidden" value="<?= $_GET["b"] ?>" />
        <label for="nome">Nome do Professor</label>
        <input type="text" name="nome" id="nome" value="<?= $_GET["a"] ?>" />
        <label for="email">Email</label>
        <input name="email" type="text" disabled="disabled" id="email" value="<?= $_GET["b"] ?>" />
        <label for="minicv">Mini-CV</label>
        <input type="text" name="minicv" id="minicv" value="<?= $_GET["c"] ?>" />
        <input type="submit" name="button" id="button" value="Alterar Professor" />
      </form>
    </div>
    <?php
		}
		if(@$_GET["option"]=="alterlocal")
		{
	?>
    <div>
    	<h2>Alterar Local</h2>
    	<form id="form5" name="form5" method="post" action="">
        	<input name="tarefa" type="hidden" value="altlocal" />
            <input name="cod_local" type="hidden" value="<?= $_GET["codlocal"] ?>" />
            <label for="nome_local">Nome do Local</label>
            <input type="text" name="nome_local" id="email" value="<?= $_GET["nomelocal"] ?>" />
            <input type="submit" name="button" id="button" value="Alterar Local" />
            
        </form>
    </div>
    <?php
		}
		if(@$_GET["option"]=="detalhecurso")
		{
			$sql15 = "SELECT * FROM minicursos WHERE cod_curso='". $_GET["curso"] ."'";
			$busca10 = mysql_query($sql15,$link1);
			$linha6 = mysql_fetch_assoc($busca10);
	?>
    <div>
   	  <h2 id="titulo_al" style="display: inline;"><?= $linha6["titulo"] ?></h2>
      <a href="javascript:alterTitulo();"><img src="images/alterar.gif" width="32" height="32" border="0" /></a>
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td width="60px">Total de vagas</td>
            <td><?= $linha6["total_vagas"] ?> &nbsp;
            <a href="javascript:alterTotalVagas(<?= $linha6["total_vagas"] . "," . $linha6["vagas_disponiveis"] ?>)"><img src="images/alterar.gif" width="32" height="32" border="0" /></a></td>
          </tr>
          <tr>
            <td>Vagas Disponiveis</td>
            <td><?= $linha6["vagas_disponiveis"] ?></td>
          </tr>
          <tr>
            <td>Descricao</td>
            <td><span id="desc_al"><?= $linha6["descricao"] ?></span>.<br />
            <a href="javascript:alterDesc()"><img src="images/alterar.gif" width="32" height="32" border="0" /></a></td>
          </tr>
          <tr>
            <td>Evento</td>
            <td>
            <span id="op_evento">
			<?php
				switch($linha6["evento"])
				{
					case "I":
					echo "Cursos da Informatica";
					break;
					case "F":
					echo "FEMECI";
					break;
					case "M":
					echo "Enc. da Matematica";
					break;
					case "P":
					echo "Palestra";
					break;
				}
			?>
            </span>
            <select id="alter_event" name="alter_event" style="display:none;">
            	<option value="0">Selecione</option>
                <option value="F">FEMECI</option>
                <option value="M">Enc. da Matematica</option>
                <option value="I">Cursos de Informatica</option>
                <option value="P">Palestra</option>
            </select>
            <a href="javascript:alterEvento()"> &nbsp;<img src="images/alterar.gif" width="32" height="32" border="0" /></a></td>
          </tr>
          <tr>
            <td>Professores</td>
            <td>
            <?php
				$sql16 = "SELECT * FROM minicursos_professores INNER JOIN professores ON minicursos_professores.email_professor=professores.email_professor WHERE cod_curso='". $_GET["curso"] ."'";
				$busca11 = mysql_query($sql16,$link1);
				while($linha7 = mysql_fetch_assoc($busca11))
				{
					echo $linha7["nome"] . " (". $linha7["email_professor"] .")";
			?>
            <a href="javascript:removeProfe('<?= $linha7["email_professor"] ?>')"><img src="images/del.png" width="32" height="32" border="0" /></a>
            <br />       
			<?php
				}
			?>
            <select id="add_profe" name="add_profe" style="display:none;">
            <?php
				$sql19 = "SELECT * FROM professores";
				$busca14 = mysql_query($sql19,$link1);
				echo "<option value=\"0\">Selecione</option>";
				while($linha10 = mysql_fetch_assoc($busca14))
				{
					echo "<option value=\"". $linha10["email_professor"] ."\">". $linha10["nome"] ."</option>";
				}
			?>
            </select>
            <a href="javascript: addProfe()"><img src="images/add.png" width="32" height="32" border="0" /></a></td>
          </tr>
          <tr>
            <td>Horario</td>
            <td><table width="100%" border="1" cellspacing="0" cellpadding="0">
              <tr bgcolor="#FFFFFF">
                <td align="center">Dia</td>
                <td align="center">Hora de Inicio</td>
                <td align="center">Hora de Termino</td>
                <td align="center">Local</td>
                <td width="32px">&nbsp;</td>
              </tr>
              <?php
			  $sql17 = "SELECT `datas`.`id_datas` AS `id`,`nome_dia` AS `dia`,`hora_inicio` AS `inicio`,`hora_fim` AS `fim`,`nome_local` AS `local`,`cod_curso` AS `curso` FROM `datas`,`semana`,`local` WHERE `datas`.`cod_local`=`local`.`cod_local` AND `datas`.`dia`=`semana`.`cod_dia` AND `cod_curso`='". $_GET["curso"] ."' ORDER BY `nome_dia` ASC";
			  $busca12 = mysql_query($sql17,$link1);
			  while($linha8 = mysql_fetch_assoc($busca12))
			  {
			  ?>
              <tr>
                <td align="center"><?= $linha8["dia"] ?></td>
                <td align="center"><?= $linha8["inicio"] ?></td>
                <td align="center"><?= $linha8["fim"] ?></td>
                <td align="center"><?= $linha8["local"] ?></td>
                <td><a href="javascript:removeHorario(<?= $linha8["id"] ?>)"><img src="images/del.png" width="32" height="32" border="0" /></a></td>
              </tr>
              <?php
			  }
			  ?>
              <tr>
                <td align="center">
                <select name="add_dia" id="add_dia">
                	<option value="2" selected="selected">segunda-feira</option>
                	<option value="3">terca-feira</option>
                	<option value="4">quarta-feira</option>
                	<option value="5">quinta-feira</option>
                	<option value="6">sexta-feira</option>
                </select>
                </td>
                <td align="center"><input name="add_inicio" type="text" id="add_inicio" style="width:70px;" maxlength="8" /></td>
                <td align="center"><input name="add_fim" type="text" id="add_fim" style="width:70px;" maxlength="8" /></td>
                <td align="center">
                <select name="add_local" style="width:140px;" id="add_local">
                <?php
					$sql18 = "SELECT * FROM local";
					$busca13 = mysql_query($sql18,$link1);
					while($linha9 = mysql_fetch_assoc($busca13))
					{
						echo "<option value=\"" . $linha9["cod_local"] . "\">" . $linha9["nome_local"] . "</option>\n\r";
					}
				?>
                </select>
                </td>
                <td><a href="javascript:addHorario();"><img src="images/add.png" width="32" height="32" border="0" /></a></td>
              </tr>
            </table></td>
          </tr>
        </table>
        <script type="text/javascript">
		codigo = <?= $_GET["curso"] ?>;
		Titulo = document.getElementById("titulo_al");
		titulo_ul = Titulo.innerHTML;
		function alterTitulo()
		{
			if(titulo_ul!=Titulo.innerHTML)
			{
			pag = "system_cursos_query.php?tipo=1&codigo=";
			pag += codigo + "&titulo=" + escape(Titulo.innerHTML);
			window.location.href = pag;
			}
			Titulo.contentEditable=="true"?
			Titulo.contentEditable="false":Titulo.contentEditable="true";
			
		}
		function alterTotalVagas(total,disp)
		{
			ocupado = total - disp;
			novo = prompt("Digite o total de vagas!\n\nObservacao: o total tem que ser maior que " + ocupado + ",pois usuarios ja cadastaram-se no curso!!!","");
			if(novo != null && novo != "")
			{
				if(!isNaN(novo))
				{
					v_disp = novo - ocupado;
					if(novo>=ocupado)
					{
						pag = "system_cursos_query.php?tipo=2&codigo=";
						pag+= codigo +"&total="+novo+"&disp="+v_disp;
						window.location.href = pag;
					}
					else alert("invalido!");
				} else alert("nao eh numero");
			}
		}
		function removeHorario(num)
		{
			confirma = confirm("Tem certeza que deseja excluir esse horario???");
			if(confirma)
			{
				pag = "system_cursos_query.php?tipo=3&codigo="+ codigo +"&id=" + num;
				window.location.href = pag;
			}
		}
		function addHorario()
		{
			confirma = confirm("Deseja mesmo adicionar novo horario???");
			if(confirma)
			{
				dia = document.getElementById("add_dia").value;
				inicio = document.getElementById("add_inicio").value;
				fim = document.getElementById("add_fim").value;
				local = document.getElementById("add_local").value;
				if(!validaHora(inicio) || !validaHora(fim))
					alert("Formato de Hora invalido!");
				else
				{
					pag = "system_cursos_query.php?tipo=4&codigo="+ codigo;
					pag+= "&dia=" + dia + "&inicio=" + inicio + "&fim=" + fim;
					pag+= "&local=" + local;
					window.location.href = pag;
				}
			}
		}
		descri = document.getElementById("desc_al");
		descri_ul = descri.innerHTML;
		function alterDesc()
		{
			if(descri_ul!=descri.innerHTML)
			{
				pag = "system_cursos_query.php?tipo=5&codigo=";
				pag += codigo + "&descr=" + escape(descri.innerHTML);
				window.location.href = pag;
			}
			descri.contentEditable=="true"?
			descri.contentEditable="false":descri.contentEditable="true";
		}
		function addProfe()
		{
			lista_p = document.getElementById("add_profe");
			if(lista_p.style.display == "none")
			{
				lista_p.style.display = "inline";
			}
			else
			{
				if(lista_p.value == 0)
				lista_p.style.display = "none";
				else
				{
					pag = "system_cursos_query.php?tipo=6&codigo=";
					pag+= codigo + "&email=" + escape(lista_p.value);
					window.location.href = pag;
				}
			}	
		}
		function removeProfe(email)
		{
			out = confirm("Tem certeza que deseja remover professor do curso???");
			if(out)
			{
				pag = "system_cursos_query.php?tipo=7&codigo=";
				pag+= codigo + "&email=" + escape(email);
				window.location.href = pag;
			}
		}
		function alterEvento()
		{
			evt_in = document.getElementById("alter_event");
			evt_out = document.getElementById("op_evento");
			if(evt_in.style.display == "none")
			{
			evt_in.style.display = "inline";
			evt_out.style.display = "none";
			}
			else
			{
				if(evt_in.value != "0")
				{
					pag = "system_cursos_query.php?tipo=8&codigo=";
					pag+= codigo + "&evt=" + evt_in.value;
					window.location.href = pag;
				}
				else
				{
					evt_in.style.display = "none";
					evt_out.style.display = "inline";
				}
			}
		}
		</script>
    </div>
    <?php
		}
    ?>
    &nbsp;
</div>
</div>
</body>
</html>
<?php
}else{
	echo "Restrito!";
	header("Location:index.php");
}
?>