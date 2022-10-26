<?php
/**
 * Model contato
 * @author Wanderlei Silva do Carmo <wander.silva@gmail.com>
 * @version 0.1
 *
 */

//Entity Contato
namespace App\Entities;

class Produto {

    private int $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    private string $produto;

    /**
     * @return string
     */
    public function getProduto(): string
    {
        return $this->produto;
    }

    /**
     * @param string $produto
     */
    public function setProduto(string $produto): void
    {
        $this->produto = $produto;
    }
    private string $marca;

    /**
     * @return string
     */
    public function getMarca(): string
    {
        return $this->marca;
    }

    /**
     * @param string $marca
     */
    public function setMarca(string $marca): void
    {
        $this->marca = $marca;
    }
    private string $unidade;

    /**
     * @return string
     */
    public function getUnidade(): string
    {
        return $this->unidade;
    }

    /**
     * @param string $unidade
     */
    public function setUnidade(string $unidade): void
    {
        $this->unidade = $unidade;
    }
    private string $descricao;

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }


}