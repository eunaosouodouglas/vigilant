<?php

/*

    format_id:
    247+251 =
    244+251 =
    302+251 =

*/

// Setar timezone para não deixar o servidor inserir informações com datas erradas.
date_default_timezone_set('UTC');

// Importar o arquivo com as configurações de banco de dados e constantes.
require('config.php');

$time = time();

// Carregar JSON.
$data = file_get_contents("../data/youtube.json");
$json = json_decode($data, true);

// Recuperar os inputs eviados pelo usuário utilizando a superglobal $_POST.
$url = $_POST['url'];
// $right = $_POST['right'];

// Comando de Shell Script que será executado pelo interpretador do PHP.
$command = YT_DLP.' '.$url.' --simulate --no-download-archive --skip-download --print "######%(channel_id)s|||%(channel)s|||%(channel_follower_count)s|||%(id)s|||%(title)s|||%(upload_date)s|||%(view_count)s|||%(like_count)s|||%(dislike_count)s|||%(comment_count)s|||%(was_live)s|||%(duration)s|||%(format_id)s|||%(webpage_url)s######"';

// shell_exec = executar o comando de shell retornando o output inteiro.
// trim = remover espaços ou caracteres indesejados inseridos pelo PHP.
// explode = dividir o retorno em arrays, utilizando string '######' e '|||' para delimitar.
// array_map = fazer um loop em cada item de um array executando uma função de callback.
// array_filter = remover índices nulos ou vazios.
$output = shell_exec(trim($command));
$video_listing = explode('######', $output);
$space_removed = array_map('trim', $video_listing);
$videos_list = array_filter($space_removed);

foreach($videos_list as $video) {
    $data = file_get_contents("../data/youtube.json");
    $json = json_decode($data, true);
    $arr = explode('|||', $video);
    $video_data = array_map('trim', $arr);

    $video = new stdClass;
    $video->table = "videos";
    $video->id = $video_data[3];
    $video->name = $video_data[4];
    $video->live = $video_data[10];
    $video->type = $video_data[12];
    $video->duration = $video_data[11];
    $video->time = $time;

    $video_exists = false;
    foreach($json[2] as $i){
        if($i['id'] == $video->id){
            $video_exists = true;
        }
    }
    if($video_exists == false) {
        array_push($json[2], $video);
        $handle = fopen('../data/youtube.json', 'w');
        fwrite($handle, json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_QUOT));
        fclose($handle);
    }

    $video_count = new stdClass;
    $video_count->table = "video_count";
    $video_count->vid = $video_data[3];
    $video_count->views = $video_data[6];
    $video_count->likes = $video_data[7];
    $video_count->dislikes = $video_data[8];
    $video_count->comments = $video_data[9];
    $video_count->time = $time;

    array_push($json[3], $video_count);
    $handle = fopen('../data/youtube.json', 'w');
    fwrite($handle, json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_QUOT));
    fclose($handle);
}

$channel = new stdClass;
$channel->table = "channels";
$channel->id = $video_data[0];
$channel->name = $video_data[1];
$channel->right = 1;
// $channel->views = $total;
$channel->time = $time;

$channel_exists = false;
foreach($json[0] as $i){
    if($i['id'] == $channel->id){
        $channel_exists = true;
    }
}
if($channel_exists == false) {
    array_push($json[0], $channel);
    $handle = fopen('../data/youtube.json', 'w');
    fwrite($handle, json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_QUOT));
    fclose($handle);
}

$channel_count = new stdClass;
$channel_count->table = "channel_count";
$channel_count->cid = $video_data[0];
$channel_count->followers = $video_data[2];
$channel_count->right = 1;
$channel_count->time = $time;

array_push($json[1], $channel_count);
$handle = fopen('../data/youtube.json', 'w');
fwrite($handle, json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_QUOT));
fclose($handle);
