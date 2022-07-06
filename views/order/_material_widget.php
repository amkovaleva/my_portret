
<div class="materials__<?= $main_class?>s-choice" <?=  count($list) === 1 ? 'style="display:none;"' : ''?>>
<?php foreach ($list as $key => $item) { ?>
    <label class="materials__<?= $main_class ?>">
        <input class="materials__widget" type="radio" name="CartItem[<?= $field_name ?>]" value="<?= $key ?>"
            <?= ($model->$field_name == $key) ? 'checked' : '' ?>>
        <span class="materials__<?= $display ?>"><?= $item ?></span>
    </label>
<?php } ?>
</div>
