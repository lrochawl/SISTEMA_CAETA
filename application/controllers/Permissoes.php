<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permissoes extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Verifica se o usuário tem permissão para acessar este controller
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'cPermissao')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para configurar as permissões no sistema.');
            redirect(base_url());
        }

        $this->load->helper(['form', 'codegen_helper']); // 'codegen_helper' já estava, mantido
        $this->load->model('permissoes_model');
        $this->data['menuConfiguracoes'] = 'Permissões'; // Para o menu ativo
    }

    public function index()
    {
        $this->gerenciar();
    }

    public function gerenciar()
    {
        $this->load->library('pagination');

        // Configuração da paginação
        // Nota: A chave 'base_url' e 'total_rows' estavam sendo setadas em $this->data['configuration']
        // mas a biblioteca de paginação espera um array $config. Ajustando para clareza.
        $config['base_url'] = site_url('permissoes/gerenciar/');
        $config['total_rows'] = $this->permissoes_model->count('permissoes');
        $config['per_page'] = $this->data['configuration']['per_page'] ?? 10; // Pega da configuração global ou usa 10
        $config['next_link'] = 'Próxima';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a style="color: #2D335B"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = 'Primeira';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Última';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['uri_segment'] = 3; // Segmento da URI para o número da página

        $this->pagination->initialize($config);

        $this->data['results'] = $this->permissoes_model->get(
            'permissoes',
            'idPermissao,nome,data,situacao',
            '', // Sem 'where' específico aqui
            $config['per_page'],
            $this->uri->segment($config['uri_segment'])
        );

        $this->data['view'] = 'permissoes/permissoes';
        return $this->layout();
    }

    public function adicionar()
    {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        // Regras de validação
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|is_unique[permissoes.nome]');
        $this->form_validation->set_rules('situacao', 'Situação', 'trim|required|in_list[0,1]'); // Obrigatório e deve ser 0 ou 1

        // Definindo mensagens de erro customizadas para as validações (opcional, mas bom para UX)
        $this->form_validation->set_message('required', 'O campo %s é obrigatório.');
        $this->form_validation->set_message('is_unique', 'Este %s já está cadastrado.');
        $this->form_validation->set_message('in_list', 'O campo %s deve ser Ativo ou Inativo.');

        if ($this->form_validation->run() == false) {
            // Se a validação falhar, exibe os erros
            $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : false);
        } else {
            // Coleta das permissões específicas (checkboxes)
            // É importante listar todas as permissões que seu formulário envia.
            $permissoesArray = [
                'vCliente' => $this->input->post('vCliente') ? 1 : 0,
                'aCliente' => $this->input->post('aCliente') ? 1 : 0,
                'eCliente' => $this->input->post('eCliente') ? 1 : 0,
                'dCliente' => $this->input->post('dCliente') ? 1 : 0,
                'vProduto' => $this->input->post('vProduto') ? 1 : 0,
                'aProduto' => $this->input->post('aProduto') ? 1 : 0,
                'eProduto' => $this->input->post('eProduto') ? 1 : 0,
                'dProduto' => $this->input->post('dProduto') ? 1 : 0,
                'vServico' => $this->input->post('vServico') ? 1 : 0,
                'aServico' => $this->input->post('aServico') ? 1 : 0,
                'eServico' => $this->input->post('eServico') ? 1 : 0,
                'dServico' => $this->input->post('dServico') ? 1 : 0,
                'vOs' => $this->input->post('vOs') ? 1 : 0,
                'aOs' => $this->input->post('aOs') ? 1 : 0,
                'eOs' => $this->input->post('eOs') ? 1 : 0,
                'dOs' => $this->input->post('dOs') ? 1 : 0,
                'vVenda' => $this->input->post('vVenda') ? 1 : 0,
                'aVenda' => $this->input->post('aVenda') ? 1 : 0,
                'eVenda' => $this->input->post('eVenda') ? 1 : 0,
                'dVenda' => $this->input->post('dVenda') ? 1 : 0,
                'vArquivo' => $this->input->post('vArquivo') ? 1 : 0,
                'aArquivo' => $this->input->post('aArquivo') ? 1 : 0,
                'eArquivo' => $this->input->post('eArquivo') ? 1 : 0,
                'dArquivo' => $this->input->post('dArquivo') ? 1 : 0,
                'vLancamento' => $this->input->post('vLancamento') ? 1 : 0,
                'aLancamento' => $this->input->post('aLancamento') ? 1 : 0,
                'eLancamento' => $this->input->post('eLancamento') ? 1 : 0,
                'dLancamento' => $this->input->post('dLancamento') ? 1 : 0,
                'vGarantia' => $this->input->post('vGarantia') ? 1 : 0,
                'aGarantia' => $this->input->post('aGarantia') ? 1 : 0,
                'eGarantia' => $this->input->post('eGarantia') ? 1 : 0,
                'dGarantia' => $this->input->post('dGarantia') ? 1 : 0,
                'vEmail' => $this->input->post('vEmail') ? 1 : 0,
                'aEmail' => $this->input->post('aEmail') ? 1 : 0,
                'eEmail' => $this->input->post('eEmail') ? 1 : 0,
                'dEmail' => $this->input->post('dEmail') ? 1 : 0,
                'vCobranca' => $this->input->post('vCobranca') ? 1 : 0,
                'aCobranca' => $this->input->post('aCobranca') ? 1 : 0,
                'eCobranca' => $this->input->post('eCobranca') ? 1 : 0,
                'dCobranca' => $this->input->post('dCobranca') ? 1 : 0,
                // Permissões de Funcionários
                'vFuncionario' => $this->input->post('vFuncionario') ? 1 : 0,
                'aFuncionario' => $this->input->post('aFuncionario') ? 1 : 0,
                'eFuncionario' => $this->input->post('eFuncionario') ? 1 : 0,
                'dFuncionario' => $this->input->post('dFuncionario') ? 1 : 0,
                // Permissões de Configuração
                'cUsuario' => $this->input->post('cUsuario') ? 1 : 0,
                'cEmitente' => $this->input->post('cEmitente') ? 1 : 0,
                'cPermissao' => $this->input->post('cPermissao') ? 1 : 0,
                'cBackup' => $this->input->post('cBackup') ? 1 : 0,
                'cAuditoria' => $this->input->post('cAuditoria') ? 1 : 0,
                'cEmail' => $this->input->post('cEmail') ? 1 : 0,
                'cSistema' => $this->input->post('cSistema') ? 1 : 0,
                // Relatórios
                'rCliente' => $this->input->post('rCliente') ? 1 : 0,
                'rProduto' => $this->input->post('rProduto') ? 1 : 0,
                'rServico' => $this->input->post('rServico') ? 1 : 0,
                'rOs' => $this->input->post('rOs') ? 1 : 0,
                'rVenda' => $this->input->post('rVenda') ? 1 : 0,
                'rFinanceiro' => $this->input->post('rFinanceiro') ? 1 : 0,
                'rGarantia' => $this->input->post('rGarantia') ? 1 : 0, // Adicionado se existir
                'rEtiqueta' => $this->input->post('rEtiqueta') ? 1 : 0, // Adicionado se existir
                'rCompra' => $this->input->post('rCompra') ? 1 : 0, // Adicionado se existir
                'rEstoque' => $this->input->post('rEstoque') ? 1 : 0, // Adicionado se existir
                // Adicione outras permissões conforme necessário
            ];
            // Usar json_encode é geralmente preferível a serialize
            $permissoesJson = json_encode($permissoesArray);

            $data = [
                'nome' => $this->input->post('nome'),
                'data' => date('Y-m-d'), // Data de cadastro
                'permissoes' => $permissoesJson,
                'situacao' => $this->input->post('situacao'), // Já validado para ser 0 ou 1
            ];

            // Para depuração, você pode descomentar as linhas abaixo:
            // echo '<pre>';
            // var_dump($data);
            // echo '</pre>';
            // die('Verificando dados antes de inserir.');

            if ($this->permissoes_model->add('permissoes', $data) == true) {
                $this->session->set_flashdata('success', 'Permissão adicionada com sucesso!');
                log_info('Adicionou uma permissão. Nome: ' . $data['nome']); // Usar $data['nome'] que já foi processado
                redirect(site_url('permissoes/adicionar/')); // Redireciona para adicionar outra ou para gerenciar
            } else {
                $this->data['custom_error'] = '<div class="alert alert-danger"><p>Ocorreu um erro ao tentar adicionar a permissão. Por favor, tente novamente.</p></div>';
            }
        }

        $this->data['view'] = 'permissoes/adicionarPermissao';
        return $this->layout();
    }

    public function editar()
    {
        $idPermissao = $this->uri->segment(3);
        if (!$idPermissao || !is_numeric($idPermissao)) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect(site_url('permissoes/gerenciar'));
        }

        // Verifica se o usuário tem permissão para editar
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'ePermissao')) { // Supondo 'ePermissao' para editar
             $this->session->set_flashdata('error', 'Você não tem permissão para editar permissões.');
             redirect(site_url('permissoes/gerenciar'));
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->data['result'] = $this->permissoes_model->getById($idPermissao);
        if ($this->data['result'] == null) {
            $this->session->set_flashdata('error', 'Permissão não encontrada.');
            redirect(site_url('permissoes/gerenciar'));
        }

        // Regra de validação para o nome, verificando unicidade exceto para o ID atual
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|callback_check_nome_permissao_unique[' . $idPermissao . ']');
        $this->form_validation->set_rules('situacao', 'Situação', 'trim|required|in_list[0,1]');

        $this->form_validation->set_message('required', 'O campo %s é obrigatório.');
        $this->form_validation->set_message('in_list', 'O campo %s deve ser Ativo ou Inativo.');

        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : false);
        } else {
            $permissoesArray = [
                'vCliente' => $this->input->post('vCliente') ? 1 : 0,
                'aCliente' => $this->input->post('aCliente') ? 1 : 0,
                'eCliente' => $this->input->post('eCliente') ? 1 : 0,
                'dCliente' => $this->input->post('dCliente') ? 1 : 0,
                'vProduto' => $this->input->post('vProduto') ? 1 : 0,
                'aProduto' => $this->input->post('aProduto') ? 1 : 0,
                'eProduto' => $this->input->post('eProduto') ? 1 : 0,
                'dProduto' => $this->input->post('dProduto') ? 1 : 0,
                'vServico' => $this->input->post('vServico') ? 1 : 0,
                'aServico' => $this->input->post('aServico') ? 1 : 0,
                'eServico' => $this->input->post('eServico') ? 1 : 0,
                'dServico' => $this->input->post('dServico') ? 1 : 0,
                'vOs' => $this->input->post('vOs') ? 1 : 0,
                'aOs' => $this->input->post('aOs') ? 1 : 0,
                'eOs' => $this->input->post('eOs') ? 1 : 0,
                'dOs' => $this->input->post('dOs') ? 1 : 0,
                'vVenda' => $this->input->post('vVenda') ? 1 : 0,
                'aVenda' => $this->input->post('aVenda') ? 1 : 0,
                'eVenda' => $this->input->post('eVenda') ? 1 : 0,
                'dVenda' => $this->input->post('dVenda') ? 1 : 0,
                'vArquivo' => $this->input->post('vArquivo') ? 1 : 0,
                'aArquivo' => $this->input->post('aArquivo') ? 1 : 0,
                'eArquivo' => $this->input->post('eArquivo') ? 1 : 0,
                'dArquivo' => $this->input->post('dArquivo') ? 1 : 0,
                'vLancamento' => $this->input->post('vLancamento') ? 1 : 0,
                'aLancamento' => $this->input->post('aLancamento') ? 1 : 0,
                'eLancamento' => $this->input->post('eLancamento') ? 1 : 0,
                'dLancamento' => $this->input->post('dLancamento') ? 1 : 0,
                'vGarantia' => $this->input->post('vGarantia') ? 1 : 0,
                'aGarantia' => $this->input->post('aGarantia') ? 1 : 0,
                'eGarantia' => $this->input->post('eGarantia') ? 1 : 0,
                'dGarantia' => $this->input->post('dGarantia') ? 1 : 0,
                'vEmail' => $this->input->post('vEmail') ? 1 : 0,
                'aEmail' => $this->input->post('aEmail') ? 1 : 0,
                'eEmail' => $this->input->post('eEmail') ? 1 : 0,
                'dEmail' => $this->input->post('dEmail') ? 1 : 0,
                'vCobranca' => $this->input->post('vCobranca') ? 1 : 0,
                'aCobranca' => $this->input->post('aCobranca') ? 1 : 0,
                'eCobranca' => $this->input->post('eCobranca') ? 1 : 0,
                'dCobranca' => $this->input->post('dCobranca') ? 1 : 0,
                'vFuncionario' => $this->input->post('vFuncionario') ? 1 : 0,
                'aFuncionario' => $this->input->post('aFuncionario') ? 1 : 0,
                'eFuncionario' => $this->input->post('eFuncionario') ? 1 : 0,
                'dFuncionario' => $this->input->post('dFuncionario') ? 1 : 0,
                'cUsuario' => $this->input->post('cUsuario') ? 1 : 0,
                'cEmitente' => $this->input->post('cEmitente') ? 1 : 0,
                'cPermissao' => $this->input->post('cPermissao') ? 1 : 0,
                'cBackup' => $this->input->post('cBackup') ? 1 : 0,
                'cAuditoria' => $this->input->post('cAuditoria') ? 1 : 0,
                'cEmail' => $this->input->post('cEmail') ? 1 : 0,
                'cSistema' => $this->input->post('cSistema') ? 1 : 0,
                'rCliente' => $this->input->post('rCliente') ? 1 : 0,
                'rProduto' => $this->input->post('rProduto') ? 1 : 0,
                'rServico' => $this->input->post('rServico') ? 1 : 0,
                'rOs' => $this->input->post('rOs') ? 1 : 0,
                'rVenda' => $this->input->post('rVenda') ? 1 : 0,
                'rFinanceiro' => $this->input->post('rFinanceiro') ? 1 : 0,
                'rGarantia' => $this->input->post('rGarantia') ? 1 : 0,
                'rEtiqueta' => $this->input->post('rEtiqueta') ? 1 : 0,
                'rCompra' => $this->input->post('rCompra') ? 1 : 0,
                'rEstoque' => $this->input->post('rEstoque') ? 1 : 0,
            ];
            $permissoesJson = json_encode($permissoesArray);

            $data = [
                'nome' => $this->input->post('nome'),
                'data' => date('Y-m-d'), // Atualiza a data para a da modificação
                'permissoes' => $permissoesJson,
                'situacao' => $this->input->post('situacao'),
            ];

            if ($this->permissoes_model->edit('permissoes', $data, 'idPermissao', $idPermissao) == true) {
                $this->session->set_flashdata('success', 'Permissão editada com sucesso!');
                log_info('Alterou uma permissão. ID: ' . $idPermissao);
                redirect(site_url('permissoes/editar/') . $idPermissao);
            } else {
                $this->data['custom_error'] = '<div class="alert alert-danger"><p>Ocorreu um erro ao tentar editar a permissão. Por favor, tente novamente.</p></div>';
            }
        }

        // Para preencher o formulário na view, decodifique as permissões
        $decodedPermissoes = json_decode($this->data['result']->permissoes, true);
        $this->data['result']->permissoes = is_array($decodedPermissoes) ? $decodedPermissoes : [];


        $this->data['view'] = 'permissoes/editarPermissao';
        return $this->layout();
    }

    /**
     * Callback function para validar se o nome da permissão é único ao editar,
     * ignorando o registro atual.
     */
    public function check_nome_permissao_unique($nome, $idPermissao)
    {
        $this->db->where('nome', $nome);
        $this->db->where('idPermissao !=', $idPermissao);
        $query = $this->db->get('permissoes');

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_nome_permissao_unique', 'Este Nome de permissão já está em uso.');
            return false;
        }
        return true;
    }


    public function excluir() // O método original era desativar(), mas o nome da função no menu é Excluir.
                            // Se for para desativar, o nome da função deveria ser `desativar` e a lógica mantida.
                            // Se for para excluir de fato, a lógica abaixo deve ser usada.
                            // Vou assumir que é para EXCLUIR, conforme o nome da função.
    {
        // Verifica se o usuário tem permissão para excluir
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dPermissao')) { // Supondo 'dPermissao' para deletar
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir permissões.');
            redirect(site_url('permissoes/gerenciar'));
        }

        $id = $this->input->post('id'); // Pega o ID do post, geralmente de um formulário/botão de exclusão
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir permissão: ID inválido.');
            redirect(site_url('permissoes/gerenciar/'));
        }

        // Verifica se a permissão não está em uso por algum usuário antes de excluir (BOA PRÁTICA)
        // Exemplo: $this->load->model('usuarios_model');
        // if ($this->usuarios_model->is_permissao_in_use($id)) {
        //    $this->session->set_flashdata('error', 'Esta permissão não pode ser excluída, pois está em uso por um ou mais usuários.');
        //    redirect(site_url('permissoes/gerenciar/'));
        // }

        if ($this->permissoes_model->delete('permissoes', 'idPermissao', $id)) {
            log_info('Removeu uma permissão. ID: ' . $id);
            $this->session->set_flashdata('success', 'Permissão excluída com sucesso!');
        } else {
            $this->session->set_flashdata('error', 'Erro ao excluir a permissão. Tente novamente.');
        }
        redirect(site_url('permissoes/gerenciar/'));
    }

    // O método desativar original, caso a intenção não seja excluir, mas sim mudar a situação.
    // Se for este o caso, o nome da função no menu e a chamada deveriam ser para "desativar".
    /*
    public function desativar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'ePermissao')) { // Editar para desativar
            $this->session->set_flashdata('error', 'Você não tem permissão para alterar a situação das permissões.');
            redirect(site_url('permissoes/gerenciar/'));
        }

        $id = $this->input->post('id'); // ID da permissão a ser desativada/ativada
        if (!$id || !is_numeric($id)) {
            $this->session->set_flashdata('error', 'Erro ao tentar alterar situação da permissão: ID inválido.');
            redirect(site_url('permissoes/gerenciar/'));
        }

        $permissaoAtual = $this->permissoes_model->getById($id);
        if(!$permissaoAtual){
            $this->session->set_flashdata('error', 'Permissão não encontrada.');
            redirect(site_url('permissoes/gerenciar/'));
        }

        // Inverte a situação atual
        $novaSituacao = $permissaoAtual->situacao == 1 ? 0 : 1;
        $mensagemAcao = $novaSituacao == 1 ? 'ativada' : 'desativada';

        $data = ['situacao' => $novaSituacao];

        if ($this->permissoes_model->edit('permissoes', $data, 'idPermissao', $id)) {
            log_info(ucfirst($mensagemAcao) . ' uma permissão. ID: ' . $id);
            $this->session->set_flashdata('success', "Permissão {$mensagemAcao} com sucesso!");
        } else {
            $this->session->set_flashdata('error', "Erro ao tentar {$mensagemAcao} a permissão.");
        }
        redirect(site_url('permissoes/gerenciar/'));
    }
    */
}

/* End of file permissoes.php */
/* Location: ./application/controllers/permissoes.php */
