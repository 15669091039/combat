<?php
/**
 * Create by ZhangShuo
 * Date: 2021/7/24
 * Time: 13:38
 * When you read this code, good luck for you.
 */

namespace Application\Form;

/**
 * Class Generic
 *
 * 自动生成表单
 * @package Application\Form
 */
class Generic
{
// 此处添加代码
    const ROW = 'row';
    const FORM = 'form';
    const INPUT = 'input';
    const LABEL = 'label';
    const ERRORS = 'errors';
    const TYPE_FORM = 'form';
    const TYPE_TEXT = 'text';
    const TYPE_EMAIL = 'email';
    const TYPE_RADIO = 'radio';
    const TYPR_SUBMIT = 'submit';
    const TYPE_SELECT = 'select';
    const TYPE_PASSWORD = 'password';
    const TYPE_CHECKBOX = 'checkbox';
    const DEFAULT_TYPE = self::TYPE_TEXT;
    const DEFAULT_WRAPPER = 'div';
    protected $name;
    protected $type = self::DEFAULT_TYPE;
    protected $label = '';
    protected $errors = [];
    protected $wrappers;
    protected $attributes;
    protected $pattern = '<input type="%s" name="%s" %s>';

    public function __construct($name, $type, $label = '', array $wrappers = [], array $attributes = [], array $errors = [])
    {
        $this->name = $name;
        if ($type instanceof Generic) {
            $this->type = $type->getType();
            $this->label = $type->getLabelValue();
            $this->errors = $type->getErrorsArray();
            $this->wrappers = $type->getWrappers();
            $this->attributes = $type->getAttributes();
        } else {
            $this->type = $type ?? self::DEFAULT_TYPE;
            $this->label = $label;
            $this->errors = $errors;
            $this->attributes = $attributes;
            if ($wrappers) {
                $this->wrappers = $wrappers;
            } else {
                $this->wrappers[self::INPUT]['type'] = self::DEFAULT_WRAPPER;
                $this->wrappers[self::LABEL]['type'] = self::DEFAULT_WRAPPER;
                $this->wrappers[self::ERRORS]['type'] = self::DEFAULT_WRAPPER;
            }
        }
        $this->attributes['id'] = $name;
    }
    public function getWrappers(){
        return $this->wrappers;
    }
    public function getAttributes(){
        return $this->attributes;
    }

    /**
     * 封装器
     *
     * 用于封装 input label errors 成html
     * @param $type //封装类型
     * @return string //返回封装好的string
     */
    public function getWrapperPattern($type): string
    {
        $pattern = '<' . $this->wrappers[$type]['type'];
        foreach ($this->wrappers[$type] as $key => $value) {
            if ($key != 'type') {
                $pattern .= ' ' . $key . '="' . $value . '"';
            }
        }
        $pattern .= '>%s</' . $this->wrappers[$type]['type'] . '>';
        return $pattern;
    }

    /**
     * label   封装器
     * @return string
     */
    public function getLabel(): string
    {
        return sprintf($this->getWrapperPattern(self::LABEL), $this->label);
    }

    /**
     * 对属性加工 ，使用urlencod() 和 htmlspecialchars
     * @return string
     */
    public function getAttribs(): string
    {
        $attribs = '';
        foreach ($this->attributes as $key => $value) {
            $key = strtolower($key);
            if ($value) {
                if ($key == 'value') {
                    if (is_array($value)) {
                        foreach ($value as $k => $i) {
                            $value[$k] = htmlspecialchars($i);
                        }
                    } else {
                        $value = htmlspecialchars($value);
                    }
                } elseif ($key == 'href') {
                    $value = urlencode($value);
                }
                $attribs .= $key . '="' . $value . '" ';
            } else {
                $attribs .= $key . ' ';
            }
        }
        return trim($attribs);
    }


    public function getInputOnly(): string
    {
        return sprintf($this->pattern, $this->type, $this->name, $this->getAttribs());
    }

    public function getInputWithWrapper(): string
    {
        return sprintf($this->getWrapperPattern(self::INPUT), $this->getInputOnly());

    }

    public function getErrors()
    {
        if (!$this->errors || count($this->errors) == 0) return '';
        $html = '';
        $pattern = '<li>%s</li>';
        $html .= '<ul>';
        foreach ($this->errors as $error) {
            $html .= sprintf($pattern, $error);
        }
        $html .= '</ul>';
        return sprintf($this->getWrapperPattern(self::ERRORS), $html);
    }

    public function setSingleAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function addSingleError($error)
    {
        $this->errors[] = $error;
    }

    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getLabelValue()
    {
        return $this->label;
    }

    public function getErrorsArray()
    {
        return $this->errors;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function setAttributes(array $attributes)
    {
        $this->attributes=$attributes;
    }


}
