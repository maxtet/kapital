<td>
    <select id="todo_cat<?= $todo->todo_id ?>">
        <?php foreach ($todo_cat_items as $todo_cat): ?>
        <?php $selected = ($todo_cat->todo_cat_id == $todo->todo_cat_id) ? 'selected = "selected"' : '' ?>
        <option value="<?= $todo_cat->todo_cat_id ?>" <?= $selected ?> >
            <?= $todo_cat->description ?>
        </option>
        <?php endforeach ?>
    </select>
</td>
<td><textarea rows="2" cols="45" id="description<?= $todo->todo_id ?>"><?= $todo->description ?></textarea></td>
<td>
    <select id="todo_status<?= $todo->todo_id ?>">
        <?php foreach ($todo_status_items as $todo_status): ?>
        <?php $selected = ($todo_status->todo_status_id == $todo->todo_status_id) ? 'selected = "selected"'
                : '' ?>
        <option value="<?= $todo_status->todo_status_id ?>"><?= $todo_status->description ?></option>
        <?php endforeach ?>
    </select>
</td>
<td><?= $todo->date_create ?></td>
<td><?= $todo->timestamp ?></td>
<td><input type="submit" id="<?= $todo->todo_id ?>" name="edit" value="Изменить"/></td>