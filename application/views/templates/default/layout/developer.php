<!DOCTYPE html
        PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="/assets/default/style.css"/>
    <script type="text/javascript" src="/assets/js/jquery-1.6.4.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $('.header_message').fadeOut(3000);
        })
    </script>
    <title><?= $title ?></title>
</head>
<body>

<div class="container">
    <div class="header">

        <div class="top"><?= $this->tpl->block('developer/top_menu') ?></div>

        <div class="header_message">
            <?php if (isset($message)): ?>
            <div class="message"><?= $message ?></div>
            <?php endif ?>
            <?php if (isset($error)): ?>
            <div class="error"><?= $error ?></div>
            <?php endif ?>
        </div>

    </div>

    <?= $content ?>

</div>

</body>
</html>