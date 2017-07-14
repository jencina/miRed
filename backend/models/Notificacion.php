<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "notificacion".
 *
 * @property integer $not_id
 * @property string $not_usu_id
 * @property string $not_usu_id_para
 * @property integer $not_tipo
 * @property string $not_titulo
 * @property string $not_fechacreacion
 * @property string $not_fechamodificacion
 * @property string $not_post_id
 *
 * @property ModuloPost $notPost
 * @property NotificacionTipo $notTipo
 * @property Usuario $notUsu
 * @property Usuario $notUsuIdPara
 */
class Notificacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notificacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['not_usu_id', 'not_usu_id_para', 'not_tipo'], 'required'],
            [['not_usu_id', 'not_usu_id_para', 'not_tipo', 'not_post_id'], 'integer'],
            [['not_fechacreacion', 'not_fechamodificacion'], 'safe'],
            [['not_titulo'], 'string', 'max' => 100],
            [['not_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModuloPost::className(), 'targetAttribute' => ['not_post_id' => 'mod_post_id']],
            [['not_tipo'], 'exist', 'skipOnError' => true, 'targetClass' => NotificacionTipo::className(), 'targetAttribute' => ['not_tipo' => 'tipo_id']],
            [['not_usu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['not_usu_id' => 'usu_id']],
            [['not_usu_id_para'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['not_usu_id_para' => 'usu_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'not_id' => 'Not ID',
            'not_usu_id' => 'Not Usu ID',
            'not_usu_id_para' => 'Not Usu Id Para',
            'not_tipo' => 'Not Tipo',
            'not_titulo' => 'Not Titulo',
            'not_fechacreacion' => 'Not Fechacreacion',
            'not_fechamodificacion' => 'Not Fechamodificacion',
            'not_post_id' => 'Not Post ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotPost()
    {
        return $this->hasOne(ModuloPost::className(), ['mod_post_id' => 'not_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotTipo()
    {
        return $this->hasOne(NotificacionTipo::className(), ['tipo_id' => 'not_tipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotUsu()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'not_usu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotUsuIdPara()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'not_usu_id_para']);
    }
}
