<?php
class Canvassignages_Uploader_Block_Monblock extends Mage_Core_Block_Template
{
     public function methodblock($SID)
     {
		 $SID = $SID;
		 
		 //getting real path
		  $path = realpath(Mage::getBaseDir().'/canvas_uploader/uploads/'.$SID.'/');

		  if($path !="") // check if the path is blank or not
		  {
			    // getting the url of the folder not real path
				$path_url = Mage::getBaseUrl().'/canvas_uploader/uploads/'.$SID.'/';

				$di = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS),
				RecursiveIteratorIterator::LEAVES_ONLY
				);
				
				
				$image_name = array();
				
				foreach($di as $name => $fio) 
				{
					 $filename = $fio->getPath() . DIRECTORY_SEPARATOR .( $fio->getFilename() );
					 $filename_rsz = $fio->getPath() . DIRECTORY_SEPARATOR .'resized/'.( $fio->getFilename() );
					
					$filepath = explode("uploads/",$filename);
					
					$filepathurl = Mage::getBaseUrl().'/canvas_uploader/uploads/'.$filepath[1];
					
					//$image_name[$i]['image_name'] = $filepathurl;
					$img_name=$fio->getFilename(); // get the file name
					
					 $ext = pathinfo($img_name, PATHINFO_EXTENSION);
					
					if(!file_exists($path.'/resized'))
					mkdir($path.'/resized',0777);
					 $imageName = substr(strrchr($filename,"/"),1);
					
					 $imageResized = $path.'/resized/'.$img_name;

					 $dirImg = Mage::getBaseDir().str_replace("/",DS,strstr($filename,'/resized'));
					 
					 // adding the resized images
					 
					if($ext !="svg")
					{
						if(!file_exists($path.'/resized/'.$img_name))
						{
							
							// calling the varien images
							$imageObj = new Varien_Image($filename);
							$imageObj->constrainOnly(TRUE);
							$imageObj->keepAspectRatio(TRUE);
							$imageObj->keepFrame(FALSE);
							$imageObj->resize(135, 135);
							$imageObj->save($imageResized);
						}
					} 
					else
					{
						//echo "svg";
						
						copy($filename, $filename_rsz);
						
					}
						
					
					
					
						
					
				}
				
				// calling the resized path
				
				$path_resized = realpath(Mage::getBaseDir().'/canvas_uploader/uploads/'.$SID.'/resized/');
				
				// calling the original path
				$path_org = realpath(Mage::getBaseDir().'/canvas_uploader/uploads/'.$SID);
				
				// calling the original path url
				$path_org_src = Mage::getBaseUrl().'/canvas_uploader/uploads/'.$SID;
				
				
				// calling the resized path url
				
				$path_resized_url = Mage::getBaseUrl().'/canvas_uploader/uploads/'.$SID.'/resized/';
				
				// calling the object for the resized path
				
				$path_resized_alt = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator($path_resized, FilesystemIterator::SKIP_DOTS),
				RecursiveIteratorIterator::LEAVES_ONLY
				);
				$i=1;
				
				$image_name = array(); // initialize the blank array
				
				foreach($path_resized_alt as $name => $fio) 
				{
					// assign the variabe into array
					$filename = $fio->getPath() . DIRECTORY_SEPARATOR .( $fio->getFilename() );
					$image_name[$i]['image_name'] = $path_resized_url.$fio->getFilename();
					$image_name[$i]['fullpath'] = $path_resized.'/'.$fio->getFilename();
					$image_name[$i]['path_org'] = $path_org.'/'.$fio->getFilename();
					$image_name[$i]['data_original_src'] = $path_org_src.'/'.$fio->getFilename();
					$i++;
				}
				
         return $image_name ;
		  }
		 
		 
     } 
     
}// end class
