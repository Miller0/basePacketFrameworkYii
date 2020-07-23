<?php

namespace app\models\generated;

use Yii;

/**
 * This is the model class for table "logAuthorizations".
 *
 * @property int $id
 * @property string $email
 * @property string $browser
 * @property string $ip
 * @property string $created
 */
class LogAuthorizations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logAuthorizations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'browser', 'ip'], 'required'],
            [['created'], 'safe'],
            [['email', 'browser', 'ip'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'browser' => 'Browser',
            'ip' => 'Ip',
            'created' => 'Created',
        ];
    }
}
