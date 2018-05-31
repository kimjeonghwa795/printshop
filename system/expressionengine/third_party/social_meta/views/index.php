<h3>Instructions</h3>
<p>Template Tag: <input type='text' class="fullwidth" value='{exp:social_meta entry_id="{entry_id}"}' readonly/></p>
<p>&nbsp;</p>

<?php
	$this->table->set_template($cp_table_template);
	$this->table->set_heading(array(
		array('data' => lang('setting'), 'width' => '30%'),
		lang('current_value'),
	));

	echo form_open($_form_base.'&method=save_settings');

    $this->table->add_row(array(
        lang('template', 'social_meta_template'),
        form_error('social_meta_template'). form_textarea(array(
        	'name'	=>	'social_meta_template',
        	'value'	=>	set_value('social_meta_template', $template),
        	'id'	=>	'social_meta_template',
        	'rows'	=>	15,
        ))
    ));


/* this settings screen is not in use after removing some options to keep this simpler */


	echo $this->table->generate();
	
	echo '<p>', form_submit(array('name' => 'submit', 'value' => lang('update'), 'class' => 'submit')), '</p>';
	echo form_close();


/* End of file index.php */
/* Location: ./system/expressionengine/third_party/social_meta/views/index.php */