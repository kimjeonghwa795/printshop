<?php
// Set strict 404 settings
$this->config->update_site_prefs(array(
                                    'member_theme'	=> 'adorama',
                                    'strict_urls'	=> 'y',
                                    'site_404'		=> 'assets/404'
                                    ),
                                    1 // site id
                                );