<h1>Importar planilha</h1>
<form name="env" action="<?= $url; ?>/importxlsx" method="POST" enctype="multipart/form-data">
    <label>
        Insira a planilha
        <input name="file" type="file"/>
    </label>
    <button type="submit">Enviar</button>
</form>
<?php if ($message):
    echo $message;
endif;

?>