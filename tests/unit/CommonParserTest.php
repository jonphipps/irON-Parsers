<?php
  namespace IronParsers\commON;

  /**
   * Generated by PHPUnit_SkeletonGenerator on 2012-05-11 at 15:19:04.
   */
  class CommonParserTest extends \PHPUnit_Framework_TestCase
  {
    /**
     * @var CommonParser
     */
    protected $object;

    static private $goodCsvFile;

    public function  __construct ()
    {
      self::$goodCsvFile = file_get_contents(__DIR__ . "/../_files/bkn_dataset_20091020.csv");
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
     * @covers IronParsers\commON\CommonParser::getCsvRecords
     */
    public function testGetCsvRecords ()
    {
      $csvRecords = $this->object->getCsvRecords();
      $this->assertCount(139, $csvRecords);
    }

    /**
     * @covers IronParsers\commON\CommonParser::getCommonRecords
     */
    public function testGetCommonRecords ()
    {
      $Records = $this->object->getCommonRecords();
      $this->assertCount(101, $Records);
    }

    /**
     * @covers IronParsers\commON\CommonParser::getLinkageSchema
     * @todo   Implement testGetLinkageSchema().
     */
    public function testGetLinkageSchema ()
    {
      $Linkage = $this->object->getLinkageSchema();
      $this->assertCount(2, $Linkage['description']);
      $this->assertCount(17, $Linkage['properties']);
      $this->assertCount(2, $Linkage['properties'][0]);
      $this->assertCount(14, $Linkage['types']);
      $this->assertCount(3, $Linkage);
      $this->assertEquals('1.03', $Linkage['description']['&version'][0], "The version is 1.03");
      $this->assertEquals('person', $Linkage['types'][0]['&typeList'][0], "The first entry in types is 'person'");
      $this->assertEquals(' http://xmlns.com/foaf/0.1/Person', $Linkage['types'][0]['&mapTo'][0], "The first entry in types is 'person' and is mapped to foaf:person");
    }

    /**
     * @covers IronParsers\commON\CommonParser::getDataset
     */
    public function testGetDataset ()
    {
      $dataset = $this->object->getDataset();
      $this->assertCount(0, $dataset);
    }

    /**
     * @covers IronParsers\commON\CommonParser::getCsvErrors
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
     * @covers IronParsers\commON\CommonParser::getCommonErrors
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
     * @covers IronParsers\commON\CommonParser::getRdfN3
     */
    public function testGetRdfN3 ()
    {
      // Remove the following lines when you implement this test.
      $rdf = $this->object->getRdfN3("http://example.org/testme/");
//      $file = fopen(__DIR__ . "/../_files/testRdfN3.xml", "w");
//      fwrite($file, $rdf);
//      fclose($file);
      $this->assertContains('<http://example.org/testme/deleeuw> a <http://xmlns.com/foaf/0.1/Person> .', $rdf);
    }

    /**
     * @covers IronParsers\commON\CommonParser::getLinkedProperty
     */
    public function testGetLinkedProperty ()
    {
      $result = $this->object->getLinkedProperty("prefLabel");
      $this->assertEquals("http://www.w3.org/2008/05/skos#prefLabel", $result);
      $this->assertEquals("", $this->object->getLinkedProperty("byteme"), "Bad property returns empty string");
    }

    /**
     * @covers IronParsers\commON\CommonParser::getLinkedType
     */
    public function testGetLinkedType ()
    {
      $result = $this->object->getLinkedType("person");
      $this->assertEquals("http://xmlns.com/foaf/0.1/Person", $result);
      $this->assertEquals("", $this->object->getLinkedType("byteme"), "Bad type returns empty string");
    }
  }
