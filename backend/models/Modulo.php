<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "modulo".
 *
 * @property string $mod_id
 * @property string $mod_nombre
 * @property string $mod_descripcion
 * @property integer $mod_activo
 * @property string $mod_fechacreacion
 * @property string $mod_fechamodificacion
 * @property integer $emp_id
 * @property string $mod_color
 *
 * @property Empresa $emp
 * @property ModuloPost[] $moduloPosts
 * @property ModuloRegistro[] $moduloRegistros
 */
class Modulo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modulo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mod_descripcion'], 'string'],
            [['mod_activo', 'emp_id'], 'integer'],
            [['mod_fechacreacion', 'mod_fechamodificacion'], 'safe'],
            [['emp_id'], 'required'],
            [['mod_nombre'], 'string', 'max' => 100],
            [['mod_color'], 'string', 'max' => 45],
            [['emp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['emp_id' => 'emp_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mod_id' => 'Mod ID',
            'mod_nombre' => 'Mod Nombre',
            'mod_descripcion' => 'Mod Descripcion',
            'mod_activo' => 'Mod Activo',
            'mod_fechacreacion' => 'Mod Fechacreacion',
            'mod_fechamodificacion' => 'Mod Fechamodificacion',
            'emp_id' => 'Emp ID',
            'mod_color' => 'Mod Color',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmp()
    {
        return $this->hasOne(Empresa::className(), ['emp_id' => 'emp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuloPosts()
    {
        return $this->hasMany(ModuloPost::className(), ['mod_id' => 'mod_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuloRegistros()
    {
        return $this->hasMany(ModuloRegistro::className(), ['mod_reg_mod_id' => 'mod_id']);
    }
}
