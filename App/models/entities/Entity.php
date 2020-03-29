<?php


abstract class Entity
{
    public function __construct(array $datas = array())
    {
        if (!empty($datas))
        {
            $this->hydrate($datas);
        }
    }

    /**
     * @param array $datas setted to my entity's parameters
     */
    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            //call the good method of my class if she exists
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }
}