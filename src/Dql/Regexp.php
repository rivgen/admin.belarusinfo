<?php
namespace App\Dql;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

class Regexp extends FunctionNode
{
    public $value = null;

    public $regexp = null;

    const T_IDENTIFIER = 102;
    const T_OPEN_PARENTHESIS  = 7;
    const T_COMMA             = 8;
    const T_CLOSE_PARENTHESIS = 6;
    public function parse(Parser $parser): void
    {
        $parser->match(self::T_IDENTIFIER);
        $parser->match(self::T_OPEN_PARENTHESIS);
        $this->value = $parser->StringPrimary();
        $parser->match(self::T_COMMA);
        $this->regexp = $parser->StringExpression();
        $parser->match(self::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker): string
    {
        return '(' . $this->value->dispatch($sqlWalker) . ' REGEXP ' . $this->regexp->dispatch($sqlWalker) . ')';
    }
}