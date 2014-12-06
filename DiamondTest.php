<?php

class DiamondTest extends \PHPUnit_Framework_TestCase
{
    public function testASingleLetter()
    {
        $this->assertEquals("A\n", (new Diamond("A"))->__toString());
    }

    public function testTwoLetters()
    {
        $this->assertEquals(
              " A \n" 
            . "B B\n"
            . " A \n"
            , (new Diamond("B"))->__toString());
    }

    public function testThreeLetters()
    {
        $this->assertEquals(
              "  A  \n" 
            . " B B \n"
            . "C   C\n"
            . " B B \n"
            . "  A  \n" 
            , (new Diamond("C"))->__toString());
    }

    public function testFourLetters()
    {
        $this->assertEquals(
              "   A   \n" 
            . "  B B  \n"
            . " C   C \n"
            . "D     D\n"
            . " C   C \n"
            . "  B B  \n"
            . "   A   \n" 
            , (new Diamond("D"))->__toString());
    }
}

class Diamond
{
    private $finalLetter;
    private $order;
    private $letters = [
        'A',
        'B',
        'C',
        'D',
    ];
    
    public function __construct($finalLetter)
    {
        $this->finalLetter = $finalLetter;
        $this->order = array_search($finalLetter, $this->letters);
        $this->size = $this->order * 2 + 1;
    }

    public function __toString()
    {
        $spaces = str_repeat(' ', $this->order);
        $lines = [];
        $lines[] = $spaces . $this->letters[0] . $spaces;
        for ($i = 1; $i <= $this->order; $i++) {
            $externalSpaces = $this->spaces($this->order - $i);
            $internalSpaces = $this->spaces(($i * 2) - 1);
            $lines[] = "{$externalSpaces}{$this->letters[$i]}{$internalSpaces}{$this->letters[$i]}{$externalSpaces}";
        }
        for ($i = $this->order + 1; $i < $this->size; $i++) {
            $lines[$i] = $lines[$this->size - $i - 1];
        }
        return implode("\n", $lines) . "\n";
    }

    private function spaces($number)
    {
        return str_repeat(' ', $number);
    }
}
