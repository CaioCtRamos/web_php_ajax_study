<?php

namespace App\Entities;

class Produto{
    private int $id;
    private string $descricao;
    private float $valorUnitario;
    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of valor_unitario
     */ 
    public function getValorUnitario()
    {
        return $this->valorUnitario;
    }

    /**
     * Set the value of valor_unitario
     *
     * @return  self
     */ 
    public function setValorUnitario($valorUnitario)
    {
        $this->valorUnitario = $valorUnitario;

        return $this;
    }
}