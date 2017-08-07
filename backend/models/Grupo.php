<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "grupo".
 *
 * @property string $grupo_id
 * @property string $grupo_nombre
 * @property string $grupo_descripcion
 * @property integer $grup_publico
 * @property string $grupo_color
 * @property string $grupo_fechacreacion
 * @property string $grupo_fechamodificacion
 * @property integer $grupo_activo
 * @property integer $emp_id
 * @property string $usu_id_create
 * @property string $grupo_admin
 *
 * @property Empresa $emp
 * @property Usuario $usuIdCreate
 * @property Usuario $grupoAdmin
 * @property GrupoHasUsuario[] $grupoHasUsuarios
 * @property Usuario[] $usuarios
 * @property ModuloPostHasGrupo[] $moduloPostHasGrupos
 * @property ModuloPost[] $modPosts
 */
class Grupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emp_id','grup_publico','grupo_nombre','grupo_descripcion'], 'required'],
            [['grup_publico', 'grupo_activo', 'emp_id', 'usu_id_create', 'grupo_admin'], 'integer'],
            [['grupo_fechacreacion', 'grupo_fechamodificacion'], 'safe'],
            [['grupo_nombre'], 'string', 'max' => 100],
            [['grupo_descripcion', 'grupo_color'], 'string', 'max' => 45],
            [['emp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['emp_id' => 'emp_id']],
            [['usu_id_create'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usu_id_create' => 'usu_id']],
            [['grupo_admin'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['grupo_admin' => 'usu_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'grupo_id' => 'Grupo ID',
            'grupo_nombre' => 'Nombre',
            'grupo_descripcion' => 'Descripcion',
            'grup_publico' => 'Publico',
            'grupo_color' => 'Color',
            'grupo_fechacreacion' => 'Fechacreacion',
            'grupo_fechamodificacion' => 'Fechamodificacion',
            'grupo_activo' => 'Activo',
            'emp_id' => 'ID',
            'usu_id_create' => 'Usu Id Create',
            'grupo_admin' => 'Administrador',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmp()
    {
        return $this->hasOne(Empresa::className(), ['emp_id' => 'emp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuIdCreate()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'usu_id_create']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoAdmin()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'grupo_admin']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoHasUsuarios()
    {
        return $this->hasMany(GrupoHasUsuario::className(), ['grupo_id' => 'grupo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['usu_id' => 'usuario_id'])->viaTable('grupo_has_usuario', ['grupo_id' => 'grupo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuloPostHasGrupos()
    {
        return $this->hasMany(ModuloPostHasGrupo::className(), ['grupo_id' => 'grupo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModPosts()
    {
        return $this->hasMany(ModuloPost::className(), ['mod_post_id' => 'mod_post_id'])->viaTable('modulo_post_has_grupo', ['grupo_id' => 'grupo_id']);
    }
}
