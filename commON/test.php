<?php
  include_once("CommonParser.php");

  $csvFile = <<<EOD
&&recordList
&id,&type,&prefLabel,&homepage,&authorClaimsPage,&isAuthorOfTitle,&isAuthorOfTitle&prefURL
info:lib:am:2009-02-18:maria_francisca_abad_garcia,Person,Maria Francisca Abad-Garcia,,http://authorclaim.org/profile/pab1/,Acceso Abierto y revistas m?dicas espa?olas,http://eprints.rclis.org/11490/1/open_acces_Medicina_Cl%C3%ADnica_2006_versi%C3%B3n_aceptada_del_autor.pdf
,,,,,Una base de datos de recursos web m?dicos: una soluci?n a medida para una recuperaci?n m?s eficaz de informaci?n de Internet,http://eprints.rclis.org/527/2/15_UV_BD_Good.pdf
,,,,,[Open access and the Spanish medical journals],http://www.ncbi.nlm.nih.gov/sites/entrez?cmd=retrieve&list_uids=17040632
,,,,,Produccion cient?fica de la Comunitat Valenciana en materias de biomedicina y ciencias de la salud a trav?s de las bases de datos del Institute of Scientific Information (ISI) 2000-2004.,http://eprints.rclis.org/15459/1/produccion_cientifica_def_200307%5B1%5D.pdf
,,,,,La base de datos de recursos web de la biblioteca m?dica virtual del COMV,http://eprints.rclis.org/8788/1/La_base_de_datos_de_recursos_web_de_la_biblioteca_m%C3%A9dica_virtual_del_COMV.pdf
,,,,,Uso de internet por los m?dicos colegiados de Valencia: un estudio de viabilidad de la Biblioteca M?dica Virtual del Colegio Oficial de M?dicos de Valencia,http://eprints.rclis.org/12145/1/epi_vol_13_n_2.pdf
&&linkage
&version,&linkageType
0.1,rdf
&attributeList,&mapTo
prefLabel,http://www.w3.org/2000/01/rdf-schema#label
homepage,http://xmlns.com/foaf/0.1/homepage
prefURL,http://purl.org/ontology/bibo/uri
&typeList,&mapTo
Person,http://xmlns.com/foaf/0.1/Person
EOD;

  $parser = new CommonParser($csvFile);

  $CommonErrors = $parser->getCommonErrors();
if (!$CommonErrors) {
  echo "<h2>CSV Records</h2>";

  var_dump($parser->getCsvRecords());

  echo "<h2>Common Records</h2>";

  var_dump($parser->getCommonRecords());

  echo "<h2>Linkage Schema</h2>";

  var_dump($parser->getLinkageSchema());
}
else {
  echo "<h2>Parsing Errors</h2>";
  foreach ($CommonErrors as $key => $error) {
    echo $key . ". " . $error . "<br />";
  }
}
?>