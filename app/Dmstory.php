<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Dmstory extends Model
{
    protected $fillable = ['id','name','count'];
    protected $primaryKey = 'dmstory_id';
}