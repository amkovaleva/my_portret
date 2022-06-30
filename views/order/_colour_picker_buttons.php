
<?php foreach ($colours_list as $key => $item) { ?>
    <label class="color-picker__item" style="background-color: <?= $item[0] ?>;">
        <input class="color-picker__widget" type="radio" name="CartItem[<?= $field_name ?>]" value="<?= $key ?>"
            <?= ($model->$field_name == $key) ? 'checked' : '' ?>>
        <span class="color-picker__label"> <?= $item[1] ?></span>
    </label>
<?php } ?>
