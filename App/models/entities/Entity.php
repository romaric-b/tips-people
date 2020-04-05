<?php

//namespace Entities;
namespace App\models\entities;

abstract class Entity
{
    public function __construct(array $datas = [])
    {
        if (!empty($datas))
        {
            //$this->hydrate($attributs);
            foreach ($datas as $attribut => $value)
            {
                //$this->__set($attribut, $value);
                $this->{$attribut} = $value;
            }
        }
    }

    /** Set est une méthode magique et set directement un attribut ex : $tonObjet->UnAttribut = "quelquechose". Si "UnAttribut" n'est pas définis dans les attributs de la  classe.
     * @param $attribut
     * @param $value
     */
    public function __set($attribut, $value)
    {
        if (property_exists($this, $attribut))
        {
            $this->$attribut = $value;
        }
        //var_dump($this);
        return $this;
    }

    public function __get($property)
    {
        return $this->$property;
    }
}