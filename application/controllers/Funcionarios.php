<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Funcionarios extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Verifica se o usuário está logado
        if (!$this->session->userdata('logado')) {
            redirect('mapos/login');
        }

        // Carrega o Model de Funcionários que criamos
        $this->load->model('Funcionarios_model', 'funcionarios_model');
        // Carrega a library de permissões
        $this->load->library('permission');
    }

    /**
     * Método principal, lista os funcionários.
     * No MapOS, geralmente o método de listagem é chamado 'gerenciar'.
     */
    public function gerenciar()
    {
        // Verifica se o usuário tem permissão para visualizar funcionários
        // Usaremos 'vFuncionario' como código de permissão para visualização.
        // Você precisará adicionar essa permissão no sistema depois.
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vFuncionario')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar funcionários.');
            redirect(base_url());
        }

        $this->load->library('pagination');

        $config['base_url'] = base_url('index.php/funcionarios/gerenciar');
        $config['total_rows'] = $this->funcionarios_model->count('funcionarios'); // Conta todos os funcionários
        $config['per_page'] = 10; // Quantidade de funcionários por página
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

        $this->pagination->initialize($config);

        // $this->uri->segment(3) pega o número da página da URL
        $offset = ($this->uri->segment(3) == null) ? 0 : $this->uri->segment(3);

        $data['results'] = $this->funcionarios_model->get($config['per_page'], $offset);
        $data['pagination_links'] = $this->pagination->create_links();

        // Define qual view será carregada e passa os dados para ela
        // Criaremos a view 'funcionarios/funcionarios.php' no próximo passo.
        $data['view'] = 'funcionarios/funcionarios';
        $this->load->view('tema/conteudo', $data);
    }

    /**
     * Carrega o formulário para adicionar um novo funcionário
     * e processa o envio do formulário.
     */
    public function adicionar()
    {
        // Verifica se o usuário tem permissão para adicionar funcionários
        // Usaremos 'aFuncionario' como código de permissão para adicionar.
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aFuncionario')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar funcionários.');
            redirect(base_url('index.php/funcionarios/gerenciar'));
        }

        $this->load->library('form_validation');
        // Define as regras de validação dos campos do formulário
        // O terceiro parâmetro do set_rules é o nome do campo que aparecerá nas mensagens de erro
        $this->form_validation->set_rules('nomeCompleto', 'Nome Completo', 'trim|required');
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|required|callback_check_cpf_unique');
        $this->form_validation->set_rules('dataAdmissao', 'Data de Admissão', 'trim|required');
        $this->form_validation->set_rules('cargo', 'Cargo/Função', 'trim|required');
        $this->form_validation->set_rules('situacaoFuncionario', 'Situação do Funcionário', 'trim|required');

        // Validação para e-mail do portal, se preenchido
        if ($this->input->post('portal_email')) {
            $this->form_validation->set_rules('portal_email', 'E-mail de Acesso ao Portal', 'trim|valid_email|callback_check_portal_email_unique');
        }
        // Validação para senha do portal, se e-mail do portal preenchido
        if ($this->input->post('portal_email') && $this->input->post('portal_senha')) {
             $this->form_validation->set_rules('portal_senha', 'Senha de Acesso ao Portal', 'trim|required|min_length[6]');
        }


        if ($this->form_validation->run() == false) {
            // Se a validação falhar, carrega a view do formulário novamente com os erros
            $data['custom_error'] = (validation_errors() ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : false);
            $data['view'] = 'funcionarios/adicionarFuncionario'; // Criaremos esta view
            $this->load->view('tema/conteudo', $data);
        } else {
            // Se a validação passar, prepara os dados para salvar
            $dataFuncionario = [
                'nome_completo' => $this->input->post('nomeCompleto'),
                'cpf' => $this->input->post('cpf'),
                'rg' => $this->input->post('rg'),
                'data_nascimento' => $this->input->post('data_nascimento') ? $this->input->post('data_nascimento') : null,
                'sexo' => $this->input->post('sexo'),
                'foto_url' => $this->input->post('foto_url'),
                'possui_cnh' => $this->input->post('possui_cnh') ? 1 : 0,
                'categoria_cnh' => $this->input->post('categoria_cnh'),
                'validade_cnh' => $this->input->post('validade_cnh') ? $this->input->post('validade_cnh') : null,
                'telefone_residencial' => $this->input->post('telefone_residencial'),
                'celular_principal' => $this->input->post('celular_principal'),
                'email_pessoal' => $this->input->post('email_pessoal'),
                'cep' => $this->input->post('cep'),
                'rua' => $this->input->post('rua'),
                'numero' => $this->input->post('numero'),
                'complemento' => $this->input->post('complemento'),
                'bairro' => $this->input->post('bairro'),
                'cidade' => $this->input->post('cidade'),
                'estado' => $this->input->post('estado'),
                'data_admissao' => $this->input->post('dataAdmissao'),
                'data_demissao' => $this->input->post('data_demissao') ? $this->input->post('data_demissao') : null,
                'cargo' => $this->input->post('cargo'),
                'salario' => $this->input->post('salario') ? str_replace([',', '.'], ['', ''], $this->input->post('salario')) / 100 : null, // Trata o formato do salário
                'horario_trabalho' => $this->input->post('horario_trabalho'),
                'tipo_contrato' => $this->input->post('tipo_contrato'),
                'recebe_cesta_basica' => $this->input->post('recebe_cesta_basica') ? 1 : 0,
                'transporte_info' => $this->input->post('transporte_info'),
                'hospedagem_info' => $this->input->post('hospedagem_info'),
                'sindicalizado' => $this->input->post('sindicalizado') ? 1 : 0,
                'situacao_funcionario' => $this->input->post('situacaoFuncionario'),
                'tamanho_camisa' => $this->input->post('tamanho_camisa'),
                'tamanho_calca' => $this->input->post('tamanho_calca'),
                'tamanho_sapato' => $this->input->post('tamanho_sapato'),
                'banco_nome' => $this->input->post('banco_nome'),
                'banco_codigo' => $this->input->post('banco_codigo'),
                'agencia_numero' => $this->input->post('agencia_numero'),
                'agencia_dv' => $this->input->post('agencia_dv'),
                'conta_numero' => $this->input->post('conta_numero'),
                'conta_dv' => $this->input->post('conta_dv'),
                'conta_tipo' => $this->input->post('conta_tipo'),
                'pix_tipo_chave' => $this->input->post('pix_tipo_chave'),
                'pix_chave' => $this->input->post('pix_chave'),
                'portal_email' => $this->input->post('portal_email'),
                'portal_senha' => $this->input->post('portal_senha'), // O model vai tratar o hash
                'portal_status_acesso' => $this->input->post('portal_status_acesso') ? 1 : 0,
                'observacoes' => $this->input->post('observacoes'),
                'id_usuario_sistema' => $this->input->post('id_usuario_sistema') ? $this->input->post('id_usuario_sistema') : null,
                'data_cadastro' => date('Y-m-d'), // Data de cadastro é definida aqui
            ];

            // Remove campos de senha do portal se o e-mail do portal não for preenchido
            if (empty($dataFuncionario['portal_email'])) {
                unset($dataFuncionario['portal_senha']);
                unset($dataFuncionario['portal_status_acesso']);
            } elseif (empty($dataFuncionario['portal_senha'])) {
                 unset($dataFuncionario['portal_senha']); // Não tenta inserir senha vazia se email preenchido
            }


            if ($this->funcionarios_model->add($dataFuncionario)) {
                $this->session->set_flashdata('success', 'Funcionário adicionado com sucesso!');
                redirect(base_url('index.php/funcionarios/gerenciar'));
            } else {
                $data['custom_error'] = '<div class="alert alert-danger">Ocorreu um erro ao adicionar o funcionário.</div>';
                $data['view'] = 'funcionarios/adicionarFuncionario';
                $this->load->view('tema/conteudo', $data);
            }
        }
    }

    // Função de callback para verificar CPF único
    public function check_cpf_unique($cpf)
    {
        $funcionarioId = $this->input->post('id_funcionario'); // Pega o ID se estiver editando
        if ($this->funcionarios_model->getByCpf($cpf, $funcionarioId)) {
            $this->form_validation->set_message('check_cpf_unique', 'Este CPF já está cadastrado.');
            return false;
        }
        return true;
    }

    // Função de callback para verificar e-mail do portal único
    public function check_portal_email_unique($email)
    {
        if (empty($email)) { // Não valida se o e-mail não for preenchido
            return true;
        }
        $funcionarioId = $this->input->post('id_funcionario'); // Pega o ID se estiver editando
        if ($this->funcionarios_model->getByPortalEmail($email, $funcionarioId)) {
            $this->form_validation->set_message('check_portal_email_unique', 'Este e-mail de acesso ao portal já está em uso.');
            return false;
        }
        return true;
    }

    // Os métodos editar(), visualizar() e excluir() serão adicionados nos próximos passos.
}