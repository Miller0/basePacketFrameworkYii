<?php

namespace app\models\form;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\generated\LogAuthorizations;


class Login extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;
    public $verifyCode;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            //['verifyCode', 'captcha'],
        ];
    }


    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password))
            {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate())
        {
            if (Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0))
            {
                $logAuth = new LogAuthorizations();
                $logAuth->email = $this->_user->getEmail();
                $logAuth->browser =  get_browser();
                $logAuth->ip = Yii::$app->request->userIP;

                if($logAuth->validate())
                {
                    $logAuth->save();
                }

                return true;

            }

        }
        return false;
    }

    /**
     * @return bool
     */
    public function getUser()
    {
        if ($this->_user === false)
        {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}
