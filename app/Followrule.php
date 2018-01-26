<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Followrule extends Model
{
    protected $fillable = ['account_id','span','followlimit','allowtime'];
    	protected $primaryKey = 'followrule_id';
}