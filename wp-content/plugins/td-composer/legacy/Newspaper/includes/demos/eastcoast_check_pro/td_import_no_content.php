<?php

/*  ----------------------------------------------------------------------------
	PAGES
*/
$page_tab_pricing_plans_id = td_demo_content::add_page( array(
    'title' => 'Tab Pricing Plans',
    'file' => 'tab_pricing_plans.txt',
    'demo_unique_id' => '7633c2a00c69ba',
));

$page_video_tutorial_pop_up_id = td_demo_content::add_page( array(
    'title' => 'Video Tutorial Pop Up',
    'file' => 'video_tutorial_pop_up.txt',
    'demo_unique_id' => '99633c2a00c6d21',
));

$page_pricing_plans_id = td_demo_content::add_page( array(
    'title' => 'Pricing Plans',
    'file' => 'pricing_plans.txt',
    'demo_unique_id' => '94633c2a00c7177',
));

$page_eastcoast_check_form_id = td_demo_content::add_page( array(
    'title' => 'EastCoast Check Form',
    'file' => 'eastcoast_check_form.txt',
    'demo_unique_id' => '93633c2a00c7574',
));

$page_homepage_id = td_demo_content::add_page( array(
    'title' => 'Homepage',
    'file' => 'homepage.txt',
    'homepage' => true,
    'demo_unique_id' => '42633c2a00c803b',
));

/*  ----------------------------------------------------------------------------
	SUBSCRIPTION - start phase 1
*/
update_option('users_can_register', true);
global $wpdb;
$disable_wizard = $wpdb->get_var( "SELECT value FROM tds_options WHERE name = 'disable_wizard'");
if ( empty($disable_wizard) ) {

    td_demo_subscription::add_account_details( array(
            'company_name' => 'Demo Company',
            'billing_cui' => '75864589',
            'billing_j' => '10/120/2021',
            'billing_address' => '2656 Farm Meadow Drive',
            'billing_city' => 'Tucson',
            'billing_country' => 'Arizona',
            'billing_email' => 'yourcompany@website.com',
            'billing_bank_account' => 'NL43INGB4186520410',
            'billing_post_code' => '85712',
            'billing_vat_number' => '75864589',
            'options' => 'a:1:{s:15:"td_demo_content";i:1;}',
        )
    );

    td_demo_subscription::add_payment_bank( array(
            'account_name' => 'Alpha Bank Account',
            'account_number' => '123456',
            'bank_name' => 'Alpha Bank',
            'routing_number' => '123456',
            'iban' => 'NL43INGB4186520410',
            'bic_swift' => '123456',
            'description' => 'Make your payment directly into our bank account. Please use your Subscription ID as the payment reference. Your subscription will be activated when the funds are cleared in our account.',
            'instruction' => 'Payment method instructions go here.',
            'is_active' => '1',
            'options' => 'a:1:{s:15:"td_demo_content";i:1;}',
        )
    );

    td_demo_subscription::add_option( array(
            'name' => 'td_demo_content',
            'value' => '1',
        )
    );

}



$plan_free_plan_id = td_demo_subscription::add_plan( array(
        'name' => 'Free Plan',
        'price' => '',
        'months_in_cycle' => '',
        'trial_days' => '0',
        'is_free' => '1',
        'options' => 'a:2:{s:15:"td_demo_content";i:1;s:9:"unique_id";s:15:"52633c2a009a527";}',
    )
);

$plan_monthly_plan_id = td_demo_subscription::add_plan( array(
        'name' => 'Monthly Plan',
        'price' => '10',
        'months_in_cycle' => '1',
        'trial_days' => '0',
        'is_free' => '0',
        'options' => 'a:2:{s:15:"td_demo_content";i:1;s:9:"unique_id";s:15:"62633c2a009a57b";}',
    )
);

$plan_yearly_plan_id = td_demo_subscription::add_plan( array(
        'name' => 'Yearly Plan',
        'price' => '100',
        'months_in_cycle' => '12',
        'trial_days' => '0',
        'is_free' => '0',
        'options' => 'a:2:{s:15:"td_demo_content";i:1;s:9:"unique_id";s:15:"92633c2a009a654";}',
    )
);

$page_payment_page_id_id = td_demo_content::add_page( array(
    'title' => 'Checkout - eastcoast_check_pro',
    'file' => 'tds_checkout.txt',
));

td_demo_subscription::add_option( array(
        'name' => 'payment_page_id',
        'value' => $page_payment_page_id_id,
    )
);

$page_my_account_page_id_id = td_demo_content::add_page( array(
    'title' => 'My Account - eastcoast_check_pro',
    'file' => 'tds_my_account.txt',
));

td_demo_subscription::add_option( array(
        'name' => 'my_account_page_id',
        'value' => $page_my_account_page_id_id,
    )
);

$page_create_account_page_id_id = td_demo_content::add_page( array(
    'title' => 'Login/Register - eastcoast_check_pro',
    'file' => 'tds_login_register.txt',
));

td_demo_subscription::add_option( array(
        'name' => 'create_account_page_id',
        'value' => $page_create_account_page_id_id,
    )
);

td_demo_subscription::add_option( array(
        'name' => 'go_wizard',
        'value' => '1',
    )
);

td_demo_subscription::add_option( array(
        'name' => 'wizard_company_complete',
        'value' => '1',
    )
);

td_demo_subscription::add_option( array(
        'name' => 'wizard_payments_complete',
        'value' => '1',
    )
);

td_demo_subscription::add_option( array(
        'name' => 'wizard_plans_complete',
        'value' => '1',
    )
);

td_demo_subscription::add_option( array(
        'name' => 'wizard_locker_complete',
        'value' => '1',
    )
);

td_demo_subscription::add_option( array(
        'name' => 'disable_wizard',
        'value' => '1',
    )
);


/*  ----------------------------------------------------------------------------
	SUBSCRIPTION - end phase 1
*/




/*  ----------------------------------------------------------------------------
	SUBSCRIPTIONS
*/
// add locker
$post_tds_default_wizard_locker_id = td_demo_content::add_post( array(
        'post_type' => 'tds_locker',
        'title' => 'Wizard Locker (default)',
        'file' => '',
        'categories_id_array' => [],
        'tds_locker_settings' => array(
            'tds_title' => 'Subscribe to Unlock',
            'tds_message' => 'We promise not to spam you and only send you updates when you give us your email address.',
            'tds_submit_btn_text' => 'Subscribe',
            'tds_pp_msg' => 'I consent to processing of my data according to <a href=\"#\">Terms of Use</a> & <a href=\"#\">Privacy Policy</a>.',
            'tds_locker_cf_1_name' => 'Custom field 1',
            'tds_locker_cf_2_name' => 'Custom field 2',
            'tds_locker_cf_3_name' => 'Custom field 3',
        ),
        'tds_payable' => 'paid_subscription',
        'tds_paid_subs_page_id' => $page_pricing_plans_id,
        'tds_paid_subs_plan_ids' => [$plan_free_plan_id,$plan_monthly_plan_id,$plan_yearly_plan_id],
        'tds_locker_styles' => array(
            'tds_bg_color' => '#ffffff',
            'all_tds_border' => '0',
            'all_tds_border_color' => '#abb8c0',
            'tds_title_color' => '#4d5860',
            'tds_message_color' => '#abb8c0',
            'tds_submit_btn_text_color' => '#4d5860',
            'tds_submit_btn_text_color_h' => '#ffffff',
            'tds_submit_btn_bg_color' => '#ffc03a',
            'tds_submit_btn_bg_color_h' => '#d2930b',
            'tds_pp_checked_color' => '#ffc03a',
            'tds_pp_check_bg' => '#e6eaed',
            'tds_pp_check_bg_f' => '#e6eaed',
            'tds_pp_check_border_color' => '#abb8c0',
            'tds_pp_check_border_color_f' => '#5d7e93',
            'tds_pp_msg_color' => '#abb8c0',
            'tds_pp_msg_links_color' => '#5d7e93',
            'tds_pp_msg_links_color_h' => '#ffc03a',
            'tds_general_font_family' => 'eastcoast-global_global',
            'tds_title_font_family' => 'eastcoast-global_global',
            'tds_title_font_size' => '26',
            'tds_title_font_line_height' => '1.2',
            'tds_title_font_weight' => '700',
            'tds_message_font_family' => 'eastcoast-global_global',
            'tds_message_font_size' => '18',
            'tds_message_font_line_height' => '1.2',
            'tds_message_font_weight' => '500',
            'tds_submit_btn_text_font_family' => 'eastcoast-global_global',
            'tds_submit_btn_text_font_size' => '16',
            'tds_submit_btn_text_font_line_height' => '1.2',
            'tds_submit_btn_text_font_weight' => '700',
            'tds_submit_btn_text_font_transform' => 'uppercase',
            'tds_submit_btn_text_font_spacing' => '1',
            'tds_after_btn_text_font_family' => 'eastcoast-global_global',
            'tds_after_btn_text_font_size' => '16',
            'tds_after_btn_text_font_line_height' => '1.2',
            'tds_after_btn_text_font_weight' => '500',
            'tds_pp_msg_font_family' => 'eastcoast-global_global',
            'tds_pp_msg_font_size' => '18',
            'tds_pp_msg_font_line_height' => '1.2',
            'tds_pp_msg_font_weight' => '500',
        ),
    )
);

// add post meta for default locker
td_demo_content::add_locker_meta( array(
        'tds_locker_id' => (int) get_option( 'tds_default_locker_id' ),
        'tds_locker_meta' => array(
            'tds_locker_settings' => array(
                'tds_title' => 'This Content Is Only For Subscribers',
                'tds_message' => 'Please subscribe to unlock this content. Enter your email to get access.',
                'tds_input_placeholder' => 'Please enter your email address.',
                'tds_submit_btn_text' => 'Subscribe to unlock',
                'tds_after_btn_text' => 'Your email address is 100% safe from spam!',
                'tds_pp_msg' => 'I consent to processing of my data according to <a href=\"#\">Terms of Use</a> & <a href=\"#\">Privacy Policy</a>',
            ),
        )
    )
);

td_util::update_option('tds_demo_options', 'a:1:{s:5:"plans";a:3:{i:0;a:2:{s:9:"unique_id";s:15:"52633c2a009a527";s:4:"name";s:9:"Free Plan";}i:1;a:2:{s:9:"unique_id";s:15:"62633c2a009a57b";s:4:"name";s:12:"Monthly Plan";}i:2;a:2:{s:9:"unique_id";s:15:"92633c2a009a654";s:4:"name";s:11:"Yearly Plan";}}}');


/*  ----------------------------------------------------------------------------
	SUBSCRIPTION - end phase 2
*/

/*  ----------------------------------------------------------------------------
	CLOUD TEMPLATES
*/
$template_search_template_id = td_demo_content::add_cloud_template( array(
    'title' => 'EastCoast Check - Search Template',
    'file' => 'search_cloud_template.txt',
    'template_type' => 'search',
));

td_demo_misc::update_global_search_template( 'tdb_template_' . $template_search_template_id);


$template_date_template_id = td_demo_content::add_cloud_template( array(
    'title' => 'EastCoast Check - Date Template',
    'file' => 'date_cloud_template.txt',
    'template_type' => 'date',
));

td_demo_misc::update_global_date_template( 'tdb_template_' . $template_date_template_id);


$template_tag_template_id = td_demo_content::add_cloud_template( array(
    'title' => 'EastCoast Check - Tag Template',
    'file' => 'tag_cloud_template.txt',
    'template_type' => 'tag',
));

td_demo_misc::update_global_tag_template( 'tdb_template_' . $template_tag_template_id);


$template_category_template_id = td_demo_content::add_cloud_template( array(
    'title' => 'EastCoast Check - Category Template',
    'file' => 'cat_cloud_template.txt',
    'template_type' => 'category',
));

td_demo_misc::update_global_category_template( 'tdb_template_' . $template_category_template_id);


$template_author_template_id = td_demo_content::add_cloud_template( array(
    'title' => 'EastCoast Check - Author Template',
    'file' => 'author_cloud_template.txt',
    'template_type' => 'author',
));

td_demo_misc::update_global_author_template( 'tdb_template_' . $template_author_template_id);


$template_404_template_id = td_demo_content::add_cloud_template( array(
    'title' => 'EastCoast Check - 404 Template',
    'file' => '404_cloud_template.txt',
    'template_type' => '404',
));

td_demo_misc::update_global_404_template( 'tdb_template_' . $template_404_template_id);


$template_custom_post_type_id = td_demo_content::add_cloud_template( array(
    'title' => 'EastCoast Check - Custom Post Type',
    'file' => 'cpt_cloud_template.txt',
    'template_type' => 'cpt',
));

td_demo_misc::update_global_cpt_template( 'tdb_template_' . $template_custom_post_type_id, 'tdcpt_directories' );


td_demo_misc::update_global_cpt_template( 'tdb_template_' . $template_custom_post_type_id, 'tdc-review' );


$template_custom_taxonomy_id = td_demo_content::add_cloud_template( array(
    'title' => 'EastCoast Check - Custom Taxonomy',
    'file' => 'cpt_tax_cloud_template.txt',
    'template_type' => 'cpt_tax',
));

td_demo_misc::update_global_cpt_tax_template( 'tdb_template_' . $template_custom_taxonomy_id, 'tdtax_services' );


td_demo_misc::update_global_cpt_tax_template( 'tdb_template_' . $template_custom_taxonomy_id, 'tdc-review-criteria' );


td_demo_misc::update_global_cpt_tax_template( 'tdb_template_' . $template_custom_taxonomy_id, 'tdtax_locations' );


$template_single_template_id = td_demo_content::add_cloud_template( array(
    'title' => 'EastCoast Check - Single Template',
    'file' => 'post_cloud_template.txt',
    'template_type' => 'single',
));

td_util::update_option('td_default_site_post_template', 'tdb_template_' . $template_single_template_id);


$template_footer_template_id = td_demo_content::add_cloud_template( array(
    'title' => 'EastCoast Check - Footer Template',
    'file' => 'footer_cloud_template.txt',
    'template_type' => 'footer',
));

td_demo_misc::update_global_footer_template( 'tdb_template_' . $template_footer_template_id);


$template_header_template_id = td_demo_content::add_cloud_template( array(
    'title' => 'EastCoast Check - Header Template',
    'file' => 'header_cloud_template.txt',
    'template_type' => 'header',
));

td_demo_misc::update_global_header_template( 'tdb_template_' . $template_header_template_id);


update_post_meta( $template_header_template_id, 'header_mobile_menu_id', $menu_td_demo_header_menu_id);


/*  ----------------------------------------------------------------------------
	GENERAL SETTINGS
*/
td_demo_misc::update_background('', false);

td_demo_misc::update_background_mobile('tdx_pic_10');

td_demo_misc::update_background_login('');

td_demo_misc::update_background_header('');

td_demo_misc::update_background_footer('');

td_demo_misc::update_footer_text('');

td_demo_misc::update_logo(array('normal' => '','retina' => '','mobile' => '',));

td_demo_misc::update_footer_logo(array('normal' => '','retina' => '',));

td_demo_misc::add_social_buttons(array());

$generated_css = td_css_generator();
if ( function_exists('tdsp_css_generator') ) {
    $generated_css .= tdsp_css_generator();
}
td_util::update_option( 'tds_user_compile_css', $generated_css );
