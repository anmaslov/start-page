<h3><?=Yii::t('app', 'ROLES_TYPE')?></h3>

<div class="row">
    <div class="col-md-3">
        <ul class="list-group">
            <?foreach($model as $item):?>
                <li class="list-group-item">
                    <span class="badge"><?=$item->description?></span>
                    <?=$item->name?>
                </li>
            <?endforeach?>
        </ul>
    </div>
</div>

<?= $this->render('_back') ?>