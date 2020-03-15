<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public $timestamps = false;
    protected $guarded  = [];
    //protected $fillable = ['name', 'title', 'form_type', 'form_option', 'create_time', 'value', 'type', 'status',
    //    'form_class', 'placeholder', 'modify_time'];

    public static $disabledStatus = 0;
    public static $enableStatus = 1;
    public static $deleteStatus = 2;

    const FORM_TYPE_INPUT = 1;
    const FORM_TYPE_CHECKBOX = 2;
    const FORM_TYPE_TEXTAREA = 3;
    const FORM_TYPE_SELECT = 4;
    const FORM_TYPE_SWITCH = 5;
    const FORM_TYPE_RADIO = 6;

    const FORM_TYPE_LIST = [
        self::FORM_TYPE_INPUT => 'input',
        self::FORM_TYPE_CHECKBOX => '复选框',
        self::FORM_TYPE_TEXTAREA => '富文本框',
        self::FORM_TYPE_SELECT => '下拉列表',
        self::FORM_TYPE_SWITCH => '切换开关',
        self::FORM_TYPE_RADIO => '单选框',
    ];

    const MUST_FORM_OPTION_FORM_OPTION = [
        self::FORM_TYPE_CHECKBOX,
        self::FORM_TYPE_SELECT,
        self::FORM_TYPE_RADIO,
    ];

    public static function getTableName()
    {
        return 'options';
    }

}
