<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="fas fa-user-plus"></i>
                </span>
                <h5>Cadastro de Funcionário</h5>
            </div>
            <div class="widget-content nopadding">
                <?php echo $custom_error; ?>
                <form action="<?php echo current_url(); ?>" id="formFuncionario" method="post" class="form-horizontal">

                    <div class="accordion" id="accordionDadosPessoais">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionDadosPessoais" href="#collapseDadosPessoais">
                                    <i class="fas fa-user"></i> Dados Pessoais e Profissionais
                                </a>
                            </div>
                            <div id="collapseDadosPessoais" class="accordion-body collapse in">
                                <div class="accordion-inner">
                                    <div class="control-group">
                                        <label for="nomeCompleto" class="control-label">Nome Completo <span class="required">*</span></label>
                                        <div class="controls">
                                            <input id="nomeCompleto" type="text" name="nomeCompleto" value="<?php echo set_value('nomeCompleto'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="cpf" class="control-label">CPF <span class="required">*</span></label>
                                        <div class="controls">
                                            <input id="cpf" type="text" name="cpf" value="<?php echo set_value('cpf'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="rg" class="control-label">RG</label>
                                        <div class="controls">
                                            <input id="rg" type="text" name="rg" value="<?php echo set_value('rg'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="data_nascimento" class="control-label">Data Nasc.</label>
                                        <div class="controls">
                                            <input id="data_nascimento" type="text" name="data_nascimento" value="<?php echo set_value('data_nascimento'); ?>" class="datepicker" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="sexo" class="control-label">Sexo</label>
                                        <div class="controls">
                                            <select name="sexo" id="sexo">
                                                <option value="">Selecione</option>
                                                <option value="Masculino" <?php echo set_select('sexo', 'Masculino'); ?>>Masculino</option>
                                                <option value="Feminino" <?php echo set_select('sexo', 'Feminino'); ?>>Feminino</option>
                                                <option value="Outro" <?php echo set_select('sexo', 'Outro'); ?>>Outro</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="foto_url" class="control-label">Link da Foto</label>
                                        <div class="controls">
                                            <input id="foto_url" type="text" name="foto_url" value="<?php echo set_value('foto_url'); ?>" />
                                            <span class="help-block">Cole o link da imagem (URL) aqui.</span>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="possui_cnh" class="control-label">Possui CNH?</label>
                                        <div class="controls">
                                            <input id="possui_cnh" type="checkbox" name="possui_cnh" value="1" <?php echo set_checkbox('possui_cnh', '1'); ?> />
                                        </div>
                                    </div>

                                    <div class="control-group cnh-fields" style="display: none;">
                                        <label for="categoria_cnh" class="control-label">Categoria CNH</label>
                                        <div class="controls">
                                            <input id="categoria_cnh" type="text" name="categoria_cnh" value="<?php echo set_value('categoria_cnh'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group cnh-fields" style="display: none;">
                                        <label for="validade_cnh" class="control-label">Validade CNH</label>
                                        <div class="controls">
                                            <input id="validade_cnh" type="text" name="validade_cnh" value="<?php echo set_value('validade_cnh'); ?>" class="datepicker" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="dataAdmissao" class="control-label">Data Admissão <span class="required">*</span></label>
                                        <div class="controls">
                                            <input id="dataAdmissao" type="text" name="dataAdmissao" value="<?php echo set_value('dataAdmissao'); ?>" class="datepicker" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="data_demissao" class="control-label">Data Demissão</label>
                                        <div class="controls">
                                            <input id="data_demissao" type="text" name="data_demissao" value="<?php echo set_value('data_demissao'); ?>" class="datepicker" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="cargo" class="control-label">Cargo/Função <span class="required">*</span></label>
                                        <div class="controls">
                                            <input id="cargo" type="text" name="cargo" value="<?php echo set_value('cargo'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="salario" class="control-label">Salário</label>
                                        <div class="controls">
                                            <input id="salario" type="text" name="salario" value="<?php echo set_value('salario'); ?>" class="money" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="horario_trabalho" class="control-label">Horário de Trabalho</label>
                                        <div class="controls">
                                            <input id="horario_trabalho" type="text" name="horario_trabalho" value="<?php echo set_value('horario_trabalho'); ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion" id="accordionMedidasPessoais">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionMedidasPessoais" href="#collapseMedidasPessoais">
                                    <i class="fas fa-ruler-horizontal"></i> Medidas Pessoais (Uniformes)
                                </a>
                            </div>
                            <div id="collapseMedidasPessoais" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <div class="control-group">
                                        <label for="tamanho_camisa" class="control-label">Tamanho da Camisa</label>
                                        <div class="controls">
                                            <input id="tamanho_camisa" type="text" name="tamanho_camisa" value="<?php echo set_value('tamanho_camisa'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="tamanho_calca" class="control-label">Tamanho da Calça</label>
                                        <div class="controls">
                                            <input id="tamanho_calca" type="text" name="tamanho_calca" value="<?php echo set_value('tamanho_calca'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="tamanho_sapato" class="control-label">Tamanho do Sapato</label>
                                        <div class="controls">
                                            <input id="tamanho_sapato" type="text" name="tamanho_sapato" value="<?php echo set_value('tamanho_sapato'); ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion" id="accordionDadosBancarios">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionDadosBancarios" href="#collapseDadosBancarios">
                                    <i class="fas fa-money-check-alt"></i> Dados Bancários e Pix
                                </a>
                            </div>
                            <div id="collapseDadosBancarios" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <div class="control-group">
                                        <label for="banco_nome" class="control-label">Banco</label>
                                        <div class="controls">
                                            <input id="banco_nome" type="text" name="banco_nome" value="<?php echo set_value('banco_nome'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="banco_codigo" class="control-label">Código do Banco</label>
                                        <div class="controls">
                                            <input id="banco_codigo" type="text" name="banco_codigo" value="<?php echo set_value('banco_codigo'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="agencia_numero" class="control-label">Agência</label>
                                        <div class="controls">
                                            <input id="agencia_numero" type="text" name="agencia_numero" value="<?php echo set_value('agencia_numero'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="agencia_dv" class="control-label">Dígito Agência</label>
                                        <div class="controls">
                                            <input id="agencia_dv" type="text" name="agencia_dv" value="<?php echo set_value('agencia_dv'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="conta_numero" class="control-label">Conta</label>
                                        <div class="controls">
                                            <input id="conta_numero" type="text" name="conta_numero" value="<?php echo set_value('conta_numero'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="conta_dv" class="control-label">Dígito Conta</label>
                                        <div class="controls">
                                            <input id="conta_dv" type="text" name="conta_dv" value="<?php echo set_value('conta_dv'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="conta_tipo" class="control-label">Tipo de Conta</label>
                                        <div class="controls">
                                            <select name="conta_tipo" id="conta_tipo">
                                                <option value="">Selecione</option>
                                                <option value="Corrente" <?php echo set_select('conta_tipo', 'Corrente'); ?>>Corrente</option>
                                                <option value="Poupanca" <?php echo set_select('conta_tipo', 'Poupanca'); ?>>Poupança</option>
                                                <option value="Salario" <?php echo set_select('conta_tipo', 'Salario'); ?>>Salário</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="pix_tipo_chave" class="control-label">Tipo Chave Pix</label>
                                        <div class="controls">
                                            <select name="pix_tipo_chave" id="pix_tipo_chave">
                                                <option value="">Selecione</option>
                                                <option value="CPF" <?php echo set_select('pix_tipo_chave', 'CPF'); ?>>CPF</option>
                                                <option value="Email" <?php echo set_select('pix_tipo_chave', 'Email'); ?>>E-mail</option>
                                                <option value="Telefone" <?php echo set_select('pix_tipo_chave', 'Telefone'); ?>>Telefone</option>
                                                <option value="Aleatoria" <?php echo set_select('pix_tipo_chave', 'Aleatoria'); ?>>Aleatória</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="pix_chave" class="control-label">Chave Pix</label>
                                        <div class="controls">
                                            <input id="pix_chave" type="text" name="pix_chave" value="<?php echo set_value('pix_chave'); ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion" id="accordionDadosContratuais">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionDadosContratuais" href="#collapseDadosContratuais">
                                    <i class="fas fa-file-contract"></i> Dados Contratuais
                                </a>
                            </div>
                            <div id="collapseDadosContratuais" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <div class="control-group">
                                        <label for="tipo_contrato" class="control-label">Tipo de Contrato</label>
                                        <div class="controls">
                                            <input id="tipo_contrato" type="text" name="tipo_contrato" value="<?php echo set_value('tipo_contrato'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="recebe_cesta_basica" class="control-label">Recebe Cesta Básica?</label>
                                        <div class="controls">
                                            <input id="recebe_cesta_basica" type="checkbox" name="recebe_cesta_basica" value="1" <?php echo set_checkbox('recebe_cesta_basica', '1'); ?> />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="transporte_info" class="control-label">Transporte</label>
                                        <div class="controls">
                                            <input id="transporte_info" type="text" name="transporte_info" value="<?php echo set_value('transporte_info'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="hospedagem_info" class="control-label">Hospedagem</label>
                                        <div class="controls">
                                            <input id="hospedagem_info" type="text" name="hospedagem_info" value="<?php echo set_value('hospedagem_info'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="sindicalizado" class="control-label">Sindicalizado?</label>
                                        <div class="controls">
                                            <input id="sindicalizado" type="checkbox" name="sindicalizado" value="1" <?php echo set_checkbox('sindicalizado', '1'); ?> />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="situacaoFuncionario" class="control-label">Situação <span class="required">*</span></label>
                                        <div class="controls">
                                            <select name="situacaoFuncionario" id="situacaoFuncionario">
                                                <option value="">Selecione</option>
                                                <option value="Ativo" <?php echo set_select('situacaoFuncionario', 'Ativo'); ?>>Ativo</option>
                                                <option value="Inativo" <?php echo set_select('situacaoFuncionario', 'Inativo'); ?>>Inativo</option>
                                                <option value="Ferias" <?php echo set_select('situacaoFuncionario', 'Ferias'); ?>>Férias</option>
                                                <option value="Licenca Medica" <?php echo set_select('situacaoFuncionario', 'Licenca Medica'); ?>>Licença Médica</option>
                                                </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion" id="accordionContato">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionContato" href="#collapseContato">
                                    <i class="fas fa-phone"></i> Contato
                                </a>
                            </div>
                            <div id="collapseContato" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <div class="control-group">
                                        <label for="telefone_residencial" class="control-label">Telefone</label>
                                        <div class="controls">
                                            <input id="telefone_residencial" type="text" name="telefone_residencial" value="<?php echo set_value('telefone_residencial'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="celular_principal" class="control-label">Celular</label>
                                        <div class="controls">
                                            <input id="celular_principal" type="text" name="celular_principal" value="<?php echo set_value('celular_principal'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="email_pessoal" class="control-label">E-mail Pessoal</label>
                                        <div class="controls">
                                            <input id="email_pessoal" type="text" name="email_pessoal" value="<?php echo set_value('email_pessoal'); ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion" id="accordionEndereco">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionEndereco" href="#collapseEndereco">
                                    <i class="fas fa-map-marker-alt"></i> Endereço
                                </a>
                            </div>
                            <div id="collapseEndereco" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <div class="control-group">
                                        <label for="cep" class="control-label">CEP</label>
                                        <div class="controls">
                                            <input id="cep" type="text" name="cep" value="<?php echo set_value('cep'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="rua" class="control-label">Rua</label>
                                        <div class="controls">
                                            <input id="rua" type="text" name="rua" value="<?php echo set_value('rua'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="numero" class="control-label">Número</label>
                                        <div class="controls">
                                            <input id="numero" type="text" name="numero" value="<?php echo set_value('numero'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="complemento" class="control-label">Complemento</label>
                                        <div class="controls">
                                            <input id="complemento" type="text" name="complemento" value="<?php echo set_value('complemento'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="bairro" class="control-label">Bairro</label>
                                        <div class="controls">
                                            <input id="bairro" type="text" name="bairro" value="<?php echo set_value('bairro'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="cidade" class="control-label">Cidade</label>
                                        <div class="controls">
                                            <input id="cidade" type="text" name="cidade" value="<?php echo set_value('cidade'); ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="estado" class="control-label">Estado</label>
                                        <div class="controls">
                                            <input id="estado" type="text" name="estado" value="<?php echo set_value('estado'); ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion" id="accordionAcessoPortal">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionAcessoPortal" href="#collapseAcessoPortal">
                                    <i class="fas fa-user-lock"></i> Dados de Acesso ao Portal "Mine"
                                </a>
                            </div>
                            <div id="collapseAcessoPortal" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <div class="control-group">
                                        <label for="portal_email" class="control-label">E-mail para Acesso ao Portal</label>
                                        <div class="controls">
                                            <input id="portal_email" type="text" name="portal_email" value="<?php echo set_value('portal_email'); ?>" />
                                            <span class="help-block">Opcional. Se preenchido, o funcionário poderá acessar o portal "Mine".</span>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="portal_senha" class="control-label">Senha para Acesso ao Portal</label>
                                        <div class="controls">
                                            <input id="portal_senha" type="password" name="portal_senha" value="" />
                                            <span class="help-block">Mínimo de 6 caracteres. Deixe em branco para não alterar a senha.</span>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="portal_status_acesso" class="control-label">Acesso ao Portal Ativo?</label>
                                        <div class="controls">
                                            <input id="portal_status_acesso" type="checkbox" name="portal_status_acesso" value="1" <?php echo set_checkbox('portal_status_acesso', '1'); ?> />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="id_usuario_sistema" class="control-label">Usuário do Sistema MapOS (Opcional)</label>
                                        <div class="controls">
                                            <input id="id_usuario_sistema" class="span12" type="text" name="id_usuario_sistema" value="" placeholder="Pesquise e selecione um usuário do sistema" />
                                            <input id="usuarios_id" class="span12" type="hidden" name="id_usuario_sistema" value="<?php echo set_value('id_usuario_sistema'); ?>" />
                                            <span class="help-block">Vincule este funcionário a um usuário existente do sistema MapOS, se ele for um administrador ou outro tipo de usuário.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion" id="accordionOutros">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionOutros" href="#collapseOutros">
                                    <i class="fas fa-sticky-note"></i> Outras Informações
                                </a>
                            </div>
                            <div id="collapseOutros" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <div class="control-group">
                                        <label for="observacoes" class="control-label">Observações</label>
                                        <div class="controls">
                                            <textarea class="span12" name="observacoes" id="observacoes" cols="30" rows="5"><?php echo set_value('observacoes'); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Adicionar</button>
                                <a href="<?php echo base_url('index.php/funcionarios/gerenciar'); ?>" class="btn">
                                    <i class="fas fa-undo-alt"></i> Voltar
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/js/jquery.validate.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/maskmoney.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Máscaras de input
        $('#cpf').mask('000.000.000-00');
        $('#telefone_residencial').mask('(00) 0000-0000');
        $('#celular_principal').mask('(00) 00000-0000');
        $('#cep').mask('00000-000');
        $('.money').maskMoney({
            decimal: ',',
            thousands: '.',
            allowZero: true
        });
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true
        });

        // Lógica para mostrar/esconder campos da CNH
        function toggleCnhFields() {
            if ($('#possui_cnh').is(':checked')) {
                $('.cnh-fields').show();
            } else {
                $('.cnh-fields').hide();
            }
        }
        toggleCnhFields(); // Executa na carga da página
        $('#possui_cnh').change(toggleCnhFields); // Executa ao mudar o checkbox

        // Validação do Formulário
        $('#formFuncionario').validate({
            rules: {
                nomeCompleto: {
                    required: true
                },
                cpf: {
                    required: true,
                    remote: { // Validação remota para CPF único
                        url: "<?php echo base_url('index.php/funcionarios/check_cpf_unique'); ?>",
                        type: "post",
                        data: {
                            cpf: function() {
                                return $("#cpf").val();
                            },
                            id_funcionario: function() {
                                return null; // Será usado na edição, aqui é nulo
                            }
                        }
                    }
                },
                dataAdmissao: {
                    required: true
                },
                cargo: {
                    required: true
                },
                situacaoFuncionario: {
                    required: true
                },
                portal_email: {
                    email: true,
                    remote: { // Validação remota para E-mail do portal único
                        url: "<?php echo base_url('index.php/funcionarios/check_portal_email_unique'); ?>",
                        type: "post",
                        data: {
                            portal_email: function() {
                                return $("#portal_email").val();
                            },
                            id_funcionario: function() {
                                return null; // Será usado na edição, aqui é nulo
                            }
                        }
                    }
                },
                 portal_senha: {
                    minlength: 6,
                    required: function(element) {
                        return $("#portal_email").val().length > 0; // Torna obrigatório se o e-mail do portal for preenchido
                    }
                }
            },
            messages: {
                nomeCompleto: {
                    required: 'Campo Requerido.'
                },
                cpf: {
                    required: 'Campo Requerido.',
                    remote: 'Este CPF já está cadastrado.'
                },
                dataAdmissao: {
                    required: 'Campo Requerido.'
                },
                cargo: {
                    required: 'Campo Requerido.'
                },
                situacaoFuncionario: {
                    required: 'Campo Requerido.'
                },
                portal_email: {
                    email: 'Por favor, insira um e-mail válido.',
                    remote: 'Este e-mail de acesso ao portal já está em uso.'
                },
                portal_senha: {
                    required: 'Campo Requerido se o e-mail do portal for preenchido.',
                    minlength: 'A senha deve ter no mínimo 6 caracteres.'
                }
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });

        // Autocomplete para vincular usuário do sistema (igual ao que já existe no MapOS)
        // Isso assume que já existe um endpoint para buscar usuários, como em Mapos/pesquisa.
        $("#id_usuario_sistema").autocomplete({
            source: "<?php echo base_url(); ?>index.php/funcionarios/autoCompleteUsuario", // Criaremos essa função no Controller
            minLength: 2,
            select: function(event, ui) {
                $("#id_usuario_sistema").val(ui.item.label);
                $("#usuarios_id").val(ui.item.id);
            }
        });
    });
</script>