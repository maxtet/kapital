<script type="text/javascript">
    $(function() {
        $('input[name="delete"]').click(function() {
            if (confirm('Вы действительно хотите удалить эту запись') == true) {
                var id = $(this).attr('id');
                $.post('/objects/delete_item/objects_cat' + id);
                $(this).parents('tr').fadeOut(300);
            }
        });
    });
</script>

<?php if ($items): ?>
<table cellpadding="0" cellspacing="0">
    <tr class="table_head">
        <td>Наименование</td>
        <td class="td_head_left">Действие</td>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?= $item->description ?></td>
        <td><input type="submit" id="<?= $item->objects_cat_id ?>" name="delete" value="Удалить"/></td>
    </tr>
    <?php endforeach ?>
</table>
<?php endif ?>

<div style="margin: 12px 18px">
    <?= form_open() ?>
    <input type="text" size="60" name="description" value=""/>
    <input type="submit" name="create" value="Создать"/>
    <?= form_close() ?>
</div>


<?= validation_errors() ?>