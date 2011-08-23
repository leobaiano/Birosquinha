<?php
/**
 * Classe generica com funções gerais para uso em outras classes
 *
 * @author Leo Baiano <leobaiano@leobaiano.com>
 * @date 19/01/2010
 * @package classes/generica.class.php
 * @version 1.0
*/
class Generica{
    
    /**
     * Trabalha os dados recebidos pelo formulário, via $_POST, e
     * monta o formato para o insert do WP
     *
     * @param array $dados - Dados da categoria passados via $_POST
     * @param boolean $imagem - Verifica se o cadastro tem imagem para fazer o upload
     * @return string $d - String com os dados no formato de cadastro
    */
    function dadosInsert($dados,$imagem=false){
        
        // Verifica se existe imagem no cadastro
        if($imagem){
            // Apaga a chave imagem do Array
            unset($dados['imagem']);
            
            // Faz o upload da imagem e recupera um array com as informações
            $imagemUp = wp_handle_upload($_FILES['imagem'],$overrides);
            
            // Grava a URL da imagem em uma nova variavel
            $imagem = $imagemUp['url'];
            
            // Inclui os dados da imagem na string que será retornada para inserir
            $d = "'imagem' => '$imagem', ";
        }
        
        // Inseri os outros dados do formulário na string
        foreach($dados as $key => $value){
            $d .= "'$key' => '$value', ";
        }
        
        // Retira a virgula e o espaço sobrando no final da string
        $d = substr($d,0,-2);
        
        // Retorna a string no formato correto para insert no BD
        return $d;
    }
}
?>