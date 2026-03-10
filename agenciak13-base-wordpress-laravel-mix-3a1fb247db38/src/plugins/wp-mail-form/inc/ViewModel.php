<?php
/**
 * Class developed to customize admin pages in Wordpress
 *
 * @author Euclécio Josias Rodrigues <eucjosias@gmail.com>
 *
 * @version 1.0
 *
 */

Class ViewModel
{
	/**
	 * @param string
	 *
	 * Path for template of page
	 *
	 */
	private $template;

	/**
	 * @param array
	 *
	 * Array of attributes
	 *
	 */
	private $attributes = array();

	/**
     * Gets the value of template.
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Sets the value of template.
     *
     * @param mixed $template the template
     *
     * @return self
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Gets the value of attributes.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Sets the value of attributes.
     *
     * @param mixed $attributes the attributes
     *
     * @return self
     */
    public function setAttributes(Array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Add value in attributes array.
     *
     * @param $key => $value in attributes array
     *
     * @return self
     */
    public function addAttribute($key, $value)
    {
        $this->attributes[$key] = $value;

        return $this;
    }

	/**
	 * This function replaces keys in template
	 *
	 * @param array $attributes
	 *
	 * @return string
	 */
	public function replaceTemplateKeys()
	{
		$content = file_get_contents($this->template);
		foreach ($this->attributes as $key => $value)
			$content = str_replace('{{'.$key.'}}', $value, $content);

		return $content;
	}
}