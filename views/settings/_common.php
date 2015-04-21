<?php
use dosamigos\editable\Editable;

$url = 'settings/user';
?>
<h3>Редактирование информации:</h3>

<blockquote>
    <p>Важная информация</p>
    <footer>При смене стиля оформления - необходимо перезагруть страницу.</footer>
</blockquote>

<div class="row">
    <div class="col-md-5">
            <table class="table table-striped table-bordered detail-view">
                <tbody>

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

        <div class="alert alert-warning">При смене визуального оформления, работоспособность
            в internet explorer 8 и ниже - <b>не гарантируется</b></div>

    </div>
</div>

