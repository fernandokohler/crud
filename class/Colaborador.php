<?php

/**
 * Created by PhpStorm.
 * User: luiz_
 * Date: 09/09/2017
 * Time: 16:39
 */

include "conexao.php";
include "utils/function.php";

class Colaborador
{

    private $cd_colaborador;
    private $nome;
    private $cpf;
    private $dt_nascimento;

    /**
     * Seleciona todas as linhas
     *
     * @return mixed
     * @throws Exception
     */
    public static function get()
    {
        try {
            global $conn;
            $sql = "SELECT * FROM colaborador";
            $result = $conn->query($sql);
            /**
             * Retorna um array de StdClass
             */
            $result = arrayObjects($result);
            /**
             * Converte a stdClass para um objeto colaborador
             */
            return cast('Colaborador', $result);
        } catch (Exception $e) {
            throw new Exception("Erro ao selecionar os colaboradores -> " . $e->getMessage());
        }
    }

    /**
     * Seleciona pelo codigo
     *
     * @param $cd
     * @return mixed
     * @throws Exception
     */
    public static function getPorCd($cd)
    {
        try {
            global $conn;
            $sql = "SELECT * FROM colaborador where cd_colaborador = $cd";
            $result = $conn->query($sql);
            /**
             * Retorna um array de StdClass
             */
            if ($result) {
                $result = arrayObjects($result);
                /**
                 * Converte a stdClass para um objeto colaborador
                 */
                return cast('Colaborador', $result);
            }
            return null;
        } catch (Exception $e) {
            throw new Exception("Erro ao selecionar o colaborador especifico -> " . $e->getMessage());
        }
    }

    /**
     * @return bool|mysqli_result
     * @throws Exception
     */
    public function save(){
        try{
            global $conn;
            $sql = "INSERT INTO 
                    colaborador (nome, cpf, dt_nascimento)
                    VALUES ('".$this->getNome()."', '".$this->getCpf()."', '" . date('Y-m-d',strtotime($this->getDtNascimento())) . "')";
            $query = $conn->query($sql);
            return $query;
        }catch (Exception $e){
            throw new Exception("Erro ao atualizar -> " . $e->getMessage());
        }
    }

    /**
     * @return bool|mysqli_result
     * @throws Exception
     */
    public function update(){
        try{
            global $conn;
            $sql = "UPDATE 
                      colaborador
                    SET 
                      nome = '".$this->getNome()."', 
                      cpf = '".$this->getCpf()."', 
                      dt_nascimento = '" . date('Y-m-d',strtotime($this->getDtNascimento())) . "'
                    WHERE 
                      cd_colaborador = ".$this->getCdColaborador();
            $query = $conn->query($sql);
            return $query;
        }catch (Exception $e){
            throw new Exception("Erro ao atualizar -> " . $e->getMessage());
        }
    }

    /**
     * @return bool|mysqli_result
     * @throws Exception
     */
    public function delete(){
        try{
            global $conn;
            $sql = "DELETE FROM colaborador WHERE cd_colaborador = " . $this->getCdColaborador();
            $query = $conn->query($sql);
            return $query;
        }catch (Exception $e){
            throw new Exception("Erro ao deletar -> " . $e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function getCdColaborador()
    {
        return $this->cd_colaborador;
    }

    /**
     * @param mixed $cd_colaborador
     */
    public function setCdColaborador($cd_colaborador)
    {
        $this->cd_colaborador = $cd_colaborador;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getDtNascimento()
    {
        return $this->dt_nascimento;
    }

    /**
     * @param mixed $dt_nascimento
     */
    public function setDtNascimento($dt_nascimento)
    {
        $this->dt_nascimento = $dt_nascimento;
    }
}