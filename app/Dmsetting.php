<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Dmsetting extends Model
{
    protected $fillable = ['account_id','dmstory_id','dmrule_id'];
    protected $primaryKey = 'dmsetting_id';

     public function rule()
    {
        return $this->hasOne('App\Dmrule','dmrule_id','dmrule_id');
    }
    public function story()
    {
        return $this->hasOne('App\Dmstory','dmstory_id','dmstory_id');
    }

}