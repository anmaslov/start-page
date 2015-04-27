<?php

use app\assets\UserAsset;
UserAsset::register($this);
?>

<h4>Назначение ролей пользователю</h4>
<!--
<div class="row">
    <div class="col-md-10">
        <div class="alert alert-warning">Плохая идея - редактировать роли у самого себя!</div>
    </div>
</div>-->

<div class="row">
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                Назначеные роли
            </div>
            <ul class="list-group list-link" id="rolesExist">
                <?foreach(Yii::$app->authManager->getRolesByUser($model->id) as $role):?>
                    <?$rolesEx[] = $role->name;?>
                    <li class="list-group-item" id="role_<?=$role->name?>"><?=$role->description?></li>
                <?endforeach?>
            </ul>
        </div>
    </div>

    <div class="col-md-5">
        <div class="panel panel-danger">
            <div class="panel-heading">
                Доступные роли
            </div>
            <ul class="list-group list-link" id="rolesAll">
                <?foreach(Yii::$app->authManager->getRoles() as $role):?>
                    <?if(!in_array($role->name, $rolesEx)):?>
                        <li class="list-group-item" id="role_<?=$role->name?>"><?=$role->description?></li>
                    <?endif?>
                <?endforeach?>
            </ul>
        </div>
    </div>
</div>

<blockquote>
    <p>Подсказка</p>
    <footer>Для назначения/удаления ролей пользователю - достаточно перетащить нужные роли в соответсвующие столбцы.</footer>
</blockquote>

<script type="text/javascript">
    $(function(){
        $( "#rolesExist, #rolesAll" ).sortable({
            connectWith: ".list-group",
            receive: function(event, ui) {
                var newIndex = ui.item.attr('id');
                console.log(newIndex);
            },
            // Likewise, use the .remove event to *delete* the item from its origin list
            remove: function(event, ui) {
                var oldIndex = ui.item.index();
                //console.log(oldIndex);
            }
        }).disableSelection();

    });
</script>