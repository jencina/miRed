<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "modulo_post_files".
 *
 * @property string $file_id
 * @property string $file_nombre
 * @property string $file_tipo
 * @property string $file_size
 * @property string $file_fechacreacion
 * @property string $file_fechamodificacion
 * @property string $file_post_id
 * @property string $file_usu_id
 *
 * @property ModuloPost $filePost
 * @property Usuario $fileUsu
 */
class ModuloPostFiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modulo_post_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_fechacreacion', 'file_fechamodificacion'], 'safe'],
            [['file_post_id', 'file_usu_id'], 'required'],
            [['file_post_id', 'file_usu_id'], 'integer'],
            [['file_nombre'], 'string', 'max' => 255],
            [['file_tipo', 'file_size'], 'string', 'max' => 45],
            [['file_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModuloPost::className(), 'targetAttribute' => ['file_post_id' => 'mod_post_id']],
            [['file_usu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['file_usu_id' => 'usu_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file_id' => 'File ID',
            'file_nombre' => 'File Nombre',
            'file_tipo' => 'File Tipo',
            'file_size' => 'File Size',
            'file_fechacreacion' => 'File Fechacreacion',
            'file_fechamodificacion' => 'File Fechamodificacion',
            'file_post_id' => 'File Post ID',
            'file_usu_id' => 'File Usu ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilePost()
    {
        return $this->hasOne(ModuloPost::className(), ['mod_post_id' => 'file_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileUsu()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'file_usu_id']);
    }
}
