<!-- Page Content -->
<div class="container">

    <div class="row">

        <!--Mais a esquerda da página-->
        <div class="col-md-8">

            <h1 class="page-header">
                D&D On Flow
            </h1>
           
            <div class="col-md-12">
                <h3 class="lead">
                    Aqui tem que ter uma imagem, o link está abaixo desta linha
                </h3>

                <!-- <img class="img-responsive" src="<?php echo base_url('assets/img/d20.jpg'); ?>" alt="imagem d20"> -->
                
                <p align="justify">
                    Ao contrário do que se acredita, Lorem Ipsum não é simplesmente um texto randômico. Com mais de 2000 anos, suas raízes podem ser encontradas em uma obra de literatura latina clássica datada de 45 AC. Richard McClintock, um professor de latim do Hampden-Sydney College na Virginia, pesquisou uma das mais obscuras palavras em latim, consectetur, oriunda de uma passagem de Lorem Ipsum, e, procurando por entre citações da palavra na literatura clássica, descobriu a sua indubitável origem. Lorem Ipsum vem das seções 1.10.32 e 1.10.33 do "de Finibus Bonorum et Malorum" (Os Extremos do Bem e do Mal), de Cícero, escrito em 45 AC. Este livro é um tratado de teoria da ética muito popular na época da Renascença. A primeira linha de Lorem Ipsum, "Lorem Ipsum dolor sit amet..." vem de uma linha na seção 1.10.32.
                </p>
            </div>
            <!-- hr é usada para separar contextos-->
            <hr>
        </div>

        <!--Mais a direita da página-->
        <div class="col-md-4">

            <h1 class="page-header">
                Iniciar sessão
            </h1>

            <div>
                <h3 class="lead">
                    A Jornada Nunca Acaba
                </h3>
                <!--Cria o formulário de login-->
                <!--txt-email e txt-senha são os valores que serão enviados ao BD na autenticação-->
            </div>

            <div class="form-group">
                <form action="<?php echo base_url('usuarios'); ?>" method="post">
                    <fieldset>
                    <p>
                        <label id="txt-email" > E-mail: </label> <br>
                        <input class="form-control" type="text" id="txt-email" name="txt-email" placeholder="Digite seu e-mail" />
                    </p>

                    <p>
                        <label id="txt-senha"> Senha: </label> <br>
                        <input class="form-control" type="password" id="txt-senha" name="txt-senha" placeholder="Digite sua senha" />
                    </p>
                    
                    <p>
                        <button class="btn btn-default" type="submit">
                            Continuar História
                        </button> <br />
                    </p>
                    </fieldset>
                </form>
            </div>

            <div>
                <!-- Ativa o modal via botão-->
                <button class="btn btn-default" type="button"  data-toggle="modal" data-target="#myModal">
                    Entrar Para a História
                </button>

                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Torne-se Uma Lenda Neste Mundo!</h4>
                        </div>

                        <div class="modal-body">
                            <form action="<?php echo base_url('Users_Controller/cadastrarUsuario'); ?>" method="get">
                            <p>
                                <label id="txt-nome"> Nome Completo: </label> <br>
                                <input class="form-control" type="text" id="txt-nome" name="txt-nome" placeholder="Digite um nome"/>
                            </p>

                            <p>
                                <label id="txt-email" > E-mail: </label> <br>
                                <input class="form-control" type="text" id="txt-email" name="txt-email" placeholder="Digite um e-mail"/>
                            </p>

                            <p>
                                <label id="txt-senha"> Senha: </label> <br>
                                <input class="form-control" type="password" id="txt-senha" name="txt-senha" placeholder="Digite uma senha"/>
                            </p>

                            <p>
                                <button class="btn btn-default" type="submit" value="Registrar" name="btm_enviar" >
                                    Iniciar História
                                </button><br />
                            </p>
                        </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- Fim Modal COntent -->
                </div>
            </div>           
        </div>
    </div>
</div>
<!--aside.php