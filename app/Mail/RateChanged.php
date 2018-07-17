<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Entity\Currency;

class RateChanged extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $currency;
    protected $oldCurrencyRate;
    
    public function __construct(User $user, Currency $currency, float $oldCurrencyRate)
    {
        $this->user = $user;
        $this->currency = $currency;
        $this->oldCurrencyRate = $oldCurrencyRate;
    }

    
    public function build(): RateChanged
    {
        $email = $this->from('admin@cryptomarket.com')
                      ->view('emails.rateChanged')
                      ->with([
                          'userName'        => $this->user->name,
                          'currencyName'    => $this->currency->name,
                          'oldCurrencyRate' => $this->oldCurrencyRate,
                          'newCurrencyRate' => $this->currency->rate,
                      ]);

        return $email;
    }
}
