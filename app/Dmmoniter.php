<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Dmmoniter extends Model
{
    protected $fillable = ['account_id','count','updated_at'];
    	protected $primaryKey = 'account_id';

}