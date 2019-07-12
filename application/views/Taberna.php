<!--header.php-->
<!-- Page Content -->
<div class="container">

    <div class="row">
                
        <div class="col-md-4">

            <h2 class="page-header">
                Taberna
            </h2>
            <h2 class=class="lead">
                Aventureiros
            </h2>
            <p>
                "Montar Lista de pessoas logadas".
            </p>
        </div>

        <div class="col-md-8">

            <h2 class="page-header">
                Mesa de conversa
            </h2>
           
            <div class="col-md-12">
                <!--Ao enviar os dados do formulário, redireciona para a mesma pagina-->
                <form action="<?php echo base_url('masmorra') ?>" method="post" >

                    <!--Aqui deve ser feito um select no BD ou guardar sempre o conteúdo de uma conversa.-->
                    <!--Talvez usar uma string para ficar pegando as frases digitadas ou coisa do tipo.-->
                    <fieldset>
                        <textarea class="form-control" type="textarea" id="txt-historico" readonly="Readonly" rows="14" cols="90"></textarea> <br />
                    </fieldset>

                    <fieldset>
                        <legend> Conte sua história </legend>
                        <textarea class="form-control" type="textarea" id="txt-frase" name="txt-frase" rows="1" cols="90" placeholder="Conte sua história..." ></textarea> <br />
                        <button class="btn btn-default" type="submit">
                            Enviar
                        </button>
                    </fieldset>
                </form>
            </div>
            
        </div>
    </div>
</div>
        <!--aside.php-->