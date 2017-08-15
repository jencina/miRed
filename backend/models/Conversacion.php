<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "conversacion".
 *
 * @property string $con_id
 * @property string $con_fechacreacion
 * @property string $con_fechamodificacion
 * @property string $con_contenido
 * @property string $grupo_id
 * @property string $usu_id
 *
 * @property Grupo $grupo
 * @property Usuario $usu
 * @property Like[] $likes 
 */
class Conversacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conversacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['con_fechacreacion', 'con_fechamodificacion'], 'safe'],
            [['con_contenido'], 'string'],
            [['grupo_id'], 'required'],
            [['grupo_id', 'usu_id'], 'integer'],
            [['grupo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Grupo::className(), 'targetAttribute' => ['grupo_id' => 'grupo_id']],
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
            'con_fechacreacion' => 'Con Fechacreacion',
            'con_fechamodificacion' => 'Con Fechamodificacion',
            'con_contenido' => 'Con Contenido',
            'grupo_id' => 'Grupo ID',
            'usu_id' => 'Usu ID',
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
    public function getUsu()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'usu_id']);
    }
    
    public function getLikes() 
    { 
       return $this->hasMany(Like::className(), ['con_id' => 'con_id']); 
    } 
}
