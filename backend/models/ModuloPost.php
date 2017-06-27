<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "modulo_post".
 *
 * @property string $mod_post_id
 * @property string $mod_post_titulo
 * @property string $mod_post_fechacreacion
 * @property string $mod_post_fechamodificacion
 * @property string $mod_post_asignado_usu_id
 * @property string $mod_id
 *
 * @property Modulo $mod
 * @property Usuario $modPostAsignadoUsu
 * @property ModuloPostComentario[] $moduloPostComentarios
 * @property ModuloPostHasGrupo[] $moduloPostHasGrupos
 * @property Grupo[] $grupos
 * @property ModuloPostHasModuloRegistro[] $moduloPostHasModuloRegistros
 * @property ModuloRegistro[] $modRegs
 */
class ModuloPost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modulo_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mod_post_fechacreacion', 'mod_post_fechamodificacion'], 'safe'],
            [['mod_post_asignado_usu_id', 'mod_id'], 'required'],
            [['mod_post_asignado_usu_id', 'mod_id'], 'integer'],
            [['mod_post_titulo'], 'string', 'max' => 100],
            [['mod_id'], 'exist', 'skipOnError' => true, 'targetClass' => Modulo::className(), 'targetAttribute' => ['mod_id' => 'mod_id']],
            [['mod_post_asignado_usu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['mod_post_asignado_usu_id' => 'usu_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mod_post_id' => 'Mod Post ID',
            'mod_post_titulo' => 'Mod Post Titulo',
            'mod_post_fechacreacion' => 'Mod Post Fechacreacion',
            'mod_post_fechamodificacion' => 'Mod Post Fechamodificacion',
            'mod_post_asignado_usu_id' => 'Mod Post Asignado Usu ID',
            'mod_id' => 'Mod ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMod()
    {
        return $this->hasOne(Modulo::className(), ['mod_id' => 'mod_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModPostAsignadoUsu()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'mod_post_asignado_usu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuloPostComentarios()
    {
        return $this->hasMany(ModuloPostComentario::className(), ['com_mod_post_id' => 'mod_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuloPostHasGrupos()
    {
        return $this->hasMany(ModuloPostHasGrupo::className(), ['mod_post_id' => 'mod_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(Grupo::className(), ['grupo_id' => 'grupo_id'])->viaTable('modulo_post_has_grupo', ['mod_post_id' => 'mod_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuloPostHasModuloRegistros()
    {
        return $this->hasMany(ModuloPostHasModuloRegistro::className(), ['mod_post_id' => 'mod_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModRegs()
    {
        return $this->hasMany(ModuloRegistro::className(), ['mod_reg_id' => 'mod_reg_id'])->viaTable('modulo_post_has_modulo_registro', ['mod_post_id' => 'mod_post_id']);
    }
}
