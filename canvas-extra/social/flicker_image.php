<?php 
class flickr

			{

				var $api;

				function __construct($api) {

					$this->api = $api;

				}

				function flickr_photos_search($search,$count_image,$size)

				{

					$params = array(

					'api_key'	=> $this->api,

					'method'	=> 'flickr.photos.search',

					'text'	=> $search,

					'format'	=> 'rest',

					'per_page' => $count_image,

					'page'		=> 1,);

					$xml = $this->create_url($params);
					if(@$rsp = simplexml_load_file($xml))
					{
						if (count($rsp)<>0)
						{
							foreach($rsp->photos->children() as $photo)

							{
								if ($photo->getName()=='photo')

								{
									$farm=$photo->attributes()->farm;
									$server=$photo->attributes()->server;
									$id=$photo->attributes()->id;
									$secret=$photo->attributes()->secret;
									if ($size=='Med')
									{
										$sz="";
									}
									else

									{
										$sz = "_".$size;

									}
									$gbr[]='<img src="https://farm'.$farm.'.staticflickr.com/'.$server.'/'.$id.'_'.$secret.$sz.'.jpg'.'" /> ';

								}
							}
						}
						else
						{
							die("No images found!");
						}
					}else
					{
						die("wrong parameter");
					}
					return $gbr;
				}

				function create_url($params)

				{
					$encoded_params = array();
					foreach ($params as $k => $v){
						$encoded_params[] = urlencode($k).'='.urlencode($v);
					}
					$url = "https://api.flickr.com/services/rest/?".implode('&', $encoded_params);
					return $url;
				}

			} ?>