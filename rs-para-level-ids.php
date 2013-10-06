<?php
/*
Plugin Name: Pargraph Level IDs
Plugin URI: http://www.robertsharp.co.uk/paragraph-level-ids/
Description:  Now you and your readers can link to specific paragraphs in your blog posts.  This plug-in adds a customizable 'id' attribute to your <p> tags, and/or an an anchor above each paragraph.
Author: Robert Sharp
Version: 0.2
Author URI: http://www.robertsharp.co.uk
*/

/*  Copyright 2013 Robert Sharp (email : rob [at] robertsharp [dot] co [dot] uk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if(is_admin()) {
  add_action('admin_menu', 'rs_para_ids_menu'); 
  add_action('admin_init', 'rs_para_ids_register');
  }

function rs_para_ids_register() {
  register_setting('rs_para_ids_optiongroup', 'rs_para_ids_enabled');
  register_setting('rs_para_ids_optiongroup', 'rs_para_id_prefix');
  register_setting('rs_para_ids_optiongroup', 'rs_anchor_enabled');
  register_setting('rs_para_ids_optiongroup', 'rs_anchor_prefix');
}

function rs_para_ids_menu() {
  add_options_page('Paragraph Level IDs Settings', 'Paragraph IDs', 'manage_options', 'paragraph-level-ids', 'rs_para_ids_options');
}

function rs_para_ids_options() { ?>

  <div class="wrap">
    <div id="icon-options-general" class="icon32"><br /></div>
    <h2>Paragraph Level IDs</h2>
<p>by <strong><a href="http://www.robertsharp.co.uk" title="Visit my website">Robert Sharp</a></strong> | <a href="https://twitter.com/robertsharp59" title="Follow me on Twitter">robertsharp59</a>
    
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>
</p>

    <p>This plugin adds paragraph level IDs and anchors to your post content.</p>
    
    <p><em>Note:  This plugin only acts on a simple <code>&lt;p&gt;</code> tag with no attributes.</em></p>
 
    <form method="post" action="options.php">
    <?php settings_fields('rs_para_ids_optiongroup'); ?>
    
   
    <h3 style="margin-top: 30px;">Paragraph IDs</h3>
    <p>Enable this section to add an 'id' attribute to each paragraph tag in your content.  You can choose an optional prefix if you wish.</p>
    <input type="checkbox" name="rs_para_ids_enabled" value="1" <?php checked( get_option('rs_para_ids_enabled'), 1 ); ?> />
    <label for="rs_para_ids_enabled">Enable</label><br />
	<input name="rs_para_id_prefix" type="text" id="rs_para_id_prefix" value="<?php echo get_option('rs_para_id_prefix'); ?>" class="regular-text" />
    
    <h3 style="margin-top: 30px;">Anchors</h3>
     <p>Enable this section to add anchors immediately before each paragraph tag in your content.  You can choose an optional prefix if you wish.</p>
    <input type="checkbox" name="rs_anchor_enabled" value="1" <?php checked( get_option('rs_anchor_enabled'), 1 ); ?> />
    <label for="rs_anchor_enabled">Enable</label><br />
	<input name="rs_anchor_prefix" type="text" id="rs_anchor_prefix" value="<?php echo get_option('rs_anchor_prefix'); ?>" class="regular-text" />
	<p class="submit">
      <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
    </p>		
    </form>
    
    <h3 style="margin-top: 30px;">Preview</h3>
   
   <p>This is how each paragraph in your markup will begin.  Remember this only applies to <strong>single posts</strong>, not the archives or home page.  If you see XXX or YY in the example below, those letters will be replaced with numbers relating to the post ID and paragraph number.</p>
    
<p><code><?php if(get_option('rs_anchor_enabled')) { ?>&lt;a name="<?php echo get_option('rs_anchor_prefix'); ?>XXX-YY"&gt;&lt;/a&gt;<?php } ?>&lt;p<?php if(get_option('rs_para_ids_enabled')) { ?> id="<?php echo get_option('rs_para_id_prefix'); ?>XXX-YY"<?php } ?>&gt;</code></p>
</div><?php }

class InsertAnchors {
    protected $count = 0;
    public function build( $pattern, $content ) 
		
		{	
		
		$this->count = 0;
        	$content = preg_replace_callback( $pattern, array( $this, '_replacer' ), $content );
   			return $content; 	}
   
	public function _replacer( $matches ) {
       
	  $postid = get_the_ID(); 
	  $this->count++;
       
	    if(get_option('rs_para_ids_enabled')) {	
			if(get_option('rs_anchor_enabled')) {
				return '<a name="' . 	get_option('rs_anchor_prefix') . $postid . '-' . $this->count . '"></a><p id="' . get_option('rs_para_id_prefix') . $postid . '-' . $this->count . '">';   }
	  		else {
		  		return '<p id="' . get_option('rs_para_id_prefix') . $postid . '-' . $this->count . '">'; }}
	  	else {
		  	if(get_option('rs_anchor_enabled')) {
	  			return '<a name="' . get_option('rs_anchor_prefix') . $postid . '-' . $this->count . '"></a><p>';   }
	  		else {
		  		return '<p>'; }	}	}	}

function para_ids_content_filter( $content ) {

	if(is_single()) {
    	$insert = new InsertAnchors();
   		return $insert->build( '~<p>~', $content );	}
	else { return $content; } }

add_filter( 'the_content', 'para_ids_content_filter', 100 ); 
?>