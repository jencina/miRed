<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "modulo_registro_tipo".
 *
 * @property integer $reg_tipo_id
 * @property string $reg_tipo_nombre
 *
 * @property ModuloRegistro[] $moduloRegistros
 */
class ModuloRegistroTipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modulo_registro_tipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reg_tipo_nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reg_tipo_id' => 'Reg Tipo ID',
            'reg_tipo_nombre' => 'Reg Tipo Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuloRegistros()
    {
        return $this->hasMany(ModuloRegistro::className(), ['mod_reg_tipo_id' => 'reg_tipo_id']);
    }
}
