<?php

namespace WPNCEasyWP\WPBones\Database;

/**
 * The Database Model provides a base class for all database models.
 *
 * @package WPNCEasyWP\WPBones\Database
 *
 * @method static all()
 *
 */
abstract class Model extends DB
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table;

  /**
   * The primary key for the model.
   *
   * @var string
   */
  protected $primaryKey = 'id';

  public function __construct()
  {
    // get the class name
    $this->table = DB::getTableName($this->table ?? get_called_class());

    parent::__construct($this->table, $this->primaryKey);
  }

  /*
  |--------------------------------------------------------------------------
  | Magic methods
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   * We will this magic method to handle all static/instance methods.
   *
   * @param string $name
   * @param array  $arguments
   * @return mixed
   */
  public static function __callStatic($name, $arguments)
  {
    return (new static())->$name(...$arguments);
  }
}
