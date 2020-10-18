<?php

namespace App\Entity\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

/**
 * App\Entity\User\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property string $status
 * @property string $verify_token
 * @property string|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereVerifyToken($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';

    protected $fillable = [
        'name', 'email', 'password', 'status', 'verify_token',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public static function register(string $name, string $email, string $password): self
    {
        return static::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'verify_token' => Str::uuid(),
            'status' => self::STATUS_WAIT,
        ]);
    }

    /**
     * @param $name
     * @param $email
     * @return User
     */
    public static function new($name, $email): self
    {
        return static::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt(Str::random()),
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * @return bool
     */
    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    /**
     * Get Statuses
     *
     * @return string[]
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_WAIT => 'Waiting',
            self::STATUS_ACTIVE => 'Active',
        ];
    }

    public function verify(): void
    {
        if (!$this->isWait()) {
            throw new \DomainException('User is already verified.');
        }

        $this->update([
            'status' => self::STATUS_ACTIVE,
            'verify_token' => null,
        ]);
    }
}
