<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property integer $plan_id
 * @property string $plan_nombre
 * @property integer $plan_precio
 * @property integer $plan_usuarios
 * @property integer $plan_modulos
 * @property string $plan_fechacreacion
 * @property string $plan_fechamodificacion
 * @property string $plan_periodo
 * @property integer $plan_status
 * @property integer $plan_destacado
 *
 * @property Empresa[] $empresas
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plan_precio', 'plan_usuarios', 'plan_modulos', 'plan_status', 'plan_destacado'], 'integer'],
            [['plan_fechacreacion', 'plan_fechamodificacion'], 'safe'],
            [['plan_nombre'], 'string', 'max' => 100],
            [['plan_periodo'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'plan_id' => Yii::t('app', 'Plan ID'),
            'plan_nombre' => Yii::t('app', 'Plan Nombre'),
            'plan_precio' => Yii::t('app', 'Plan Precio'),
            'plan_usuarios' => Yii::t('app', 'Plan Usuarios'),
            'plan_modulos' => Yii::t('app', 'Plan Modulos'),
            'plan_fechacreacion' => Yii::t('app', 'Plan Fechacreacion'),
            'plan_fechamodificacion' => Yii::t('app', 'Plan Fechamodificacion'),
            'plan_periodo' => Yii::t('app', 'Plan Periodo'),
            'plan_status' => Yii::t('app', 'Plan Status'),
            'plan_destacado' => Yii::t('app', 'Plan Destacado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresas()
    {
        return $this->hasMany(Empresa::className(), ['plan_id' => 'plan_id']);
    }
}
