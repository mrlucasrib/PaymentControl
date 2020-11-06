<h1>Insira os dados do pagamento</h1>

<form action="<?= $url; ?>/inserir" method="POST">
    <input name="title" type="text" placeholder="Titulo"/>
    <input name="value" type="number" placeholder="Valor"/>
    <input name="date" type="date" placeholder="Data"/>
    <input name="comments" type="text" placeholder="Comentarios"/>
    <button type="submit">Enviar</button>
</form>
<br />
<a href="/listar">Listar registros</a>
<?php if ($message):
    echo $message;
endif;
?>