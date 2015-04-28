<?php

use app\assets\UserAsset;
use yii\helpers\Url;

UserAsset::register($this);

$rolesEx = [];
?>

<h4>Назначение ролей пользователю</h4>

<?if($model->id == \Yii::$app->user->id):?>
    <div class="row">
        <div class="col-md-10">
            <div class="alert alert-warning">Плохая идея - редактировать роли у самого себя!</div>
        </div>
    </div>
<?endif?>

<div class="row">
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                Назначеные роли
            </div>
            <ul class="list-group list-link" id="rolesExist">
                <?foreach(Yii::$app->authManager->getRolesByUser($model->id) as $role):?>
                    <?$rolesEx[] = $role->name;?>
                    <li class="list-group-item" id="<?=$role->name?>"><?=$role->description?></li>
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
                        <li class="list-group-item" id="<?=$role->name?>"><?=$role->description?></li>
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
        $( "#rolesExist" ).sortable({
            connectWith: ".list-group",
            receive: function(event, ui) {
                var roleId = ui.item.attr('id');
                console.log(roleId);
                $.get('<?=Url::toRoute(['add-role', 'user' => $model->id])?>', {role: roleId},function(data){
                    //console.log(data);
                },"json");
            },
            remove: function(event, ui) {
                var roleId = ui.item.attr('id');
                //console.log(oldIndex);
                $.get('<?=Url::toRoute(['delete-role', 'user' => $model->id])?>', {role: roleId},function(data){
                    //console.log(data);
                },"json");
            }
        }).disableSelection();

        $("#rolesAll").sortable({
            connectWith: ".list-group"
        });

    });
</script>