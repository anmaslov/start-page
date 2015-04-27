<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\editable\Editable;

$url = 'settings/user';

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = "Редактирование пользователя #$model->id";
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="row">
        <div class="col-md-5">
            <table class="table table-striped table-bordered detail-view">
                <tbody>

                <tr>
                    <th>Ip адрес:</th>
                    <td><?=$model->ip?></td>
                </tr>

                <tr>
                    <th>Визуальное оформление:</th>
                    <td>
                        <?= Editable::widget( [
                            'model' => $model,
                            'attribute' => 'style',
                            'url' => $url,
                            'mode' => 'pop',
                            'type' => 'select2',
                            'clientOptions' => [
                                'pk' => $model->id,
                                'autotext' => 'always',
                                'placement' => 'right',
                                'select2' => [
                                    'width' => '200px'
                                ],
                                'value' => $model->style,
                                'source' => \app\models\Style::getStyleArray(),
                            ]
                        ]);?>
                    </td>
                </tr>

                <tr>
                    <th>Псевдоним</th>
                    <td>
                        <?= Editable::widget( [
                            'model' => $model,
                            'attribute' => 'username',
                            'url' => $url,
                            'mode' => 'pop',
                        ]);?>
                    </td>
                </tr>

                <tr>
                    <th>Фамилия</th>
                    <td>
                        <?= Editable::widget( [
                            'model' => $model,
                            'attribute' => 'fa',
                            'url' => $url,
                            'mode' => 'pop',
                            'clientOptions' => [
                                'title' => 'Введите фамилию',
                                'emptytext' => 'Не задано'
                            ]
                        ]);?>
                    </td>
                </tr>

                <tr>
                    <th>Имя</th>
                    <td>
                        <?= Editable::widget( [
                            'model' => $model,
                            'attribute' => 'im',
                            'url' => $url,
                            'mode' => 'pop',
                            'clientOptions' => [
                                'emptytext' => 'Не задано'
                            ]
                        ]);?>
                    </td>
                </tr>

                <tr>
                    <th>Отчество</th>
                    <td>
                        <?= Editable::widget( [
                            'model' => $model,
                            'attribute' => 'ot',
                            'url' => $url,
                            'mode' => 'pop',
                            'clientOptions' => [
                                'emptytext' => 'Не задано'
                            ]
                        ]);?>
                    </td>
                </tr>

                <tr>
                    <th>Дата рождения</th>
                    <td>
                        <?= Editable::widget( [
                            'model' => $model,
                            'attribute' => 'dr',
                            'type' => 'date',
                            'url' => $url,
                            'mode' => 'pop',
                            'clientOptions' => [
                                'emptytext' => 'Не задано',
                                'format' => 'yyyy-mm-dd',
                                'viewformat' => 'dd.mm.yyyy',
                                'datetimepicker' => [
                                    'orientation' => 'top auto'
                                ]
                            ]
                        ]);?>
                    </td>
                </tr>

                </tbody>

            </table>
        </div>
    </div>

    <p>        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить пользователя?',
                'method' => 'post',
            ],
        ]) ?>


    </p>
</div>
