<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Edit Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="text-align: center;">
    <h1 class="d-sm-flex justify-content-sm-center">Edit payment details</h1>
    <?php if ($payments): ?>
    <form action="/editar/<?= $payments->id; ?>" method="POST" style="text-align: center;">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">Title</span></div><input value="<?= $payments->title; ?>" name="title" class="form-control" type="text">
            <div class="input-group-append"></div>
        </div>
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">Value</span></div><input value="<?= $payments->value; ?>" name="value" class="form-control" type="number">
            <div class="input-group-append"></div>
        </div>
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">Date</span></div><input value="<?= $payments->date; ?>" name="date" class="form-control" type="date">
            <div class="input-group-append"></div>
        </div>
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">Comments</span></div><input value="<?= $payments->comments; ?>" name="comments" class="form-control" type="text">
            <div class="input-group-append"></div>
        </div><button class="btn btn-primary border rounded d-sm-flex justify-content-sm-end" type="submit" style="text-align: center;">Save</button>
    </form>
    <?php endif ?>
    <a href="/listar">List payments</a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>