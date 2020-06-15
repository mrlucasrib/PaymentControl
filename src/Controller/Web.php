<?php

namespace Source\Controller;

use League\Plates\Engine;
use Source\Model\Payment;

class Web
{
    private $view;
    private $router;
    public function __construct($router)
    {
        $this->router = $router;
        $this->view = Engine::create(__DIR__.'/../View','php');
    }

    public function insert($data)
    {
        $message = null;

        /* Verifica se o formulario foi submetido  e registra no banco */
        if(!empty($data))
        {
//            TODO: FAZER VERIFICAÇÃO DO REGISTRO validData
            $payment = new Payment();
            $payment->title = $data['title'];
            $payment->value = $data['value'];
            $payment->date = $data['date'];
            $payment->external_tax = $data['external_tax'];
            $payment->comments = $data['comments'];
            $add = $payment->save();
            if($add)
                $message =  "Registro adicionado com sucesso";
            else
                $message = "Falha ao adicionar";


        }
        $url = URL_BASE;
        echo $this->view->render('insert', [
            'url' => $url,
            'message' => $message,
        ]);
    }

    public function listItems($data)
    {
        $payments = new Payment();
        $url = URL_BASE;
        $pymnt = $payments->find()->fetch(true);
        echo $this->view->render('listItems', [
            'payments' => $pymnt,
            'url' => $url
        ]);
    }
    public function deleteItem($data)
    {
        if($data)
        {
            $payments = (new Payment())->findById($data['id']);
            $payments->destroy();
        }
        $this->router->redirect('listar');

    }

    public function changeItem($data)
    {

    }
    /* Valida os campos e retorna true se esta dentro do esperadp */
    private function validData(string $title, int $value, string $date) : bool
    {

        return true;
    }
}