<!--header.php-->
<!-- Page Content -->
<div class="container container-style">

    <div class="row">
                
        <div class="col-md-4">

            <h2 class="page-header">
                Masmorra
            </h2>
            <h2 class=class="lead">
                Pré-definições
            </h2>
            <div class="col-md-12">
                <p>
                    "Montar Lista de jogadas pré-definidas".
                </p>
            </div>

            <div class="row">
                <!-- Limpa todo o chat -->
                <?php
                echo validation_errors('<div class="alert alert-danger">','</div>');
                echo form_open('Masmorra_Controller/apagarChat');
                ?> 
                    <button class="btn btn-default" type="submit"> Limpar Chat </button>
                <?php
                echo form_close();
                ?>

            </div>
        </div>

        <div class="col-md-8">

            <div class="row">
                <h2 class="page-header">
                    Fazendo História
                </h2>
                
                <!--Aqui deve ser feito um select no BD ou guardar sempre o conteúdo de uma conversa.-->
                <!--Talvez usar uma string para ficar pegando as frases digitadas ou coisa do tipo.-->
                <div  id="chat-scroll" class="row chat-window">
                    <?php foreach($chat as $msg){ ?>
                        <p><?php echo $msg->mensagem ?></p>

                    <?php
                    }?>
                </div>
            </div>

            <div class="row">
                <?php
                echo validation_errors('<div class="alert alert-danger">','</div>');
                echo form_open('Masmorra_Controller/cadastrarMsg');
                ?> 
                    <div class="row">
                        <div>
                            <input class="form-control form-control-style" type="text"  id="txt-frase" name="txt-frase" rows="1" cols="90" placeholder="Descreva suas ações aqui">
                        </div>
                        <div>
                            <button class="btn btn-default" type="submit"> Enviar </button>
                        </div>
                    </div>
                <?php
                echo form_close();
                ?>
            </div>
            
        </div>
    </div>
</div>
