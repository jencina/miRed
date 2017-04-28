<div class="text-center card-box">
    <div class="member-card">
        <div class="thumb-xl member-thumb m-b-10 center-block">
            <img src="<?= Yii::getAlias('@web'); ?>/admin-theme/images/users/avatar-1.jpg" class="img-circle img-thumbnail" alt="profile-image">
        </div>

        <div class="">
            <h4 class="m-b-5">Mark A. McKnight</h4>
            <p class="text-muted">@webdesigner</p>
        </div>

        <?= Html::a('Editar', ['update'], ['class' => 'btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light']) ?>
        <?= Html::a('Eliminar', ['delete'], ['class' => 'btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light']) ?>

        <div class="text-left m-t-40">
            <p class="text-muted font-13"><strong>Nombre :</strong> <span class="m-l-15"><?= $model->emp_nombre ?></span></p>
            <p class="text-muted font-13"><strong>Direccion :</strong><span class="m-l-15"><?= $model->emp_direccion; ?></span></p>
            <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">coderthemes@gmail.com</span></p>
            <p class="text-muted font-13"><strong>Region :</strong> <span class="m-l-15">USA</span></p>
            <p class="text-muted font-13"><strong>Ciudad :</strong> <span class="m-l-15">USA</span></p>
            <p class="text-muted font-13"><strong>Fecha Creacion :</strong> <span class="m-l-15"><?= $model->emp_fechacreacion; ?></span></p>
        </div>

        <ul class="social-links list-inline m-t-30">
            <li>
                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
            </li>
            <li>
                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
            </li>
            <li>
                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a>
            </li>
        </ul>
    </div>
</div> <!-- end card-box -->