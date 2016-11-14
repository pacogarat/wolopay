<?php
namespace AppBundle\Doctrine\CustomFunctions\Mysql;


use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\SqlWalker;


class RoundFunction  extends FunctionNode {
    private $arithmeticExpression;
    private $decimals;

    public function getSql(SqlWalker $sqlWalker)
    {
        $extra="";
        if ($this->decimals){
            $extra = "," . $sqlWalker->walkSimpleArithmeticExpression($this->decimals);
        }

        $ret = 'ROUND(' . $sqlWalker->walkSimpleArithmeticExpression($this->arithmeticExpression) .
            $extra .
            ')';
        return $ret;
    }

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {

        $lexer = $parser->getLexer();

        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->arithmeticExpression = $parser->SimpleArithmeticExpression();

        if ($lexer->isNextToken(Lexer::T_COMMA)){
            $parser->match(Lexer::T_COMMA);
            $this->decimals = $parser->SimpleArithmeticExpression();
        }

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
