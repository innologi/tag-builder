<?php
namespace Innologi\TagBuilder;

/**
 * Tag Interface
 *
 * @package TagBuilder
 * @author Frenck Lutke
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 2 or later
 */
interface TagInterface
{

    /**
     * Returns TRUE if tag contains content, otherwise FALSE
     *
     * @return boolean
     */
    public function hasContent(): bool;

    /**
     * Gets the content of the tag
     *
     * @return mixed
     */
    public function getContent();

    /**
     * Sets the content of the tag
     *
     * @param mixed $content
     *            Content of the tag to be rendered
     * @return $this
     */
    public function setContent($content);

    /**
     * Render the object as string, includes recursively rendering any content.
     *
     * @return string
     */
    public function render(): string;

    /**
     * Magic method invoked when using the object directly into a string.
     *
     * @return string
     */
    public function __toString(): string;

    /**
     * Resets objects properties.
     *
     * @return $this
     */
    public function reset();
}
