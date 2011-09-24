<?php if ($this->session->userdata('uid')): ?>
<script type="text/javascript">
    $(function() {
        $('input[name="delete"]').click(function() {
            if (confirm('Вы действительно хотите удалить эту запись') == true) {
                var id = $(this).attr('id');
                $.post('/rubrik/delete_item/' + id);
                $(this).parents('tr').fadeOut(300);
            }
        });
    })
</script>
<?php endif ?>

<script type="text/javascript">
    $(function() {
        $('tr.list').mouseover(
                function() {
                    $(this).attr('style', 'background: yellow');
                }).mouseout(function() {
                    $(this).removeAttr('style');
                });
    });
</script>
    
<?php if ($items): ?>
<table cellpadding="0" cellspacing="0">
    <tr class="table_head">
        <td class="td_head_right">Код</td>
        <td>Категория объекта</td>
        <td>Наименование</td>
        <td class="td_head_left">Действие</td>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr class="list">
        <td><?= $item->code ?></td>
        <td><?= Modules::run('objects/objects/objects_cat_item', $item->objects_cat_id)->description ?></td>
        <td><?= $item->description ?></td>
        <td><input type="submit" id="<?= $item->rubrik_id ?>" name="delete" value="Удалить"/></td>
    </tr>
    <?php endforeach ?>
</table>
<?php endif ?>

<div style="margin: 12px 18px">
    <?= form_open() ?>

    <table cellpadding="0" cellspacing="0">
        <tr class="table_head">
            <td class="td_head_right">Категория объекта</td>
            <td>Код</td>
            <td>Наименование</td>
            <td class="td_head_left"></td>
        </tr>
        <tr>
            <td>
                <select name="objects_cat_id">
                    <option value="">Выберите категорию</option>
                    <?php foreach (Modules::run('objects/objects/objects_cat_items') as $objects_cat): ?>
                    <option value="<?= $objects_cat->objects_cat_id ?>"><?= $objects_cat->description ?></option>
                    <?php endforeach ?>
                </select>
                <?= form_error('objects_cat_id') ?>
            </td>
            <td style="text-align: center;">
                <input type="text" size="10" name="code" accesskey="Код" value=""/>
                <?= form_error('code') ?>
            </td>
            <td>
                <input type="text" size="60" name="description" value=""/>
                <?= form_error('description') ?>
            </td>
            <td><input type="submit" name="create" value="Создать"/></td>
        </tr>
    </table>

    <?= form_close() ?>
</div>