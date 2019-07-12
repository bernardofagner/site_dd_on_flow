<?php /*Bloqueia o acesso via url a este arquivo no brouser*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	// Declara os atributos que o model possui
	public $id_user;
	public $nome;
	public $email;
	public $senha;
	public $id_categoria;

	//Construtor do Model
	public function __construct(){
		parent::__construct();
	}

	public function listarUsuarios(){
		//Realiza a busca de todos os dados ordenados por id 'id_categoria' em ordem crescente 'ASC'
		$this->db->order_by('id_user','ASC');
		//Retorna o resultado da busca na tabela categoria
		return $this->db->get('users')->result();
	}
}