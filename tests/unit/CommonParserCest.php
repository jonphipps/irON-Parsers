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

    Public $class = 'CommonParser';

    public function checkForBlank (CodeGuy $I)
    {

      $I->haveStub($commonParser = Stub::makeEmptyExcept($this->class, 'checkForBlank'));
      xdebug_break();

      $I->wantTo('test a truly blank record')
        ->executeTestedMethod($commonParser, "")
        ->seeResultEquals(false);
      $I->wantTo('test a truly blank record')
        ->executeTestedMethod($commonParser, "")
        ->seeResultEquals(false);

      $I->wantTo('test a record with no data')
        ->executeTestedMethod($commonParser, ",,,,,")
        ->seeResultEquals(TRUE);

      $I->wantTo('test a linkage record')
        ->executeTestedMethod($commonParser, "&&Linkage,,,,,")
        ->seeResultEquals(false);

    }
  }



