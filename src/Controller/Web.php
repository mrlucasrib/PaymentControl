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
        $this->view = Engine::create(__DIR__ . '/../View', 'php');
    }

    public function insert($data)
    {
        $message = null;

        /* Verifica se o formulario foi submetido  e registra no banco */
        if (!empty($data)) {
            $payment = new Payment();

            if ($this->changeOrInsert($payment, $data))
                $message = "Registro adicionado com sucesso";
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

    /* Deleta o registro no BD quando o usuario clica em EXCLUIR - Satisfaz item 1.3 */
    public function deleteItem($data)
    {
        if ($data) {
            $payments = (new Payment())->findById($data['id']);
            $payments->destroy();
        }
        $this->router->redirect('listar');

    }

    public function editItem($data)
    {
        if (array_key_exists('index', $data)) {
            $message = null;
            $payments = null;
            // Se o item foi alterado essa key existirá
            if (array_key_exists('title', $data)) {
                $payment = (new Payment())->findById($data['index']);
                if ($this->changeOrInsert($payment, $data)) {
                    $this->router->redirect('listar');
                } else {
                    $message = "Falha ao editar registro";
                }

            } else {
                $payments = (new Payment())->findById($data['index']);
            }
            $url = URL_BASE;

            echo $this->view->render('editItem', [
                'url' => $url,
                'message' => $message,
                'payments' => $payments

            ]);
        }
    }

    public function params(array $data): void
    {
        var_dump($data);
    }

    /* Valida os campos e retorna true se esta dentro do esperadp */
    private function validData(string $title, int $value, string $date): bool
    {

        return true;
    }

    private function changeOrInsert($payment, $data): bool
    {
//         TODO: FAZER VERIFICAÇÃO DO REGISTRO validData

        $payment->title = $data['title'];
        $payment->value = $data['value'];
        $payment->date = $data['date'];
        $payment->external_tax = $data['value'];  //TODO: ALTERAR
        $payment->comments = $data['comments'];
        return $payment->save();

    }
}