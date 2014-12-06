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
}

class Diamond
{
    private $finalLetter;
    private $order;
    private $letters = [
        'A',
        'B',
        'C',
    ];
    
    public function __construct($finalLetter)
    {
        $this->finalLetter = $finalLetter;
        $this->order = array_search($finalLetter, $this->letters);
    }

    public function __toString()
    {
        $spaces = str_repeat(' ', $this->order);
        $lines = [];
        $line = $spaces . $this->letters[0] . $spaces . "\n";
        $lines[] = $line;
        $secondLine = '';
        $thirdLine = '';
        $fourthLine = '';
        $fifthLine = '';
        if ($this->order == 1) {
            $secondLine = "{$this->letters[1]} {$this->letters[1]}\n";
            $lines[] = $secondLine;
            $thirdLine = $line;
            $lines[2] = $lines[0];
        }
        if ($this->order == 2) {
            $secondLine = " {$this->letters[1]} {$this->letters[1]} \n";
            $lines[] = $secondLine;
            $thirdLine = "{$this->letters[2]}   {$this->letters[2]}\n";
            $lines[] = $thirdLine;
            $fourthLine = $secondLine;
            $lines[3] = $lines[1];
            $fifthLine = $line;
            $lines[4] = $lines[0];
        }
        return implode('', $lines);
    }
}
