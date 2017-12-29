<?php
	set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors",'On');
echo $_SERVER['REMOTE_ADDR'];
	if($_SERVER['REMOTE_ADDR']=="123.237.8.112" || $_SERVER['REMOTE_ADDR']=="117.222.74.159" || $_SERVER['REMOTE_ADDR']=="117.198.204.117" || $_SERVER['REMOTE_ADDR']=="127.0.0.1")
	{ 
		//echo "test";
    require_once 'app/Mage.php';
    Mage::app('admin');
	 $fp = fopen("/home/shourya/public_html/wandh/media/import/test.csv", 'r'); 

	
	$j = 0;
	$img=$sku=array(); 
	//echo "test";
	
	while(($website=fgetcsv($fp))) 
	{
	$sku[$j]=$website[0];
	$img[$j]=$website[1];
	$pos[$j]=$website[2];
	$j++;
	}
	//print_r($sku);
	//print_r($img);
	fclose($fp);
	//print(count($sku));
	
	
	$media = Mage::getModel('catalog/product_attribute_media_api'); 
	$count = 0;
	echo "<br/> count ".count($sku);
	
	for($i=0;$i<count($sku);$i++)
	{
		$label='';
    $sk = trim($sku[$i]);
    $imageName =$img[$i];
	$positn = $pos[$i];
	print $sk; echo "	<=sku<br>";
	echo $imageName."	<=image name<br>";
	echo $positn."	 <=position<br>";
	
	
	/*   if(stristr($sk,"Pavillion")!== False)
	{
		$sk=str_ireplace("Pavillion","Pavilion",$sk); 
		echo $sk;
	}  */
	
	/* if(stristr($sk,"Midnight") !== False || stristr($sk,"Mocha") !== False)
		continue; */
 
	if(empty($imageName))
		continue; 
		
	 echo "path".Mage::getBaseDir() . DS ;
    // get the image from the import dir
	$import = Mage::getBaseDir() . DS . 'test_pic//'.$imageName;  
	
	
    $product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sk);     
	
    if ($product->getId() > 0)
    {
		echo $product->getId().'<br>';
		echo $count;
		$count++;
		
	      
     // $positn=1;
      echo $positn."<br/>";
      
   
      if($positn==1){
		echo "test2<br/>";
		$label = 'Head on';
		}
	  $newImage = array(
            'file' => array(
                'content' => base64_encode($import),
                'mime' => 'image/jpeg',
                'name' => basename($import),
                ),
            'label' => $label, // change this. 
            'position' => $positn,
            'types' => array('small_image','thumbnail','image'),
            'exclude' => 0,
        ); 
           
		
		print_r($newImage);
		echo "test3<br/>";  
		echo "</br>";
		
		$media->create($sk, $newImage);         
	      
	   //} //if condition for test
    }
	$positn++;
	//echo $positn;
	//print '<br>';
  }
  }//remote address
 
?>
