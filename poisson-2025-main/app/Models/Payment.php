<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'team_id',
        'midtrans_order_id',
        'midtrans_id',
        'payment_method',
        'url',
        'type',
        'created_at',
    ];

    protected $attributes = [
        'confirmed' => false,
    ];


     /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'payment_url',
    ];


    /**
     * team
     *
     * @return void
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }


    /**
     * getPaymentUrlAttribute
     *
     * @return void
     */
    public function getPaymentUrlAttribute()
    {
        return asset('storage/' . $this->url);
    }


    /**
     * verify payments and give specific permission to it's team
     *
     * @param  mixed $payment_id
     * @return bool
     */
    public static function verify($payment_id)
    {
        try {
            $payment = self::findOrFail($payment_id);
            $team = $payment->team;
            switch ($payment->type) {
                case config('variables.payments.olimpiade_1'):
                    $team->confirmed = true;
                    $team->save();
                    $team->givePermissionTo('olimpiade_penyisihan_peserta');
                    break;
                case config('variables.payments.olimpiade_2'):
                    $team->givePermissionTo('olimpiade_semifinal_peserta');
                    break;
                case config('variables.payments.infografis_1'):
                    $team->confirmed = true;
                    $team->save();
                    $team->givePermissionTo('infografis_penyisihan_peserta');
                    break;
                default:
                    return false;
            }
            $payment->confirmed = true;
            $payment->save();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
