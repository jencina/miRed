<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "encuesta_respuesta_has_usuario".
 *
 * @property integer $respuesta_id
 * @property string $usu_id
 * @property string $fechacreacion
 *
 * @property EncuestaRespuesta $respuesta
 * @property Usuario $usu
 */
class EncuestaRespuestaHasUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'encuesta_respuesta_has_usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['respuesta_id', 'usu_id'], 'required'],
            [['respuesta_id', 'usu_id'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['respuesta_id'], 'exist', 'skipOnError' => true, 'targetClass' => EncuestaRespuesta::className(), 'targetAttribute' => ['respuesta_id' => 'id']],
            [['usu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usu_id' => 'usu_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'respuesta_id' => 'Respuesta ID',
            'usu_id' => 'Usu ID',
            'fechacreacion' => 'Fechacreacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuesta()
    {
        return $this->hasOne(EncuestaRespuesta::className(), ['id' => 'respuesta_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsu()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'usu_id']);
    }
}
