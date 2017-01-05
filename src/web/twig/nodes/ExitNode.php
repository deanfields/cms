<?php
/**
 * @link      https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license   https://craftcms.com/license
 */

namespace craft\web\twig\nodes;

use Craft;
use yii\web\HttpException;

/**
 * Class ExitNode
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since  3.0
 */
class ExitNode extends \Twig_Node
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);

        if ($status = $this->getNode('status')) {
            $compiler
                ->write('throw new '.HttpException::class.'(')
                ->subcompile($status)
                ->raw(");\n");
        } else {
            $compiler->write(Craft::class."::\$app->end();\n");
        }
    }
}
