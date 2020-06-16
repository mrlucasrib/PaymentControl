<h1>Alterar registro</h1>
<?php if ($payments): ?>
    <form action="<?= $url; ?>/editar/<?= $payments->id; ?>" method="POST">
        <label>
            Título
            <input name="title" type="text" value="<?= $payments->title; ?>"/>
        </label>
        <label>
            Valor
            <input name="value" type="text" value="<?= $payments->value; ?>"/>
        </label>
        <label>
            Data
            <input name="date" type="date" value="<?= $payments->date; ?>"/>
        </label>
        <label>
            Comentarios
            <input name="comments" type="text" value="<?= $payments->comments; ?>"/>
        </label>
        <button type="submit">Enviar</button>
    </form>

<?php
endif;
if ($message):
    echo $message;
endif;

?>