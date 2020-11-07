<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PaymentControl</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <h1 class="justify-content-sm-center d-sm-flex ">List of payments</h1>
    <div class="table-responsive d-md-flex">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Value</th>
                    <th>Date</th>
                    <th>Tax</th>
                    <th>Comments</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($payments) :
                    foreach ($payments as $pay) : ?>
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
                            <td><a href="/editar/<?= $pay->id; ?>" class="btn btn-primary">EDIT</a></td>
                            <td><a href="/excluir/<?= $pay->id; ?>" class="btn btn-primary" type="button">DELETE</a></td>
                        </tr>
                <?php
                    endforeach;
                endif;
                ?>
            </tbody>
        </table>
    </div>
    <a href="/inserir">Insert payment</a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>