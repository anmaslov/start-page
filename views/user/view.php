<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\editable\Editable;

$url = 'settings/user';

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'USER_EDIT {model}', ['model' => $model->id]);
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
                    <th><?=Yii::t('app', 'IP_ADDRESS')?>:</th>
                    <td><?=$model->ip?></td>
                </tr>

                <tr>
                    <th><?=Yii::t('app', 'DESIGN')?>:</th>
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
                    <th><?=Yii::t('app', 'NICKNAME')?></th>
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
                    <th><?=Yii::t('app', 'USER_FAMILY')?>:</th>
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
                    <th><?=Yii::t('app', 'USER_NAME')?>:</th>
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
                    <th><?=Yii::t('app', 'USER_FATHER_NAME')?>:</th>
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
                    <th><?=Yii::t('app', 'BIRTH_DATE')?>:</th>
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

        <div class="col-md-6">
            <?= $this->render('_roles', [
                'model' => $model,
            ]) ?>
        </div>

    </div>

    <p>        <?= Html::a(Yii::t('app', 'BUTTON_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'USER_DELETE_CONFIRMATION'),
                'method' => 'post',
            ],
        ]) ?>


    </p>
</div>
