<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Empresas');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'] = $this->title;
?>


<div class="panel panel-border panel-purple">
    <div class="panel-heading">
        <h3 class="panel-title">
            Mantenedor
            <div class="btn-group dropdown-btn-group pull-right">
                <?= Html::a(Yii::t('app', 'Create Empresa'), ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </h3>
    </div>
    <div class="panel-body">
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                'emp_id',
                'emp_nombre',
                'emp_direccion',
                'emp_activo',
                'emp_fechacreacion',
                // 'emp_fechamodificacion',
                // 'adm_id',
                ['class' => 'yii\grid\ActionColumn',
                    /*'template'=>'{mod} {view} {update} {delete}',
                    'buttons'=> [
                        
                        'view' => function ($url, $model) {
                            return Html::a('<i class="material-icons">account_circle</i>', $url, [
                                        'title' => Yii::t('yii', 'ver Usuario'),
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<i class="material-icons">remove_red_eye</i>', $url, [
                                        'title' => Yii::t('yii', 'Editar Usuario'),
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<i class="material-icons">delete</i>', $url, [
                                        'title' => Yii::t('yii', 'Eliminar Usuario'),
                            ]);
                        }
                    ]*/
                ],
        ],
    ]); ?>
    </div>
</div>
