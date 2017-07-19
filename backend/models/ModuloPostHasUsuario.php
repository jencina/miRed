<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "modulo_post_has_usuario".
 *
 * @property string $modulo_post_mod_post_id
 * @property string $usuario_usu_id
 * @property string $fecha_creacion
 * @property string $fecha_modificacion
 * @property integer $activo
 *
 * @property ModuloPost $moduloPostModPost
 * @property Usuario $usuarioUsu
 */
class ModuloPostHasUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modulo_post_has_usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['modulo_post_mod_post_id', 'usuario_usu_id'], 'required'],
            [['modulo_post_mod_post_id', 'usuario_usu_id', 'activo'], 'integer'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['modulo_post_mod_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModuloPost::className(), 'targetAttribute' => ['modulo_post_mod_post_id' => 'mod_post_id']],
            [['usuario_usu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario_usu_id' => 'usu_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'modulo_post_mod_post_id' => 'Modulo Post Mod Post ID',
            'usuario_usu_id' => 'Usuario Usu ID',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_modificacion' => 'Fecha Modificacion',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuloPostModPost()
    {
        return $this->hasOne(ModuloPost::className(), ['mod_post_id' => 'modulo_post_mod_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioUsu()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'usuario_usu_id']);
    }
    
    
}
