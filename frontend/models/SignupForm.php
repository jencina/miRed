<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Admin;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['nombre', 'required'],
            ['nombre', 'string', 'min' => 6],
            
            ['apellido', 'required'],
            ['apellido', 'string', 'min' => 6],
            
            ['telefono', 'required'],
            ['telefono', 'string', 'min' => 6],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'min' => 2, 'max' => 255],
            ['email', 'unique', 'targetAttribute' => ['email'=>'adm_email'],'targetClass' => '\common\models\Admin', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new Admin();
        $user->adm_nombre = $this->nombre;
        $user->adm_apellido = $this->apellido;
        $user->adm_telefono = $this->telefono;
        $user->adm_email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        $user->adm_fechacreacion     = date("Y-m-d h:i:s");
        $user->adm_fechamodificacion = date("Y-m-d h:i:s");
        
        return $user->save() ? $user : null;
    }
}
