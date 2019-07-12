<?php /*Bloqueia o acesso via url a este arquivo no brouser*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model {

	// Declara os atributos que o model possui
	public $id_categoria;
	public $descricao;

	//Construtor do Model
	public function __construct(){
		parent::__construct();
	}

	public function listarCategorias(){
		//Realiza a busca de todos os dados ordenados por id 'id_categoria' em ordem crescente 'ASC'
		$this->db->order_by('id_categoria','ASC');
		//Retorna o resultado da busca na tabela categoria
		return $this->db->get('categorias')->result();
	}
}