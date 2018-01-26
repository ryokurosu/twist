<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Unfollowrule extends Model
{
    protected $fillable = ['account_id','span','unfollowlimit','allowtime'];
    	protected $primaryKey = 'unfollowrule_id';
}