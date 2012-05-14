<?php
  namespace IronParsers\commON;

  /**
 * Generated by PHPUnit_SkeletonGenerator on 2012-05-11 at 21:31:06.
 */
class ReaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Reader
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new \IronParsers\commON\Reader(__DIR__ . "/../_files/test.csv");
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers EasyCSV\Reader::getRow
     */
    public function testGetRow()
    {
      $row = $this->object->getRow();
      $this->assertEquals('abridgerExpression',$row[0], "The first row in the file is the first row of data ");
      $this->assertEquals('Eine Person, Familie oder Körperschaft, die eine Expression eines Werkes kürzt oder zusammenfasst, dabei aber das Wesen des Originalwerkes unverändert lässt. ', $row[8]);

    }

  /**
   * @covers EasyCSV\Reader::getRow
   */
  public function testGetCsvRecords()
  {
    $row = $this->object->getCsvRecords();
    $this->assertInternalType('array', $row);
    $this->assertEquals('&&recordList',$row[0][0], "The first row is %%recordList");
    $this->assertEquals('&id', $row[1][0], 'the second row is the headers');
    }

  /**
     * @covers EasyCSV\Reader::getAll
     * This is a very ham-handed functional test that takes a pre-defined csv file and compares
     * all of the resulting commON records.
     *
     * There are a few lines commented out that can be used to generate a new serialized
     * array of the commON records if the source file is updated for content or format.
     * This should be run once and should be checked by human to verify correctness.
     */
    public function testGetAll()
    {
      $data = $this->object->getAll();
      $filename = __DIR__ .  "/../_files/csvTest.inc";
      $goodArray = array();
      if (is_readable($filename))
      {
        $handle = fopen($filename,"r");
        if ($handle) {
          $goodArray = fread($handle, filesize($filename));
          fclose($handle);
        }
      }
      $this->assertArrayHasKey('recordlist',$data);
      $this->assertArrayHasKey('dataset',$data);
      $this->assertArrayHasKey('linkage',$data);
      $this->assertCount(3, $data['recordlist']);
      $this->assertEquals($goodArray, serialize($data));

      //writes out a good array for testing if enabled
      //$handle = fopen($filename,"w");
      //fwrite($handle, serialize($data));
      //fclose($handle);
    }

    /**
     * @covers EasyCSV\Reader::getLineNumber
     */
    public function testGetLineNumber()
    {
      $this->assertEquals(2,$this->object->getLineNumber(),"Initial state of object is on the line 2 of the data after the headers");
    }
}
