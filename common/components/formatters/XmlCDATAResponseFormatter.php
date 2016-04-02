<?php

namespace common\components\formatters;


use DOMElement;
use DOMText;
use yii\base\Arrayable;
use yii\helpers\StringHelper;
use yii\web\XmlResponseFormatter;
use DOMCdataSection;

/**
 * XmlCDATAResponseFormatter formats the given data into an XML response content with CDATA support.
 * https://en.wikipedia.org/wiki/CDATA
 * 
 * Idea found in github:
 * https://github.com/dcb9/dcb9.github.io/blob/master/_posts/2014-11-17-yii2-usage.md
 * https://github.com/search?q=%24child-%3EappendChild%28new+DOMCdataSection%28&type=Code&utf8=%E2%9C%93
 */
class XmlCDATAResponseFormatter extends XmlResponseFormatter
{
    /**
     * Mark node for CDATA support
     */
    const CDATA = '---cdata---';
    
    /**
     * @param DOMElement $element
     * @param mixed $data
     */
    protected function buildXml($element, $data)
    {
        if (is_array($data) ||
            ($data instanceof \Traversable && $this->useTraversableAsArray && !$data instanceof Arrayable)
        ) {
            foreach ($data as $name => $value) {
                if (is_int($name) && is_object($value)) {
                    $this->buildXml($element, $value);
                } elseif (is_array($value) || is_object($value)) {
                    $child = new DOMElement(is_int($name) ? $this->itemTag : $name);
                    $element->appendChild($child);
                    if (array_key_exists(self::CDATA, $value)) {
                        $child->appendChild(new DOMCdataSection((string) $value[0]));
                    } else {
                        $this->buildXml($child, $value);
                    }
                } else {
                    $child = new DOMElement(is_int($name) ? $this->itemTag : $name);
                    $element->appendChild($child);
                    $child->appendChild(new DOMText((string) $value));
                }
            }
        } elseif (is_object($data)) {
            $child = new DOMElement(StringHelper::basename(get_class($data)));
            $element->appendChild($child);
            if ($data instanceof Arrayable) {
                $this->buildXml($child, $data->toArray());
            } else {
                $array = [];
                foreach ($data as $name => $value) {
                    $array[$name] = $value;
                }
                $this->buildXml($child, $array);
            }
        } else {
            $element->appendChild(new DOMText((string) $data));
        }
    }
}
