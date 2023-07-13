<?php

// Importa o arquivo com as configurações de banco de dados e constantes.
require('config.php');

// Shell Script
// 1. Criar diretório para binário do yt-dlp com mkdir.
// 2. Baixar binário utilizando curl.
// 3. Conceder permissão de execução com chmod.
$command = 'mkdir '.ENV.' && curl -L '.YT_DLP_URL.' --output '.ENV.'/yt-dlp && chmod a+rx '.ENV.'/yt-dlp';

// Executa o comando shell acima e envia o retorno para $output.
$output = shell_exec($command);

// Simples verificação se o download foi concluído.
if($output == 0) {
    echo 'Download concluído.';
} else {
    echo 'Ocorreu um erro.';
}
