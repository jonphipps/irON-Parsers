<?php
  /**
   * Created by JetBrains PhpStorm.
   * User: jphipps
   * Date: 5/4/14
   * Time: 6:07 AM
   * To change this template use File | Settings | File Templates.
   */


  use Codeception\Util\Stub as Stub;

  Class ReaderCest
  {
    public $class = '\IronParsers\CommON\Reader';

    private static $testFile;
    private static $row;

    public function _before() {
      self::$testFile = __DIR__ . '/../_files/test.csv';
    }

    /**
     * @covers EasyCSV\Reader::getRow
     */
    public function testGetRow(CodeGuy $I)
    { //xdebug_break();
      //echo phpinfo();
      $reader = new \IronParsers\commON\Reader(self::$testFile);
      $I->execute(function() use ($reader) {
      $row =  $reader->getRow();
        return $row [0];
      });
      $I->seeResultEquals('abridgerExpression');
      //assertEquals('abridgerExpression',$row[0], "The first row in the file is the first row of data ");
      $reader = new \IronParsers\commON\Reader(self::$testFile);
      $I->execute(function() use ($reader) {
        $row =  $reader->getRow();
        return $row [8];
      });
      $I->seeResultEquals('Eine Person, Familie oder Körperschaft, die eine Expression eines Werkes kürzt oder zusammenfasst, dabei aber das Wesen des Originalwerkes unverändert lässt. ');
      //assertEquals('Eine Person, Familie oder Körperschaft, die eine Expression eines Werkes kürzt oder zusammenfasst, dabei aber das Wesen des Originalwerkes unverändert lässt. ', $row[8]);

      $reader = new \IronParsers\commON\Reader(self::$testFile);
      $row =  $reader->getRow();
      $I->seeArrayValueEquals('abridgerExpression', $row[0]);
      $I->seeArrayValueEquals('Eine Person, Familie oder Körperschaft, die eine Expression eines Werkes kürzt oder zusammenfasst, dabei aber das Wesen des Originalwerkes unverändert lässt. ', $row[8]);


    }

    /**
     *
     * */

  }



