<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function dreams()
    {
        return $this->belongsToMany(Dream::class, 'dream_user');
    }

    public function getCountDreams($done, $all = false)
    {
        if ($done) {
            return $this->dreams()->whereNotNull('done')->count();
        }
        if ($all) {
            return $this->dreams()->count();
        }
        return $this->dreams()->whereNull('done')->count();
    }

    public function getDreams($done = false)
    {
        if (!$done) {
            if ($this->getCountDreams(false) > 0) {
                return $this->dreams()->orderBy('created_at', 'ASC')->whereNull('done')->get();
            }
        } else {
            if ($this->getCountDreams(true) > 0) {
                return $this->dreams()->orderBy('done', 'ASC')->whereNotNull('done')->get();
            }
        }
        return null;
    }

    public function getDreamRatio()
    {
        if ($this->getCountDreams(false) > 0){
            return number_format($this->getCountDreams(true) / $this->getCountDreams(false), 2, '.', ' ') ;
        }
        return $this->getCountDreams(true);
    }


    public function getDreamsChart()
    {
        $dreams = $this->dreams->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('M');
        })->toArray();

        $dreamsDone = $this->dreams->where('done', '!=', null)->groupBy(function ($date) {
            return Carbon::parse($date->done)->format('M');
        })->toArray();

        $countDreams = [];
        $countDreamsDone = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        foreach ($months as $key => $month) {
            if (array_key_exists($month, $dreams)) {
                $countDreams[] = count($dreams[$month]);
            } else {
                $countDreams[] = 0;
            }
            if (array_key_exists($month, $dreamsDone)) {
                $countDreamsDone[] = count($dreamsDone[$month]);
            } else {
                $countDreamsDone[] = 0;
            }
        }


        return app()->chartjs
            ->name('lineChartTest')
            ->type('line')
            ->labels($months)
            ->datasets([
                [
                    'label' => 'Přidáno snů',
                    'backgroundColor' => 'rgba(38, 185, 154, 0.31)',
                    'borderColor' => 'rgba(38, 185, 154, 0.7)',
                    'pointBorderColor' => 'rgba(38, 185, 154, 0.7)',
                    'pointBackgroundColor' => 'rgba(38, 185, 154, 0.7)',
                    'pointHoverBackgroundColor' => '#fff',
                    'pointHoverBorderColor' => 'rgba(220,220,220,1)',
                    'data' => $countDreams,
                ],
                [
                    'label' => 'Splněno snů',
                    'backgroundColor' => 'rgba(185, 38, 154, 0.31)',
                    'borderColor' => 'rgba(185, 38, 154, 0.7)',
                    'pointBorderColor' => 'rgba(185, 38, 154, 0.7)',
                    'pointBackgroundColor' => 'rgba(185, 38, 154, 0.7)',
                    'pointHoverBackgroundColor' => '#fff',
                    'pointHoverBorderColor' => 'rgba(220,220,220,1)',
                    'data' => $countDreamsDone,
                ],
            ])
            ->options([]);
    }
}
