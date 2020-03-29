<?php

//namespace Entities;
namespace App\models\entities;

abstract class Entity
{
    private $attributs = [];

    public function __construct(array $attributs = [])
    {
        if (!empty($attributs))
        {
            //$this->hydrate($attributs);
            foreach ($attributs as $attribut => $value)
            {
                //$this->__set($attribut, $value);
                $this->{$attribut} = $value;
            }
        }
    }

    public function __set($attribut, $value)
    {
        //je peux pas mettre de variable en guise d'attribut, mais si je concatène $ et chaine j'ai une variable
        //$this->attributs['$' . $attribut] = $value;
        $this->attributs[$attribut] = $value;
    }

    public function __get($attribut)
    {
        if (isset($this->attributs[$attribut]))
        {
            return $this->attributs[$attribut];
        }
    }

//    public function __isset($nom)
//    {
//        return isset($this->attributs[$nom]);
//    }
//
//    public function __unset($nom)
//    {
//        if (isset($this->attributs[$nom]))
//        {
//            unset($this->attributs[$nom]);
//        }
//    }
}