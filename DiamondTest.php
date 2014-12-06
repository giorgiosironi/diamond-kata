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
        $line = $spaces . $this->letters[0] . $spaces . "\n";
        $secondLine = '';
        $thirdLine = '';
        $fourthLine = '';
        $fifthLine = '';
        if ($this->order == 1) {
            $secondLine = "{$this->letters[1]} {$this->letters[1]}\n";
            $thirdLine = $line;
        }
        if ($this->order == 2) {
            $secondLine = " {$this->letters[1]} {$this->letters[1]} \n";
            $thirdLine = "{$this->letters[2]}   {$this->letters[2]}\n";
            $fourthLine = $secondLine;
            $fifthLine = $line;
        }
        return $line . $secondLine . $thirdLine . $fourthLine . $fifthLine;
    }
}
