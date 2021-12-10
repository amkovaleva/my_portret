<div id="modal-del" class="modal" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=  Yii::t('app/carts', 'del_title') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?=  Yii::t('app/carts', 'del_question') ?><span></span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"><?=  Yii::t('app/carts', 'delete') ?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=  Yii::t('app/carts', 'cancel') ?></button>
            </div>
        </div>
    </div>
</div>