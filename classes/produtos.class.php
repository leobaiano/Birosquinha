<?php
/**
 * Classe produtos
 *
 * @author Leo Baiano <leobaiano@leobaiano.com>
 * @date 26/01/2010
 * @package classes/produtos.class.php
 * @version 1.0
*/
class produtos{
    /**
     * Faz o cadastro de um produto
     *
     * @param array $dados - Dados do produto passados via $_POST
     * @return int $id - Retorna o ID da categoria que acabou de ser cadastrada
    */
    function cadastro($dados){
        // Trabalha os dados recebidos para montar a string para INSERT
        $d = Generica::dadosInsert($dados);
        
        // Chama o método insert do WP para inserir os dados na tabela
        $wpdb->insert('wp_bir_produtos', array($d));
        
        // Recupera o ID do registro inserido
        $id = $wpdb->insert_id;
        
        // Retorna o ID do registro inserido
        return $id;
    }
    
    /**
     * Exclui um produto
     *
     * @param int $id - ID do produto
     * @return boolean - Retorna false ou true a depender do resultado
    */
    function excluir($id){
        $resultado = $wpdb->query("DELETE FROM wp_bir_produtos WHERE id = '$id' LIMIT 1");
        if($resultado){
            $resposta = true;
        }
        else{
            $resposta = false;
        }
        return $resposta;
    }
    
    /**
     * Editar os dados de um produto
     *
     * @param array $dados - Dados do produto passados via $_POST
     * @return int $id - Retorna o ID do produto que acabou de ser cadastrada
    */
    function editar($dados,$id){
        $d = Generica::dadosInsert($dados);
        $resultado = $wpdb->update('wp_bir_produtos', array($d), array('id' => '$id'));
        if($resultado){
            $resposta = true;
        }
        else{
            $resposta = false;
        }
        return $resposta;
    }
    
    /**
     * Imprimir na tela todos os produtos
     *
     * @param string $ordem - ASC ou DESC (padrão ASC)
     * @param string $ordemPor - Nome do campo pelo qual deseja ordenar (padrão ID)
     * @param boolean $aleatorio - Produtos devem ser listador de forma aleatoria esse parametro ignora o @ordem e o $ordemPor, para aleatório 1, para não aleatório 0 (padrão 0)
     * @param int $idListarCategoria - Listar produtos de 1 ou mais categorias
     * @param int $idExcluirCategoria - Exclui os produtos de 1 ou mais categorias da lista
     * @return string $content - Conteúdo que será impresso
    */
    function listarProdutos($ordem='ASC',$ordemPor='id',$aleatorio='0',$idListarCategorias=null,$idExcluirCategoria=null){
        if($aleatorio == 0){
            
            $produtos = $wpdb->get_results("SELECT * FROM wp_bir_produtos ORDER BY $ordemPor $ordem");
        }
    }
}
?>