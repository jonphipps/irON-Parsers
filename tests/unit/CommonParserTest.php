<?php
  /**
   * Generated by PHPUnit_SkeletonGenerator on 2012-05-07 at 09:25:14.
   */

  require_once __DIR__ .  "/../../commON/CommonParser.php";


  class CommonParserTest extends PHPUnit_Framework_TestCase
  {
    /**
     * @var CommonParser
     */
    protected $object;
    static private $goodCsvFile;

  public function  __construct(){
    self::$goodCsvFile = file_get_contents(__DIR__ . "/../../../../public/vocabs/vocab-test/test.csv");
    parent::__construct();
  }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp ()
    {
      $this->object = new CommonParser(self::$goodCsvFile);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown ()
    {
    }

    /**
     * @covers CommonParser::getCsvRecords
     * @todo   Implement testGetCsvRecords().
     */
    public function testGetCsvRecords ()
    {
      // Remove the following lines when you implement this test.
      $csvRecords = $this->object->getCsvRecords();
      $this->assertCount(39,$csvRecords);
    }

    /**
     * @covers CommonParser::getCommonRecords
     * @todo   Implement testGetCommonRecords().
     */
    public function testGetCommonRecords ()
    {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
    }

    /**
     * @covers CommonParser::getLinkageSchema
     * @todo   Implement testGetLinkageSchema().
     */
    public function testGetLinkageSchema ()
    {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
    }

    /**
     * @covers CommonParser::getDataset
     * @todo   Implement testGetDataset().
     */
    public function testGetDataset ()
    {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
    }

    /**
     * @covers CommonParser::getCsvErrors
     * @todo   Implement testGetCsvErrors().
     */
    public function testGetCsvErrors ()
    {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
    }

    /**
     * @covers CommonParser::getCommonErrors
     * @todo   Implement testGetCommonErrors().
     */
    public function testGetCommonErrors ()
    {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
    }

    /**
     * @covers CommonParser::getRdfN3
     * @todo   Implement testGetRdfN3().
     */
    public function testGetRdfN3 ()
    {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
    }

    /**
     * @covers CommonParser::getLinkedProperty
     * @todo   Implement testGetLinkedProperty().
     */
    public function testGetLinkedProperty ()
    {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
    }

    /**
     * @covers CommonParser::getLinkedType
     * @todo   Implement testGetLinkedType().
     */
    public function testGetLinkedType ()
    {
      // Remove the following lines when you implement this test.
      $this->markTestIncomplete(
        'This test has not been implemented yet.'
      );
    }
  }