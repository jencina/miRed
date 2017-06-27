<?php
use yii\helpers\ArrayHelper;
?>
<div class="col-md-12 reg" data-posicion="<?= $i;?>">
    <div class="col-md-5">
        <?= $form->field($reg, 'mod_reg_nombre')->textInput(['name'=>"ModuloRegistro[{$i}][mod_reg_nombre]",'maxlength' => true]) ?>
    </div>
    <div class="col-md-5">
            <?= $form->field($reg, 'mod_reg_tipo_id')->dropDownList(ArrayHelper::map(app\models\ModuloRegistroTipo::find()->all(), 'reg_tipo_id', 'reg_tipo_nombre'),['name'=>"ModuloRegistro[{$i}][mod_reg_tipo_id]"]) ?>
    </div>
    <div class="col-md-2">
        <?= yii\bootstrap\Html::a('eliminar',null,['class'=>'btn btn-danger','onclick'=>'js:$(this).parent().parent().remove();']);?>
    </div>
    

    <?= $form->field($reg, 'mod_reg_posicion')->hiddenInput(['value'=>$i,'name'=>"ModuloRegistro[{$i}][mod_reg_posicion]"])->label(false); ?> 
</div>