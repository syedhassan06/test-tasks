<?php

class BinaryToLetterConverter{

    private $name;

    private $binaryNumList = [
    '01110000', '01110010' ,'01101001', '01101110', '01110100', '00100000', '01101111', '01110101',
    '01110100', '00100000', '01111001', '01101111', '01110101', '01110010', '00100000', '01101110',
    '01100001', '01101101', '01100101', '00100000', '01110111', '01101001', '01110100', '01101000',
    '00100000', '01101111', '01101110', '01100101', '00100000', '01101111', '01100110', '00100000',
    '01110000', '01101000', '01110000', '00100000', '01101100', '01101111', '01101111', '01110000',
    '01110011'
    ];

    private $mappedDecimalLetter = [];

    public function __construct($name='')
    {
        $this->name = $name;
        $this->convert();
    }

    public function convert(){
        foreach ($this->binaryNumList as $item){
            $this->mappedDecimalLetter[] = [
                'binary'=>$item,
                'decimal'=>bindec($item),
                'letter'=>chr(bindec($item)),
            ];
        }
        $this->displayOutput();
    }

    public function displayOutput(){
        $input = '';
        $result = '';
        $nameBinaryMapped = [ 'name'=>'' , 'binary'=>'' ];
        $headingStyle = 'font-family: Trebuchet MS;margin-bottom: 10px;';
        $contentStyle = 'font-family: Trebuchet MS;margin-bottom: 2em;';

        foreach ($this->mappedDecimalLetter as $item){
            $result .= $item['letter'];
            $input .= $item['binary']." ";
        }

        //Finding the name of letters from available list
        if( $this->name && is_string($this->name) && strlen(trim($this->name))>0 ){
            $availableLetterList = array_column( $this->mappedDecimalLetter, 'letter' );

            foreach (str_split($this->name) as $letter){
                if( in_array( $letter, $availableLetterList ) ){
                    $nameBinaryMapped['name'] .= $letter;
                    $nameBinaryMapped['binary'] .= decbin(ord($letter)) ." ";
                }
            }

        }


        echo "<h3 style='${headingStyle}'><u>Binary Input</u></h3>";
        echo "<div style='${contentStyle}' >".$input."</div>";

        echo "<h3 style='${headingStyle}'><u>Binary Input To Letter</u></h3>";
        echo "<div style='${contentStyle}' >".$result."</div>";

        echo "<h3 style='${headingStyle}'><u>Print Your Name</u></h3>";
        echo "<div style='${contentStyle}' >".$nameBinaryMapped['name']."</div>";

        echo "<h3 style='${headingStyle}'><u>Name To Binary Conversion</u></h3>";
        echo "<div style='${contentStyle}' >".$nameBinaryMapped['binary']."</div>";

    }
}

new BinaryToLetterConverter('hassan');

?>
