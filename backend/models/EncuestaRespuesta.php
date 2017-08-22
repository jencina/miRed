<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "encuesta_respuesta".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $fechacreacion
 * @property string $con_id
 *
 * @property Conversacion $con
 * @property EncuestaRespuestaHasUsuario[] $encuestaRespuestaHasUsuarios
 * @property Usuario[] $usuarioUsus
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
            [['con_id'], 'required'],
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
            'id' => 'ID',
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
        return $this->hasMany(EncuestaRespuestaHasUsuario::className(), ['encuesta_respuesta_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioUsus()
    {
        return $this->hasMany(Usuario::className(), ['usu_id' => 'usuario_usu_id'])->viaTable('encuesta_respuesta_has_usuario', ['encuesta_respuesta_id' => 'id']);
    }
}
