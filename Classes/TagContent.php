<?php
namespace Innologi\TagBuilder;

/**
 * Custom TagContent object
 *
 * Represents content of a tag. Normally, this is a string, and can be interchangable with
 * other TagInterface classes. TagContent can additionaly contain multiple other
 * TagInterfaces within $markReplacements, that will be rendered into $content where $content
 * has corresponding marks.
 *
 * @package TagBuilder
 * @author Frenck Lutke
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 2 or later
 */
class TagContent extends TagAbstract
{

    /**
     *
     * @var string
     */
    protected $content = '';

    /**
     *
     * @var array
     */
    protected $markReplacements = [];

    /**
     * Constructor
     *
     * @param string $content
     * @oaran array $markReplacements
     * @return void
     */
    public function __construct(string $content = '', array $markReplacements = [])
    {
        $this->content = $content;
        $this->markReplacements = $markReplacements;
    }

    /**
     *
     * {@inheritdoc}
     * @see TagInterface::hasContent()
     */
    public function hasContent(): bool
    {
        return isset($this->content[0]);
    }

    /**
     * Adds mark replacements for content
     *
     * @param array $markReplacements
     * @return $this
     */
    public function addMarkReplacements(array $markReplacements): self
    {
        $this->markReplacements = $markReplacements + $this->markReplacements;
        return $this;
    }

    /**
     *
     * {@inheritdoc}
     * @see TagInterface::render()
     */
    public function render(): string
    {
        $content = $this->content;
        /** @var TagInterface $tag */
        foreach ($this->markReplacements as $mark => $tag) {
            $content = str_replace($mark, $tag->render(), $content);
        }
        return $content;
    }

    /**
     *
     * {@inheritdoc}
     * @see TagInterface::reset()
     */
    public function reset(): self
    {
        $this->content = '';
        $this->markReplacements = [];
        return $this;
    }
}
