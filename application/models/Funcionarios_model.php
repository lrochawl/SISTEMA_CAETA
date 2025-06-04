<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Funcionarios_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add($data)
    {
        if (isset($data['portal_senha']) && !empty($data['portal_senha'])) {
            $data['portal_senha'] = password_hash($data['portal_senha'], PASSWORD_DEFAULT);
        } else {
            unset($data['portal_senha']);
        }

        if (empty($data['data_cadastro'])) {
            $data['data_cadastro'] = date('Y-m-d');
        }

        // Certifique-se de que id_usuario_sistema seja NULL se vazio
        if (isset($data['id_usuario_sistema']) && empty($data['id_usuario_sistema'])) {
            $data['id_usuario_sistema'] = null;
        }


        $this->db->insert('funcionarios', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function get($perpage = 0, $start = 0, $where = '')
    {
        $this->db->select('funcionarios.*, usuarios.nome as nome_usuario_sistema');
        $this->db->from('funcionarios');
        $this->db->join('usuarios', 'funcionarios.id_usuario_sistema = usuarios.idUsuarios', 'left');
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

    public function getById($id)
    {
        $this->db->select('funcionarios.*, usuarios.nome as nome_usuario_sistema');
        $this->db->from('funcionarios');
        $this->db->join('usuarios', 'funcionarios.id_usuario_sistema = usuarios.idUsuarios', 'left');
        $this->db->where('id_funcionario', $id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function edit($id, $data)
    {
        if (isset($data['portal_senha']) && !empty($data['portal_senha'])) {
            $data['portal_senha'] = password_hash($data['portal_senha'], PASSWORD_DEFAULT);
        } elseif (isset($data['portal_senha']) && empty($data['portal_senha'])) {
            unset($data['portal_senha']);
        }

        // Certifique-se de que id_usuario_sistema seja NULL se vazio
        if (isset($data['id_usuario_sistema']) && empty($data['id_usuario_sistema'])) {
            $data['id_usuario_sistema'] = null;
        }

        $this->db->where('id_funcionario', $id);
        if ($this->db->update('funcionarios', $data)) {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $this->db->where('id_funcionario', $id);
        if ($this->db->delete('funcionarios')) {
            return true;
        }
        return false;
    }

    public function count($table, $where = '') // Adicionado $where para consistência, mesmo que não usado aqui.
    {
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        return $this->db->count_all_results();
    }


    public function getByCpf($cpf, $exceptId = null)
    {
        $this->db->where('cpf', $cpf);
        if ($exceptId) {
            $this->db->where('id_funcionario !=', $exceptId);
        }
        $this->db->limit(1);
        return $this->db->get('funcionarios')->row();
    }

    public function getByPortalEmail($email, $exceptId = null)
    {
        if(empty($email)) { // Se o email for vazio, não há o que buscar.
            return null;
        }
        $this->db->where('portal_email', $email);
        if ($exceptId) {
            $this->db->where('id_funcionario !=', $exceptId);
        }
        $this->db->limit(1);
        return $this->db->get('funcionarios')->row();
    }
}