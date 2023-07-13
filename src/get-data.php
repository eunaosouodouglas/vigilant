<?php

// Importa o arquivo com as configurações de banco de dados e constantes.
require('config.php');

// Recupera o input eviado pelo usuário para a variável $url, utilizando a superglobal $_POST.
$url = $_POST['url'];

// Comando de Shell Script que será executado pelo interpretador do PHP.
$command = YT_DLP.' '.$url.' --print "%(channel)s - %(title)s - %(upload_date)s - %(view_count)s - %(like_count)s - %(dislike_count)s - %(comment_count)s - %(was_live)s - %(duration>%H:%M:%S)s"';

// Executa, trata e recebe o output em um array inteiro.
// shell_exec = função nativa para executar o comando de shell.
// trim = função nativa para remover espaços ou caracteres indesejados inseridos pelo PHP.
// explode = função nativa para dividir o retorno em arrays, utilizando string ' - ' para delimitar.
$output = explode(' - ', trim(shell_exec($command)));

// Exibe o retorno dos dados no navegador.
echo "<pre>";
var_dump($output);
echo "</pre>";
