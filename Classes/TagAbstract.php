<?php
namespace Innologi\TagBuilder;

/**
 * Abstract Tag class
 *
 * @package TagBuilder
 * @author Frenck Lutke
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 2 or later
 */
abstract class TagAbstract implements TagInterface
{

    /**
     *
     * {@inheritdoc}
     * @see TagInterface::getContent()
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     *
     * {@inheritdoc}
     * @see TagInterface::setContent()
     */
    public function setContent($content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     *
     * {@inheritdoc}
     * @see TagInterface::__toString()
     */
    public function __toString(): string
    {
        return $this->render();
    }
}
