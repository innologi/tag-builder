<?php
namespace Innologi\TagBuilder;

/**
 * Tag Factory
 *
 * Should be used to create Tag objects that are used to render
 * frontend output.
 *
 * @package TagBuilder
 * @author Frenck Lutke
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 2 or later
 */
class TagFactory
{

    /**
     * Creates Tag object
     *
     * @param string $tagName
     * @param array $tagAttributes
     * @param TagInterface $content
     * @return Tag
     */
    public function createTag(string $tagName, array $tagAttributes = [], ?TagInterface $content = null): Tag
    {
        return new Tag($tagName, $tagAttributes, $content);
    }

    /**
     * Creates TagContent object
     *
     * @param string $content
     * @param array $markReplacements
     * @return TagContent
     */
    public function createTagContent(string $content, array $markReplacements = []): TagContent
    {
        return new TagContent($content, $markReplacements);
    }
}
