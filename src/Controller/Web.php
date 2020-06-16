<?php

namespace Source\Controller;

use Aspera\Spreadsheet\XLSX\Reader;
use CoffeeCode\Router\Router;
use CoffeeCode\Uploader\Send;
use Exception;
use League\Plates\Engine;
use Source\Model\Payment;

class Web
{
    private Engine $view;
    private Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->view = Engine::create(__DIR__ . '/../View', 'php');
    }

    /**
     * GET - /inserir
     * Pagina de formulário
     *
     * POST - /inserir
     * Insere pagamentos no banco de dados
     *
     * @param array $data
     */
    public function insert(array $data): void
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

    /**
     * GET - /listar
     * Lista valores numa tabela com opção de excluir e alterar
     *
     * @param array $data
     */
    public function listItems(array $data): void
    {
        $payments = (new Payment())->find()->fetch(true);
        $url = URL_BASE;
        echo $this->view->render('listItems', [
            'payments' => $payments,
            'url' => $url
        ]);
    }

    /**
     * GET - /excluir/{id}
     * Deleta o registro no BD quando o usuário clica em EXCLUIR na pagina de listagem e retorna a pagina.
     * Satisfaz item 1.3 (Apenas um click)
     *
     * @param array $data
     */
    public function deleteItem(array $data): void
    {
        if ($data) {
            $payments = (new Payment())->findById($data['id']);
            $payments->destroy();
        }
        $this->router->redirect('listar');

    }

    /**
     * GET - /editar/{index}
     * Abre pagina para edição do registro selecionado.
     * POST - /editar/{index}
     * Salva o registro no banco de dados. Se for salvo com sucesso retorna a listagem,
     * se nao, mostra uma mensagem de erro.
     *
     * @param array $data
     */
    public function editItem(array $data): void
    {
        // Verifica se foi passado um index
        if (array_key_exists('index', $data)) {
            $message = null;
            $payment = (new Payment())->findById($data['index']);

            // Se o metodo for POST será alterado o registro e redirecionado.
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

    /**
     * GET - /importxlsx
     * Retorna a pagina para fazer upload de planilha
     * POST - /importxlsx
     * Salva a planilha na pasta uploads e registra itens no banco de dados.
     * @param array $data
     */
    public function importXlsx(array $data): void
    {
        // Permite apenas o upload de planilhas
        $file = new Send(__DIR__ . "/../../uploads", 'excel',
            ["application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"], ['xlsx'], false);
        $message = null;
        if ($_FILES) {
            try {
                $path = $file->upload($_FILES['file'], $_FILES['file']['name']);
                $reader = new Reader();
                $reader->open($path);
                // Escolhe apenas a 1ª planilha
                $reader->changeSheet(0);
                foreach ($reader as $row) {
                    // Verifica se não há linha vazia
                    if (!empty($row[0])) {
                        $payment = new Payment();

                        // Verifica se na planilha existe o comentario, e se não existir atribui a null
                        $row[3] ??= null;
                        $keys = array('title', 'date', 'value', 'comments');
                        $pay = array_combine($keys, $row);
                        $this->changeOrInsert($payment, $pay);
                    }
                }
                $message = "Planilha adicionada com sucesso";
            } catch (Exception $e) {
                $message = "Houve um erro ao adicionar a planilha, certifique se ela esta dentro do modelo";
            }

        }
        $url = URL_BASE;
        echo $this->view->render('importXlsx', [
            'url' => $url,
            'message' => $message
        ]);
    }


    /**
     * Adiciona ou exclui item no banco, a depender do parâmetro $payment
     * @param Payment $payment
     * @param array $data
     * @return bool
     */
    private function changeOrInsert(Payment $payment, array $data): bool
    {
        /* Verifica se o tamanho do titulo esta conforme pede a atividade */
        if (strlen($data['title']) >= 5 && strlen($data['title']) <= 100)
            $payment->title = $data['title'];
        else
            return false;
        $payment->value = (float)$data['value'];
        /* Verifica se o campo esta como Y-m-d */
        if (checkdate(
            (int)substr($data['date'], 5, 2),
            (int)substr($data['date'], 8, 2),
            (int)substr($data['date'], 0, 4))) {
            $payment->date = $data['date'];
        } else
            return false;
        $payment->external_tax = (float)$data['value'] * 0.05;
        $payment->comments = $data['comments'];
        return $payment->save();

    }
}