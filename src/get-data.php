<?php

/*

    format_id:
    247+251 = 
    244+251 = 
    302+251 = 

*/

// Importa o arquivo com as configurações de banco de dados e constantes.
require('config.php');

// Recupera o input eviado pelo usuário para a variável $url, utilizando a superglobal $_POST.
$url = $_POST['url'];

// Comando de Shell Script que será executado pelo interpretador do PHP.
$command = YT_DLP.' '.$url.' --simulate --no-download-archive --skip-download --print "######%(id)s|||%(channel)s|||%(title)s|||%(upload_date)s|||%(view_count)s|||%(like_count)s|||%(dislike_count)s|||%(comment_count)s|||%(was_live)s|||%(duration)s|||%(format_id)s|||%(webpage_url)s######"';

// shell_exec = executar o comando de shell retornando o output inteiro.
// trim = remover espaços ou caracteres indesejados inseridos pelo PHP.
// explode = dividir o retorno em arrays, utilizando string '######' e '|||' para delimitar.
// array_map = fazer um loop em cada item de um array executando uma função de callback.
// array_filter = remover índices nulos ou vazios.
$output = shell_exec(trim($command));
$video_listing = explode('######', $output);
$space_removed = array_map('trim', $video_listing);
$videos = array_filter($space_removed);

foreach($videos as $video) {
    $arr = explode('|||', $video);
    $map = array_map('trim', $arr);
    echo "<pre>";
    var_dump($map);
    echo "</pre>";
}
