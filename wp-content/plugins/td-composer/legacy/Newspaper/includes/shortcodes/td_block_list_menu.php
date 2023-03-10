<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 19.08.2016
 * Time: 13:54
 */

class td_block_list_menu extends td_block {

	private $atts = array();

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $in_composer = td_util::tdc_is_live_editor_iframe() || td_util::tdc_is_live_editor_ajax();
        $in_element = td_global::get_in_element();
        $unique_block_class_prefix = '';
        if( $in_element || $in_composer ) {
            $unique_block_class_prefix = 'tdc-row .';

            if( $in_element && $in_composer ) {
                $unique_block_class_prefix = 'tdc-row-composer .';
            }
        }
        $unique_block_class = $unique_block_class_prefix . $this->block_uid;

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @style_general_list_menu */
                .td_block_list_menu ul {
                  flex-wrap: wrap;
                  margin-left: 12px;
                }
                .td_block_list_menu ul li {
                  margin-left: 0;
                }
                .td_block_list_menu .sub-menu {
                  padding-left: 22px;
                }
                .td_block_list_menu .sub-menu li {
                  font-size: 13px;
                }
                .td_block_list_menu li.current-menu-item > a,
				.td_block_list_menu li.current-menu-ancestor > a,
				.td_block_list_menu li.current-category-ancestor > a {
				    color: #4db2ec;
				}

                
                /* @inline */
				.$unique_block_class li {
					display: inline-block;
				}
				.$unique_block_class .menu {
					display: flex;
				}
				.$unique_block_class .sub-menu {
					display: none;
				}
				/* @list_padding */
				.$unique_block_class ul {
					margin: @list_padding;
				}
				/* @item_space_right */
				.$unique_block_class ul li {
					margin-right: @item_space_right;
				}
				.$unique_block_class ul li:last-child {
					margin-right: 0;
				}
				/* @item_space_bottom */
				.$unique_block_class ul li {
					margin-bottom: @item_space_bottom;
				}
				.$unique_block_class ul li:last-child {
					margin-bottom: 0;
				}
				/* @item_horiz_center */
				.$unique_block_class ul {
					text-align: center;
					justify-content: center;
				}
				/* @item_horiz_right */
				.$unique_block_class ul {
					text-align: right;
					justify-content: flex-end;
				}
				/* @item_horiz_left */
				.$unique_block_class ul {
					text-align: left;
					justify-content: flex-start;
				}
				

                /* @menu_color */
				.$unique_block_class a {
					color: @menu_color;
				}
				/* @menu_hover_color */
				body .$unique_block_class li.current-menu-item > a,
				body .$unique_block_class li.current-menu-ancestor > a,
				body .$unique_block_class li.current-category-ancestor > a,
				body .$unique_block_class a:hover {
					color: @menu_hover_color;
				}
				


                /* @f_header */
				.$unique_block_class .td-block-title a,
				.$unique_block_class .td-block-title span {
					@f_header
				}
				/* @f_list */
				.$unique_block_class li {
					@f_list
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        $res_ctx->load_settings_raw( 'style_general_list_menu', 1 );

        // inline list elements
        $res_ctx->load_settings_raw( 'inline', $res_ctx->get_shortcode_att('inline') );

        // list padding
        $padding = $res_ctx->get_shortcode_att('list_padding');
        $res_ctx->load_settings_raw( 'list_padding', $padding );
        if( $padding != '' && is_numeric( $padding ) ) {
            $res_ctx->load_settings_raw( 'list_padding', $padding . 'px' );
        }

        // list item space
        $item_space = $res_ctx->get_shortcode_att('item_space');
        $display_inline = $res_ctx->get_shortcode_att('inline');
        if( $display_inline == 'yes' ) {
            $res_ctx->load_settings_raw( 'item_space_right', $item_space );
            if( $item_space != '' && is_numeric( $item_space ) ) {
                $res_ctx->load_settings_raw( 'item_space_right', $item_space . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'item_space_bottom', $item_space );
            if( $item_space != '' && is_numeric( $item_space ) ) {
                $res_ctx->load_settings_raw( 'item_space_bottom', $item_space . 'px' );
            }
        }


        // menu list horizontal align
        $item_horiz_align = $res_ctx->get_shortcode_att('item_horiz_align');
        if( $item_horiz_align == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'item_horiz_center', 1 );
        }
        if( $item_horiz_align == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'item_horiz_right', 1 );
        }
        if( $item_horiz_align == 'content-horiz-left' ) {
            $res_ctx->load_settings_raw( 'item_horiz_left', 1 );
        }



        // heading text color
        $res_ctx->load_settings_raw( 'menu_color', $res_ctx->get_shortcode_att('menu_color') );

        // heading background color
        $res_ctx->load_settings_raw( 'menu_hover_color', $res_ctx->get_shortcode_att('menu_hover_color') );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_header' );
        $res_ctx->load_font_settings( 'f_list' );

    }

	function render($atts, $content = null){

		self::disable_loop_block_features();

		parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

		$this->atts = shortcode_atts(
			array(
				'menu_id' => ''
			), $atts);

		$buffy = ''; //output buffer


		$buffy .= '<div class="' . $this->get_block_classes() . ' widget" ' . $this->get_block_html_atts() . '>';

		//get the block css
		$buffy .= $this->get_block_css();

		//get the js for this block
		$buffy .= $this->get_block_js();

		// block title wrap
		$buffy .= '<div class="td-block-title-wrap">';
			$buffy .= $this->get_block_title(); //get the block title
			$buffy .= $this->get_pull_down_filter(); //get the sub category filter for this block
		$buffy .= '</div>';

		// For tagDiv composer add a placeholder element
		if (empty($this->atts['menu_id'])) {
            //td-fix-index class to fix background color z-index
            $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner td-fix-index">';
			$buffy .= td_util::get_block_error('List Menu', 'Render failed - please select a menu' );
			$buffy .= '</div>';

			$buffy .= '</div>';

			return $buffy;
		}

        //td-fix-index class to fix background color z-index
        $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner td-fix-index">';

		$buffy .= $this->inner($this->atts['menu_id']);  //inner content of the block
		$buffy .= '</div>';

		//get the ajax pagination for this block
		$buffy .= $this->get_block_pagination();
		$buffy .= '</div>';
		return $buffy;
	}

	function inner($menu_id, $td_column_number = '') {
		$buffy = '';

		$td_block_layout = new td_block_layout();
		if (!empty($menu_id)) {

			ob_start();

			$td_menu_instance = td_menu::get_instance();
			remove_filter( 'wp_nav_menu_objects', array($td_menu_instance, 'hook_wp_nav_menu_objects') );

			wp_nav_menu( array( 'menu' => $menu_id ) );

			add_filter( 'wp_nav_menu_objects', array($td_menu_instance, 'hook_wp_nav_menu_objects'),  10, 2 );
			$buffy .= ob_get_clean();

		}
		$buffy .= $td_block_layout->close_all_tags();
		return $buffy;
	}
}