<?php
/*
Plugin Name: Paragraph Level IDs
Plugin URI: http://www.robertsharp.co.uk/paragraph-level-ids/
Description:  Now you and your readers can link to specific paragraphs in your blog posts.  This plug-in adds a customizable, linkable 'id' attribute to your <p> tags.
Author: Robert Sharp
Version: 1.0
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


add_action('admin_menu', 'rs_para_ids_menu'); 

function rs_para_ids_register() {
    register_setting('rs_para_ids_optiongroup', 'rs_para_ids_enabled');
    register_setting('rs_para_ids_optiongroup', 'rs_para_id_prefix');
    register_setting('rs_para_ids_optiongroup', 'rs_anchor_enabled');
    register_setting('rs_para_ids_optiongroup', 'rs_anchor_prefix');
    register_setting('rs_para_ids_optiongroup', 'rs_styling_enabled');
}
add_action('admin_init', 'rs_para_ids_register');

function rs_para_ids_load_js_and_css() {
    
    wp_register_style( 'rs-para-ids', plugins_url('rs-para-ids.css', __FILE__), array(), '0.1');
    wp_register_script( 'rs-para-ids', plugins_url('rs-para-ids.js', __FILE__), array('jquery'), null, true);

    if (is_singular()) {
        
        wp_enqueue_style( 'rs-para-ids');
        wp_enqueue_script('rs-para-ids');

    }

}
add_action( 'wp_enqueue_scripts', 'rs_para_ids_load_js_and_css' );

function rs_para_ids_menu() {
    add_options_page('Paragraph Level IDs Settings', 'Paragraph IDs', 'manage_options', 'paragraph-level-ids', 'rs_para_ids_options');
}

function rs_para_ids_options() { ?>

    <div class="wrap">
        <div id="icon-options-general" class="icon32"><br /></div>
        <h2>Paragraph Level IDs</h2>
        <p>Conceived by <strong><a href="http://www.robertsharp.co.uk" title="Visit my website">Robert Sharp</a></strong> and developed by <a href="https://twitter.com/strangerpixel" title="Follow me on Twitter">@strangerpixel</a> | <a href="https://twitter.com/robertsharp59" title="Follow me on Twitter">robertsharp59</a></p>

        <p>This plugin adds paragraph level IDs to your post content.</p>
        
        <p><em>Note:  This plugin only acts on a simple <code>&lt;p&gt;</code> tag with no attributes.</em></p>
     
        <form method="post" action="options.php">
        <?php settings_fields('rs_para_ids_optiongroup'); ?>
        
            <h3 style="margin-top: 30px;">Paragraph IDs</h3>
            <p>Check this box to add an 'id' attribute to each paragraph tag in your content. You can choose an optional prefix if you wish.</p>
            <input type="checkbox" name="rs_para_ids_enabled" value="1" <?php checked( get_option('rs_para_ids_enabled'), 1 ); ?> />
            <label for="rs_para_ids_enabled">Enable</label><br />
            <input name="rs_para_id_prefix" type="text" id="rs_para_id_prefix" placeholder="Your custom prefix" value="<?php echo get_option('rs_para_id_prefix'); ?>" class="regular-text" />

            <h3 style="margin-top: 30px;">Anchors</h3>
            <p>Check this box to add # links immediately after each paragraph tag in your content. This will enable readers to quickly share a section of your article.</p>
            <input type="checkbox" name="rs_anchor_enabled" value="1" <?php checked( get_option('rs_anchor_enabled'), 1 ); ?> />
            <label for="rs_anchor_enabled">Enable</label><br />        
            <p>NOTE: Paragraph IDs must also be enabled for the anchors to work</p>

            <h3 style="margin-top: 30px;">Styling</h3>
            <p>Check this box to add highlight styling to each paragraph tag on hover.</p>
            <input type="checkbox" name="rs_styling_enabled" value="1" <?php checked( get_option('rs_styling_enabled'), 1 ); ?> />
            <label for="rs_styling_enabled">Enable</label><br />        

            <p class="submit">
              <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
            </p>		
        </form>
        
        <h3 style="margin-top: 30px;">Preview</h3>
       
        <p>This is how each paragraph in your markup will begin.  Remember this only applies to <strong>single posts</strong>, not the archives or home page.  If you see XXX or YY in the example below, those letters will be replaced with numbers relating to the post ID and paragraph number.</p>
        <p><code><?php if(get_option('rs_anchor_enabled')) { ?>&lt;a name="<?php echo get_option('rs_anchor_prefix'); ?>XXX-YY"&gt;&lt;/a&gt;<?php } ?>&lt;p<?php if(get_option('rs_para_ids_enabled')) { ?> id="<?php echo get_option('rs_para_id_prefix'); ?>XXX-YY"<?php } ?>&gt;</code></p>
    </div><?php } // end if (is_admin())

/*
*  rsParagraphIDs class
*
*  @description:
*/
class rsParagraphIDs 
{

    protected $count = 0;

    /*
    *  Constructor
    *
    *  @description: This method will be called each time this object is created
    */
    public function __construct() {

        add_filter( 'the_content', array($this, 'para_ids_content_filter'), 100 ); 

    }
    
    /*
    *  Build
    *
    *  @description: 
    */
    public function scan( $start_pattern, $end_pattern, $content ) 
	{	

		if (get_option('rs_para_ids_enabled')) {
            // Scan the content for the start pattern
    		$this->count = 0;
            $content = preg_replace_callback( $start_pattern, array( $this, 'insertID' ), $content );
        }

        if (get_option('rs_anchor_enabled')) {
            // Scan the content for the end pattern
            $this->count = 0;
            $content = preg_replace_callback( $end_pattern, array( $this, 'insertAnchor' ), $content );
        }

        return $content; 

    }


    /*
    *  gatherClass
    *
    *  @description: 
    */
    public function gatherClass() 
    {
        $classes = array('rs-para');
        if (get_option('rs_styling_enabled')) {
            array_push( $classes, 'rs-highlight' );
        }
        return $classes;   

    }


    /*
    *  insertID
    *
    *  @description: 
    */
	public function insertID( $matches )
    {
        
        $postid = get_the_ID(); 
        $this->count++;

        $classes = $this->gatherClass();
       
        return '<p class="' . implode($classes, ' ') . '" id="' . get_option('rs_para_id_prefix') . $postid . '-' . $this->count . '">'; 

    }	


    /*
    *  insertAnchor
    *
    *  @description: 
    */
    public function insertAnchor( $matches )
    {
       
        $postid = get_the_ID(); 
        $this->count++;
       
        return '&nbsp;<a href="#' . get_option('rs_para_id_prefix') . $postid . '-' . $this->count . '" title="Link to this paragraph" class="rs-anchor"># Link in context</a></p>';   
        
    }
    

    /*
    *  para_ids_content_filter
    *
    *  @description: 
    */
    public function para_ids_content_filter( $content ) 
    {

        if (is_singular()) {
            
            return $this->scan( '~<p>~', '~</p>~', $content ); 

        } else { 

            return $content; 
        } 
    }
}

$rs = new rsParagraphIDs();

?>