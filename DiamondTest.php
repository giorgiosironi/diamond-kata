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
        $externalSpaces = $this->spaces($this->order);
        $lines = [];
        $lines[] = $this->overlapBy1(
            $externalSpaces . $this->letters[0],
            strrev($externalSpaces . $this->letters[0])
        );
        for ($i = 1; $i <= $this->order; $i++) {
            $externalSpaces = $this->spaces($this->order - $i);
            $internalSpaces = $this->spaces($i);
            $leftPart = $externalSpaces . $this->letters[$i];
            $lines[] = $this->overlapBy1(
                $leftPart . $internalSpaces,
                strrev($leftPart . $internalSpaces)
            );
        }
        for ($i = $this->order + 1; $i < $this->size; $i++) {
            $oppositeLine = $this->size - $i - 1;
            $lines[$i] = $lines[$oppositeLine];
        }
        return implode("\n", $lines) . "\n";
    }

    private function overlapBy1($first, $second)
    {
        return substr($first, 0, -1) . $second;
    }

    private function spaces($number)
    {
        return str_repeat(' ', $number);
    }
}
