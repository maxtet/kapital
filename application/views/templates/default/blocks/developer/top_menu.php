<ul>
    <li><a href="<?= site_url('developer/todo/active') ?>">To Do менеджер</a></li>
    <li><a href="<?= site_url('developer/migration') ?>">Миграции</a></li>
</ul>
<?= form_open(site_url('logout')) ?>
    <span><?= $this->session->userdata('username') ?></span>
    <input type="submit" name="logout" value="Выход"/>
<?= form_close() ?>