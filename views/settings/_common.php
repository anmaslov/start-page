<?php
use dosamigos\editable\Editable;

$url = 'settings/user';
?>
<h3><?=Yii::t('app', 'SETTINGS_PERSONAL')?>:</h3>

<blockquote>
    <p><?=Yii::t('app', 'WARNING_INFO')?></p>
    <footer><?=Yii::t('app', 'WARNING_DESCRIPTION')?></footer>
</blockquote>

<div class="row">
    <div class="col-md-5">
            <table class="table table-striped table-bordered detail-view">
                <tbody>

                    <tr>
                        <th><?=Yii::t('app', 'DESIGN')?></th>
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
                        <th><?=Yii::t('app', 'USER_FAMILY')?></th>
                        <td>
                            <?= Editable::widget( [
                                'model' => $model,
                                'attribute' => 'fa',
                                'url' => $url,
                                'mode' => 'pop',
                                'clientOptions' => [
                                    'emptytext' => Yii::t('app', 'NOT_SET')
                                ]
                            ]);?>
                        </td>
                    </tr>

                    <tr>
                        <th><?=Yii::t('app', 'USER_NAME')?></th>
                        <td>
                            <?= Editable::widget( [
                                'model' => $model,
                                'attribute' => 'im',
                                'url' => $url,
                                'mode' => 'pop',
                                'clientOptions' => [
                                    'emptytext' => Yii::t('app', 'NOT_SET')
                                ]
                            ]);?>
                        </td>
                    </tr>

                    <tr>
                        <th><?=Yii::t('app', 'USER_FATHER_NAME')?></th>
                        <td>
                            <?= Editable::widget( [
                                'model' => $model,
                                'attribute' => 'ot',
                                'url' => $url,
                                'mode' => 'pop',
                                'clientOptions' => [
                                    'emptytext' => Yii::t('app', 'NOT_SET')
                                ]
                            ]);?>
                        </td>
                    </tr>

                    <tr>
                        <th><?=Yii::t('app', 'BIRTH_DATE')?></th>
                        <td>
                            <?= Editable::widget( [
                                'model' => $model,
                                'attribute' => 'dr',
                                'type' => 'date',
                                'url' => $url,
                                'mode' => 'pop',
                                'clientOptions' => [
                                    'emptytext' => Yii::t('app', 'NOT_SET'),
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

        <div class="alert alert-warning">
            <?=Yii::t('app', 'WARNING_IE8')?>
        </div>

    </div>
</div>

