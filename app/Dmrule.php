<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Dmrule extends Model
{
    protected $fillable = ['id','name','span','response','dmlimit'];
    	protected $primaryKey = 'dmrule_id';
}