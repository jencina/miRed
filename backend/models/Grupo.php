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
 *
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
            [['grup_publico'], 'integer'],
            [['grupo_fechacreacion', 'grupo_fechamodificacion'], 'safe'],
            [['grupo_nombre'], 'string', 'max' => 100],
            [['grupo_descripcion', 'grupo_color'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'grupo_id' => 'ID',
            'grupo_nombre' => 'Nombre',
            'grupo_descripcion' => 'Descripcion',
            'grup_publico' => 'Publico',
            'grupo_color' => 'Color',
            'grupo_fechacreacion' => 'Fechacreacion',
            'grupo_fechamodificacion' => 'Fechamodificacion',
        ];
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
