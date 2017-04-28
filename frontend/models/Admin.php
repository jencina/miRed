<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property integer $adm_id
 * @property string $adm_nombre
 * @property string $adm_apellido
 * @property string $adm_telefono
 * @property string $adm_email
 * @property string $adm_password_hash
 * @property string $adm_password_reset_token
 * @property integer $adm_status
 * @property string $adm_auth_key
 * @property string $adm_fechacreacion
 * @property string $adm_fechamodificacion
 *
 * @property Empresa[] $empresas
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['adm_status'], 'integer'],
            [['adm_fechacreacion', 'adm_fechamodificacion'], 'safe'],
            [['adm_nombre', 'adm_apellido', 'adm_password_hash'], 'string', 'max' => 255],
            [['adm_telefono'], 'string', 'max' => 15],
            [['adm_email'], 'string', 'max' => 100],
            [['adm_password_reset_token', 'adm_auth_key'], 'string', 'max' => 45],
            [['adm_email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'adm_id' => Yii::t('app', 'Adm ID'),
            'adm_nombre' => Yii::t('app', 'Adm Nombre'),
            'adm_apellido' => Yii::t('app', 'Adm Apellido'),
            'adm_telefono' => Yii::t('app', 'Adm Telefono'),
            'adm_email' => Yii::t('app', 'Adm Email'),
            'adm_password_hash' => Yii::t('app', 'Adm Password Hash'),
            'adm_password_reset_token' => Yii::t('app', 'Adm Password Reset Token'),
            'adm_status' => Yii::t('app', 'Adm Status'),
            'adm_auth_key' => Yii::t('app', 'Adm Auth Key'),
            'adm_fechacreacion' => Yii::t('app', 'Adm Fechacreacion'),
            'adm_fechamodificacion' => Yii::t('app', 'Adm Fechamodificacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresas()
    {
        return $this->hasMany(Empresa::className(), ['adm_id' => 'adm_id']);
    }
}
