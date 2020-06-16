<h1>Importar planilha</h1>
<form name="env" action="<?= $url; ?>/importxlsx" method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="File Name" required/>
    <input name="file"  type="file" />


    <button type="submit">Enviar</button>
</form>
