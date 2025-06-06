<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 * (c) Armin Ronacher
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ElementorDeps\Twig\Node;

use ElementorDeps\Twig\Attribute\YieldReady;
use ElementorDeps\Twig\Compiler;
/**
 * Represents a block call node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
#[\Twig\Attribute\YieldReady]
class BlockReferenceNode extends Node implements NodeOutputInterface
{
    public function __construct(string $name, int $lineno, ?string $tag = null)
    {
        parent::__construct([], ['name' => $name], $lineno, $tag);
    }
    public function compile(Compiler $compiler) : void
    {
        $compiler->addDebugInfo($this)->write(\sprintf("yield from \$this->unwrap()->yieldBlock('%s', \$context, \$blocks);\n", $this->getAttribute('name')));
    }
}
