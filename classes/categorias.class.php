<?php
/**
 * Classe categoria de produtos
 *
 * @author Leo Baiano <leobaiano@leobaiano.com>
 * @date 19/01/2010
 * @package classes/categorias.class.php
 * @version 1.0
*/
class categorias{
    
    /**
     * Faz o cadastro de uma categoria
     *
     * @param array $dados - Dados da categoria passados via $_POST
     * @return int $id - Retorna o ID da categoria que acabou de ser cadastrada
    */
    function cadastro($dados){
        // Trabalha os dados recebidos para montar a string para INSERT
        $d = Generica::dadosInsert($dados,$imagem=true);
        
        // Chama o método insert do WP para inserir os dados na tabela
        $wpdb->insert('wp_bir_categorias', array($d));
        
        // Recupera o ID do registro inserido
        $id = $wpdb->insert_id;
        
        // Retorna o ID do registro inserido
        return $id;
    }
    
    /**
     * Exclui uma categoria
     *
     * @param int $id - ID da categoria que deverá ser excluida
     * @return boolean - Retorna false ou true a depender do resultado
    */
    function excluir($id){
        $resultado = $wpdb->query("DELETE FROM wp_bir_categorias WHERE id = '$id' LIMIT 1");
        if($resultado){
            $resposta = true;
        }
        else{
            $resposta = false;
        }
        return $resposta;
    }
    
    /**
     * Editar os dados de uma categoria
     *
     * @param array $dados - Dados da categoria passados via $_POST
     * @return int $id - Retorna o ID da categoria que acabou de ser cadastrada
    */
    function editar($dados,$id){
        $d = Generica::dadosInsert($dados);
        $resultado = $wpdb->update('wp_bir_categorias', array($d), array('id' => '$id'));
        if($resultado){
            $resposta = true;
        }
        else{
            $resposta = false;
        }
        return $resposta;
    }
    
    /**
     * Imprimi na tela os dados da categoria
     * o formato da impressão é em listas
     * Padrão <ul><li class='classe'>Categoria</li></ul>
     *
     * @param string $ordem (default null)(permitido: asc, desc, ordem)  - Como ordenar os resultados
     * @param string $classe (default bir_ul_categorias) - Classe que será utilizada na tag <li>
     * @return string $content - Imprimi na tela as categorias cadastradas
    */
    function listarCategorias($ordem=null, $classe='bir_ul_categorias'){
       
       // Verifica se o parametro $ordem foi definido
       if(!empty($ordem)){
            
            // Se diferente de ASC e DESC ordena de forma crescente pela ordem definida na administração
            if(($ordem != 'ASC') AND ($ordem != 'DESC')){
                $categorias = $wpdb->get_results("SELECT * FROM wp_bir_categorias ORDER BY ordem ASC");
            }
            
            // Se não for definido por ordem organiza de forma crescente ASC ou DESC conforme parametro passado
            else{
                $categorias = $wpdb->get_results("SELECT * FROM wp_bir_categorias ORDER BY nome $ordem");
            }
       }
       
       // Se o parametro ordem não for definido organiza de forma crescente, por nome
       else{
        $categorias = $wpdb->get_results("SELECT * FROM wp_bir_categorias ORDER BY nome");
       }
       
       // Monta a lista ordenada com os resultados
       $content = "<ul>\n";
       foreach($categorias as $categoria){
            $content .= "<li class='$classe'><a href='get_option('home')/birosquinha?categoria=$categoria->id' title='$categoria->nome'>$categoria->nome</a></li>\n";
       }
       $content .= "</ul>\n";
       
       // imprimi a lista na tela
       echo $content;
    }
    
    /**
     * Retorna as categorias separadas pelo separador definido
     * a virgula é o separador padrão
     *
     * @param string $ordem (default null)(permitido: asc, desc, ordem)  - Como ordenar os resultados
     * @param string $separados (default , [virgula]) - caracter que vai separar as categorias
     * @return string $content - Retorna as categorias cadastradas separadas pelo separador definido
    */
    function getListarCategorias($ordem=null, $separador=','){
        if(!empty($ordem)){
            if(($ordem != 'ASC') AND ($ordem != 'DESC')){
                $categorias = $wpdb->get_results("SELECT * FROM wp_bir_categorias ORDER BY $ordem ASC");
            }
            else{
                $categorias = $wpdb->get_results("SELECT * FROM wp_bir_categorias ORDER BY nome $ordem");
            }
       }
       else{
        $categorias = $wpdb->get_results("SELECT * FROM wp_bir_categorias ORDER BY nome $ordem");
       }
       foreach($categorias as $categoria){
            $content .= $categoria->nome.",";
       }
       return $content;
    }
}
?>