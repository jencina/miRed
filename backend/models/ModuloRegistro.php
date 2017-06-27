<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "modulo_registro".
 *
 * @property string $mod_reg_id
 * @property string $mod_reg_nombre
 * @property integer $mod_reg_posicion
 * @property integer $mod_reg_tipo_id
 * @property string $mod_reg_mod_id
 * @property string $mod_reg_fechacreacion
 * @property string $mod_reg_fechamodificacion
 *
 * @property ModuloPostHasModuloRegistro[] $moduloPostHasModuloRegistros
 * @property ModuloPost[] $modPosts
 * @property Modulo $modRegMod
 * @property ModuloRegistroTipo $modRegTipo
 */
class ModuloRegistro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modulo_registro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mod_reg_posicion', 'mod_reg_tipo_id', 'mod_reg_mod_id'], 'integer'],
            [['mod_reg_tipo_id', 'mod_reg_mod_id'], 'required'],
            [['mod_reg_fechacreacion', 'mod_reg_fechamodificacion'], 'safe'],
            [['mod_reg_nombre'], 'string', 'max' => 100],
            [['mod_reg_mod_id'], 'exist', 'skipOnError' => true, 'targetClass' => Modulo::className(), 'targetAttribute' => ['mod_reg_mod_id' => 'mod_id']],
            [['mod_reg_tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModuloRegistroTipo::className(), 'targetAttribute' => ['mod_reg_tipo_id' => 'reg_tipo_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mod_reg_id' => 'Mod Reg ID',
            'mod_reg_nombre' => 'Mod Reg Nombre',
            'mod_reg_posicion' => 'Mod Reg Posicion',
            'mod_reg_tipo_id' => 'Mod Reg Tipo ID',
            'mod_reg_mod_id' => 'Mod Reg Mod ID',
            'mod_reg_fechacreacion' => 'Mod Reg Fechacreacion',
            'mod_reg_fechamodificacion' => 'Mod Reg Fechamodificacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuloPostHasModuloRegistros()
    {
        return $this->hasMany(ModuloPostHasModuloRegistro::className(), ['mod_reg_id' => 'mod_reg_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModPosts()
    {
        return $this->hasMany(ModuloPost::className(), ['mod_post_id' => 'mod_post_id'])->viaTable('modulo_post_has_modulo_registro', ['mod_reg_id' => 'mod_reg_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModRegMod()
    {
        return $this->hasOne(Modulo::className(), ['mod_id' => 'mod_reg_mod_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModRegTipo()
    {
        return $this->hasOne(ModuloRegistroTipo::className(), ['reg_tipo_id' => 'mod_reg_tipo_id']);
    }
}
