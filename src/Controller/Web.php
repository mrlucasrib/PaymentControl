<?php

namespace Source\Controller;

use CoffeeCode\Uploader\File;
use CoffeeCode\Uploader\Send;
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
        if ($data) {
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
            $payment = (new Payment())->findById($data['index']);

            // Se o item foi alterado essa key existirá
            if (array_key_exists('title', $data)) {
                if ($this->changeOrInsert($payment, $data)) {
                    $this->router->redirect('listar');
                } else {
                    $message = "Falha ao editar registro";
                }

            }

            $url = URL_BASE;
            echo $this->view->render('editItem', [
                'url' => $url,
                'message' => $message,
                'payments' => $payment

            ]);
        }
    }

    public function importXlsx($data)
    {
        $file = new Send(__DIR__."/../../uploads",'excel',["application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"],['xlsx'],false);
        var_dump($_FILES);
        if ($_FILES) {
            try {
                $file->upload($_FILES['file'], $_FILES['file']['name']);
//                echo "<p><a href='{$upload}' target='_blank'>@CoffeeCode</a></p>";
            } catch (Exception $e) {
                echo "<p>(!) {$e->getMessage()}</p>";
            }
        }
            $url = URL_BASE;
        echo $this->view->render('importXlsx', [
            'url' => $url
        ]);
    }



    private function changeOrInsert($payment, $data): bool
    {
//        CORRIGIR: ELE NAO ACEITA MSG
            /* Verifica se o tamanho do titulo esta conforme pede a atividade */
        if(strlen($data['title']) >= 5 && strlen($data['title']) <= 100)
            $payment->title = $data['title'];
        else
            return false;
        $payment->value = (float)$data['value'];
        /* Verifica se o campo esta como Y-m-d */
        if(checkdate(
            (int)substr($data['date'],5,2),
            (int)substr($data['date'],8,2),
            (int)substr($data['date'],0,4)))
        {
            $payment->date = $data['date'];
        } else
            return false;
        $payment->external_tax = (float)$data['value'] * 0.05;
        $payment->comments = $data['comments'];
        return $payment->save();

    }
}