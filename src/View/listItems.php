<h1>Dados de pagamento</h1>
Inserir e excluir.
<table border="1"style="table-layout: fixed; text-align: left;">
    <tr>
        <th>ID</th>
        <th>Titulo</th>
        <th>Valor</th>
        <th>Data</th>
        <th>Imposto</th>
        <th>Comentario</th>
        <th>EDITAR</th>
        <th>EXCLUIR</th>
    </tr>
    <?php if ($payments):
        foreach ($payments as $pay): ?>

            <tr>
                <td>
                    <?= $pay->id; ?>
                </td>
                <td>
                    <?= $pay->title; ?>
                </td>
                <td>
                    <?= $pay->value; ?>
                </td>
                <td>
                    <?= $pay->date; ?>
                </td>
                <td>
                    <?= $pay->external_tax; ?>
                </td>
                <td>
                    <?= $pay->comments; ?>
                </td>
                <td>
                    <a href="<?= $url; ?>/editar/<?= $pay->id; ?>">EDITAR</a>

                </td>
                <td>
                    <a href="<?= $url; ?>/excluir/<?= $pay->id; ?>">EXCLUIR</a>
                </td>
            </tr>
        <?php
        endforeach;
    endif;
    ?>
</table>
<br />
<a href="/inserir">Inserir registro</a>