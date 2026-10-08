<?php
//funcao saudação
    $nomeEscola = "SENAI";
    function sadaucao(){
        return "Bem Vindo";
    }
// funcao receber um nome
    function comprimentar($nome){
        return "Ola,". $nome . "!";
    }
//funcção somar
    function somar($numero1, $numero2){
        $resultado = $numero1 + $numero2;
        return $resultado;
    }

// funcao media
    function calcularMedia($nota1, $nota2){
        $media = ($nota1 + $nota2)/2;
        return $media;
    }
    function verificarStatus($media){
        //media é 7
        if($media >= 7){
            return "Aprovado";
        }
    }
?>

