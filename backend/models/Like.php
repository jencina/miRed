<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "like".
 *
 * @property string $con_id
 * @property string $usu_id
 * @property string $fechacreacion
 *
 * @property Conversacion $con
 * @property Usuario $usu
 */
class Like extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'like';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['con_id', 'usu_id', 'fechacreacion'], 'required'],
            [['con_id', 'usu_id'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['con_id'], 'exist', 'skipOnError' => true, 'targetClass' => Conversacion::className(), 'targetAttribute' => ['con_id' => 'con_id']],
            [['usu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usu_id' => 'usu_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'con_id' => 'Con ID',
            'usu_id' => 'Usu ID',
            'fechacreacion' => 'Fechacreacion',
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
    public function getUsu()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'usu_id']);
    }
}
