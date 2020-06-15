<h1>Dados de pagamento</h1>
Inserir e excluir.
<?php if($payments):
    foreach ($payments as $pay): ?>
    <table>
        <tr>
            <td>
                <?= $pay->title; ?>
            </td>
            <td>
                <?= $pay->comments; ?>
            </td>
            <td>
                <?= $pay->id; ?>
            </td>
        </tr>
    </table>
<?php
    endforeach;
endif;
?>
?>
