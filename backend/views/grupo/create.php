<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Grupo */

$this->title = 'Create Grupo';
$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
