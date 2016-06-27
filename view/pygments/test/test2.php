<?php

class PinProduct
{
    private $pin;

    function __construct($pin)
    {
        $this->pin = $pin;
    }

    function __toString()
    {
        return $this->pin . "<br>\n";
    }
}

class PukProduct extends Test
{
    function __toString()
    {
        return $this->puk . "<br>\n";
    }
}

class Test
{
    private $a;
    private $ab;
    private $abc;
    private $abcd;
    private $pin = '2431';
    protected $puk = '1342';

    public function buildPinProduct()
    {
        for ($a = 0; $a < 10; $a++)
            echo new PinProduct($this->pin);
    }

    public function buildPukProduct()
    {
        for ($a = 0; $a < 10; $a++)
            echo new PukProduct();
    }

    /**
     * @return mixed
     */
    public function getAbcd()
    {
        return $this->abcd;
    }

    /**
     * @param mixed $abc
     */
    public function setAbc($abc)
    {
        $this->abc = $abc;
    }

    /**
     * @return mixed
     */
    public function getAb()
    {
        return $this->ab;
    }

    /**
     * @param mixed $a
     */
    public function setA($a)
    {
        $this->a = $a;
    }
}

(new Test())->buildPinProduct();
(new Test())->buildPukProduct();