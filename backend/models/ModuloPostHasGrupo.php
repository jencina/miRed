<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "modulo_post_has_grupo".
 *
 * @property string $mod_post_id
 * @property string $grupo_id
 *
 * @property Grupo $grupo
 * @property ModuloPost $modPost
 */
class ModuloPostHasGrupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modulo_post_has_grupo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mod_post_id', 'grupo_id'], 'required'],
            [['mod_post_id', 'grupo_id'], 'integer'],
            [['grupo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Grupo::className(), 'targetAttribute' => ['grupo_id' => 'grupo_id']],
            [['mod_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModuloPost::className(), 'targetAttribute' => ['mod_post_id' => 'mod_post_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mod_post_id' => 'Mod Post ID',
            'grupo_id' => 'Grupo ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupo()
    {
        return $this->hasOne(Grupo::className(), ['grupo_id' => 'grupo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModPost()
    {
        return $this->hasOne(ModuloPost::className(), ['mod_post_id' => 'mod_post_id']);
    }
}
