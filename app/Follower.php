<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Follower extends Model
{
    protected $fillable = ['key','account_id','target_id','dmwait','replywait'];
    protected $primaryKey = 'key';
    public $incrementing = false;
}