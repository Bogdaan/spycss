<?php

namespace SpyCss\Util;

/**
 * Html render helper.
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Html
{
    /**
     * Encodes special characters into HTML entities.
     *
     * @param string $text to be encoded
     * @return string encoded data
     */
    public static function encode($text)
    {
        return htmlspecialchars($text, ENT_QUOTES);
    }

    /**
	 * Renders the HTML tag attributes.
	 * Attributes, such as 'checked', 'disabled', 'readonly', will be rendered
	 * properly based on their corresponding boolean value.
	 *
	 * @param array $attrs attributes to be rendered
	 * @return string rendering result
	 */
	public static function renderAttributes($attrs)
	{
		$specialAttributes = [
			'autofocus'=>1,
			'autoplay'=>1,
			'async'=>1,
			'checked'=>1,
			'controls'=>1,
			'declare'=>1,
			'default'=>1,
			'defer'=>1,
			'disabled'=>1,
			'formnovalidate'=>1,
			'hidden'=>1,
			'ismap'=>1,
			'itemscope'=>1,
			'loop'=>1,
			'multiple'=>1,
			'muted'=>1,
			'nohref'=>1,
			'noresize'=>1,
			'novalidate'=>1,
			'open'=>1,
			'readonly'=>1,
			'required'=>1,
			'reversed'=>1,
			'scoped'=>1,
			'seamless'=>1,
			'selected'=>1,
			'typemustmatch'=>1,
		];

        if (empty($attrs)) {
			return '';
        }

        $html='';
		if (isset($attrs['encode'])) {
			$raw =! $attrs['encode'];
			unset($attrs['encode']);
		} else {
			$raw=false;
        }

		foreach ($attrs as $name=>$value) {
			if (isset($specialAttributes[$name])) {
				if ($value===false && $name==='async') {
					$html .= ' ' . $name.'="false"';
				} elseif ($value) {
	                $html .= ' ' . $name;
				}
			} elseif ($value!==null) {
				$html .= ' ' . $name . '="' . ($raw ? $value : self::encode($value)) . '"';
            }
		}
		return $html;
	}

    /**
	 * Generates an HTML element.
	 *
	 * @param string $tag the tag name
	 * @param array $attrs the element attributes.
	 * @param mixed $content the content to be enclosed between open and close
	 * element tags. It will not be HTML-encoded. If false, it means there is
	 * no content.
	 * @param boolean $closeTag whether to generate the close tag.
	 * @return string HTML element tag
	 */
	public static function tag($tag, $attrs=[], $content=false, $closeTag=true)
	{
		$html = '<' . $tag . self::renderAttributes($attrs);
		if ($content===false) {
			return $closeTag ? $html.' />' : $html.'>';
		} else {
			return $closeTag ? $html.'>'.$content.'</'.$tag.'>' : $html.'>'.$content;
        }
	}
}
