<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property string $usu_id
 * @property string $usu_nombre
 * @property string $usu_apellido
 * @property string $usu_email
 * @property string $usu_direccion
 * @property string $usu_imagen
 * @property string $usu_cargo
 * @property string $usu_username
 * @property string $usu_password
 * @property string $usu_fechacreacion
 * @property string $usu_fechamodificacion
 * @property integer $usu_activo
 * @property integer $emp_id
 * @property string $dep_id
 *
 * @property GrupoHasUsuario[] $grupoHasUsuarios
 * @property Grupo[] $grupos
 * @property ModuloPost[] $moduloPosts
 * @property ModuloPostComentario[] $moduloPostComentarios
 * @property Departamento $dep
 * @property Empresa $emp
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usu_fechacreacion', 'usu_fechamodificacion'], 'safe'],
            [['usu_activo', 'emp_id', 'dep_id'], 'integer'],
            [['emp_id'], 'required'],
            [['usu_nombre', 'usu_apellido', 'usu_direccion'], 'string', 'max' => 255],
            [['usu_email', 'usu_cargo', 'usu_username', 'usu_password'], 'string', 'max' => 100],
            [['usu_imagen'], 'string', 'max' => 200],
            [['dep_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['dep_id' => 'dep_id']],
            [['emp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['emp_id' => 'emp_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usu_id' => Yii::t('app', 'Usu ID'),
            'usu_nombre' => Yii::t('app', 'Usu Nombre'),
            'usu_apellido' => Yii::t('app', 'Usu Apellido'),
            'usu_email' => Yii::t('app', 'Usu Email'),
            'usu_direccion' => Yii::t('app', 'Usu Direccion'),
            'usu_imagen' => Yii::t('app', 'Usu Imagen'),
            'usu_cargo' => Yii::t('app', 'Usu Cargo'),
            'usu_username' => Yii::t('app', 'Usu Username'),
            'usu_password' => Yii::t('app', 'Usu Password'),
            'usu_fechacreacion' => Yii::t('app', 'Usu Fechacreacion'),
            'usu_fechamodificacion' => Yii::t('app', 'Usu Fechamodificacion'),
            'usu_activo' => Yii::t('app', 'Usu Activo'),
            'emp_id' => Yii::t('app', 'Emp ID'),
            'dep_id' => Yii::t('app', 'Dep ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoHasUsuarios()
    {
        return $this->hasMany(GrupoHasUsuario::className(), ['usuario_id' => 'usu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(Grupo::className(), ['grupo_id' => 'grupo_id'])->viaTable('grupo_has_usuario', ['usuario_id' => 'usu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuloPosts()
    {
        return $this->hasMany(ModuloPost::className(), ['mod_post_asignado_usu_id' => 'usu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuloPostComentarios()
    {
        return $this->hasMany(ModuloPostComentario::className(), ['com_usuario_id' => 'usu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDep()
    {
        return $this->hasOne(Departamento::className(), ['dep_id' => 'dep_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmp()
    {
        return $this->hasOne(Empresa::className(), ['emp_id' => 'emp_id']);
    }
}
