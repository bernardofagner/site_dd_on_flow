<?php /*Bloqueia o acesso via url a este arquivo no brouser*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio_Controller extends CI_Controller {

	//Construtor
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		/*Dá o nome da aba do navegador*/
		$dados['titulo'] = "D&D On Flow";

		/*Carrega todas as views que constroem o frontend*/
		$this->load->view('template/html-header', $dados);
		$this->load->view('template/header');
		$this->load->view('Inicio');
		$this->load->view('template/footer');
		$this->load->view('template/html-footer');
	}

	/*Na verdade eu gostaria  que fosse criada uma pequena janela na tela mesmo, onde a pessoa pudesse inserir os dados de cadastro*/
	public function cadastro(){
		/*Dá o nome da aba do navegador*/
		$dados['titulo'] = "Cadastre-se";

		/*Carrega todas as views que constroem o frontend*/
		$this->load->view('template/html-header', $dados);
		$this->load->view('template/header');
		$this->load->view('Cadastro');
		$this->load->view('template/footer');
		$this->load->view('template/html-footer');
	}
}