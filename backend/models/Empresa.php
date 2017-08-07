<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "empresa".
 *
 * @property integer $emp_id
 * @property string $emp_nombre
 * @property string $emp_direccion
 * @property integer $emp_activo
 * @property string $emp_fechacreacion
 * @property string $emp_fechamodificacion
 * @property integer $adm_id
 * @property integer $plan_id
 *
 * @property Departamento[] $departamentos
 * @property Admin $adm
 * @property Plan $plan
 * @property Modulo[] $modulos
 * @property Usuario[] $usuarios
 */
class Empresa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'empresa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emp_activo', 'adm_id', 'plan_id'], 'integer'],
            [['emp_fechacreacion', 'emp_fechamodificacion'], 'safe'],
            [['adm_id', 'plan_id'], 'required'],
            [['emp_nombre'], 'string', 'max' => 100],
            [['emp_direccion'], 'string', 'max' => 250],
            [['adm_id'], 'exist', 'skipOnError' => true, 'targetClass' => Admin::className(), 'targetAttribute' => ['adm_id' => 'adm_id']],
            [['plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plan::className(), 'targetAttribute' => ['plan_id' => 'plan_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'emp_id' => 'Emp ID',
            'emp_nombre' => 'Emp Nombre',
            'emp_direccion' => 'Emp Direccion',
            'emp_activo' => 'Emp Activo',
            'emp_fechacreacion' => 'Emp Fechacreacion',
            'emp_fechamodificacion' => 'Emp Fechamodificacion',
            'adm_id' => 'Adm ID',
            'plan_id' => 'Plan ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamentos()
    {
        return $this->hasMany(Departamento::className(), ['emp_id' => 'emp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdm()
    {
        return $this->hasOne(Admin::className(), ['adm_id' => 'adm_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlan()
    {
        return $this->hasOne(Plan::className(), ['plan_id' => 'plan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModulos()
    {
        return $this->hasMany(Modulo::className(), ['emp_id' => 'emp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['emp_id' => 'emp_id']);
    }
}
