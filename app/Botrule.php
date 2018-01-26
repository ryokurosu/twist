<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Botrule extends Model
{
    protected $fillable = ['id','name','span','botlimit'];
    	protected $primaryKey = 'botrule_id';
}