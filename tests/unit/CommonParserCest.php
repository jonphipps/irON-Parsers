<?php
  /**
   * Created by JetBrains PhpStorm.
   * User: jphipps
   * Date: 5/4/12
   * Time: 6:07 PM
   * To change this template use File | Settings | File Templates.
   */


  use Codeception\Util\Stub as Stub;

  Class CommonParserCest
  {
    public $class = 'CommonParser';

    public $goodCSV = <<< 'CSV'
abridgerExpression,Property,New-Proposed,abridgerExpression,Abridger (Expression),Abridger (Expression),Note that this definition column does not have a ‟language” attribute in the header. The 'default' language for this column is specified in the attribute map.,"A person, family, or corporate body contributing to an expression of a work by shortening or condensing the original work but leaving the nature and content of the original work substantially unchanged.","Eine Person, Familie oder Körperschaft, die eine Expression eines Werkes kürzt oder zusammenfasst, dabei aber das Wesen des Originalwerkes unverändert lässt. ",rdafrbr:Expression,,rdaroles:contributor,3
CSV;

    public function _before() {

    }

    public function checkForBlank (CodeGuy $I)
    {
      $I->haveStub($commonParser = Stub::makeEmptyExcept($this->class, 'checkForBlank'));

      $I->wantTo('test blank records processing')
        ->expect('a truly blank record returns true')
        ->executeTestedMethod($commonParser, str_getcsv (""))
        ->seeResultEquals(true);

      $I->expect('a record with no data returns true')
        ->executeTestedMethod($commonParser, str_getcsv (",,,,,"))
        ->seeResultEquals(TRUE);

      $I->expect('a linkage record returns false')
        ->executeTestedMethod($commonParser, str_getcsv ('"&&Linkage",,,,,'))
        ->seeResultEquals(false);

    }

    public function checkForSection (CodeGuy $I)
    {
      $I->haveStub($commonParser = Stub::makeEmptyExcept($this->class, 'checkForSection'));

      $I->wantTo('test the section parser');

      $I->expect('that a linkage record returns linkage')
        ->executeTestedMethod($commonParser, str_getcsv ('"&&Linkage",,,,,'))
        ->seeResultEquals('linkage');

      $I->expect('that a recordList record returns recordlist')
        ->executeTestedMethod($commonParser, str_getcsv ('"&&recordList",,,,,'))
        ->seeResultEquals('record');

      $I->expect('that a DATASET record returns dataset')
        ->executeTestedMethod($commonParser, str_getcsv ('"&&DATASET",,,,,'))
        ->seeResultEquals('dataset');

      $I->expect('that a foobar record returns unknown')
        ->executeTestedMethod($commonParser, str_getcsv ('"&&fooBar",,,,,'))
        ->seeResultEquals('unknown');

      $I->expect('that not a record returns false')
        ->executeTestedMethod($commonParser, str_getcsv ('"bingo bango",,,,,'))
        ->seeResultEquals(false);
    }

    public function csvParser (CodeGuy $I)
    {
      $I->haveStub($commonParser = Stub::makeEmptyExcept($this->class, 'csvParser'));

      $I->wantTo('test the csv parser');

      $I->expect('csv record returns an array')
        ->executeTestedMethod($commonParser, $this->goodCSV)
        ->seeResultEquals(str_getcsv($this->goodCSV))
        ->seeResultIs('array');


    }

  }



