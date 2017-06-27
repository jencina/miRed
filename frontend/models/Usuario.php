<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property string $usu_id
 * @property integer $emp_id
 * @property string $dep_id
 * @property string $usu_nombre
 * @property string $usu_apellido
 * @property string $usu_email
 * @property string $usu_direccion
 * @property string $usu_imagen
 * @property string $usu_cargo
 * @property string $usu_password_hash
 * @property string $usu_password_reset_token
 * @property integer $usu_status
 * @property string $usu_auth_key
 * @property string $usu_fechacreacion
 * @property string $usu_fechamodificacion
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
            [['usu_nombre', 'usu_apellido','usu_password_hash', 'usu_email','dep_id','emp_id'], 'required'],
            [['emp_id', 'dep_id', 'usu_status'], 'integer'],
            [['usu_fechacreacion', 'usu_fechamodificacion'], 'safe'],
            [['usu_nombre', 'usu_apellido', 'usu_direccion'], 'string', 'max' => 255],
            [['usu_email', 'usu_cargo', 'usu_password_hash', 'usu_password_reset_token'], 'string', 'max' => 100],
            [['usu_imagen'], 'string', 'max' => 200],
            [['usu_auth_key'], 'string', 'max' => 45],
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
            'emp_id' => Yii::t('app', 'Emp ID'),
            'dep_id' => Yii::t('app', 'Dep ID'),
            'usu_nombre' => Yii::t('app', 'Nombre'),
            'usu_apellido' => Yii::t('app', 'Apellido'),
            'usu_email' => Yii::t('app', 'Email'),
            'usu_direccion' => Yii::t('app', 'Direccion'),
            'usu_imagen' => Yii::t('app', 'Imagen'),
            'usu_cargo' => Yii::t('app', 'Cargo'),
            'usu_password_hash' => Yii::t('app', 'Password'),
            'usu_password_reset_token' => Yii::t('app', 'Usu Password Reset Token'),
            'usu_status' => Yii::t('app', 'Usu Status'),
            'usu_auth_key' => Yii::t('app', 'Usu Auth Key'),
            'usu_fechacreacion' => Yii::t('app', 'Usu Fechacreacion'),
            'usu_fechamodificacion' => Yii::t('app', 'Usu Fechamodificacion'),
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
