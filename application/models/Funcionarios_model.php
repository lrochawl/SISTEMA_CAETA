<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Funcionarios_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Carrega o banco de dados
    }

    /**
     * Adiciona um novo funcionário ao banco de dados
     * @param array $data Dados do funcionário
     * @return int|boolean ID do funcionário inserido ou false em caso de falha
     */
    public function add($data)
    {
        // Prepara os dados antes de inserir
        if (isset($data['portal_senha']) && !empty($data['portal_senha'])) {
            $data['portal_senha'] = password_hash($data['portal_senha'], PASSWORD_DEFAULT);
        } else {
            // Remove o campo se a senha estiver vazia para não dar erro no DB se for null
            unset($data['portal_senha']);
        }

        // Garante que a data de cadastro seja preenchida
        if (empty($data['data_cadastro'])) {
            $data['data_cadastro'] = date('Y-m-d');
        }

        $this->db->insert('funcionarios', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return false;
    }

    /**
     * Retorna todos os funcionários com opção de paginação e busca
     * @param int $perpage Quantidade por página
     * @param int $start Início da busca para paginação
     * @param string $where Condição de busca (opcional)
     * @return array Lista de funcionários
     */
    public function get($perpage = 0, $start = 0, $where = '')
    {
        $this->db->select('funcionarios.*, usuarios.nome as nome_usuario_sistema'); // Pega o nome do usuário do sistema se houver
        $this->db->from('funcionarios');
        $this->db->join('usuarios', 'funcionarios.id_usuario_sistema = usuarios.idUsuarios', 'left'); // JOIN para pegar nome do usuário
        $this->db->order_by('nome_completo', 'ASC');

        if ($where) {
            $this->db->where($where);
        }
        if ($perpage != 0) {
            $this->db->limit($perpage, $start);
        }
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Retorna um funcionário específico pelo ID
     * @param int $id ID do funcionário
     * @return object|null Objeto do funcionário ou null se não encontrar
     */
    public function getById($id)
    {
        $this->db->select('funcionarios.*, usuarios.nome as nome_usuario_sistema');
        $this->db->from('funcionarios');
        $this->db->join('usuarios', 'funcionarios.id_usuario_sistema = usuarios.idUsuarios', 'left');
        $this->db->where('id_funcionario', $id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    /**
     * Edita os dados de um funcionário
     * @param int $id ID do funcionário
     * @param array $data Dados a serem atualizados
     * @return boolean True se sucesso, false se falha
     */
    public function edit($id, $data)
    {
        // Se uma nova senha para o portal foi fornecida, criptografa
        if (isset($data['portal_senha']) && !empty($data['portal_senha'])) {
            $data['portal_senha'] = password_hash($data['portal_senha'], PASSWORD_DEFAULT);
        } elseif (isset($data['portal_senha']) && empty($data['portal_senha'])) {
            // Se o campo senha foi enviado vazio, não atualiza a senha
            unset($data['portal_senha']);
        }

        $this->db->where('id_funcionario', $id);
        if ($this->db->update('funcionarios', $data)) {
            return true;
        }
        return false;
    }

    /**
     * Deleta um funcionário
     * @param int $id ID do funcionário
     * @return boolean True se sucesso, false se falha
     */
    public function delete($id)
    {
        $this->db->where('id_funcionario', $id);
        if ($this->db->delete('funcionarios')) {
            return true;
        }
        return false;
    }

    /**
     * Conta o total de funcionários
     * @param string $where Condição de busca (opcional)
     * @return int Total de funcionários
     */
    public function count($where = '')
    {
        $this->db->from('funcionarios');
        if ($where) {
            $this->db->where($where);
        }
        return $this->db->count_all_results();
    }

    /**
     * Busca funcionário pelo CPF (útil para evitar duplicidade)
     * @param string $cpf
     * @param int $exceptId ID do funcionário a ser ignorado na busca (útil na edição)
     * @return object|null
     */
    public function getByCpf($cpf, $exceptId = null)
    {
        $this->db->where('cpf', $cpf);
        if ($exceptId) {
            $this->db->where('id_funcionario !=', $exceptId);
        }
        $this->db->limit(1);
        return $this->db->get('funcionarios')->row();
    }

    /**
     * Busca funcionário pelo email do portal (útil para evitar duplicidade)
     * @param string $email
     * @param int $exceptId ID do funcionário a ser ignorado na busca (útil na edição)
     * @return object|null
     */
    public function getByPortalEmail($email, $exceptId = null)
    {
        $this->db->where('portal_email', $email);
        if ($exceptId) {
            $this->db->where('id_funcionario !=', $exceptId);
        }
        $this->db->limit(1);
        return $this->db->get('funcionarios')->row();
    }
}