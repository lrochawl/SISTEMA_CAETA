<div class="new122"> <div class="widget-title" style="margin: -20px 0 0">
        <span class="icon">
            <i class="fas fa-id-badge"></i> </span>
        <h5>Funcionários</h5>
    </div>

    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aFuncionario')) : ?>
    <a href="<?php echo base_url('index.php/funcionarios/adicionar'); ?>" class="button btn btn-mini btn-success" style="max-width: 180px">
        <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">Novo Funcionário</span>
    </a>
    <?php endif; ?>

    <div class="widget-box">
        <h5 style="padding: 3px 0"></h5> <div class="widget-content nopadding tab-content">
            <table id="tabela" class="table table-bordered "> <thead>
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
                        echo '<td>' . htmlspecialchars($r->nome_completo) . '</td>';
                        echo '<td>' . htmlspecialchars($r->cpf) . '</td>';
                        echo '<td>' . htmlspecialchars($r->cargo) . '</td>';
                        echo '<td>' . htmlspecialchars($r->celular_principal ?: $r->telefone_residencial) . '</td>';

                        $situacaoClasse = '';
                        if ($r->situacao_funcionario == 'Ativo') $situacaoClasse = 'label-success';
                        else if ($r->situacao_funcionario == 'Inativo') $situacaoClasse = 'label-important';
                        else if ($r->situacao_funcionario == 'Férias') $situacaoClasse = 'label-info';
                        else if ($r->situacao_funcionario == 'Licenca Medica') $situacaoClasse = 'label-warning';
                        echo '<td><span class="label ' . $situacaoClasse . '">' . htmlspecialchars($r->situacao_funcionario) . '</span></td>';

                        echo '<td>';

                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vFuncionario')) {
                            echo '<a style="margin-right: 1%" href="' . base_url() . 'index.php/funcionarios/visualizar/' . $r->id_funcionario . '" class="btn-nwe" title="Visualizar Funcionário"><i class="bx bx-show bx-xs"></i></a>';
                        }
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eFuncionario')) {
                            echo '<a style="margin-right: 1%" href="' . base_url() . 'index.php/funcionarios/editar/' . $r->id_funcionario . '" class="btn-nwe3" title="Editar Funcionário"><i class="bx bx-edit bx-xs"></i></a>';
                        }
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dFuncionario')) {
                            echo '<a href="#modal-excluir" role="button" data-toggle="modal" funcionario_id="' . $r->id_funcionario . '" class="btn-nwe4" title="Excluir Funcionário"><i class="bx bx-trash-alt bx-xs"></i></a>';
                        }
                        echo '</td>';
                        echo '</tr>';
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php if(isset($this->pagination)) { echo $this->pagination->create_links(); } ?> <div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo base_url() ?>index.php/funcionarios/excluir" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Excluir Funcionário</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" id="idFuncionarioExcluir" name="id" value="" />
            <h5 style="text-align: center">Deseja realmente excluir este funcionário?</h5>
        </div>
        <div class="modal-footer" style="display:flex;justify-content: center">
            <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
            <button class="button btn btn-danger"><span class="button__icon"><i class='bx bx-trash'></i></span> <span class="button__text2">Excluir</span></button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', 'a', function(event) {
            var funcionario_id = $(this).attr('funcionario_id');
            if(funcionario_id) {
                 $('#idFuncionarioExcluir').val(funcionario_id);
            }
        });
    });
</script>