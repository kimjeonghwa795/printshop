<?php
	class Facebook_Photo extends EE_Object {
	
		public $id;
		
		function __construct($json){
			$this->id   = $json->id;
                        $this->name = @$json->name;
                        $this->created_time = @$json->created_time;
                        $this->description =  @$json->description;
                        $this->image =  @$json->images[0]->source;
                        
		}
		
	}