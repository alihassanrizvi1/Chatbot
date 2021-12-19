<?php
$data = strtolower($_GET['data']);

//What?
if (strpos($data, 'what') !== false && strpos($data, 'definition') === false) {
    $term = str_replace('what ','',$data);
    $term = str_replace('is ','',$term);
    $term = str_replace('are ','',$term);
    $term = str_replace('.','',$term);
    $term = str_replace('?','',$term);
    $term = str_replace('a ','',$term);
    $term = str_replace('an ','',$term);
    $term = str_replace('the ','',$term);
    $term = trim($term);
    $term = ucfirst($term);
    echo getUrlWikidata($term, 'desc').'||SEP||0||SEP||0||SEP||0';
}

//Define/Definition of
else if (strpos($data, 'define') !== false || strpos($data, 'definition') !== false) {
   $term = str_replace('define ','',$data);
   $term = str_replace('definition ','',$term);
   $term = str_replace('what ','',$term);
   $term = str_replace('of ','',$term);
   $term = str_replace('is ','',$term);
   $term = str_replace('.','',$term);
   $term = str_replace('?','',$term);
   $term = str_replace('a ','',$term);
   $term = str_replace('an ','',$term);
   $term = str_replace('the ','',$term);
   $term = trim($term);
   $term = ucfirst($term);
   echo getUrlDbpediaAbstract($term).'||SEP||1||SEP||0||SEP||0';
}

//Find/Search/Explore
if (strpos($data, 'find') !== false || strpos($data, 'search') !== false || strpos($data, 'explore') !== false) {
    $term = str_replace('can ','',$data);
    $term = str_replace(' you','',$term);
    $term = str_replace('find ','',$term);
    $term = str_replace('search ','',$term);
    $term = str_replace('explore ','',$term);
    $term = str_replace('out ','',$term);
    $term = str_replace('for ','',$term);
    $term = str_replace('me ','',$term);
    $term = str_replace(' me','',$term);
    $term = str_replace('a ','',$term);
    $term = str_replace('an ','',$term);
    $term = str_replace('the ','',$term);
    $term = str_replace('.','',$term);
    $term = str_replace('?','',$term);
    $term = trim($term);
    $term = ucfirst($term);
    echo getUrlWikidata($term, 'link').'||SEP||0||SEP||1||SEP||0';
}

//picture/image
if (strpos($data, 'picture') !== false || strpos($data, 'image') !== false) {
   $term = str_replace('picture ','',$data);
   $term = str_replace('image ','',$term);
   $term = str_replace('show ','',$term);
   $term = str_replace('me ','',$term);
   $term = str_replace('of ','',$term);
   $term = str_replace('a ','',$term);
   $term = str_replace('an ','',$term);
   $term = str_replace('the ','',$term);
   $term = str_replace('.','',$term);
   $term = trim($term);
   $term = ucfirst($term);
   echo getUrlDbpediaAbstract($term).'||SEP||1||SEP||0||SEP||1';
}

function getUrlWikidata($term, $param){
   $endpointUrl = 'https://query.wikidata.org/sparql';
   $sparqlQueryString = 'SELECT distinct ?item ?itemLabel ?itemDescription WHERE{  
   ?item ?label "'.$term.'"@en.  
   ?article schema:about ?item .
   ?article schema:inLanguage "en" .
   ?article schema:isPartOf <https://en.wikipedia.org/>.	
   SERVICE wikibase:label { bd:serviceParam wikibase:language "en". }    
   } Limit 1';

   $queryDispatcher = new SPARQLQueryDispatcher($endpointUrl);
   $queryResult = $queryDispatcher->query($sparqlQueryString);

   if(count($queryResult['results']['bindings'])){
      if($param == 'desc'){
         return $queryResult['results']['bindings'][0]['itemDescription']['value'];
      } else{
         return $queryResult['results']['bindings'][0]['item']['value'];
      }
   } else{
      return 0;
   }
}

function getUrlDbpediaAbstract($term)
{
   $format = 'json';
 
   $query = 
   "PREFIX dbp: <http://dbpedia.org/resource/>
   PREFIX dbp2: <http://dbpedia.org/ontology/>
 
   SELECT *
   WHERE {
      dbp:".$term." dbp2:abstract ?abstract; 
      dbp2:thumbnail ?thumbnail . 
      FILTER langMatches(lang(?abstract), 'en')
   }";
 
   $searchUrl = 'https://dbpedia.org/sparql?'
      .'query='.urlencode($query)
      .'&format='.$format;
	  
   return $searchUrl;
}

class SPARQLQueryDispatcher
{
   private $endpointUrl;

   public function __construct(string $endpointUrl)
   {
      $this->endpointUrl = $endpointUrl;
   }

   public function query(string $sparqlQuery): array
   {
      $opts = [
         'http' => [
               'method' => 'GET',
               'header' => [
                  'Accept: application/sparql-results+json',
                  'User-Agent: WDQS-example PHP/' . PHP_VERSION, // TODO adjust this; see https://w.wiki/CX6
               ],
         ],
      ];
      $context = stream_context_create($opts);

      $url = $this->endpointUrl . '?query=' . urlencode($sparqlQuery);
      $response = file_get_contents($url, false, $context);
      return json_decode($response, true);
   }
}
?>