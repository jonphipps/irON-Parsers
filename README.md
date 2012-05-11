Introduction
============

**irON** (**instance record** and **Object Notation**) is a abstract notation and associated vocabulary for specifying [RDF](http://techwiki.openstructs.org/index.php/RDF_Concept)  (Resource Description Framework) triples and schema in non-RDF forms. Its purpose is to allow users and tools in non-RDF formats to stage interoperable datasets using RDF.

The notation supports writing RDF and schema in [JSON](http://techwiki.openstructs.org/index.php/JSON_Concept)  (**irJSON**), [XML](http://techwiki.openstructs.org/index.php/XML_Concept) (**irXML**) and comma-delimited ([CSV](http://techwiki.openstructs.org/index.php/CSV_Concept)) formats (**commON**) The notation specification includes guidance for creating instance records (including in bulk), linkages to existing ontologies and schema, and schema definitions.

irON Parsers is a set of irON profiles parsers written in PHP. These parsers can output different kind of structures from the parsed irON files. Check below for more usage information.

The current parsers that have been developed are:

* commON Parser
* irJSON Parser

Documentation
=============

The [irON Specification](http://techwiki.openstructs.org/index.php/Instance_Record_and_Object_Notation_\(irON\)_Specification) explains what is irON, what is the difference between all profiles (commON, irXML and irJSON). It also explains how to write a valid file for any of these formats.

There is also a good [commON case study](http://techwiki.openstructs.org/index.php/CommON_Case_Study) that explains how the commON format can be written using any spreadsheet application.

Using the commON Parser
=======================

Using the commON parser is quite simple. There is basically 3 main areas:

* Creating the parser's object and parsing the commON document
* Checking for parsing errors
* Getting the parsed data into different formats

The first thing to do is to create the commON's parser object with the commON file we want to parse:

```php
  <?php
    include_once("CommonParser.php");
  
    $commONFileContent = file_get_contents("/tmp/myCommonFile.csv");
  
    $parser = new CommonParser($commONFileContent);
  ?>
```

The next thing to do is to check if the parser found any error into the commON file:

```php
  <?php
    if($parser->getErrors())
    {
      echo "There are errors!";
	} 
  ?>
```

If there are errors, then we can check what these errors are. There are two kind of errors:

* Errors that come from the CSV file, according to the CSV specification
* Errors that come from the commON format, according to the irON+commON specification

```php
  <?php
    echo "<h2>Parsing Errors</h2>";

    foreach($parser->getErrors() as $key => $error)
    {
      echo $key . ". " . $error . "<br />";
    }
  ?>
```

If there is no errors, then we can output the parsed records in different formats:

```php
  <?php
    echo "<h2>CSV Records</h2>";

    var_dump($parser->getCsvRecords());

    echo "<h2>Common Records</h2>";

    var_dump($parser->getCommonRecords());

    echo "<h2>Linkage Schema</h2>";

    var_dump($parser->getLinkageSchema());
  
    echo "<h2>RDF+N3 FIle</h2>";

    var_dump($parser->getRdfN3());
  ?>
```

There is the complete example:

```php
<?php
  include_once("CommonParser.php");
  
  $commONFileContent = file_get_contents("/tmp/myCommonFile.csv");
  
  $parser = new CommonParser($commONFileContent);

  if(!$parser->getErrors())
  {
    echo "<h2>CSV Records</h2>";

    var_dump($parser->getCsvRecords());

    echo "<h2>Common Records</h2>";

    var_dump($parser->getCommonRecords());

    echo "<h2>Linkage Schema</h2>";

    var_dump($parser->getLinkageSchema());
  
    echo "<h2>RDF+N3 FIle</h2>";

    var_dump($parser->getRdfN3());	
  }
  else
  {
    echo "<h2>Parsing Errors</h2>";

    foreach($parser->getErrors() as $key => $error)
    {
      echo $key . ". " . $error . "<br />";
    }
  }
?> 
```

Some Data Structures
--------------------

If you are using the API <code>getCsvRecords()</code>, the returned result will be a PHP array formatted this way:

```text
    Array
    (
        [0] => &&recordList
    )
    Array
    (
        [0] => &id
        [1] => &type
        [2] => &prefLabel
        [3] => &homepage
        [4] => &authorClaimsPage
        [5] => &isAuthorOfTitle
        [6] => &isAuthorOfTitle&prefURL
    )
    Array
    (
        [0] => info:lib:am:2009-02-18:maria_francisca_abad_garcia
        [1] => Person
        [2] => Maria Francisca Abad-Garcia
        [3] =>
        [4] => http://authorclaim.org/profile/pab1/
        [5] => Acceso Abierto y revistas madicas espaolas
        [6] => http://eprints.rclis.org/11490/1/open_acces_Medicina_Cl%C3%ADnica_2006_versi%C3%B3n_aceptada_del_autor.pdf
    )
     
    ...
```

If you are using the API <code>getCommonRecords()</code>, the returned result will be a PHP array formatted this way:

```text
  Array
  (
      [0] => Array
          (
              [&id] => Array
                  (
                      [0] => Array
                          (
                              [value] => info:lib:am:2009-02-18:maria_francisca_abad_garcia
                              [reify] =>
                          )
  
                  )
  
              [&type] => Array
                  (
                      [0] => Array
                          (
                              [value] => Person
                              [reify] =>
                          )
  
                  )
  
              [&prefLabel] => Array
                  (
                      [0] => Array
                          (
                              [value] => Maria Francisca Abad-Garcia
                              [reify] =>
                          )
  
                  )

                    [&homepage] => Array
                  (
                      [0] => Array                        
                          (
                              [value] => Personal Data in a Large Digital Library.
                              [reify] => Array
                                  (
                                      [&prefURL] => Array
                                          (
                                              [0] => http://dblp.uni-trier.de/db/conf/ercimdl/ecdl2000.html#CruzKK00
                                          )
  
                                  )
  
                          )
          )
                  
        ...
      )
      
    ...
  
  )
```

If you are using the API <code>getCommonLinkageSchema()</code>, the returned result will be a PHP array formatted this way:

```text
    Array
    (
        [description] => Array
            (
                [&version] => Array
                    (
                        [0] => 0.1
                    )
    
                [&linkageType] => Array
                    (
                        [0] => application/rdf+xml
                    )
    
            )
    
        [properties] => Array
            (
                [0] => Array
                    (
                        [&attributeList] => Array
                            (
                                [0] => prefLabel
                            )
    
                        [&mapTo] => Array
                            (
                                [0] => http://www.w3.org/2000/01/rdf-schema#label
                            )
    
                    )
    
                [1] => Array
                    (
                        [&attributeList] => Array
                            (
                                [0] => homepage
                            )
    
                        [&mapTo] => Array
                            (
                                [0] => http://xmlns.com/foaf/0.1/homepage
                            )
    
                    )
    
                [2] => Array
                    (
                        [&attributeList] => Array
                            (
                                [0] => prefURL
                            )
    
                        [&mapTo] => Array
                            (
                                [0] => http://purl.org/ontology/bibo/uri
                            )
    
                    )
    
            )
    
        [types] => Array
            (
                [0] => Array
                    (
                        [&typeList] => Array
                            (
                                [0] => Person
                            )
    
                        [&mapTo] => Array
                            (
                                [0] => http://xmlns.com/foaf/0.1/Person
                            )
    
                    )
    
            )
    
    )
    ...
```

Using the irJSON Parser
=======================

sing the commON parser is quite simple. There is basically 3 main areas:

* Creating the parser's object and parsing the commON document
* Checking for parsing errors
* Getting the parsed data into different formats

The first thing to do is to create the commON's parser object with the commON file we want to parse:

```php
  <?php
	include_once("Dataset.php");
	include_once("InstanceRecord.php");
	include_once("LinkageSchema.php");
	include_once("StructureSchema.php");
	include_once("irJSONParser.php");
  
    $irJSONFileContent = file_get_contents("/tmp/myIrJSONFile.csv");
  
    $parser = new irJSONParser($irJSONFileContent);
  ?>
```

The next thing to do is to check if the parser found any error into the commON file:

```php
  <?php
    if(count($parser->jsonErrors) > 0)
    {
      echo "There are JSON errors!";
	} 
	
    if(count($parser->irjsonErrors) > 0)
    {
      echo "There are irJSON errors!";
	} 
	
    if(count($parser->irjsonNotices) > 0)
    {
      echo "There are irJSON notices!";
	} 
  ?>
```

If there are errors, then we can check what these errors are. There are two kind of errors:

* Errors that come from the JSON file, according to the JSON specification
* Errors that come from the irJSON format, according to the irON+irJSON specification
* irJSON Notices

```php
  <?php
    echo "<h2>Parsing Errors</h2>";

    foreach($parser->jsonErrors as $error)
    {
      echo "$error\n";
    }
	
    foreach($parser->irjsonErrors as $error)
    {
      echo "$error\n";
    }

	foreach($parser->irjsonNotices as $notice)
    {
      echo "$notice\n";
    }
  ?>
```

If there is no errors, then we can output the parsed records in different formats:

```php
  <?php
	echo "<h2>Dataset description</h2>";

	echo "<pre>";
	var_dump($parser->dataset);

	echo "</pre>";

	echo "<h2>Linkage Schema description</h2>";

	echo "<pre>";
	var_dump($parser->linkageSchemas);

	echo "</pre>";

	echo "<h2>Structure Schema description</h2>";

	echo "<pre>";
	var_dump($parser->structureSchemas);

	echo "</pre>";

	echo "<h2>Instance Records</h2>";

	echo "<pre>";
	var_dump($parser->instanceRecords);

	echo "</pre>";
  ?>
```
