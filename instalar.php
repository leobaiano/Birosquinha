<?php
/*
Plugin Name: birosquinha
Plugin URI: http://leobaiano.com/
Description: Plugin para criar e gerenciar uma loja virtual no WordPress
Version: 1.0
Author: Leo Baiano
Author URI: http://leobaiano.com/
*/

global $birosquinha_db_version;
$birosquinha_db_version = "1";

require_once("load.php");

$versaoDB = get_option('birosquinha_db_varsion');

criarTabelas();

function criarTabelas(){
    global $wpdb, $birosquinha_db_version;
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    
    // Cria a tabela de categorias
    $tableCategorias = $wpdb->prefix . "bir_categorias";
    if(($wpdb->get_var("show tables like '$tableCategorias'") != $tableCategorias)) {
        $sqlCategorias = "
                    CREATE TABLE " . $tableCategorias . "  (
                        id INT NOT NULL AUTO_INCREMENT ,
                        nome VARCHAR(100) NULL,
                        descricao LONGTEXT NULL ,
                        pai INT NULL ,
                        imagem VARCHAR(250) NULL ,
                        ordem INT (1) NULL ,
                        status INT (1) NULL ,
                        PRIMARY KEY (id) )
                    DEFAULT CHARACTER SET = utf8
                    COLLATE = utf8_general_ci;
                ";
        dbDelta($sqlCategorias);
    }
    
    // Cria a tabela de produtos
    $tableProdutos = $wpdb->prefix . "bir_produtos";
    if(($wpdb->get_var("show tables like '$tableProdutos'") != $tableProdutos)) {
        $sqlProdutos = "
                    CREATE TABLE " . $tableProdutos . "  (
                        id INT NOT NULL AUTO_INCREMENT ,
                        nome VARCHAR(100) NULL ,
                        descricao LONGTEXT NULL ,
                        tags VARCHAR(100) NULL ,
                        status INT(1) NULL ,
                        preco DOUBLE(10,2) NULL ,
                        imagem VARCHAR(250) NULL ,
                        ordem INT(1) NULL ,
                        categoria INT NULL ,
                        PRIMARY KEY (id) )
                    DEFAULT CHARACTER SET = utf8
                    COLLATE = utf8_general_ci;
                ";
        dbDelta($sqlProdutos);
    }
    
    // Cria a tabela de clientes
    $tableClientes = $wpdb->prefix . "bir_Clientes";
    if(($wpdb->get_var("show tables like '$tableClientes'") != $tableClientes)) {
        $sqlClientes = "
                    CREATE TABLE " . $tableClientes . "  (
                        id INT NOT NULL AUTO_INCREMENT ,
                        nome VARCHAR(100) NULL,
                        sobrenome VARCHAR(100) NULL ,
                        email VARCHAR(100) NULL ,
                        telefone VARCHAR(20) NULL ,
                        celular VARCHAR(20) NULL ,
                        endereco VARCHAR(150) NULL ,
                        bairro VARCHAR(150) NULL ,
                        complemento VARCHAR(150) NULL ,
                        cidade VARCHAR(100) NULL ,
                        estado VARCHAR(100) NULL ,
                        cep VARCHAR(20) NULL ,
                        senha VARCHAR(100) NULL ,
                        PRIMARY KEY (id) )
                    DEFAULT CHARACTER SET = utf8
                    COLLATE = utf8_general_ci;
                ";
        dbDelta($sqlClientes);
    }
    
    // Cria a tabela do carrinho de compras
    $tableCarrinho = $wpdb->prefix . "bir_carrinho";
    if(($wpdb->get_var("show tables like '$tableCarrinho'") != $tableCarrinho)) {
        $sqlClientes = "
                    CREATE TABLE " . $tableCarrinho . "  (
                        id INT NOT NULL AUTO_INCREMENT ,
                        id_produto INT NULL ,
                        nome VARCHAR(100) NULL,
                        preco DOUBLE(10,2) NULL ,
                        qtd INT NULL ,
                        sessao VARCHAR(200) NULL ,
                        status INT NULL,
                        PRIMARY KEY (id) )
                    DEFAULT CHARACTER SET = utf8
                    COLLATE = utf8_general_ci;
                ";
        dbDelta($sqlCarrinho);
    }
    
    // Cria a tabela dos reviews
    $tableReview = $wpdb->prefix . "bir_review";
    if(($wpdb->get_var("show tables like '$tableReview'") != $tableReview)) {
        $sqlReview = "
                    CREATE TABLE " . $tableReview . "  (
                        id INT NOT NULL AUTO_INCREMENT ,
                        autor VARCHAR(100) NULL ,
                        email VARCHAR(100) NULL ,
                        id_produto INT NULL ,
                        texto LONGTEXT NULL ,
                        estrelas INT(2) NULL ,
                        status INT NULL,
                        PRIMARY KEY (id) )
                    DEFAULT CHARACTER SET = utf8
                    COLLATE = utf8_general_ci;
                ";
        dbDelta($sqlReview);
    }
    
    // Cria a tabela de imagens dos produtos
    $tableImagens = $wpdb->prefix . "bir_imagens";
    if(($wpdb->get_var("show tables like '$tableImagens'") != $tableImagens)) {
        $sqlImagens = "
                    CREATE TABLE " . $tableImagens . "  (
                        id INT NOT NULL AUTO_INCREMENT ,
                        id_produto INT NULL ,
                        imagem VARCHAR(150) NULL ,
                        PRIMARY KEY (id) )
                    DEFAULT CHARACTER SET = utf8
                    COLLATE = utf8_general_ci;
                ";
        dbDelta($sqlImagens);
    }
    
    add_option("birosquinha_db_version", $birosquinha_db_version);
}
?>