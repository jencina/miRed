<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "grupo_file".
 *
 * @property string $file_id
 * @property string $file_nombre
 * @property string $file_tipo
 * @property integer $file_size
 * @property string $file_fechacreacion
 * @property string $file_fechamodificacion
 * @property string $grupo_id
 * @property string $usu_id
 *
 * @property Grupo $grupo
 * @property Usuario $usu
 */
class GrupoFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupo_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_size', 'grupo_id', 'usu_id'], 'integer'],
            [['file_fechacreacion', 'file_fechamodificacion'], 'safe'],
            [['grupo_id'], 'required'],
            [['file_nombre'], 'string', 'max' => 255],
            [['file_tipo'], 'string', 'max' => 45],
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
            'file_id' => 'ID',
            'file_nombre' => 'Nombre',
            'file_tipo' => 'Tipo',
            'file_size' => 'Size',
            'file_fechacreacion' => 'Fecha Creacion',
            'file_fechamodificacion' => 'Fecha Modificacion',
            'grupo_id' => 'Grupo',
            'usu_id' => 'Usuario',
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
}
