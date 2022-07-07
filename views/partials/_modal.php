
<div class="shim" <?= (isset($hidden) && $hidden) ? 'style="display:none"' : ''?> >
    <div class="modal">
        <div class="modal__heading"><?= $title ?></div>
        <div class="modal__content">
            <?= $message ?>
        </div>
        <button class="modal__close button"><?= $button ?></button>
    </div>
</div>
