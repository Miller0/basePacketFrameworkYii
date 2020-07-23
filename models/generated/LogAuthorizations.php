<?php

namespace app\models\generated;

use Yii;

/**
 * This is the model class for table "logAuthorizations".
 *
 * @property int $id
 * @property string $email
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
            [['email', 'ip'], 'required'],
            [['created'], 'safe'],
            [['email', 'ip'], 'string', 'max' => 255],
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
            'ip' => 'Ip',
            'created' => 'Created',
        ];
    }
}
