<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once( __DIR__ . '/config.php');


class PhotoPrint_upd{
    var $version = PHOTOPRINT_VERSION;
    var $mod_class = 'Photoprint';
    
    function __construct() {
        $this->ee = &get_instance();
    }
    
    function install(){    
        $this->ee->load->dbforge();
        $this->uninstall();
        
        
        $this->ee->db->insert('modules',array(
            'module_name' => 'Photoprint',
            'module_version' => $this->version,
            'has_cp_backend' => 'y',
            'has_publish_fields' => 'n',
        ));
        
        $photoprints  = array(
           'file_id'    => array('type' => 'int', 'constraint' => '10', 'unsigned' => TRUE, 'auto_increment' => TRUE),
           'layout_id'  => array('type' => 'varchar','constraint'=> 20 ,'unsigned'=> TRUE,'null'=>FALSE),
           'file'       => array('type' => 'varchar','constraint'=>'255','null'=>FALSE),
           'sequence'   => array('type' =>'int','unsigned' =>TRUE),
           'owner_id'   => array('type' =>'varchar','constraint'=>'32',),
           'order_id'   => array('type' =>'int'),
           'item_id'    => array('type' =>'varchar','constraint'=>'20'),            
           'crop_data'  => array('type' => 'text'),
           'meta'  => array('type' => 'text')
        );        
        
        $this->ee->dbforge->add_field($photoprints);
        //$this->ee->dbforge->add_key(array('file,order_id,owner_id'));
        $this->ee->dbforge->add_key('file_id', TRUE);
        $this->ee->dbforge->create_table('photoprints');
        
        unset($photoprints);
        
        $order_prints = array(
           'order_id'   => array('type' => 'int', 'constraint' => '10', 'unsigned' => TRUE, 'auto_increment' => TRUE),
           'layout_id'  => array('type' =>'int','null'=>FALSE),
           'owner_id'   => array('type' =>'int','null'=>FALSE),
        );
        $this->ee->dbforge->add_field($order_prints);
        $this->ee->dbforge->add_key('order_id', TRUE);               
        $this->ee->dbforge->create_table('printorders');
        unset($order_prints);
        
        $this->_register_action('parameter');
        $this->_register_action('arrange');
        $this->_register_action('downloadImage');
        $this->_register_action('product');
        $this->_register_action('size');
        $this->_register_action('cover');
        $this->_register_action('canvas');
        $this->_register_action('quantity');
        $this->_register_action('border');
        $this->_register_action('select');
        $this->_register_action('crop_data');
        $this->_register_action('crop');
        
        $this->_load_data();
        
        @mkdir(FC .'/media/');
        @mkdir(FC .'/media/photoprints');
        @mkdir(FC .'/media/photoprints/thumbnail');
        @mkdir(FC .'/media/photoprints/production');        
        return true;
    }
    
    
    function uninstall(){
        $this->ee->load->dbforge();
        $this->ee->db->where('class', $this->mod_class);
        $this->ee->db->delete('actions');
        $this->ee->dbforge->drop_table('photoprints');
        $this->ee->dbforge->drop_table('printorders');
        $this->ee->db->where('module_name' ,'PhotoPrint');
        $this->ee->db->delete('modules');
        return TRUE;
    }
    
    function _load_data(){
        $datafiles = glob(__DIR__. '/data/*.{php}',GLOB_BRACE);        
        foreach ($datafiles as $file){
            $table = basename($file,'.php');
            $data = include($file);
            foreach($data as $row){
                $this->ee->db->insert($table,$row);
            }
            
        }
                
        
    }
    
    function install_product($renew=false){
        if ($renew)
            $this->ee->db->query('DELETE FROM exp_br_product');        
        $sql = "INSERT INTO exp_br_product 
                (site_id,type_id,title,enabled,taxable,sku,weight,shippable,url,manage_inventory,quantity,price,detail)             
                VALUES 
                (1,1,'Photoprint',  1,1,'pp-0001',1,1,'photoprint',0, 100,    50000.0,    'Photoprint Description'),
                (1,1,'Photobook',   1,1,'pb-0001',1,1,'photobook' ,0, 100,    50000.0,    'Photobook Description'),
                (1,1,'Magnets',     1,1,'mg-0001',1,1,'magnet'    ,0, 100,    50000.0,    'Magnet Description'),
                (1,1,'Canvas',      1,1,'cv-0001',1,1,'canvas'    ,0, 100,    50000.0,    'Canvas Description');";
                
//                ('2519', '1', '1', '2020 Clothing Guide', '2010-10-28 07:55:46', '1', '0', '10107752', '0.00', '0', '2020-clothing-guide', '1', '9997', '15.00', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', 'Know what is in style with the latest in fashion this year. ', null,'0.00',0),
//                ('2523', '1', '1', 'Shea Butter Hand Lotion', '2010-10-28 12:11:59', '1', '1', '10109875', '1.50', '1', 'shea-butter-hand-lotion', '1', '2000', '14.99', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Shea Butter Hand Lotion', 'Use Shea butter hand lotion to soften even the driest hands.', 'Shea butter, butter, hand, lotion, hand lotion, dry skin', 'Lotion with 40% Shea Butter, 10% honey and sweet walnut extract, blended with the light and sweet smells of lavender and peppermint extracts. This lotion with a nice texture, heals and protects dry or dehydrated skin by locking in moisture. Fresh vitamin E helps!\n', null,'0.00',0),
//                ('2516', '1', '1', 'Capture RX20 Digital SLR Camera', '2010-10-27 13:15:02', '1', '0', '10102887', '10.00', '1', 'capture-rx20-digital-slr-camera', '1', '459', '349.00', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', 'Amazing photos can be taken with this camera', '1','0.00',0),
//                ('2517', '1', '2', 'Capture RX20 Digital SLR Camera + 2 Year Service Plan', '2010-10-27 13:17:17', '1', '0', '1011236', '10.00', '1', 'capture-rx20-digital-slr-camera-2-year-service-plan', '1', '481', '450.00', '400.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', 'GREAT 20% PACKAGE DISCOUNT\nSave big when you buy the RX20 Camera and the 2 Year Service pack.', '1','0.00',0),
//                ('2524', '1', '1', 'Lemon Peppermint Perfume Oil', '2010-10-28 14:06:31', '1', '1', '10108293', '2.50', '1', 'lemon-peppermint-perfume-oil', '1', '85', '60.00', '40.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Lemon Pepper Mint Oil', 'Use Lemon Pepper Mint Oil to smell good!', 'lemon, peppermint, oil, perfume, scents', 'Peppermint can also be used as a ladies fragrance. You will smell of intoxicating peppermint wherever you go.  Although it smells strong it first, the peppermint becomes subdued for more of a citrusy smell. Lemon Peppermint oil provides satisfaction for everyone. ', '1','0.00',0),
//                ('2525', '1', '1', 'Oil Free Sunscreen SPF 30', '2010-10-28 14:40:15', '1', '1', '10101876', '1.00', '1', 'oil-free-sunscreen-spf-30', '1', '3000', '5.99', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Oil Free Sunscreen SPF 30', 'use Oil Free Sunscreen SPF 30 when you are on vacation!', 'Oil free, sunscreen, waterproof, sun, lotion, sun tan,', 'Scent free. Doesn\'t log pours. Protect yourself from powerful sun rays. UVA/UVB protection. It\'s Waterproof. It wont feel greasy. It also moisturizers your skin with added age defying nutrients. SPF 30', '1','0.00',0),
//                ('2526', '1', '1', 'Stunning Eyeliner ', '2010-10-28 15:00:14', '1', '1', '10105647', '0.50', '1', 'stunning-eyeliner', '1', '2500', '12.50', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Stunning Eyeliner', 'This stunning eyeliner wont smeer! ', 'maskera, eyeliner, makeup, easy, wont smear', '<p>\n	This black eyeliner wont smear or run. It&#39;s lightweight, portable, and comes only in black. Don&#39;t worry about fading, because the eyeliner is built with a compound that resists the normal wear and tear.</p>\n', '1','0.00',0);";
        return  $this->ee->db->query($sql);

    }
    
    function update(){
        $this->uninstall();
        $this->install();
    }
    
    protected function _register_action($method)
    {
        $this->ee->db->where('class', $this->mod_class);
        $this->ee->db->where('method', $method);
        if ($this->ee->db->count_all_results('actions') == 0) {
            ee()->db->insert('actions', array(
                'class' => $this->mod_class,
                'method' => $method
            ));
        }
    }
    
    
}