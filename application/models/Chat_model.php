<?php /*Bloqueia o acesso via url a este arquivo no brouser*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends CI_Model {

	//Construtor do Model
	public function __construct(){
		parent::__construct();
	}
	
    public function startChat(){
        $dados['mensagem'] = "Fulano de tal entrou";
        $dados['user_id'] = 0;
        $dados['vazio2'] = "Nada ainda";

        $this->db->insert('chat', $dados);
        $this->db->where('msg_id', $this->db->insert_id());
        return true;
    }

    public function readChat(){
		//Realiza a busca de todos os dados ordenados por id 'id_categoria' em ordem crescente 'ASC'
		$this->db->order_by('msg_id','ACS');
		//Retorna o resultado da busca na tabela categoria
		return $this->db->get('chat')->result();
    }
    

    public function cadastrateMsg($dados){
        $this->db->insert('chat', $dados);
        $this->db->where('msg_id', $this->db->insert_id());
        return true;
    }

    public function updateChat(){
        echo "Entrou updateChat";
        return true;
    }

    public function deleteChat(){
        //$this->db->count_all('my_table');
        // Produces: DELETE FROM chat table
        $this->db->empty_table('chat');
        return true;
    }
}