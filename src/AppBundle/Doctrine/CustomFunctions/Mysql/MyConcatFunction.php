<?php
namespace AppBundle\Doctrine\CustomFunctions\Mysql;


use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\SqlWalker;


class MyConcatFunction  extends FunctionNode {
    private $exp1;
    private $exp2;
    private $concatExpressions = array();

    public function getSql(SqlWalker $sqlWalker)
    {
        $str= 'CONCAT(' .
            $sqlWalker->walkStringPrimary($this->exp1)  .','. $sqlWalker->walkStringPrimary($this->exp2) ;


        foreach ($this->concatExpressions as $expression){
            if ($expression<>""){
                $str .= "," . $sqlWalker->walkStringPrimary($expression);
            }
        }

        $str.=')';

        return $str;
    }

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->exp1 = $parser->SimpleArithmeticExpression();

        $parser->match(Lexer::T_COMMA);

        $this->exp2 = $parser->SimpleArithmeticExpression();

        while ($parser->getLexer()->isNextToken(Lexer::T_COMMA)) {
            $parser->match(Lexer::T_COMMA);
            $this->concatExpressions[] = $parser->SimpleArithmeticExpression();
        }

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
