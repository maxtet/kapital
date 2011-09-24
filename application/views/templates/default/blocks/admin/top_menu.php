<ul>
    <li><a href="<?= site_url('/admin/rubrik') ?>">Рубрики</a></li>
    <li><a href="<?= site_url('/admin/objects/objects_cat') ?>">Типы объектов</a></li>
</ul>
<?= form_open(site_url('logout')) ?>
<span><?= $this->session->userdata('username') ?></span>
<input type="submit" name="logout" value="Выход"/>
<?= form_close() ?>