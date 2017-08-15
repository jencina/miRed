<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "like".
 *
 * @property integer $like_id
 * @property string $like_fechacreacion
 * @property string $usu_id
 * @property string $con_id
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
            [['like_fechacreacion'], 'safe'],
            [['usu_id', 'con_id'], 'required'],
            [['usu_id', 'con_id'], 'integer'],
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
            'like_id' => 'Like ID',
            'like_fechacreacion' => 'Like Fechacreacion',
            'usu_id' => 'Usu ID',
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
    public function getUsu()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'usu_id']);
    }
}
