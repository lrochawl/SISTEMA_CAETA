<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * O nome de usuário do GitHub proprietário do repositório
 */
$config['github_user'] = 'lrochawl';

/**
 * O repositório no GitHub do qual estaremos atualizando
 */
$config['github_repo'] = 'SISTEMA_CAETA';

/**
 * O branch do qual atualizar
 */
$config['github_branch'] = 'main'; // Ou 'master', ou o branch principal do seu repositório

/**
 * O commit atual em que os arquivos estão.
 *
 * NOTA: Você só deve precisar definir isso inicialmente, ele será
 * definido automaticamente pela biblioteca após atualizações subsequentes.
 */
$config['current_commit'] = '5d29e6e4e55bab007f903b5f5de79c1ab059009e';

/**
 * Uma lista de arquivos ou pastas que nunca devem receber uma atualização.
 * Não especificar um caminho relativo a partir do webroot aplicará
 * a ignorância a quaisquer arquivos com um segmento correspondente.
 *
 * Ex: Especificar 'admin' como ignorado irá ignorar
 * 'application/controllers/admin.php'
 * 'application/views/admin/test.php'
 * e qualquer outro caminho com o termo 'admin' nele.
 */
$config['ignored_files'] = [];

/**
 * Sinalizador para indicar se os arquivos de atualização baixados e extraídos
 * devem ser removidos
 */
$config['clean_update_files'] = true;

?>
