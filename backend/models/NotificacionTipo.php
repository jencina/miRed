<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "notificacion_tipo".
 *
 * @property integer $tipo_id
 * @property string $tipo_nombre
 *
 * @property Notificacion[] $notificacions
 */
class NotificacionTipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notificacion_tipo';
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
    public function getNotificacions()
    {
        return $this->hasMany(Notificacion::className(), ['not_tipo' => 'tipo_id']);
    }
}
