<div class="widget-box">
    <div class="widget-title">
        <span class="icon">
            <i class="fas fa-users"></i>
        </span>
        <h5>Funcionários</h5>
    </div>

    <div class="widget-content nopadding">
        <div class="text-right">
            <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aFuncionario')) : ?>
                <a href="<?php echo base_url('index.php/funcionarios/adicionar'); ?>" class="btn btn-success">
                    <i class="fas fa-plus"></i> Adicionar Funcionário
                </a>
            <?php endif; ?>
        </div>

        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Nome Completo</th>
                    <th>CPF</th>
                    <th>Cargo</th>
                    <th>Celular/Telefone</th>
                    <th>Situação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!$results) {
                    echo '<tr>
                            <td colspan="7">Nenhum funcionário cadastrado.</td>
                          </tr>';
                }
                foreach ($results as $r) {
                    echo '<tr>';
                    echo '<td>' . $r->id_funcionario . '</td>';
                    echo '<td>' => $r->nome_completo . '</td>';
                    echo '<td>' => $r->cpf . '</td>';
                    echo '<td>' => $r->cargo . '</td>';
                    echo '<td>' => $r->celular_principal ?: $r->telefone_residencial . '</td>';
                    echo '<td>' => $r->situacao_funcionario . '</td>';
                    echo '<td>';

                    // Botão Visualizar (criaremos a função/view para isso depois)
                    if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vFuncionario')) {
                        // echo '<a style="margin-right: 1%" href="' . base_url() . 'index.php/funcionarios/visualizar/' . $r->id_funcionario . '" class="btn ٹپ-ٹاپ" title="Visualizar Funcionário"><i class="fas fa-eye"></i></a>';
                    }
                    // Botão Editar (criaremos a função/view para isso depois)
                    if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eFuncionario')) {
                        // echo '<a style="margin-right: 1%" href="' . base_url() . 'index.php/funcionarios/editar/' . $r->id_funcionario . '" class="btn btn-info ٹپ-ٹاپ" title="Editar Funcionário"><i class="fas fa-edit"></i></a>';
                    }
                    // Botão Excluir (criaremos a função para isso depois)
                    if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dFuncionario')) {
                        // echo '<a href="#modal-excluir" role="button" data-toggle="modal" funcionario_id="' . $r->id_funcionario . '" class="btn btn-danger ٹپ-ٹاپ" title="Excluir Funcionário"><i class="fas fa-trash-alt"></i></a>';
                    }
                    echo '</td>';
                    echo '</tr>';
                } ?>
            </tbody>
        </table>
    </div>
</div>

<?php echo $this->pagination->create_links(); ?>

<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo base_url() ?>index.php/funcionarios/excluir" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Excluir Funcionário</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" id="idFuncionarioExcluir" name="id" value="" />
            <h5 style="text-align: center">Deseja realmente excluir este funcionário e os dados associados a ele (se houver)?</h5>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            <button class="btn btn-danger">Excluir</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // Prepara o modal de exclusão para pegar o ID do funcionário
        $(document).on('click', 'a', function(event) {
            var funcionario_id = $(this).attr('funcionario_id');
            if(funcionario_id) {
                 $('#idFuncionarioExcluir').val(funcionario_id);
            }
        });

        // Configuração do DataTables (para deixar a tabela mais bonita e com busca)
        // Você pode precisar ajustar isso se o MapOS já tiver uma configuração padrão.
        // Por enquanto, vou deixar simples.
        // $('.data-table').dataTable({
        //     "bJQueryUI": true,
        //     "sPaginationType": "full_numbers",
        //     "sDom": '<""l>t<"F"fp>',
        //     "language": {
        //         "url": "<?php echo base_url('assets/js/dataTable_pt-br.json'); ?>"
        //     }
        // });
    });
</script>