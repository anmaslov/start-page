<h3>Виды ролей</h3>

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