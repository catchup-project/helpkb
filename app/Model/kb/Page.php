<?php namespace App\Model\kb;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Page extends Model {
  use SearchableTrait;

	protected $table = 'kb_pages';
	protected $fillable = ['name', 'slug', 'status', 'visibility', 'description'];

}
