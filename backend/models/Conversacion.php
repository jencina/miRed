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
 * @property string $con_id_padre
 * @property integer $tipo_id
 *
 * @property Conversacion $conIdPadre
 * @property Conversacion[] $conversacions
 * @property ConversacionTipo $tipo
 * @property Grupo $grupo
 * @property Usuario $usu
 * @property EncuestaRespuesta[] $encuestaRespuestas
 * @property Like[] $likes
 * @property Usuario[] $usus
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
            [['grupo_id','con_contenido'], 'required'],
            [['grupo_id', 'usu_id', 'con_id_padre', 'tipo_id'], 'integer'],
            [['con_id_padre'], 'exist', 'skipOnError' => true, 'targetClass' => Conversacion::className(), 'targetAttribute' => ['con_id_padre' => 'con_id']],
            [['tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConversacionTipo::className(), 'targetAttribute' => ['tipo_id' => 'tipo_id']],
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
            'con_id_padre' => 'Con Id Padre',
            'tipo_id' => 'Tipo ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConIdPadre()
    {
        return $this->hasOne(Conversacion::className(), ['con_id' => 'con_id_padre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConversacions()
    {
        return $this->hasMany(Conversacion::className(), ['con_id_padre' => 'con_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(ConversacionTipo::className(), ['tipo_id' => 'tipo_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEncuestaRespuestas()
    {
        return $this->hasMany(EncuestaRespuesta::className(), ['con_id' => 'con_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::className(), ['con_id' => 'con_id']);
    }
    
    public function getLikeUsu()
    {
        $query = Like::find()->where(['con_id'=>$this->con_id,'usu_id'=>Yii::$app->user->id])->count();
               
        
        if($query == 1){
           return true;
        }else{
           return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsus()
    {
        return $this->hasMany(Usuario::className(), ['usu_id' => 'usu_id'])->viaTable('like', ['con_id' => 'con_id']);
    }
    
    public function getTieneVoto(){
        
       $query = Conversacion::findBySql('select c.* from conversacion c
        inner join encuesta_respuesta e on e.con_id = c.con_id
        inner join encuesta_respuesta_has_usuario u on u.respuesta_id = e.respuesta_id
        where c.con_id= :param1 and u.usu_id= :param2
        ',[':param1'=>$this->con_id,':param2'=>Yii::$app->user->id])->count();
        
       if($query == 1){
           return true;
       }else{
           return false;
       }
    }
    
    public function getTotalVotos(){
        
       $query = Conversacion::findBySql('select c.* from conversacion c
        inner join encuesta_respuesta e on e.con_id = c.con_id
        inner join encuesta_respuesta_has_usuario u on u.respuesta_id = e.respuesta_id
        where c.con_id= :param1
        ',[':param1'=>$this->con_id])->count();
        
       return $query;
    }
    
    
}
