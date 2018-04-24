<?php
namespace Innologi\TagBuilder;

/**
 * Custom Tag object
 *
 * Represents a Tag. Can be interchangable with other TagInterface classes.
 * Tag will render itself and its content recursively into a string.
 *
 * @package TagBuilder
 * @author Frenck Lutke
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 2 or later
 */
class Tag extends TagAbstract
{

    /**
     *
     * @var string
     */
    protected $tagName = '';

    /**
     *
     * @var array
     */
    protected $attributes = [];

    /**
     *
     * @var boolean
     */
    protected $forceClosingTag = false;

    /**
     *
     * @var TagInterface
     */
    protected $content = null;

    /**
     * Constructor
     *
     * @param string $tagName
     *            name of the tag to be rendered
     * @param array $attributes
     * @param TagInterface $content
     *            content of the tag to be rendered
     * @return void
     */
    public function __construct(string $tagName = '', array $attributes = [], ?TagInterface $content = null)
    {
        $this->tagName = $tagName;
        $this->attributes = $attributes;
        $this->content = $content;
    }

    /**
     * Sets tag name
     *
     * @param string $tagName
     * @return $this
     */
    public function setTagName(string $tagName): self
    {
        $this->tagName = $tagName;
        return $this;
    }

    /**
     * Gets tag name
     *
     * @return string
     */
    public function getTagName(): string
    {
        return $this->tagName;
    }

    /**
     *
     * {@inheritdoc}
     * @see TagInterface::hasContent()
     */
    public function hasContent(): bool
    {
        return $this->content !== NULL;
    }

    /**
     * Set this to true to force a closing tag
     * E.g.
     * <textarea> cant be self-closing even if its empty
     *
     * @param boolean $forceClosingTag
     * @return $this
     */
    public function forceClosingTag(bool $forceClosingTag): self
    {
        $this->forceClosingTag = $forceClosingTag;
        return $this;
    }

    /**
     * Returns true if attribute exists
     *
     * @param string $attribute
     * @return boolean
     */
    public function hasAttribute(string $attribute): bool
    {
        return isset($this->attributes[$attribute]);
    }

    /**
     * Get a single attribute
     *
     * @param string $attribute
     * @return string|null
     */
    public function getAttribute(string $attribute): ?string
    {
        if (! $this->hasAttribute($attribute)) {
            return null;
        }
        return $this->attributes[$attribute];
    }

    /**
     * Get all attributes
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Adds a single attribute
     *
     * @param array $attributes
     * @return $this
     */
    public function addAttributes(array $attributes): self
    {
        $this->attributes = $attributes + $this->attributes;
        return $this;
    }

    /**
     * Removes an attribute
     *
     * @param string $attribute
     * @return $this
     */
    public function removeAttribute(string $attribute): self
    {
        unset($this->attributes[$attribute]);
        return $this;
    }

    /**
     * Renders and returns the tag
     *
     * @return string
     */
    public function render(): string
    {
        if (! isset($this->tagName[0])) {
            return '';
        }
        $output = '<' . $this->tagName;
        foreach ($this->attributes as $attribute => $value) {
            $output .= ' ' . $attribute . '="' . htmlspecialchars($value) . '"';
        }
        if ($this->hasContent() || $this->forceClosingTag) {
            $output .= '>' . ($this->content ?? '') . '</' . $this->tagName . '>';
        } else {
            $output .= ' />';
        }
        return $output;
    }

    /**
     *
     * {@inheritdoc}
     * @see TagInterface::reset()
     */
    public function reset(): self
    {
        $this->tagName = '';
        $this->content = null;
        $this->attributes = [];
        $this->forceClosingTag = false;
        return $this;
    }
}
