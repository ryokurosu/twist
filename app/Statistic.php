<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Statistic extends Model
{
    protected $fillable = ['account_id','follow','follower'];
}