<div class="widget-box">
    <div class="widget-title" style="margin: -20px 0 0">
        <span class="icon">
            <i class="fas fa-user"></i>
        </span>
        <h5>Detalhes do Funcionário</h5>
    </div>
    <div class="widget-content tab-content">
        <div class="accordion" id="collapse-group-view">
            <div class="accordion-group widget-box">
                <div class="accordion-heading">
                    <div class="widget-title">
                        <a data-parent="#collapse-group-view" href="#collapseGOneView" data-toggle="collapse">
                            <span><i class='bx bx-user icon-cli'></i></span>
                            <h5 style="padding-left: 28px">Dados Pessoais e Profissionais</h5>
                        </a>
                    </div>
                </div>
                <div class="collapse in accordion-body" id="collapseGOneView">
                    <div class="widget-content">
                        <table class="table table-bordered">
                            <tbody>
                                <tr><td style="text-align: right; width: 30%"><strong>Nome Completo:</strong></td><td><?php echo htmlspecialchars($result->nome_completo); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>CPF:</strong></td><td><?php echo htmlspecialchars($result->cpf); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>RG:</strong></td><td><?php echo htmlspecialchars($result->rg); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Data de Nascimento:</strong></td><td><?php echo $result->data_nascimento ? date('d/m/Y', strtotime($result->data_nascimento)) : ''; ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Sexo:</strong></td><td><?php echo htmlspecialchars($result->sexo); ?></td></tr>
                                <?php if ($result->foto_url): ?>
                                <tr><td style="text-align: right;"><strong>Foto:</strong></td><td><img src="<?php echo htmlspecialchars($result->foto_url); ?>" alt="Foto do Funcionário" style="max-width: 150px; max-height: 150px;"></td></tr>
                                <?php endif; ?>
                                <tr><td style="text-align: right;"><strong>Possui CNH:</strong></td><td><?php echo $result->possui_cnh ? 'Sim' : 'Não'; ?></td></tr>
                                <?php if($result->possui_cnh): ?>
                                <tr><td style="text-align: right;"><strong>Categoria CNH:</strong></td><td><?php echo htmlspecialchars($result->categoria_cnh); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Validade CNH:</strong></td><td><?php echo $result->validade_cnh ? date('d/m/Y', strtotime($result->validade_cnh)) : ''; ?></td></tr>
                                <?php endif; ?>
                                <tr><td style="text-align: right;"><strong>Data de Admissão:</strong></td><td><?php echo date('d/m/Y', strtotime($result->data_admissao)); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Data de Demissão:</strong></td><td><?php echo $result->data_demissao ? date('d/m/Y', strtotime($result->data_demissao)) : 'Não demitido'; ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Cargo/Função:</strong></td><td><?php echo htmlspecialchars($result->cargo); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Salário:</strong></td><td>R$ <?php echo number_format($result->salario, 2, ',', '.'); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Horário de Trabalho:</strong></td><td><?php echo htmlspecialchars($result->horario_trabalho); ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="accordion-group widget-box">
                <div class="accordion-heading">
                    <div class="widget-title">
                        <a data-parent="#collapse-group-view" href="#collapseGTwoView" data-toggle="collapse">
                            <span><i class="fas fa-ruler-horizontal icon-cli"></i></span>
                            <h5 style="padding-left: 28px">Medidas Pessoais (Uniformes)</h5>
                        </a>
                    </div>
                </div>
                <div class="collapse accordion-body" id="collapseGTwoView">
                    <div class="widget-content">
                        <table class="table table-bordered">
                            <tbody>
                                <tr><td style="text-align: right; width: 30%"><strong>Camisa:</strong></td><td><?php echo htmlspecialchars($result->tamanho_camisa); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Calça:</strong></td><td><?php echo htmlspecialchars($result->tamanho_calca); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Sapato:</strong></td><td><?php echo htmlspecialchars($result->tamanho_sapato); ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="accordion-group widget-box">
                <div class="accordion-heading">
                    <div class="widget-title">
                        <a data-parent="#collapse-group-view" href="#collapseGThreeView" data-toggle="collapse">
                           <span> <i class="fas fa-money-check-alt icon-cli"></i></span>
                            <h5 style="padding-left: 28px">Dados Bancários e Pix</h5>
                        </a>
                    </div>
                </div>
                <div class="collapse accordion-body" id="collapseGThreeView">
                    <div class="widget-content">
                        <table class="table table-bordered">
                            <tbody>
                                <tr><td style="text-align: right; width: 30%"><strong>Banco:</strong></td><td><?php echo htmlspecialchars($result->banco_nome); ?> (Cód: <?php echo htmlspecialchars($result->banco_codigo); ?>)</td></tr>
                                <tr><td style="text-align: right;"><strong>Agência:</strong></td><td><?php echo htmlspecialchars($result->agencia_numero . ($result->agencia_dv ? '-' . $result->agencia_dv : '')); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Conta:</strong></td><td><?php echo htmlspecialchars($result->conta_numero . ($result->conta_dv ? '-' . $result->conta_dv : '')); ?> (<?php echo htmlspecialchars($result->conta_tipo); ?>)</td></tr>
                                <tr><td style="text-align: right;"><strong>Chave Pix:</strong></td><td>(<?php echo htmlspecialchars($result->pix_tipo_chave); ?>) <?php echo htmlspecialchars($result->pix_chave); ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

             <div class="accordion-group widget-box">
                <div class="accordion-heading">
                    <div class="widget-title">
                        <a data-parent="#collapse-group-view" href="#collapseGFourView" data-toggle="collapse">
                            <span><i class="fas fa-file-contract icon-cli"></i></span>
                             <h5 style="padding-left: 28px">Dados Contratuais</h5>
                        </a>
                    </div>
                </div>
                <div class="collapse accordion-body" id="collapseGFourView">
                    <div class="widget-content">
                        <table class="table table-bordered">
                            <tbody>
                                <tr><td style="text-align: right; width: 30%"><strong>Tipo de Contrato:</strong></td><td><?php echo htmlspecialchars($result->tipo_contrato); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Recebe Cesta Básica:</strong></td><td><?php echo $result->recebe_cesta_basica ? 'Sim' : 'Não'; ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Transporte:</strong></td><td><?php echo htmlspecialchars($result->transporte_info); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Hospedagem:</strong></td><td><?php echo htmlspecialchars($result->hospedagem_info); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Sindicalizado:</strong></td><td><?php echo $result->sindicalizado ? 'Sim' : 'Não'; ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Situação do Funcionário:</strong></td><td><span class="badge" style="background-color: <?php echo $result->situacao_funcionario == 'Ativo' ? '#5bb75b' : '#f89406'; ?>;"><?php echo htmlspecialchars($result->situacao_funcionario); ?></span></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="accordion-group widget-box">
                <div class="accordion-heading">
                    <div class="widget-title">
                        <a data-parent="#collapse-group-view" href="#collapseGFiveView" data-toggle="collapse">
                            <span><i class="fas fa-phone icon-cli"></i></span>
                            <h5 style="padding-left: 28px">Contato</h5>
                        </a>
                    </div>
                </div>
                <div class="collapse accordion-body" id="collapseGFiveView">
                    <div class="widget-content">
                        <table class="table table-bordered">
                            <tbody>
                                <tr><td style="text-align: right; width: 30%"><strong>Telefone Residencial:</strong></td><td><?php echo htmlspecialchars($result->telefone_residencial); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Celular Principal:</strong></td><td><?php echo htmlspecialchars($result->celular_principal); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>E-mail Pessoal:</strong></td><td><?php echo htmlspecialchars($result->email_pessoal); ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="accordion-group widget-box">
                <div class="accordion-heading">
                    <div class="widget-title">
                        <a data-parent="#collapse-group-view" href="#collapseGSixView" data-toggle="collapse">
                            <span><i class="fas fa-map-marker-alt icon-cli"></i></span>
                            <h5 style="padding-left: 28px">Endereço</h5>
                        </a>
                    </div>
                </div>
                <div class="collapse accordion-body" id="collapseGSixView">
                    <div class="widget-content">
                        <table class="table table-bordered">
                            <tbody>
                                <tr><td style="text-align: right; width: 30%"><strong>CEP:</strong></td><td><?php echo htmlspecialchars($result->cep); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Rua:</strong></td><td><?php echo htmlspecialchars($result->rua); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Número:</strong></td><td><?php echo htmlspecialchars($result->numero); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Complemento:</strong></td><td><?php echo htmlspecialchars($result->complemento); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Bairro:</strong></td><td><?php echo htmlspecialchars($result->bairro); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Cidade:</strong></td><td><?php echo htmlspecialchars($result->cidade); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Estado:</strong></td><td><?php echo htmlspecialchars($result->estado); ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

             <div class="accordion-group widget-box">
                <div class="accordion-heading">
                    <div class="widget-title">
                        <a data-parent="#collapse-group-view" href="#collapseGSevenView" data-toggle="collapse">
                            <span><i class="fas fa-user-lock icon-cli"></i></span>
                            <h5 style="padding-left: 28px">Acesso ao Portal "Mine"</h5>
                        </a>
                    </div>
                </div>
                <div class="collapse accordion-body" id="collapseGSevenView">
                    <div class="widget-content">
                        <table class="table table-bordered">
                            <tbody>
                                <tr><td style="text-align: right; width: 30%"><strong>E-mail do Portal:</strong></td><td><?php echo htmlspecialchars($result->portal_email); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Status do Acesso:</strong></td><td><?php echo $result->portal_status_acesso ? 'Ativo' : 'Inativo'; ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Usuário do Sistema Vinculado:</strong></td><td><?php echo htmlspecialchars($result->nome_usuario_sistema ?: 'Nenhum'); ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

             <div class="accordion-group widget-box">
                <div class="accordion-heading">
                    <div class="widget-title">
                        <a data-parent="#collapse-group-view" href="#collapseGEightView" data-toggle="collapse">
                            <span><i class="fas fa-sticky-note icon-cli"></i></span>
                            <h5 style="padding-left: 28px">Outras Informações</h5>
                        </a>
                    </div>
                </div>
                <div class="collapse accordion-body" id="collapseGEightView">
                    <div class="widget-content">
                        <table class="table table-bordered">
                            <tbody>
                                <tr><td style="text-align: right; width: 30%"><strong>Observações:</strong></td><td><?php echo nl2br(htmlspecialchars($result->observacoes)); ?></td></tr>
                                <tr><td style="text-align: right;"><strong>Data de Cadastro:</strong></td><td><?php echo date('d/m/Y', strtotime($result->data_cadastro)); ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <div class="span12">
                <div class="span6 offset3" style="display:flex;justify-content:center">
                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eFuncionario')) : ?>
                        <a href="<?php echo base_url(); ?>index.php/funcionarios/editar/<?php echo $result->id_funcionario; ?>" class="button btn btn-primary">
                            <span class="button__icon"><i class="bx bx-edit"></i></span><span class="button__text2">Editar</span>
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo base_url() ?>index.php/funcionarios/gerenciar" class="button btn btn-warning">
                        <span class="button__icon"><i class="bx bx-undo"></i></span> <span class="button__text2">Voltar</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>