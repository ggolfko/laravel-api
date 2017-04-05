<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

      protected static function createId(){
         $id = date('dmyHis');
    		 for ($i=0;$i<4;$i++)
              $id .= rand(0,9);
         $item = User::where('userid', $id)->count();
         return $item > 0? User::createId(): $id;
      }

    	protected static function createPhotoId(){
          $id = date('dmyHis');
    		  for ($i=0;$i<4;$i++)
              $id .= rand(0,9);
          return $id;
      }

    	public static function boot(){
          parent::boot();
          static::creating(function($model){
    			     $model->userid = self::createId();
          });
      }

      public function getBirthDate(){
      		if ($this->birthdate == '0000-00-00'){
      			return $this->birthdate;
      		}
      		$date = \Carbon\Carbon::createFromFormat('Y-m-d', $this->birthdate);
      		return $date->format('d F Y');
    	}
}
