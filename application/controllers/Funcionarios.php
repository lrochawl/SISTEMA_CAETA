<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Funcionarios
 *
 * Controller para gerenciar os funcionários do sistema.
 *
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Pagination $pagination
 * @property CI_URI $uri
 * @property CI_DB_query_builder $db
 * @property Permission $permission
 * @property Funcionarios_model $funcionarios_model
 * @property Usuarios_model $usuarios_model
 * @property CI_Loader $load
 */
class Funcionarios extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Carrega bibliotecas e models essenciais para este controller
        $this->load->model('Funcionarios_model', 'funcionarios_model');
        // A biblioteca 'permission' já deve ser carregada globalmente ou no MY_Controller
        // Se não, descomente a linha abaixo ou adicione ao autoload.php / MY_Controller.php
        // $this->load->library('permission');

        if (!$this->session->userdata('logado')) {
            redirect('mapos/login');
        }

        $this->data['menuFuncionarios'] = 'Funcionários'; // Para destacar o menu ativo
    }

    public function index()
    {
        $this->gerenciar();
    }

    public function gerenciar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vFuncionario')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar funcionários.');
            redirect(base_url());
        }

        $this->load->library('pagination');

        $config['base_url'] = base_url('index.php/funcionarios/gerenciar');
        $config['total_rows'] = $this->funcionarios_model->count('funcionarios');
        $config['per_page'] = $this->data['configuration']['per_page'] ?? 10;
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
        $this->data['results'] = $this->funcionarios_model->get($config['per_page'], $this->uri->segment(3));
        $this->data['view'] = 'funcionarios/funcionarios';
        return $this->layout();
    }

    public function adicionar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aFuncionario')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar funcionários.');
            redirect(base_url('index.php/funcionarios/gerenciar'));
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('nomeCompleto', 'Nome Completo', 'trim|required');
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|required|callback_check_cpf_unique');
        $this->form_validation->set_rules('dataAdmissao', 'Data de Admissão', 'trim|required|regex_match[/^\d{2}\/\d{2}\/\d{4}$/]', ['regex_match' => 'O campo %s deve estar no formato dd/mm/aaaa.']);
        $this->form_validation->set_rules('cargo', 'Cargo/Função', 'trim|required');
        $this->form_validation->set_rules('situacaoFuncionario', 'Situação do Funcionário', 'trim|required');
        $this->form_validation->set_rules('data_nascimento', 'Data de Nascimento', 'trim|regex_match[/^\d{2}\/\d{2}\/\d{4}$/]', ['regex_match' => 'O campo %s deve estar no formato dd/mm/aaaa.']);
        $this->form_validation->set_rules('validade_cnh', 'Validade CNH', 'trim|regex_match[/^\d{2}\/\d{2}\/\d{4}$/]', ['regex_match' => 'O campo %s deve estar no formato dd/mm/aaaa.']);
        $this->form_validation->set_rules('data_demissao', 'Data de Demissão', 'trim|regex_match[/^\d{2}\/\d{2}\/\d{4}$/]', ['regex_match' => 'O campo %s deve estar no formato dd/mm/aaaa.']);


        if ($this->input->post('portal_email')) {
            $this->form_validation->set_rules('portal_email', 'E-mail de Acesso ao Portal', 'trim|valid_email|is_unique[funcionarios.portal_email]');
        }
        if ($this->input->post('portal_email') && $this->input->post('portal_senha')) {
            $this->form_validation->set_rules('portal_senha', 'Senha de Acesso ao Portal', 'trim|required|min_length[6]');
        }

        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : false);
        } else {
            $dataAdmissao = $this->input->post('dataAdmissao');
            $dataNascimento = $this->input->post('data_nascimento');
            $validadeCnh = $this->input->post('validade_cnh');
            $dataDemissao = $this->input->post('data_demissao');

            $dataFuncionario = [
                'nome_completo' => $this->input->post('nomeCompleto'),
                'cpf' => preg_replace('/[^0-9]/', '', $this->input->post('cpf')),
                'rg' => $this->input->post('rg'),
                'data_nascimento' => $dataNascimento ? date_to_db($dataNascimento) : null,
                'sexo' => $this->input->post('sexo'),
                'foto_url' => $this->input->post('foto_url'),
                'possui_cnh' => $this->input->post('possui_cnh') ? 1 : 0,
                'categoria_cnh' => $this->input->post('categoria_cnh'),
                'validade_cnh' => $validadeCnh ? date_to_db($validadeCnh) : null,
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
                'data_admissao' => date_to_db($dataAdmissao),
                'data_demissao' => $dataDemissao ? date_to_db($dataDemissao) : null,
                'cargo' => $this->input->post('cargo'),
                'salario' => $this->input->post('salario') ? price_to_db($this->input->post('salario')) : null,
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
                'portal_senha' => $this->input->post('portal_senha'),
                'portal_status_acesso' => $this->input->post('portal_status_acesso') ? 1 : 0,
                'observacoes' => $this->input->post('observacoes'),
                'id_usuario_sistema' => $this->input->post('id_usuario_sistema_hidden') ?: null,
                'data_cadastro' => date('Y-m-d H:i:s'),
            ];

            if (empty($dataFuncionario['portal_email'])) {
                unset($dataFuncionario['portal_senha']);
                $dataFuncionario['portal_status_acesso'] = 0; // Garante que o status seja desativado
            } elseif (empty($dataFuncionario['portal_senha'])) {
                unset($dataFuncionario['portal_senha']); // Não salva senha vazia se o email existir
            }

            if ($this->funcionarios_model->add($dataFuncionario)) {
                $this->session->set_flashdata('success', 'Funcionário adicionado com sucesso!');
                log_info('Adicionou um funcionário: ' . $dataFuncionario['nome_completo']);
                redirect(base_url('index.php/funcionarios/gerenciar'));
            } else {
                $this->data['custom_error'] = '<div class="alert alert-danger">Ocorreu um erro ao adicionar o funcionário.</div>';
            }
        }
        $this->data['view'] = 'funcionarios/adicionarFuncionario';
        return $this->layout();
    }

    public function editar()
    {
        $idFuncionario = $this->uri->segment(3);
        if (!$idFuncionario || !is_numeric($idFuncionario)) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('funcionarios/gerenciar');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eFuncionario')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar funcionários.');
            redirect(base_url('index.php/funcionarios/gerenciar'));
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->data['result'] = $this->funcionarios_model->getById($idFuncionario);
        if ($this->data['result'] == null) {
            $this->session->set_flashdata('error', 'Funcionário não encontrado.');
            redirect(base_url('index.php/funcionarios/gerenciar'));
        }

        $this->form_validation->set_rules('nomeCompleto', 'Nome Completo', 'trim|required');
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|required|callback_check_cpf_unique[' . $idFuncionario . ']');
        $this->form_validation->set_rules('dataAdmissao', 'Data de Admissão', 'trim|required|regex_match[/^\d{2}\/\d{2}\/\d{4}$/]', ['regex_match' => 'O campo %s deve estar no formato dd/mm/aaaa.']);
        $this->form_validation->set_rules('cargo', 'Cargo/Função', 'trim|required');
        $this->form_validation->set_rules('situacaoFuncionario', 'Situação do Funcionário', 'trim|required');
        $this->form_validation->set_rules('data_nascimento', 'Data de Nascimento', 'trim|regex_match[/^\d{2}\/\d{2}\/\d{4}$/]', ['regex_match' => 'O campo %s deve estar no formato dd/mm/aaaa.']);
        $this->form_validation->set_rules('validade_cnh', 'Validade CNH', 'trim|regex_match[/^\d{2}\/\d{2}\/\d{4}$/]', ['regex_match' => 'O campo %s deve estar no formato dd/mm/aaaa.']);
        $this->form_validation->set_rules('data_demissao', 'Data de Demissão', 'trim|regex_match[/^\d{2}\/\d{2}\/\d{4}$/]', ['regex_match' => 'O campo %s deve estar no formato dd/mm/aaaa.']);

        if ($this->input->post('portal_email')) {
            $this->form_validation->set_rules('portal_email', 'E-mail de Acesso ao Portal', 'trim|valid_email|callback_check_portal_email_unique[' . $idFuncionario . ']');
        }
        if ($this->input->post('portal_email') && $this->input->post('portal_senha')) {
            $this->form_validation->set_rules('portal_senha', 'Senha de Acesso ao Portal', 'trim|min_length[6]');
        }

        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : false);
        } else {
            $dataAdmissao = $this->input->post('dataAdmissao');
            $dataNascimento = $this->input->post('data_nascimento');
            $validadeCnh = $this->input->post('validade_cnh');
            $dataDemissao = $this->input->post('data_demissao');

            $dataFuncionario = [
                'nome_completo' => $this->input->post('nomeCompleto'),
                'cpf' => preg_replace('/[^0-9]/', '', $this->input->post('cpf')),
                'rg' => $this->input->post('rg'),
                'data_nascimento' => $dataNascimento ? date_to_db($dataNascimento) : null,
                'sexo' => $this->input->post('sexo'),
                'foto_url' => $this->input->post('foto_url'),
                'possui_cnh' => $this->input->post('possui_cnh') ? 1 : 0,
                'categoria_cnh' => $this->input->post('categoria_cnh'),
                'validade_cnh' => $validadeCnh ? date_to_db($validadeCnh) : null,
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
                'data_admissao' => date_to_db($dataAdmissao),
                'data_demissao' => $dataDemissao ? date_to_db($dataDemissao) : null,
                'cargo' => $this->input->post('cargo'),
                'salario' => $this->input->post('salario') ? price_to_db($this->input->post('salario')) : null,
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
                'portal_status_acesso' => $this->input->post('portal_status_acesso') ? 1 : 0,
                'observacoes' => $this->input->post('observacoes'),
                'id_usuario_sistema' => $this->input->post('id_usuario_sistema_hidden') ?: null,
            ];

            if ($this->input->post('portal_senha')) {
                $dataFuncionario['portal_senha'] = $this->input->post('portal_senha'); // O model fará o hash
            }

            if (empty($dataFuncionario['portal_email'])) {
                $dataFuncionario['portal_senha'] = null;
                $dataFuncionario['portal_status_acesso'] = 0;
            }

            if ($this->funcionarios_model->edit($idFuncionario, $dataFuncionario)) {
                $this->session->set_flashdata('success', 'Funcionário atualizado com sucesso!');
                log_info('Editou um funcionário. ID: ' . $idFuncionario);
                redirect(base_url('index.php/funcionarios/editar/') . $idFuncionario);
            } else {
                $this->data['custom_error'] = '<div class="alert alert-danger"><p>Ocorreu um erro ao atualizar o funcionário.</p></div>';
            }
        }

        $this->data['view'] = 'funcionarios/editarFuncionario';
        return $this->layout();
    }

    public function visualizar()
    {
        $idFuncionario = $this->uri->segment(3);
        if (!$idFuncionario || !is_numeric($idFuncionario)) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('funcionarios/gerenciar');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vFuncionario')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar funcionários.');
            redirect(base_url('index.php/funcionarios/gerenciar'));
        }

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->funcionarios_model->getById($idFuncionario);

        if ($this->data['result'] == null) {
            $this->session->set_flashdata('error', 'Funcionário não encontrado.');
            redirect(base_url('index.php/funcionarios/gerenciar'));
        }

        $this->data['view'] = 'funcionarios/visualizarFuncionario';
        return $this->layout();
    }

    public function excluir()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dFuncionario')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir funcionários.');
            redirect(base_url('index.php/funcionarios/gerenciar'));
        }

        $id = $this->input->post('id');
        if ($id == null || !is_numeric($id)) {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir funcionário: ID inválido.');
            redirect(base_url('index.php/funcionarios/gerenciar'));
        }

        // Adicionar verificação para não excluir funcionário vinculado a registros importantes (se necessário)

        if ($this->funcionarios_model->delete($id)) {
            log_info('Removeu um funcionário. ID: ' . $id);
            $this->session->set_flashdata('success', 'Funcionário excluído com sucesso!');
        } else {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir o funcionário.');
        }
        redirect(base_url('index.php/funcionarios/gerenciar'));
    }

    public function check_cpf_unique($cpf, $idFuncionario = null)
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        if (empty($cpf)) { // Não validar se o CPF estiver vazio, a regra 'required' cuidará disso.
            return true;
        }
        if ($this->funcionarios_model->getByCpf($cpf, $idFuncionario)) {
            $this->form_validation->set_message('check_cpf_unique', 'Este CPF já está cadastrado para outro funcionário.');
            return false;
        }
        return true;
    }

    public function check_portal_email_unique($email, $idFuncionario = null)
    {
        if (empty($email)) {
            return true;
        }
        if ($this->funcionarios_model->getByPortalEmail($email, $idFuncionario)) {
            $this->form_validation->set_message('check_portal_email_unique', 'Este e-mail de acesso ao portal já está em uso por outro funcionário.');
            return false;
        }
        return true;
    }

    public function autoCompleteUsuario()
    {
        if (isset($_GET['term'])) {
            $q = strtolower($this->input->get('term'));
            $this->load->model('usuarios_model');
            $this->db->select('idUsuarios, nome, email');
            $this->db->like('LOWER(nome)', $q); // Usar LOWER para busca case-insensitive no banco
            $this->db->or_like('LOWER(email)', $q);
            $this->db->where('situacao', 1);
            $this->db->limit(10);
            $query = $this->db->get('usuarios');

            $result = [];
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $result[] = ['label' => $row['nome'] . ' (Email: ' . $row['email'] . ')', 'id' => $row['idUsuarios'], 'value' => $row['nome'] . ' (Email: ' . $row['email'] . ')'];
                }
            }
            echo json_encode($result);
        }
    }
}