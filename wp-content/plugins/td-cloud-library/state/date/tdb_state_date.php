<?php


/**
 * Class tdb_state_date
 * @property tdb_method title
 * @property tdb_method search_form
 * @property tdb_method date_breadcrumbs
 * @property tdb_method loop
 *
 */
class tdb_state_date extends tdb_state_base {

    private $date_wp_query = '';
    private $current_year = '';
    private $current_month = '';
    private $current_month_num = '';
    private $current_day = '';

    /**
     * @param WP_Query $wp_query
     */
    function set_wp_query( $wp_query ) {

        parent::set_wp_query( $wp_query );

        $this->date_wp_query = $this->get_wp_query();
        $this->current_year = $this->date_wp_query->query_vars['year'];

        $monthNum  = $this->date_wp_query->query_vars['monthnum'];
        $dateObj   = DateTime::createFromFormat('!m', $monthNum, wp_timezone());
        $timestamp = $dateObj->getTimestamp();

        if ( $this->date_wp_query->is_month ) {
            //we use wp_date() to translate the month name
            $this->current_month = ucfirst( wp_date( 'F', $timestamp) );
            $this->current_month_num = $monthNum;
        }

        if ( $this->date_wp_query->is_day ) {
            //we use wp_date() to translate the month name
            $this->current_month = ucfirst( wp_date( 'M', $timestamp) );
            $this->current_day = $this->date_wp_query->query_vars['day'];
        }

    }



    public function __construct() {

        // search archive posts loop
        $this->loop = function ( $atts ) {

            $svg_list = td_global::$svg_theme_font_list;

            // previous text icon
            $prev_icon_html = '<i class="page-nav-icon td-icon-menu-left"></i>';
            if( isset( $atts['prev_tdicon'] ) ) {
                $prev_icon = $atts['prev_tdicon'];
                $prev_icon_data = '';
                if( td_util::tdc_is_live_editor_iframe() || td_util::tdc_is_live_editor_ajax() ) {
                    $prev_icon_data = 'data-td-svg-icon="' . $prev_icon . '"';
                }

                if( array_key_exists( $prev_icon, $svg_list ) ) {
                    $prev_icon_html = '<div class="page-nav-icon page-nav-icon-svg" ' . $prev_icon_data . '>' . base64_decode( $svg_list[$prev_icon] ) . '</div>';
                } else {
                    $prev_icon_html = '<i class="page-nav-icon ' . $prev_icon . '"></i>';
                }
            }
            // next text icon
            $next_icon_html = '<i class="page-nav-icon td-icon-menu-right"></i>';
            if( isset( $atts['next_tdicon'] ) ) {
                $next_icon = $atts['next_tdicon'];
                $next_icon_data = '';
                if( td_util::tdc_is_live_editor_iframe() || td_util::tdc_is_live_editor_ajax() ) {
                    $next_icon_data = 'data-td-svg-icon="' . $next_icon . '"';
                }

                if( array_key_exists( $next_icon, $svg_list ) ) {
                    $next_icon_html = '<div class="page-nav-icon page-nav-icon-svg" ' . $next_icon_data . '>' . base64_decode( $svg_list[$next_icon] ) . '</div>';
                } else {
                    $next_icon_html = '<i class="page-nav-icon ' . $next_icon . '"></i>';
                }
            }

            // pagination options
            $pagenavi_options = array(
                'pages_text'    => __td( 'Page %CURRENT_PAGE% of %TOTAL_PAGES%', TD_THEME_NAME ),
                'current_text'  => '%PAGE_NUMBER%',
                'page_text'     => '%PAGE_NUMBER%',
                'first_text'    => __td( '1' ),
                'last_text'     => __td( '%TOTAL_PAGES%' ),
                'next_text'     => $next_icon_html,
                'prev_text'     => $prev_icon_html,
                'dotright_text' => __td( '...' ),
                'dotleft_text'  => __td( '...' ),
                'num_pages'     => 3,
                'always_show'   => true
            );

            // pagination defaults
            $pagination_defaults = array(
                'pagenavi_options' => $pagenavi_options,
                'paged' => 1,
                'max_page' => 3,
                'start_page' => 1,
                'end_page' => 3,
                'pages_to_show' => 3,
                'previous_posts_link' => '<a href="#">' . $prev_icon_html . '</a>',
                'next_posts_link' => '<a href="#">' . $next_icon_html . '</a>'
            );

            // posts limit - by default get the global wp loop posts limit setting
            $limit = get_option( 'posts_per_page' );
            if ( isset( $atts['limit'] ) ) {
                $limit = $atts['limit'];
            }

            // posts offset
            $offset = 0;
            if ( isset( $atts['offset'] ) ) {
                $offset = $atts['offset'];
            }

            $dummy_data_array = array(
                'loop_posts' => array(),
                'limit'      => $limit,
                'offset'     => $offset
            );

            for ( $i = (int)$offset; $i < (int)$limit + (int)$offset; $i++ ) {
                $dummy_data_array['loop_posts'][$i] = array(
                    'post_id' => '-' . $i, // negative post_id to avoid conflict with existent posts
                    'post_type' => 'sample',
                    'post_link' => '#',
                    'post_title' => 'Sample post title ' . $i,
                    'post_title_attribute' => esc_attr( 'Sample post title ' . $i ),
                    'post_excerpt' => 'Sample post no ' . $i .  ' excerpt.',
                    'post_content' => 'Sample post no ' . $i .  ' content.',
                    'post_date_unix' =>  get_the_time( 'U' ),
                    'post_date' => date( get_option( 'date_format' ), time() ),
                    'post_modified' => date( get_option( 'date_format' ), time() ),
                    'post_author_url' => '#',
                    'post_author_name' => 'Author name',
                    'post_author_email' => get_the_author_meta( 'email', 1 ),
                    'post_comments_no' => '11',
                    'post_comments_link' => '#',
                    'post_theme_settings' => array(
                        'td_primary_cat' => '1'
                    ),
                );
            }

            $dummy_data_array['loop_pagination'] = $pagination_defaults;
            $dummy_data_array['date_query'] = array();

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $data_array = array();
            $data_array['limit'] = $limit;

            $state_wp_query = $this->date_wp_query;

            foreach ( $state_wp_query->posts as $post ) {

                $data_array['loop_posts'][$post->ID] = array(
                    'post_id' => $post->ID,
                    'post_type' => get_post_type( $post->ID ),
                    'has_post_thumbnail' => has_post_thumbnail( $post->ID ),
                    'post_thumbnail_id' => get_post_thumbnail_id( $post->ID ),
                    'post_link' => esc_url( get_permalink( $post->ID ) ),
                    'post_title' => get_the_title( $post->ID ),
                    'post_title_attribute' => esc_attr( strip_tags( get_the_title( $post->ID ) ) ),
                    'post_excerpt' => $post->post_excerpt,
                    'post_content' => $post->post_content,
                    'post_date_unix' =>  get_the_time( 'U', $post->ID ),
                    'post_date' => get_the_time( get_option( 'date_format' ), $post->ID ),
                    'post_modified' => get_the_modified_date(get_option( 'date_format' ), $post->ID),
                    'post_author_url' => get_author_posts_url( $post->post_author ),
                    'post_author_name' => get_the_author_meta( 'display_name', $post->post_author ),
                    'post_author_email' => get_the_author_meta( 'email', $post->post_author ),
                    'post_comments_no' => get_comments_number( $post->ID ),
                    'post_comments_link' => get_comments_link( $post->ID ),
                    'post_theme_settings' => td_util::get_post_meta_array( $post->ID, 'td_post_theme_settings' ),
                );

            }

            $data_array['loop_pagination'] = $pagination_defaults;

            $paged = intval( $state_wp_query->query_vars['paged'] );

            if ( $paged === 0 ) {
                $paged = 1;
            }

            $max_page = $state_wp_query->max_num_pages;

            $pages_to_show         = intval( $pagenavi_options['num_pages'] );
            $pages_to_show_minus_1 = $pages_to_show - 1;
            $half_page_start       = floor($pages_to_show_minus_1/2 );
            $half_page_end         = ceil($pages_to_show_minus_1/2 );
            $start_page            = $paged - $half_page_start;

            if( $start_page <= 0 ) {
                $start_page = 1;
            }

            $end_page = $paged + $half_page_end;
            if( ( $end_page - $start_page ) != $pages_to_show_minus_1 ) {
                $end_page = $start_page + $pages_to_show_minus_1;
            }

            if( $end_page > $max_page ) {
                $start_page = $max_page - $pages_to_show_minus_1;
                $end_page = $max_page;
            }

            if( $start_page <= 0 ) {
                $start_page = 1;
            }

            $data_array['loop_pagination']['paged'] = $paged;
            $data_array['loop_pagination']['max_page'] = $max_page;
            $data_array['loop_pagination']['start_page'] = $start_page;
            $data_array['loop_pagination']['end_page'] = $end_page;
            $data_array['loop_pagination']['pages_to_show'] = $pages_to_show;

            global $wp_query, $tdb_state_date, $paged;
            $template_wp_query = $wp_query;

            $wp_query = $tdb_state_date->get_wp_query();
            $paged = intval( $state_wp_query->query_vars['paged'] );

            $data_array['loop_pagination']['previous_posts_link'] = get_previous_posts_link( $pagenavi_options['prev_text'] );
            $data_array['loop_pagination']['next_posts_link'] = get_next_posts_link( $pagenavi_options['next_text'], $max_page );

            $wp_query = $template_wp_query;

            $data_array['date_query'] = array(
                'year'  => $this->current_year,
                'month' => $this->current_month_num,
                'day'   => $this->current_day,
            );

            return $data_array;
        };

        // date archive title
        $this->title = function ( $atts ) {

            $dummy_data_array = array(
                'title' => __td( 'Daily Archives:', TD_THEME_NAME ) . ' ' . date('M j, Y'),
                'page_number' => '1',
                'class' => 'tdb-date-title'
            );

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $data_array = array();

            if ( $this->date_wp_query->is_year ) {
                $data_array['title'] = __td( 'Yearly Archives:', TD_THEME_NAME ) . ' ' . $this->current_year;
            } elseif ( $this->date_wp_query->is_month ) {
                $data_array['title'] = __td( 'Monthly Archives:', TD_THEME_NAME ) . ' ' . $this->current_month . ', ' . $this->current_year;
            } elseif ( $this->date_wp_query->is_day ) {
                $data_array['title'] = __td( 'Daily Archives:', TD_THEME_NAME ) . ' ' . $this->current_month . ' ' . $this->current_day . ', ' . $this->current_year;
            } else {
                $data_array['title'] = __td( 'Archives', TD_THEME_NAME );
            }

            $page_number = intval( $this->get_wp_query()->query_vars['paged'] );
            $data_array['page_number'] = $page_number ? $page_number : 1;

            $data_array['class'] = 'tdb-date-title';

            return $data_array;
        };

        // date archive breadcrumbs
        $this->date_breadcrumbs = function ( $atts ) {

            $dummy_data_array = array(
                array(
                    'title_attribute' => '',
                    'url' => '',
                    'display_name' => date("Y")
                ),
                array(
                    'title_attribute' => '',
                    'url' => '',
                    'display_name' => date("F")
                ),
                array(
                    'title_attribute' => '',
                    'url' => '',
                    'display_name' => date("j")
                ),
            );

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $data_array = array(
                array(
                    'title_attribute' => '',
                    'url' => get_year_link( $this->current_year ),
                    'display_name' => $this->current_year
                )
            );

            if ( $this->date_wp_query->is_month ) {

                $data_array[] = array (
                    'title_attribute' => '',
                    'url' => get_month_link( $this->current_year, $this->current_month_num ),
                    'display_name' =>  $this->current_month
                );
            }

            if ( $this->date_wp_query->is_day  ) {

                $data_array[] = array (
                    'title_attribute' => '',
                    'url' => get_month_link( $this->current_year, $this->current_month_num ),
                    'display_name' =>  $this->current_month
                );

                $data_array[] = array (
                    'title_attribute' => '',
                    'url' => get_day_link( $this->current_year, $this->current_month_num, $this->current_day ),
                    'display_name' =>  $this->current_day
                );
            }

            return $data_array;

        };

        parent::lock_state_definition();
    }

}