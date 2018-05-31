<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once( __DIR__ . '/config.php');

class Crud {

    var $table ;
    var $fields;
    var $hiddens;
    
    function Crud() {        
        ee()->load->dbforge();
        $this->EE =  & get_instance();                
        $this->db =  & get_instance()->db;
//        
    }
    
    
                        
    public function form(){
        if (!$this->EE->TMPL->fetch_param('table') ){show_error('You must enter table to be rendered');exit();}
        
        $this->table = $this->EE->TMPL->fetch_param('table');
        $fields = $this->desc($this->table);
        
        $class      = $this->EE->TMPL->fetch_param('class');
        $continue   = $this->EE->TMPL->fetch_param('continue');        
        $show_all   = (bool)$this->EE->TMPL->fetch_param('show_all');
        $action = 'create';
        $hiddens = array();
        $record = array();
        $id = $this->EE->TMPL->fetch_param('id');
        if ($id){
            $action = 'update';            
            $hiddens = $this->load($id);            
        }
        echo '<pre>';
        $s = '';
        $s .= (print_r($hiddens,1));
        $s .= (print_r($this->fields,1));
        print_r($this->fields);
        $this->get_enum_values('content');
        
        
        echo $s;
        
        echo '</pre>';
        
        $action_url =  ee()->functions->fetch_site_index(0, 0).QUERY_MARKER.'ACT=' . ee()->functions->fetch_action_id(__CLASS__, 'save');
        
        
        $fieldTag = '';
        foreach ($this->fields as $field){
            $fieldTag .=   '';            
            unset($hiddens[$field->name]);
            
        }                
        $form_details = array(
                          'action'             => $action_url,
                          'name'               => $this->table .'form',
                          'id'                 => $this->table .'form',
                          'class'              => $class,
                          'hidden_fields'      => $hiddens,
                          'secure'             => TRUE
                      );

        $form_open     = $this->EE->functions->form_declaration($form_details);
        
        $scriptTag = '<script></script>';
        
        return $form_open . $fieldTag . $scriptTag . form_close();
        
    }
    private function get_field($name){
        return array_filter($this->fields,function($v,$k){ return $v->name ==  $name;},ARRAY_FILTER_USE_KEY)[0];
    }
    
    function field(){
        if (!$this->EE->TMPL->fetch_param('name')){show_error('You must enter field name to be rendered');exit();}
        $name =$this->EE->TMPL->fetch_param('name');
        $field  = $this->fields[$name];
        
        switch($field->type){
          case 3: return $this->field_text($field); // integer
          case 253: return $this->field_text($field); // text
          case 252: return $this->field_text($field); // textarea
          case 7: return $this->field_date($field); //datetime
          case 7: return $this->field_text($field); //datetime
        }
        
        
        return ee()->TMPL->parse_variables(ee()->TMPL->tagdata,$this);        
    }
    
    function field_text($field,$options=array('type'=>'text','class'=>'field_text' )){        
    }

    function field_textarea($field){        
    }
    
    function field_number($field){
       return $this->field_text($field,array('type'=>'number','class'=> 'field_number'));
    }
    
    function field_date($field){        
        return $this->field_text($field,array('type'=>'text','class'=> 'field_date datepicker','format' => 'yyyy-mm-dd' ));
    }    
    
    function field_radio($field){
        
    }
    
    function field_selection($field){
        
    }
    
    private function desc($table){        
        $fields = $this->db->query("show full columns from `$table`")->result();                
                
        $keys = $this->db->query("select COLUMN_NAME as `field`,REFERENCED_TABLE_NAME as `ref_table`,REFERENCED_COLUMN_NAME as `ref_field`
                                from INFORMATION_SCHEMA.KEY_COLUMN_USAGE
                                where TABLE_NAME = '$table'")->result();
        print_r($keys);
        $keys = array_map(function($f){return $f->field;}, $keys);
        
        $names  = array_map(function($f){return $f->Field;}, $fields);
        $this->fields = array_combine($names, $fields);
        $this->fields = array();
        foreach($fields as $f => $desc){
            $this->fields[$f] = @array_merge($desc,@$keys[$f]);
        }
         
        return $this->fields;
        
    }
    
    function create(){
        
    }
    function retrieve(){
        
    }
    
    function update(){
        
    }
    
    function delete(){
        
    }
    
    function name_get(){
        
    }
    
    function script(){
        
    }   
    private function load($id){
        $data = $this->db->from($this->table)->where('id',$id)->get()->row_array();
        return $data;
    }   
    
    function get_enum_values($field){
    $test = ee()->db->query("show columns from `{$this->table}` where field = '{$field}' ")->row();        
    preg_match('/^enum\((.*)\)$/', $test->Type, $matches);
    if (! $matches) return [];
    foreach( explode(',', $matches[1]) as $value )   {
       $enum[] = trim( $value, "'" );   
    }

    return $enum;

    }
    
    
}