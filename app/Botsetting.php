<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Botsetting extends Model
{
    protected $fillable = ['account_id','botstory_id','botrule_id'];
    protected $primaryKey = 'setting_id';

     public function rule()
    {
        return $this->hasOne('App\Botrule','botrule_id','botrule_id');
    }
    public function story()
    {
        return $this->hasOne('App\Botstory','botstory_id','botstory_id');
    }

}