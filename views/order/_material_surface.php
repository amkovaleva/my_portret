
<?php foreach ($model->availableBases as $key => $item) { ?>
    <label class="materials__surface">
        <input class="materials__widget" type="radio" name="CartItem[base_id]" value="<?= $key ?>" <?= ($model->base_id == $key) ? 'checked' : '' ?>>
        <span class="materials__tab"><?= $item ?></span>
    </label>
<?php } ?>
