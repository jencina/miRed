<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "modulo_post_comentario".
 *
 * @property string $com_id
 * @property string $com_comentario
 * @property string $com_fechacreacion
 * @property string $com_fechamodificacion
 * @property string $com_mod_post_id
 * @property string $com_usuario_id
 *
 * @property ModuloPost $comModPost
 * @property Usuario $comUsuario
 */
class ModuloPostComentario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modulo_post_comentario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['com_comentario'], 'string'],
            [['com_fechacreacion', 'com_fechamodificacion'], 'safe'],
            [['com_mod_post_id', 'com_usuario_id'], 'required'],
            [['com_mod_post_id', 'com_usuario_id'], 'integer'],
            [['com_mod_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModuloPost::className(), 'targetAttribute' => ['com_mod_post_id' => 'mod_post_id']],
            [['com_usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['com_usuario_id' => 'usu_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'com_id' => 'Com ID',
            'com_comentario' => 'Com Comentario',
            'com_fechacreacion' => 'Com Fechacreacion',
            'com_fechamodificacion' => 'Com Fechamodificacion',
            'com_mod_post_id' => 'Com Mod Post ID',
            'com_usuario_id' => 'Com Usuario ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComModPost()
    {
        return $this->hasOne(ModuloPost::className(), ['mod_post_id' => 'com_mod_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComUsuario()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'com_usuario_id']);
    }
}
