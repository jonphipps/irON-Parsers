<?php

  namespace EasyCSV;

  class CommonReader extends AbstractBase
  {
    private $_headers;
    private $_line;
    private $_dataMode;

    public function __construct ($path, $mode = 'r+')
    {
      parent::__construct($path, $mode);

      //check for a &&RecordList in the first row

      if (($row = $this->getRow())) {
        $this->getSectionHead($row, FALSE);
      }
    }

    public function getDataRow ($row)
    {
      if ($row) {
        return $this->_headers ? array_combine($this->_headers, $row) : $row;
      }
      return FALSE;
    }

    public function getRow ()
    {
      static $row;
      if (($row = fgetcsv($this->_handle, 1000, $this->_delimiter, $this->_enclosure)) !== FALSE) {
        $this->_line++;
        //is it a row with no values at all?
        if (is_array($row)) {
          $blankCheck = array_unique($row);
          if (is_array($blankCheck) && 1 == count($blankCheck) && '' == trim($blankCheck[0])) {
            //then get the next one
            $this->getRow();
          }
        }
        else {
          $this->getRow();
        }
        return $row;
      }
    }

    public function getAll ()
    {
      $data = array(
        'recordlist' => array(),
        'dataset'   => array(),
        'linkage'   => array()
      );

      $linkageSection = 'description';

      while (($row = $this->getRow())) {

        $row = $this->getSectionHead($row);

        switch ($this->_dataMode) {
          case "linkage":

            //in the linkage section we trim off the empty columns to the right
            $row =$this->rtrimRow($row);

            //is it a section head?
            if (preg_match("/^&/", $row[0])) {
              $linkageSection = strtolower(substr($row[0], 1));
              $this->_headers = $row;
              break;
            }
            //description is a special case
            if ("description" == $linkageSection) {
              $data['linkage'][$linkageSection] = $this->getDataRow($row);
              break;
            }

            $data['linkage'][$linkageSection][$row[0]] = $row[1];
            break;

          case "recordlist":
            $data['recordlist'][] = $this->getDataRow($row);
            break;

          case "dataset":

            //in the dataset section we trim off the empty columns to the right
            $row = $this->rtrimRow($row);

            $data['dataset'] = $this->getDataRow($row);
            break;

          default:
        }
      }
      return $data;
    }

    public function getLineNumber ()
    {
      return $this->_line;
    }

    public function  getSectionHead ($row, $getDataRow = TRUE)
    {
      //is it a section head?
      if (preg_match("/^&&/", $row[0])) {
        $this->_dataMode = strtolower(substr($row[0], 2));
        //we go ahead and get the next row
        $row            = $this->getRow();
        $this->_headers = $row;
        if ($getDataRow) {
          $row = $this->getRow();
        }
      }

      return $row;
    }

    public function rtrimRow ($row){

      //(http://stackoverflow.com/questions/8663316)
      $row = array_slice($row, 0, key(array_reverse(array_diff($row, array("")), 1)) + 1);

      //trim the headers too
      if (count($row < count($this->_headers))) {
        $this->_headers = array_slice($this->_headers, 0, key(array_reverse(array_diff($this->_headers, array("")), 1)) + 1);
      }

      return $row;
    }
  }