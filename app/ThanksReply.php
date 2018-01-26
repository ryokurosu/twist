<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Thanksreply extends Model
{
    protected $fillable = ['account_id','span','text','allowtime'];
    	protected $primaryKey = 'account_id';

}