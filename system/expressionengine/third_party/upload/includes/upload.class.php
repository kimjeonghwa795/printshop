<?php   
//if (!defined('BASEPATH'))  exit('No direct script access allowed');

require 'UploadHandler.php';
class Upload extends UploadHandler {

    protected  $EE;

    public function __construct() {
        $this->EE =& get_instance();
        $this->options['db_table'] = 'photoprint_files';
        parent::__construct();
    }
    
    public static function installDb(){
        $sql = 'CREATE TABLE `' . $this->options['db_table'] .'` (
                `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `order_id` int(11) NOT NULL,
                `layout_id` int(11) NOT NULL,
                `pos` int(11) DEFAULT NULL,
                `name` varchar(255) DEFAULT NULL,
                `size` int(11) DEFAULT NULL,
                `type` varchar(255) DEFAULT NULL,
                `url` varchar(255) DEFAULT NULL,
                `title` varchar(255) DEFAULT NULL,
                `description` text,
                PRIMARY KEY (`id`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;';
                    
    }
     protected function handle_form_data($file, $index) {
        $file->title = @$_REQUEST['title'][$index];
        $file->description = @$_REQUEST['description'][$index];
        $file->pos = @$_REQUEST['pos'][$index] || 1; 
        $file->order_id = $this->get_query_param('order_id');
        $file->layout_id = $this->get_query_param('layout_id');        
    }
    
    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error, $index = null, $content_range = null) {
        $file = parent::handle_file_upload( $uploaded_file, $name, $size, $type, $error, $index, $content_range );
        if (empty($file->error)) {
            $sql = 'INSERT INTO `'.$this->options['db_table']
                .'` (`name`, `size`, `type`, `order_id`,`layout_id`,`pos`,`title`, `description`)'
                .' VALUES (?, ?, ?, ?, ?)';
            $query = $this->EE->db->prepare($sql);
            $query->bind_param(
                'sisiiiss',
                $file->name,
                $file->size,
                $file->type,
                $file->order_id,
                $file->layout_id,
                $file->pos,                    
                $file->title,
                $file->description
            );
            $query->execute();
            $file->id = $this->EE->db->insert_id;
        }
        return $file;
    }
    
    protected function set_additional_file_properties($file) {
        $file->pos = @$this->get_query_param('pos')[$index] || 1; 
        $file->order_id = @$this->get_query_param('order_id');
        $file->layout_id = @$this->get_query_param('layout_id');        

        parent::set_additional_file_properties($file);
                
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $sql = 'SELECT `id`, `type`, `order_id`,`layout_id`,`pos`,`title`, `description` FROM `'
                .$this->options['db_table'].'` WHERE `name`=? and `order_id`=? and `layout_id`=? ';
            $query = $this->EE->db->prepare($sql);
            $query->bind_param('sii', $file->name,$file->order_id,$file->layout_id);
            $query->execute();
            $query->bind_result(
                $id,
                $type,
                $order_id,    
                $layout_id,
                $pos,    
                $title,                    
                $description
            );
            while ($query->fetch()) {
                $file->id = $id;
                $file->type = $type;
                $file->order_id = $order_id;
                $file->layout_id = $layout_id;
                $file->pos = $pos;
                $file->title = $title;
                $file->description = $description;
            }
        }
    }

    public function delete($print_response = true) {
        $response = parent::delete(false);
        $order_id  = $this->get_query_param('order_id');
        $layout_id  = $this->get_query_param('layout_id');
        foreach ($response as $name => $deleted) {
            if ($deleted) {
                $sql = 'DELETE FROM `'
                    .$this->options['db_table'].'` WHERE `name`=? and `order_id`=? and `layout_id`=? ';
                $query = $this->EE->db->prepare($sql);
                $query->bind_param('sii', $name,$order_id,$layout_id);
                $query->execute();
            }
        } 
        return $this->generate_response($response, $print_response);
    }
    

}