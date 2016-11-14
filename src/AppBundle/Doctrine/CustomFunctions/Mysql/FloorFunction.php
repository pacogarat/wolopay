<?php
namespace AppBundle\Doctrine\CustomFunctions\Mysql;


use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\SqlWalker;


class FloorFunction  extends FunctionNode {
    private $arithmeticExpression;
    private $decimals;

    public function getSql(SqlWalker $sqlWalker)
    {
        return  'FLOOR(' . $sqlWalker->walkSimpleArithmeticExpression($this->arithmeticExpression) . ')';
    }

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {

        $lexer = $parser->getLexer();

        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->arithmeticExpression = $parser->SimpleArithmeticExpression();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
