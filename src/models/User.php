<?php

namespace testnamespace\models;

use testnamespace\Model;

class User extends Model
{
	// explicit table name since our table is not "books"
	public static $table_name = 'user';

	// explicit pk since our pk is not "id"
	public static $primary_key = 'id';

}