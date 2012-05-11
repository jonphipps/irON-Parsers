<?php
  include_once("CommonParser.php");

  $csvFile = "
&&recordList
&id,&type,&prefLabel,&homepage,&authorClaimsPage,&isAuthorOfTitle,&isAuthorOfTitle&prefURL
info:lib:am:2009-02-18:maria_francisca_abad_garcia,Person,Maria Francisca Abad-Garcia,,http://authorclaim.org/profile/pab1/,Acceso Abierto y revistas m?dicas espa?olas,http://eprints.rclis.org/11490/1/open_acces_Medicina_Cl%C3%ADnica_2006_versi%C3%B3n_aceptada_del_autor.pdf
,,,,,Una base de datos de recursos web m?dicos: una soluci?n a medida para una recuperaci?n m?s eficaz de informaci?n de Internet,http://eprints.rclis.org/527/2/15_UV_BD_Good.pdf
,,,,,[Open access and the Spanish medical journals],http://www.ncbi.nlm.nih.gov/sites/entrez?cmd=retrieve&list_uids=17040632
,,,,,Produccion cient?fica de la Comunitat Valenciana en materias de biomedicina y ciencias de la salud a trav?s de las bases de datos del Institute of Scientific Information (ISI) 2000-2004.,http://eprints.rclis.org/15459/1/produccion_cientifica_def_200307%5B1%5D.pdf
,,,,,La base de datos de recursos web de la biblioteca m?dica virtual del COMV,http://eprints.rclis.org/8788/1/La_base_de_datos_de_recursos_web_de_la_biblioteca_m%C3%A9dica_virtual_del_COMV.pdf
,,,,,Uso de internet por los m?dicos colegiados de Valencia: un estudio de viabilidad de la Biblioteca M?dica Virtual del Colegio Oficial de M?dicos de Valencia,http://eprints.rclis.org/12145/1/epi_vol_13_n_2.pdf
,,,,,Ampliando el horizonte de MEDLINE : 100 bases de datos bibliogr?ficas m?dicas gratuitas en la red,http://eprints.rclis.org/5179/1/Herramientas_internet_Malaga_2003.pdf
,,,,,\"Information needs and uses: an analysis of the literature published in Spain, 1990?2004\",http://eprints.rclis.org/12136/1/Information_needs_and_uses.pdf
info:lib:am:1971-02-01:jose_manuel_barrueco,Person,Jose Manuel Barrueco,http://www.uv.e/=barrueco,http://authorclaim.org/profile/pba1/,Personal Data in a Large Digital Library,http://citeseer.ist.psu.edu/473002.html
,,,,,Cataloging Economics preprints: an introduction to the RePEc project,http://citeseer.ist.psu.edu/251821.html
,,,,,Personal Data in a Large Digital Library,http://citeseer.ist.psu.edu/466126.html
,,,,,WoPEc usage in 1999AD,http://citeseer.ist.psu.edu/623255.html
,,,,,Distributed Cataloging on the Internet: the RePEc project,http://citeseer.ist.psu.edu/360116.html
,,,,,Automated Extraction of Citation Data in a Distributed Digital Library.,http://dblp.uni-trier.de/db/conf/nddl/nddl2002.html#CruzK02
,,,,,ReLIS: una biblioteca digital distribuida para Documentaci?n.,http://dblp.uni-trier.de/db/conf/jbidi/jbidi2002.html#CollC02
,,,,,Personal Data in a Large Digital Library.,http://dblp.uni-trier.de/db/conf/ercimdl/ecdl2000.html#CruzKK00
info:lib:am:2009-07-14:geoffrey_bilder,Person,Geoffrey Bilder,,http://authorclaim.org/profile/pbi1/,,
info:lib:am:2009-04-29:travis_c_brooks,Person,Travis C. Brooks,,http://authorclaim.org/profile/pbr1/,Subject Access through Community Partnerships: A Case Study,http://arxiv.org/abs/physics/0309027
,,,,,Open Access Publishing in Particle Physics: A Brief Introduction for the non-Expert,http://arxiv.org/abs/0705.3466
,,,,,Open Access Publishing in Particle Physics: A Brief Introduction for the non-Expert,http://dblp.uni-trier.de/db/journals/corr/corr0705.html#abs-0705-3466
,,,,,Recalculation of Proton Compton Scattering in Perturbative QCD,http://arxiv.org/abs/hep-ph/0004143
,,,,,Information Resources in High-Energy Physics: Surveying the Present Landscape and Charting the Future Course,http://dblp.uni-trier.de/db/journals/corr/corr0804.html#abs-0804-2701
,,,,,Information Resources in High-Energy Physics: Surveying the Present Landscape and Charting the Future Course,http://arxiv.org/abs/0804.2701
,,,,,Preliminary Results from a Search for Disoriented Chiral Condensates at MiniMax,http://arxiv.org/abs/hep-ex/9608012
info:lib:am:2009-01-04:christian_zimmermann,Person,Christian Zimmermann,http://ideas.repec.org/zimm,http://authorclaim.org/profile/pzi1/,Assurance Chomage Et Societes,http://citeseer.ist.psu.edu/434820.html
,,,,,Credit Crunch in a Model of Financial Intermediation and Occupational Choice,http://citeseer.ist.psu.edu/425207.html
,,,,,The Economics of open bibliographic data provision,http://eprints.rclis.org/3117/
&&linkage
&version,&linkageType
0.1,rdf
&attributeList,&mapTo
prefLabel,http://www.w3.org/2000/01/rdf-schema#label
homepage,http://xmlns.com/foaf/0.1/homepage
prefURL,http://purl.org/ontology/bibo/uri
&typeList,&mapTo
Person,http://xmlns.com/foaf/0.1/Person
";

  $parser = new CommonParser($csvFile);

  if(!$parser->getCsvErrors())
  {
    echo "<h2>CSV Records</h2>";

    var_dump($parser->getCsvRecords());

    echo "<h2>Common Records</h2>";

    var_dump($parser->getCommonRecords());

    echo "<h2>Linkage Schema</h2>";

    var_dump($parser->getLinkageSchema());
  }
  else
  {
    echo "<h2>Parsing Errors</h2>";

    foreach($parser->getCsvErrors() as $key => $error)
    {
      echo $key . ". " . $error . "<br />";
    }
  }
?>