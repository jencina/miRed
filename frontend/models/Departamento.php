<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departamento".
 *
 * @property string $dep_id
 * @property string $dep_nombre
 * @property string $dep_fechacreacion
 * @property string $dep_fechamodificacion
 * @property integer $emp_id
 *
 * @property Empresa $emp
 * @property Usuario[] $usuarios
 */
class Departamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dep_fechacreacion', 'dep_fechamodificacion'], 'safe'],
            [['emp_id','dep_nombre'], 'required'],
            [['emp_id'], 'integer'],
            [['dep_nombre'], 'string', 'max' => 250],
            [['emp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['emp_id' => 'emp_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dep_id' => Yii::t('app', 'Dep ID'),
            'dep_nombre' => Yii::t('app', 'Nombre'),
            'dep_fechacreacion' => Yii::t('app', 'Fechacreacion'),
            'dep_fechamodificacion' => Yii::t('app', 'Fechamodificacion'),
            'emp_id' => Yii::t('app', 'Emp ID'),
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
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['dep_id' => 'dep_id']);
    }
}
