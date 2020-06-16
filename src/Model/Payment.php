<?php


namespace Source\Model;


use CoffeeCode\DataLayer\DataLayer;

class Payment extends DataLayer
{
    public function __construct()
    {
        parent::__construct("payments", ["title", "value", "date", "external_tax", "comments"], 'id', false);
    }
}