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
}

class Diamond
{
    private $finalLetter;
    private $order;
    private $letters = [
        'A',
        'B',
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
        if ($this->order > 0) {
            $secondLine = "{$this->letters[1]} {$this->letters[1]}\n";
            $thirdLine = $line;
        }
        return $line . $secondLine . $thirdLine;
    }
}
