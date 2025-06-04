<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_funcionarios_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id_funcionario' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
                'primary' => true,
            ],
            'nome_completo' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'cpf' => [
                'type' => 'VARCHAR',
                'constraint' => '20', // Aumentado para acomodar máscara se necessário
                'null' => false,
                'unique' => true,
            ],
            'rg' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'data_nascimento' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'sexo' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'foto_url' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'possui_cnh' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => true,
            ],
            'categoria_cnh' => [
                'type' => 'VARCHAR',
                'constraint' => '5',
                'null' => true,
            ],
            'validade_cnh' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'telefone_residencial' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'celular_principal' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'email_pessoal' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'cep' => [
                'type' => 'VARCHAR',
                'constraint' => '10', // Aumentado para máscara
                'null' => true,
            ],
            'rua' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'numero' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
            ],
            'complemento' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'bairro' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'cidade' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'estado' => [
                'type' => 'VARCHAR',
                'constraint' => '2',
                'null' => true,
            ],
            'data_admissao' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'data_demissao' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'cargo' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'salario' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'horario_trabalho' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'tipo_contrato' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'recebe_cesta_basica' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => true,
            ],
            'transporte_info' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'hospedagem_info' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'sindicalizado' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => true,
            ],
            'situacao_funcionario' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'default' => 'Ativo',
                'null' => false,
            ],
            'tamanho_camisa' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => true,
            ],
            'tamanho_calca' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => true,
            ],
            'tamanho_sapato' => [
                'type' => 'VARCHAR',
                'constraint' => '10', // Ajustado para consistência
                'null' => true,
            ],
            'banco_nome' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'banco_codigo' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => true,
            ],
            'agencia_numero' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'agencia_dv' => [
                'type' => 'VARCHAR',
                'constraint' => '2',
                'null' => true,
            ],
            'conta_numero' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'conta_dv' => [
                'type' => 'VARCHAR',
                'constraint' => '2',
                'null' => true,
            ],
            'conta_tipo' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'pix_tipo_chave' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'pix_chave' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'portal_email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
                'unique' => true,
            ],
            'portal_senha' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'portal_status_acesso' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => true,
            ],
            'portal_token_reset' => [
                'type' => 'VARCHAR',
                'constraint' => '64',
                'null' => true,
            ],
            'portal_expiracao_token' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'observacoes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'data_cadastro' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'id_usuario_sistema' => [ // Chave estrangeira para a tabela de usuários do sistema
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
        ]);
        $this->dbforge->add_key('id_funcionario', true); // Define id_funcionario como chave primária
        $this->dbforge->create_table('funcionarios');

        // Adicionar chave estrangeira para id_usuario_sistema referenciando usuarios(idUsuarios)
        // Verifique se o nome da tabela 'usuarios' e da coluna 'idUsuarios' está correto
        // A constraint ON DELETE SET NULL fará com que, se o usuário for deletado,
        // o campo id_usuario_sistema em funcionarios se torne NULL.
        // Pode ser ON DELETE RESTRICT se você não quiser que o usuário seja deletado se estiver ligado a um funcionário.
        // Ou ON DELETE CASCADE se ao deletar o usuário, o funcionário também deva ser deletado (geralmente não é o desejado).
        $this->db->query('ALTER TABLE `funcionarios` ADD CONSTRAINT `fk_funcionarios_usuarios` FOREIGN KEY (`id_usuario_sistema`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE SET NULL ON UPDATE CASCADE;');
    }

    public function down()
    {
        // Primeiro remove a chave estrangeira se ela existir
        // É importante tratar o erro caso a constraint não exista, ou verificar antes.
        // Para simplificar, assumimos que ela existe se a tabela existir.
        // O nome da constraint deve ser o mesmo definido no 'up'.
        $this->db->query('ALTER TABLE `funcionarios` DROP FOREIGN KEY `fk_funcionarios_usuarios`;');
        $this->dbforge->drop_table('funcionarios');
    }
}