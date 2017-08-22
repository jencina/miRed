<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "conversacion_tipo".
 *
 * @property integer $tipo_id
 * @property string $tipo_nombre
 *
 * @property Conversacion[] $conversacions
 */
class ConversacionTipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conversacion_tipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_nombre'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tipo_id' => 'Tipo ID',
            'tipo_nombre' => 'Tipo Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConversacions()
    {
        return $this->hasMany(Conversacion::className(), ['tipo_id' => 'tipo_id']);
    }
}
