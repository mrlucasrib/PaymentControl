<?php

namespace Source\Controller;

use League\Plates\Engine;
use Source\Model\Payment;

class Web
{
    private $view;
    public function __construct()
    {
    }

    public function insert($data)
    {
        /* Verifica se o formulario foi submetido  e registra no banco */
        if(!empty($data))
        {
//            TODO: FAZER VERIFICAÇÃO DO REGISTRO
            $payment = new Payment();
            $payment->title = $data['title'];
            $payment->value = $data['value'];
            $payment->date = $data['date'];
            $payment->external_tax = $data['external_tax'];
            $payment->comments = $data['comments'];
            $add = $payment->save();

            if($add)
                echo "Registro adicionado com sucesso";
            else
                echo "Falha ao adicionar";


        }
        $url = URL_BASE;
        require __DIR__."/../View/insert.php";
    }

    public function listItems($data)
    {
        $payments = new Payment();

        var_dump($payments->find()->fetch(true));
    }
}