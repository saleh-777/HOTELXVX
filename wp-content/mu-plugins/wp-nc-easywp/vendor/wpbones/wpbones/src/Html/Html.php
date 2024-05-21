<?php

namespace WPNCEasyWP\WPBones\Html;

class Html
{
    protected static $htmlTags = [
    'a'        => '\WPNCEasyWP\WPBones\Html\HtmlTagA',
    'button'   => '\WPNCEasyWP\WPBones\Html\HtmlTagButton',
    'checkbox' => '\WPNCEasyWP\WPBones\Html\HtmlTagCheckbox',
    'datetime' => '\WPNCEasyWP\WPBones\Html\HtmlTagDatetime',
    'fieldset' => '\WPNCEasyWP\WPBones\Html\HtmlTagFieldSet',
    'form'     => '\WPNCEasyWP\WPBones\Html\HtmlTagForm',
    'input'    => '\WPNCEasyWP\WPBones\Html\HtmlTagInput',
    'label'    => '\WPNCEasyWP\WPBones\Html\HtmlTagLabel',
    'optgroup' => '\WPNCEasyWP\WPBones\Html\HtmlTagOptGroup',
    'option'   => '\WPNCEasyWP\WPBones\Html\HtmlTagOption',
    'select'   => '\WPNCEasyWP\WPBones\Html\HtmlTagSelect',
    'textarea' => '\WPNCEasyWP\WPBones\Html\HtmlTagTextArea',
  ];

    public static function __callStatic($name, $arguments)
    {
        if (in_array($name, array_keys(self::$htmlTags))) {
            $args = (isset($arguments[ 0 ]) && ! is_null($arguments[ 0 ])) ? $arguments[ 0 ] : [];

            return new self::$htmlTags[ $name ]($args);
        }
    }
}
