<?php

/**
 * @var $todo_status_list
 */

?>
<script type="text/javascript">
    $(function() {
        $('input[name=edit]').click(function() {
            var id = $(this).attr('id');
            var form_param = {
                todo_cat: $('#todo_cat' + id).val(),
                todo_status: $('#todo_status' + id).val(),
                description: $('#description' + id).val()
            };
            $('.header_message').html('<div class="message">Сохранено</div>').show().fadeOut(3000);
            $.post('/todo/edit_item/' + id, form_param, function(data) {
                $(this).parent('tr').html(data);
            });
        });
        $('#status').change(function() {
            var status = $(this).val();
            $(location).attr('href', '<?= site_url('developer/todo') ?>/' + status);
        });
    });
</script>

<table width="920" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <?= form_open() ?>
            <select id="status">
                <?php foreach ($todo_status_list as $key => $todo_status): ?>
                <? $selected = ($key == $status) ? 'selected = "selected"' : '' ?>
                <option value="<?= $key ?>" <?= $selected ?>><?= $todo_status ?></option>
                <?php endforeach ?>
            </select>
            <?= form_close() ?>
        </td>
        <td colspan="5"></td>
    </tr>
</table>

<?php if ($todo_items): ?>

<table width="920" cellpadding="0" cellspacing="0">
    <tr class="table_head">
        <td class="td_head_right">Категория</td>
        <td width="300">Наименование</td>
        <td>Статус</td>
        <td width="">Добавлена</td>
        <td>Изменена</td>
        <td class="td_head_left">Действие</td>
    </tr>
</table>

<div style="overflow: auto; max-height: 400px; width: 100%">
    <table width="920" cellpadding="0" cellspacing="0">
        <?php foreach ($todo_items as $todo): ?>
        <tr>
            <td>
                <select id="todo_cat<?= $todo->todo_id ?>">
                    <?php foreach ($todo_cat_items as $todo_cat): ?>
                    <?php $selected = ($todo_cat->todo_cat_id == $todo->todo_cat_id) ? 'selected = "selected"'
                            : '' ?>
                    <option value="<?= $todo_cat->todo_cat_id ?>" <?= $selected ?> >
                        <?= $todo_cat->description ?>
                    </option>
                    <?php endforeach ?>
                </select>
            </td>
            <td width="300"><textarea rows="2" cols="45"
                                      id="description<?= $todo->todo_id ?>"><?= $todo->description ?></textarea>
            </td>
            <td>
                <select id="todo_status<?= $todo->todo_id ?>">
                    <?php foreach ($todo_status_items as $todo_status): ?>
                    <?php $selected = ($todo_status->todo_status_id == $todo->todo_status_id)
                            ? 'selected = "selected"'
                            : '' ?>
                    <option value="<?= $todo_status->todo_status_id ?>" <?= $selected ?>><?= $todo_status->description ?></option>
                    <?php endforeach ?>
                </select>
            </td>
            <td><?= $todo->date_create ?></td>
            <td><?= $todo->timestamp ?></td>
            <td><input type="submit" id="<?= $todo->todo_id ?>" name="edit" value="Изменить"/></td>
        </tr>
        <?php endforeach ?>
    </table>
</div>
<?php else: ?>
<table width="920" cellpadding="0" cellspacing="0">
    <tr class="table_head">
        <td class="td_head_right"></td>
        <td>Задачи по вашему запросу отсутствуют.</td>
        <td class="td_head_left"></td>
    </tr>
</table>
<?php endif ?>
<table width="920" cellpadding="0" cellspacing="0">
    <tr class="table_head">
        <td class="td_head_right">Новая задача</td>
        <td class="td_head_left"></td>
        <td colspan="4" style="background: #ffffff"></td>
    </tr>
    <tr>
        <?= form_open() ?>
        <td>
            <select name="todo_cat">
                <option value="">Тип задачи</option>
                <?php foreach ($todo_cat_items as $todo_cat): ?>
                <option value="<?= $todo_cat->todo_cat_id ?>"><?= $todo_cat->description ?></option>
                <?php endforeach ?>
            </select>
            <?= form_error('todo_cat') ?>
        </td>
        <td>
            <select name="todo_status">
                <option value="">Состояние</option>
                <?php foreach ($todo_status_items as $todo_status): ?>
                <option value="<?= $todo_status->todo_status_id ?>"><?= $todo_status->description ?></option>
                <?php endforeach ?>
            </select>
            <?= form_error('todo_status') ?>
        </td>
        <td>
            <input type="text" size="94" name="description" value=""/>
            <?= form_error('description') ?>
        </td>
        <td>
            <input type="submit" name="create" value="Новая задача"/>
        </td>
        <td></td>
        <td></td>
        <?= form_close() ?>
    </tr>
</table>