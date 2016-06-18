<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
  protected $fillable = [
      'name', 'value', 'user_id'
  ];

  protected $hidden = [
      'id', 'user_id'
  ];

  protected static $valid_names = [
    'currency',
    'language',
    'blockonomics_api_key'
  ];

  protected static $valid_values = [
    'currency' => [
      'EUR', 'USD'
    ],

    'language' => [
      'en', 'it'
    ],

    'blockonomics_api_key' => [ ]
  ];

  protected static $defaults = [
    'currency'             => 'USD',
    'language'             => 'en',
    'blockonomics_api_key' => ''
  ];

  public static function getLabelFor( $name ){
    if( $name == 'blockonomics_api_key' ){
      return 'Blockonomics.com API Key<br/>'.
             '<small style="color:#999; font-weight:normal">Needed for xPubs with more than 50 addresses.</small>';
    }
    else {
      return ucfirst($name);
    }
  }

  public static function getHtmlFor( $user, $name ){
    if( $name == 'blockonomics_api_key' ){
      $value = $user->getSetting($name);
      $html = '<input type="text" class="form-control setting" id="'.$name.'" name="'.$name.'" value="'.$value.'">';
    }
    else {
      $html = '<select class="form-control setting" id="'.$name.'" name="'.$name.'">';

      foreach( self::$valid_values[$name] as $value ){
        $selected = $user->getSetting($name) == $value ? ' selected' : '';
        $html .= '<option value="'.$value.'"'.$selected.'>'.$value.'</option>';
      }

      $html .= '</select>';
    }

    return $html;
  }

  public static function getValidNames() {
    return self::$valid_names;
  }

  public static function getDefaults(){
    return self::$defaults;
  }

  public static function getDefault( $name ){
    if( isset(self::$defaults[$name]) ){
      return self::$defaults[$name];
    }
    return NULL;
  }

  public static function isValid( $name, $value ){
    if( isset(self::$valid_values[$name]) === false ){
      echo "'$name' not found in valid_values:";
      print_r( self::$valid_values );
      return false;
    }

    $check = self::$valid_values[$name];

    return !$check || in_array( $value, $check );
  }

  public function user(){
    return $this->belongsTo('App\User');
  }
}
