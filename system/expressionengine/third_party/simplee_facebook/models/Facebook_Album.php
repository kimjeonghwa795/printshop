<?php
	class Facebook_Album extends EE_Object {
	
		public $id;
		public $date;	
		public $image;
		
		function __construct($json){
			$this->id   = $json->id;
                        $this->name = $json->name;
                        if (@$json->cover_photo)
                            $this->image = @$json->cover_photo->images[0]->source;
                        else {
                            $this->image = '/media/images/facebook.jpg';
                        }
                        $this->count = $json->count;
                        $this->created_time = $json->created_time;
                        $this->description =  @$json->description;
		}
		
	}