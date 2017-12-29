<?php

function theme_enqueue_styles() {
	wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

function get_string_between($string, $start, $end){
$string = ' ' . $string;
$ini = strpos($string, $start);
if ($ini == 0) return '';
$ini += strlen($start);
$len = strpos($string, $end, $ini) - $ini;
return substr($string, $ini, $len);
}

libxml_use_internal_errors(true);


function add_theme_scripts() {
 /* wp_enqueue_style( 'style', get_stylesheet_uri() );*/
 
  wp_enqueue_style( 'tablecss', get_template_directory_uri() . '/css/globals.css');
  wp_enqueue_style( 'retablecss', get_template_directory_uri() . '/css/responsive.css');
    wp_enqueue_style( 'resptablecss', get_template_directory_uri() . '/css/responsive-tables.css');
	  wp_enqueue_style( 'jqtabtablecss', get_template_directory_uri() . '/css/jQueryTab.css');
	    wp_enqueue_style( 'cuatomtablecss', get_template_directory_uri() . '/css/custom.css');
		  wp_enqueue_style( 'animationtablecss', get_template_directory_uri() . '/css/animation.css');
		  
 
  wp_enqueue_script( 'tabscript', get_template_directory_uri() . '/js/jQueryTab.js');
  wp_enqueue_script( 'tabresscript', get_template_directory_uri() . '/js/responsive-tables.js');
  wp_enqueue_script( 'tabresscriptcustomjs', get_template_directory_uri() . '/js/custom.js');
 
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

function rootfeed(){
$ch = curl_init("http://pricefeeds.williamhill.com/bet/en-gb?action=GoPriceFeed");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
$content = curl_exec($ch);
curl_close($ch);
//echo $content;

$dom = new domDocument;
/*** load the html into the object ***/
$dom->loadHTML($content);
/*** discard white space ***/
$dom->recover = true;
$dom->strictErrorChecking = false;
$dom->preserveWhiteSpace = false;
$links = $dom->getElementsByTagName('a');

$ds=0;
$tables = $dom->getElementsByTagName('table'); 

  //get all rows from the table
  $rows = $tables->item(0)->getElementsByTagName('tr'); 

$serc =array();
$i=0;
$gofeed = 1;
$ggggggg =0;
$Sport=array();
foreach($links as $link)
    {
		$serc[$i] = htmlspecialchars($link->getAttribute('href'));
		$i++;
	}
  
  foreach ($rows as $row) 
  { 
   // get each column by tag name
      $cols = $row->getElementsByTagName('td'); 
	  
   if($cols->item(2)->nodeValue!=''){ 
   
	/*echo '<pre>';
print_r($curlread);
echo '</pre>';*/
if (in_array($cols->item(0)->nodeValue, $Sport)) {
    //echo "Got Irix";
}else{
	$Sport[]=$cols->item(0)->nodeValue;
	}


      echo $ds.'->'.$cols->item(0)->nodeValue.'=>'.$cols->item(1)->nodeValue.'=> <font style="font-size:9px;">'.$serc[$ds].'</font><br />';
	 // getfeeddata($serc[$ds]);
	 /*$curlread = explode('://',$serc[$ds]);
	 $xx = $serc[$ds];
	 if(!empty($curlread)){}*/
	  $ds++;
   }else{
	    if($cols->item(2)->nodeValue==''){ 
	  echo '<br><h1>'.$cols->item(0)->nodeValue.'</h1><br />';
	 $gofeed++;
		}
	   }
    } 
	
	echo '<pre>';
print_r($Sport);
echo '</pre>';
}

function getRssfeeddata($urlddd){
//$url="http://pricefeeds.williamhill.com/oxipubserver?action=template&template=getHierarchyByMarketType&classId=19&marketSort=--&filterBIR=N";
//$url = "http://www.w3schools.com";

// Validate url
$url = esc_url(htmlspecialchars($urlddd));
    //echo("$url is a valid URL");


$xml = simplexml_load_file($url);
$noxmlfeed = count($xml->response->williamhill->class);




echo 'Game Name =>'.$xml->response->williamhill->class['name'];

foreach ($xml->response->williamhill->class as $game){
$p_cnt = count($game->type);
for($i = 0; $i < $p_cnt; $i++) {
  echo ' <br> - - > games->type =>'.$game->type[$i]['name'].'<br>';
} 
}

}	
	/*echo '<pre>';
print_r($game->type);
echo '</pre>';*/

function getLiveBetting($atts){
	$atts = shortcode_atts( array(
		'status' => 'N'
	), $atts, 'BETTINGLIVEDATA' );
	
	$statusBetting=$atts['status'];
		
$ch = curl_init("http://pricefeeds.williamhill.com/bet/en-gb?action=GoPriceFeed");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
$content = curl_exec($ch);
curl_close($ch);
//echo $content;
$dom = new domDocument;
$dom->loadHTML($content);
$dom->recover = true;
$dom->strictErrorChecking = false;
$dom->preserveWhiteSpace = false;
$links = $dom->getElementsByTagName('a');

$ds=0;
$tables = $dom->getElementsByTagName('table'); 

  //get all rows from the table
$rows = $tables->item(0)->getElementsByTagName('tr'); 

$serc =array();
$i=0;
$gofeed = 1;
$ggggggg =0;
$Sport=array();
$Market=array();
$Link=array();
foreach($links as $link)
    {
		$serc[$i] = htmlspecialchars($link->getAttribute('href'));
		$i++;
	}
  
  foreach ($rows as $row) 
	{ 
	$cols = $row->getElementsByTagName('td'); 
		if($cols->item(2)->nodeValue!=''){ 
		$vlchkislive = explode('filterBIR=',$serc[$ds]);		
		$parsedid = get_string_between($vlchkislive[0], 'classId=', '&');
		$mid = get_string_between($vlchkislive[0], 'marketSort=', '&');
		if($vlchkislive[1]==$statusBetting){
			
			//* Sport 
			if (in_array($cols->item(0)->nodeValue, $Sport)) {
			}else{
				$Sport[] = array("name" => $cols->item(0)->nodeValue, "id" => $parsedid);
		}
		//* Market 
			if (in_array($cols->item(1)->nodeValue, $Market)) {
			}else{
				if($parsedid == $_POST['livedataid']){
					if($cols->item(1)->nodeValue=='--'){
						$mnamec='All';
						}else{
							$mnamec=$cols->item(1)->nodeValue;
							}
				$Market[] = array("name" => $mnamec, "mid" => $mid);
				}else{
					$Market[] = array("name" => '', "mid" => '');
					}
		}
		//* Link 
			if (in_array($cols->item(0)->nodeValue, $Link)) {
			}else{
				$Link[] = array("name" => $cols->item(0)->nodeValue, "id" => $parsedid, "url" => $serc[$ds]);
		}
		
		
		}		
		$ds++;
		}
	
	} 
	$sport = array_map("unserialize", array_unique(array_map("serialize", $Sport)));
	$Market = array_map("unserialize", array_unique(array_map("serialize", $Market)));
	$Link = array_map("unserialize", array_unique(array_map("serialize", $Link)));
$html = '';
foreach($sport as $spo){
	if($spo["id"]==$_POST['livedataid']){
		$selated=' selected="selected"';
		}else{
			$selated='';
			}
			if(($spo["id"]==1)||($spo["id"]==275)){
	$html .='<option value="'.$spo["id"].'"'.$selated.'>'.$spo["name"].'</option>';
			}
	
	}
$htmlm = '';
foreach($Market as $mark){
	if($mark["mid"]==$_POST['marketid']){
		$selated=' selected="selected"';
		}else{
			$selated='';
			}
			
	$htmlm .='<option value="'.$mark["mid"].'"'.$selated.'>'.$mark["name"].'</option>';
	
	}
	
		
echo '<form action="'.get_permalink().'" method="POST">
    <select name="livedataid" id="livedataid" onchange="this.form.submit()">
        <option value="">-Select One-</option>'.$html.'
    </select>
	 <select name="marketid" id="marketid" onchange="this.form.submit()">
        <option value="">-Select One Market-</option>'.$htmlm.'
    </select>
</form>';
/*echo '<form action="'.get_permalink().'" method="POST"><select onChange="this.form.submit()" id="livedataid" name="livedataid">
  <option value="">-Select One-</option>
  <option value="275">UEFA Club Competitions</option>
  <option value="1">UK Football</option>
</select><select name="marketid" id="marketid" onchange="this.form.submit()">
        <option value="--">-Select One Market-</option>'.$htmlm.'
    </select></form>';*/
	}
function getBettingData($att){
	//ob_start();	
	$att = shortcode_atts( array(
		'id' => 36,
		'marketid'=>'MR'
	), $att, 'BETTINGDATA' );
	if($_POST['livedataid']!=''){
		$id=$_POST['livedataid'];
		}else{
	$id=$att['id'];
	}
	if($_POST['marketid']!=''){
		$marketid=$_POST['marketid'];
		
		}else{
	$marketid=$att['marketid'];
	}
	
	
	/*$ch = curl_init("http://cachepricefeeds.williamhill.com/openbet_cdn?action=template&template=getHierarchyByMarketType&classId=".$id."&marketSort=".$marketid."&filterBIR=N");*/
	$ch = curl_init("http://cachepricefeeds.williamhill.com/openbet_cdn?action=template&template=getHierarchyByMarketType&classId=".$id."&marketSort=".$marketid."&filterBIR=N");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
$content = curl_exec($ch);
curl_close($ch);

/*$xml = new DOMDocument();
$xml->loadXML($content);*/
//echo $doc->saveXML();
$dom = new DOMDocument();
$cc = $dom->loadXML( $content );
//json_prepare_xml($dom);
$sxml = simplexml_load_string( $dom->saveXML() );

$obj  = json_encode($sxml, true);
$ds=1;
$type=array();
$typeid=array();
$htmlcontent = array();
$countmarket = array();
/*echo '<pre>';
print_r($sxml->response->williamhill->class->type);
echo '</pre>';*/
foreach($sxml->response->williamhill->class->type as $key => $name){
	if('Euro 2016'==$name['name']){
$type[]=$name['name'];
//9392
//print_r($name->market);
$countmarket[$ds] = count($name->market);
$htmlcontent[]=array('html'=>getname($name->market),'notype'=>$ds);
$ds++;
	}
}
?>
<h1><?php
/*foreach($sxml->response->williamhill->class as $classname){
	echo $classname['name'];
	}*/
?>Euro 2016</h1>
<section id="table">
   <div class="container clearfix">
    <div class="table-left clearfix">
        <div class="tab_area">
                <div class="tabs-7">
                    <ul class="tabs">
                        <?php 
						$idtab = 1;
						$totaltavval = count($type);
						//shuffle($type);
						$limit=3;
						foreach($type as $ty){
							
							?>
                            
							<?php /*?><li><a href="#tab3<?php echo $idtab;?>"><?php echo $ty;?> <span style="display:block;">
							<?php echo $countmarket[$idtab];?></span></a></li><?php */?>
                            <li><a href="#tab31"> Match Result</a></li>
                            <?php
							if($idtab==$limit) break;
							$idtab++;
							}
						/*?><li><a href="#tab25">Football <span style="display:block;">12</span></a></li>
                        <li><a href="#tab26">Football <span style="display:block;">12</span></a></li>
                        <li><a href="#tab27">Cricket <span style="display:block;">12</span></a></li>
                        <li><a href="#tab27">Basketball <span style="display:block;">12</span></a></li>
                        <li><a href="#tab27">All Sports <span style="display:block;">12</span></a></li><?php */?>
                         <li><a href="#tab32">England To Win</a></li>
                    </ul>
                    <section class="tab_content_wrapper">
                    <?php
                    
					for($dsi=1;$dsi<$totaltavval+1;$dsi++){
					?>
                         <article class="tab_content" id="tab3<?php echo $dsi;?>">
                            <div class="row" style="margin-left: auto; margin-right:auto;">
			<div class="twelve columns">
    		
				<table class="responsive">
                <?php
                foreach($htmlcontent as $hht){
					if($hht['notype']==$dsi){
						echo $hht['html'];						
						}
					
					}
				?>
    				
					
    					
        </table>
    		
		</div>



	</div>
                         </article>
                         
                         <?php
						 if($dsi==$limit) break;
					}
                         ?>
                        
                      <a href="#">View all our Play Events</a>
                    </section>
                 </div>
            </div>
    </div>
   </div>
</section>
<?php
//return ob_get_clean();
	}
	
	function getname($names){
		$di=1;
		$htmlval='';
		shuffle($names);
foreach($names as $key=>$makname){
	$htmlval .= '<thead><tr>
						<th>'.$makname['name'].'</th>
						<th></th>
						<th></th>
						<th></th>
						<th>Odds</th>
						<th>Odds Decimal</th>
						<th>Date</th>
						<th>Time</th>
					</tr> </thead>';
	if($makname->participant!=null){
		foreach($makname->participant as $participant){
		//$htmlval .= '<h4>=>=>=>'.'Participant=>'.$participant['name'].'<h4>';
		$htmlval .= '<tr>					
					<td>'.$participant['name'].'</td>
					<td>--</td>
					<td>--</td>
					<td>--</td>
					<td>'.$participant['odds'].'</td>
					<td>'.$participant['oddsDecimal'].'</td>
					<td>'.$participant['lastUpdateDate'].'</td>
					<td>'.$participant['lastUpdateTime'].'</td>
					</tr>';
		}
		
		}
	
		if($di == 2){
			break;
			}
	$di++;
	}
	
	return $htmlval;
		}
	

add_shortcode( 'BETTINGDATA', 'getBettingData' );
add_shortcode( 'BETTINGLIVEDATA', 'getLiveBetting' );