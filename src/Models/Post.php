<?php
/**
 * Created by PhpStorm.
 * User: justinvoelkel
 * Date: 3/15/15
 * Time: 8:39 PM
 */

namespace simplepsr4\Models;
use Illuminate\Database\Eloquent\Model;

class Post extends Model{
    Public $title;
    protected $fillable =[];
}