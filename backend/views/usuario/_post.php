<div class="col-lg-12">
    <div class="portlet panel panel-<?= $model->mod->mod_color?> panel-border">
        <div class="portlet-heading portlet-default panel-heading">
            <h3 class="portlet-title text-dark">
                <span class="dropcap text-<?= $model->mod->mod_color?>"><?= substr($model->mod->mod_nombre, 0,1)?></span> Default Heading
            </h3>

            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default" class="" aria-expanded="true"><i class="ion-minus-round"></i></a>
                <span class="divider"></span>
                <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div id="bg-default" class="panel-collapse collapse in" aria-expanded="true">

            <div class="portlet-body">
                <dl class="dl-horizontal m-b-0">
                    <?php foreach($model->moduloPostHasModuloRegistros as $reg):?>
                        <dt>
                           <?= $reg->modReg->mod_reg_nombre?>
                        </dt>
                        <dd>
                           <?= $reg->contenido?>
                        </dd>
                    <?php endforeach;?>
                </dl>

            </div>

        </div>
    </div>
</div>
