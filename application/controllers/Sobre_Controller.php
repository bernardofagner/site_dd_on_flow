<?php /*Bloqueia o acesso via url a este arquivo no brouser*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Sobre_Controller extends CI_Controller {

	//Construtor
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		/*Dá o nome da aba do navegador*/
		$dados['titulo'] = "Sobre o D&D On Flow";

		/*Carrega todas as views que constroem o frontend*/
		$this->load->view('template/html-header', $dados);
		$this->load->view('template/header');
		$this->load->view('Sobre');
		$this->load->view('template/footer');
		$this->load->view('template/html-footer');
	}
}