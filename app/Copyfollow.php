<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Copyfollow extends Model
{
    protected $fillable = ['account_id','target_id'];
    	protected $primaryKey = 'copyfollow_id';
}