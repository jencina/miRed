<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "modulo_post_has_modulo_registro".
 *
 * @property string $mod_post_id
 * @property string $mod_reg_id
 * @property string $contenido
 *
 * @property ModuloPost $modPost
 * @property ModuloRegistro $modReg
 */
class ModuloPostHasModuloRegistro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modulo_post_has_modulo_registro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mod_post_id', 'mod_reg_id'], 'required'],
            [['mod_post_id', 'mod_reg_id'], 'integer'],
            [['contenido'], 'string', 'max' => 45],
            [['mod_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModuloPost::className(), 'targetAttribute' => ['mod_post_id' => 'mod_post_id']],
            [['mod_reg_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModuloRegistro::className(), 'targetAttribute' => ['mod_reg_id' => 'mod_reg_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mod_post_id' => 'Mod Post ID',
            'mod_reg_id' => 'Mod Reg ID',
            'contenido' => 'Contenido',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModPost()
    {
        return $this->hasOne(ModuloPost::className(), ['mod_post_id' => 'mod_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModReg()
    {
        return $this->hasOne(ModuloRegistro::className(), ['mod_reg_id' => 'mod_reg_id']);
    }
}
