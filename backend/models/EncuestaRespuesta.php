<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "encuesta_respuesta".
 *
 * @property string $respuesta_id
 * @property string $nombre
 * @property string $fechacreacion
 * @property string $con_id
 *
 * @property Conversacion $con
 * @property EncuestaRespuestaHasUsuario[] $encuestaRespuestaHasUsuarios
 * @property Usuario[] $usus
 */
class EncuestaRespuesta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'encuesta_respuesta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fechacreacion'], 'safe'],
            [['nombre'], 'required','message'=>'Respuesta no puede estar vacío.'],
            //[['con_id'], 'required'],
            [['con_id'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['con_id'], 'exist', 'skipOnError' => true, 'targetClass' => Conversacion::className(), 'targetAttribute' => ['con_id' => 'con_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'respuesta_id' => 'Respuesta ID',
            'nombre' => 'Nombre',
            'fechacreacion' => 'Fechacreacion',
            'con_id' => 'Con ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCon()
    {
        return $this->hasOne(Conversacion::className(), ['con_id' => 'con_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEncuestaRespuestaHasUsuarios()
    {
        return $this->hasMany(EncuestaRespuestaHasUsuario::className(), ['respuesta_id' => 'respuesta_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsus()
    {
        return $this->hasMany(Usuario::className(), ['usu_id' => 'usu_id'])->viaTable('encuesta_respuesta_has_usuario', ['respuesta_id' => 'respuesta_id']);
    }
}
