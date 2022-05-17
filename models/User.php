<?php

namespace app\models;

use app\models\query\UserQuery;
use Cassandra\Exception\ValidationException;
use Yii;
use yii\base\Exception;
use yii\base\InvalidArgumentException;
use yii\base\InvalidConfigException;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $password;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'email'], 'required'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    public function attributes()
    {
        return [
            'id',
            'username',
            'auth_key',
            'password_hash',
            'password',
            'password_reset_token',
            'email',
            'status',
            'created_at',
            'updated_at',
            'deleted_at',
        ];
    }

    /**
     * @return array[]
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_at',
                'updatedByAttribute' => 'updated_at',
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * @param $insert
     * @return bool
     * @throws Exception
     */
    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
                $this->password_reset_token = \Yii::$app->security->generateRandomString();
                $this->status = 10;
            }
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * @param $id
     * @return \yii\db\ActiveQueryInterface|IdentityInterface|null
     */
    public static function findIdentity($id): User
    {
        try {
            return User::findByCondition(['id' => $id])->one();
        } catch (InvalidConfigException $e) {
            throw new InvalidArgumentException('Can`t find user with this id.');
        }
    }

    /**
     * @param $token
     * @param $type
     * @return \yii\db\ActiveQueryInterface|IdentityInterface|null
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        try {
            return User::findByCondition(['id' => $token]);
        } catch (InvalidConfigException $e) {
            throw new InvalidArgumentException('Can`t find user with this id.');
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int)$this->id;
    }

    /**
     * @return string
     */
    public function getAuthKey(): string
    {
        return (string)$this->auth_key;
    }

    /**
     * @param $authKey
     * @return bool
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }

    /**
     * @throws Exception
     */
    public function setPassword(string $password): void
    {
        $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return '';
    }

    /**
     * @param string $username
     * @return \yii\db\ActiveQueryInterface
     */
    public static function findByUsername(string $username): User
    {
        try {
            return User::findByCondition(['username' => $username])->one();
        } catch (InvalidConfigException $e) {
            throw new InvalidArgumentException(sprintf('User with name %s was not found.', $username));
        }
    }

    /**
     * @param string $password
     * @return bool
     */
    public function validatePassword(string $password): bool
    {
       return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
    }
}
