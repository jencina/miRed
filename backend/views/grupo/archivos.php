<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Grupo */

$this->title = 'Update Grupo: ' . $model->grupo_id;
$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', ucwords(strtolower($model->grupo_nombre))), 'url' => ['view', 'id' => $model->grupo_id]];
$this->params['breadcrumbs'][] = 'Configuracion';
$this->params['tittle'] = 'Grupo';
?>

<?= $this->render('_header',['model'=>$model]);?>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-border panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Archivos Grupo</h3>
            </div>
            <div class="panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'tableOptions'=>['class'=>'table table-striped m-0'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'file_nombre',
                        'file_tipo',
                        'file_size',
                        'usu_id',
                        'file_fechamodificacion'
                    ],
                ]); ?>
                
            </div>
        </div>
    </div>  
    
    <div class="col-md-4">
        <div class="panel panel-border panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Subir Archivo</h3>
            </div>
            <div class="panel-body">
                <form action="<?= Url::to(['grupo/uploadfiles']) ?>" id="frmdropzone" class="dropzone">
                    <input type="hidden" name="periodo" id="periododrop" required value="">
                </form>
            </div>
        </div>
    </div>  
    
    
</div>


<?php 

$this->registerJsFile(Yii::getAlias('@web') . '/plugins/dropzone/dropzone.js', ['depends' => [\backend\assets\AdminAsset::className()]]);
$this->registerCssFile(Yii::getAlias('@web') . '/plugins/dropzone/dropzone.css', ['depends' => [\backend\assets\AdminAsset::className()]]);

$this->registerJs(<<<JS

   $(document).ready(function () {
        $("#optperiodo").change(function () {
            $("#periododrop").val(this.value);
        });
        
        var msg = "<br><br>";
        var myDropzone = new Dropzone("#frmdropzone", {maxFilesize: 100, acceptedFiles: '.pdf,.jpg,.jpeg,.png,.gif'});
        myDropzone.on("complete", function (file, response, xhr) {
            if (file.status != 'error') {
                var json = JSON.parse(response);
                if (json.error) {
                    msg += "* " + json.text + "<br>";
                } else if (json.text != undefined) {
                    alertify.success(json.text);
                    msg += "* " + json.text + "<br>";
                    
                }
            } else {
                alertify.set('notifier', 'position', 'bottom-left');
                alertify.error(response + ". Archivo: " + file.name, 15);
                msg += "* " + response + ". Archivo: " + file.name;
            }
            setTimeout(function () {
                myDropzone.removeFile(file);
            }, 5000);

            if (this.getQueuedFiles().length === 0 && this.getUploadingFiles().length === 0) {
                alertify.success("Carga Completada");
                alertify.alert().set({'startMaximized': true, 'title': '<h1>Resumen Carga Masiva</h1>', 'message': msg}).show();
                msg = "<br><br>";
                tablaDespacho();
            }

        });
    });
        
JS
);

?>
