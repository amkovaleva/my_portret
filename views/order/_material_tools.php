
<?php foreach ($availableMaterials as $key => $item) { ?>
    <label class="materials__tool">
        <input class="materials__widget" type="radio" name="CartItem[material_id]" value="<?= $key ?>"
            <?= ($model->material_id == $key) ? 'checked' : '' ?>>
        <span class="materials__button"><?= $item ?></span>
    </label>
<?php } ?>
