<?php /*Bloqueia o acesso via url a este arquivo no brouser*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Masmorra_Controller extends CI_Controller {

	//Construtor
	public function __construct(){
		parent::__construct();

		// Carrega os models a serem usados
		$this->load->model('Chat_model');
	}
	
	// Inicia o chat
	public function index()	{
		if($this->Chat_model->startChat()){
			/*Dá o nome da aba do navegador*/
			$dados['titulo'] = "Masmorras";
			$dados['chat'] = $this->Chat_model->readChat();

			/*Carrega todas as views que constroem o frontend*/
			$this->load->view('template/html-header', $dados);
			$this->load->view('template/header');
			$this->load->view('Masmorra');
			$this->load->view('template/footer');
			$this->load->view('template/html-footer');
		}
		else{
			echo "Não foi possível iniciar o chat";
		}		
	}

	// Mantém o usuário no chat
	public function chat()	{
		/*Dá o nome da aba do navegador*/
		$dados['titulo'] = "Masmorras";
		$dados['chat'] = $this->Chat_model->readChat();

		/*Carrega todas as views que constroem o frontend*/
		$this->load->view('template/html-header', $dados);
		$this->load->view('template/header');
		$this->load->view('Masmorra');
		$this->load->view('template/footer');
		$this->load->view('template/html-footer');	
	}

	public function cadastrarMsg(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-frase','Texto da mensagem','required|max_length[10000]');

		if($this->form_validation->run() == FALSE) {
            redirect(base_url('Masmorra_Controller/chat'));
		}
		else {
			$jogada = $this->input->post('txt-frase');

			// Chama a função que vai tratar a jogada
			$dados['mensagem'] = tratar_jogada($jogada);
			$dados['user_id'] = 1;
			$dados['vazio2'] = "Nada ainda";

			// Grava a mensagem no banco de dados
			if($this->Chat_model->cadastrateMsg($dados)){
                redirect(base_url('Masmorra_Controller/chat'));
			}
			else {
                echo "Erro ao enviar a mensagem";
            }
		}
		return 0;
	}

	function apagarChat(){

		//Chama a funcao para apagar todos os registros da tabela chat
		if($this->Chat_model->deleteChat()){
			redirect(base_url('Masmorra_Controller/chat'));
		}
		else {
			echo "Erro ao deletar todas as mensagens do chat";
		}
	}
}