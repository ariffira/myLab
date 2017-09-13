<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 *
 * @package			
 * @author			
 * @copyright		
 * @license			
 * @link				
 * @since				
 * @filesource	
 */

// ------------------------------------------------------------------------

/**
 * UI html Class
 *
 * @package			
 * @subpackage	
 * @category		
 * @author			
 * @link				
 */
class Ui_html extends Ui_base {

	protected $options = array(
		'ui_type' => 'tag',
		'tag' => 'html',
		'attr' => '',
		'lang' => array('en-US', ),
		'class' => array('', ),
		'doctype' => 'html5',
	);
	protected $structure = array();

	public $template = 'html';

	// ------------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @param array
	 */
	public function __construct()
	{
		parent::__construct();
		log_message('debug', "Ui_html Class Initialized");
	}

	/**
	 * Function load_config
	 * 
	 * Loading configs from saui.php
	 */
	public function load_config($template = 'html')
	{
		static $_ci;

		if (empty($_ci)) $_ci =& get_instance();

	        $this->template = $template;

		switch (Ui::$bs_tname) {
			case 'sa103':
				switch ($template) {
					case 'html':
						
						$this->structure = array(
							'head' => array(
								'options' => array(
									'ui_type' => 'tag',
									'tag' => 'head',
									'attr' => '',
								),
								'structure' => array(
									'head' => array(
										'options' => array(
											'ui_type' => 'view',
											'location' => 'partials/'.Ui::$bs_tname.'/head_view',
											'data' => array(),
										),
									),
								),
							),
							'body' => array(
								'options' => array(
									'ui_type' => 'tag',
									'tag' => 'body',
									'attr' => '',
									'id' => 'skin-blur-city',
								),
								'structure' => array(
									'topnav' => array(
										'options' => array(
											'ui_type' => 'tag',
											'tag' => 'header',
											'attr' => '',
											'id' => 'header',
											'class' => 'media',
										),
										'structure' => array(
											'topnav' => array(
												'options' => array(
													'ui_type' => 'view',
													'location' => 'partials/'.Ui::$bs_tname.'/topnav_view',
													'data' => array(),
												),
											),
										),
									),
									'clearfix' => array(
										'options' => array(
											'ui_type' => 'tag',
											'tag' => 'div',
											'attr' => '',
											'class' => 'clearfix',
										),
									),
									'main' => array(
										'options' => array(
											'ui_type' => 'tag',
											'tag' => 'section',
											'attr' => array('role' => 'main', ),
											'id' => 'main',
											'class' => 'p-relative',
										),
										'structure' => array(
											'sidenav' => array(
												'options' => array(
													'ui_type' => 'view',
													'location' => 'partials/'.Ui::$bs_tname.'/sidenav_view',
													'data' => array(),
												),
											),
											'content' => array(
												'options' => array(
													'ui_type' => 'tag',
													'tag' => 'section',
													'attr' => '',
													'id' => 'content',
													'class' => 'container',
												),
												'structure' => array(
													'messages' => array(
														'options' => array(
															'ui_type' => 'tag',
															'tag' => 'div',
															'attr' => '',
															'id' => 'messages',
															'class' => 'tile drawer animated',
														),
														'structure' => array(
															'content' => array(
																'options' => array(
																	'ui_type' => 'view',
																	'location' => 'partials/'.Ui::$bs_tname.'/drawers/messages_view',
																	'data' => array(),
																),
															),
														),
													),
													'notifications' => array(
														'options' => array(
															'ui_type' => 'tag',
															'tag' => 'div',
															'attr' => '',
															'id' => 'notifications',
															'class' => 'tile drawer animated',
														),
														'structure' => array(
															'content' => array(
																'options' => array(
																	'ui_type' => 'view',
																	'location' => 'partials/'.Ui::$bs_tname.'/drawers/notifications_view',
																	'data' => array(),
																),
															),
														),
													),
													'breadcrumb' => array(
														'options' => array(
															'ui_type' => 'tag',
															'tag' => 'ol',
															'attr' => '',
															'class' => 'breadcrumb hidden-xs',
														),
														'structure' => array(
															'li0' => array('options' => array('ui_type' => 'tag', 'tag' => 'li', 'attr' => '', 'class' => '      ' ), 'structure' => array( 'content' => array('options' => array('ui_type' => 'tag', 'tag' => 'a', 'attr' => '', 'href' => '#' ), 'structure' => array('Home',    ), ), ), ),
															'li1' => array('options' => array('ui_type' => 'tag', 'tag' => 'li', 'attr' => '', 'class' => '      ' ), 'structure' => array( 'content' => array('options' => array('ui_type' => 'tag', 'tag' => 'a', 'attr' => '', 'href' => '#' ), 'structure' => array('Library', ), ), ), ),
															'li2' => array('options' => array('ui_type' => 'tag', 'tag' => 'li', 'attr' => '', 'class' => 'active' ), 'structure' => array( 'Data', ), ),
														),
													),
													'title' => array(
														'options' => array(
															'ui_type' => 'tag',
															'tag' => 'h4',
															'attr' => '',
															'class' => 'page-title',
														),
														'structure' => array(
															'content' => 'DASHBOARD',
														),
													),
													'block0' => array(
														'options' => array(
															'ui_type' => 'tag',
															'tag' => 'div',
															'attr' => '',
															'class' => 'block-area m-b-15',
															'id' => 'main-content',
														),
														'structure' => array(
															'Content Inside',
														),
													),
													'block0hr' => array(
														'options' => array(
															'ui_type' => 'tag',
															'tag' => 'hr',
															'attr' => '',
															'class' => 'whiter',
														),
													),
													'chat' => array(
														'options' => array(
															'ui_type' => 'tag',
															'tag' => 'div',
															'attr' => '',
															'class' => 'chat',
														),
														'structure' => array(
															'content' => array(
																'options' => array(
																	'ui_type' => 'view',
																	'location' => 'partials/'.Ui::$bs_tname.'/chat_view',
																	'data' => array(),
																),
															),
														),
													),
												),
											),
											'olderie' => array(
												'options' => array(
													'ui_type' => 'view',
													'location' => 'partials/'.Ui::$bs_tname.'/olderie_view',
													'data' => array(),
												),
											),
										),
									),
									'scripts' => array(
										'options' => array(
											'ui_type' => 'view',
											'location' => 'partials/'.Ui::$bs_tname.'/scripts_view',
											'data' => array(),
										),
									),
								),
							),
						);

						$this->base_init();

						break;

					case 'login':

						$this->structure = array(
							'head' => array(
								'options' => array(
									'ui_type' => 'tag',
									'tag' => 'head',
									'attr' => '',
								),
								'structure' => array(
									'head' => array(
										'options' => array(
											'ui_type' => 'view',
											'location' => 'partials/'.Ui::$bs_tname.'/head_view',
											'data' => array(),
										),
									),
								),
							),
							'body' => array(
								'options' => array(
									'ui_type' => 'tag',
									'tag' => 'body',
									'attr' => '',
									'id' => 'skin-blur-city',
								),
								'structure' => array(
									'content' => array(
										'options' => array(
											'ui_type' => 'tag',
											'tag' => 'section',
											'attr' => '',
											'id' => 'login',
										),
										'structure' => array(
											'header' => array(
												'options' => array(
													'ui_type' => 'tag',
													'tag' => 'header',
													'attr' => '',
												),
												'structure' => array(
													'title' => array(
														'options' => array(
															'ui_type' => 'tag',
															'tag' => 'h1',
															'attr' => '',
														),
														'structure' => array(
															'content' => 'LOGIN TITLE',
														),
													),
													'sub_title' => array(
														'options' => array(
															'ui_type' => 'tag',
															'tag' => 'p',
															'attr' => '',
														),
														'structure' => array(
															'content' => 'login sub title',
														),
													),
													'alert' => array(
														'options' => array(
															'ui_type' => 'tag',
															'tag' => 'p',
															'attr' => '',
															'class' => 'alert alert-danger',
															'enabled' => FALSE, 
														),
														'structure' => array(
															'content' => 'login alert',
														),
													),
												),
											),
											'clearfix' => array(
												'options' => array(
													'ui_type' => 'tag',
													'tag' => 'div',
													'class' => 'clearfix',
												),
											),
											'content' => 'login content',
										),
									),
									'scripts' => array(
										'options' => array(
											'ui_type' => 'view',
											'location' => 'partials/'.Ui::$bs_tname.'/scripts_view',
											'data' => array(),
										),
									),
								),
							),
						);

						$this->base_init();

						break;

					case '404':

						$this->structure = array(
							'head' => array(
								'options' => array(
									'ui_type' => 'tag',
									'tag' => 'head',
									'attr' => '',
								),
								'structure' => array(
									'head' => array(
										'options' => array(
											'ui_type' => 'view',
											'location' => 'partials/'.Ui::$bs_tname.'/head_view',
											'data' => array(),
										),
									),
								),
							),
							'body' => array(
								'options' => array(
									'ui_type' => 'tag',
									'tag' => 'body',
									'attr' => '',
									'id' => 'skin-blur-city',
								),
								'structure' => array(
									'content' => array(
										'options' => array(
											'ui_type' => 'tag',
											'tag' => 'section',
											'attr' => '',
											'id' => 'error-page',
											'class' => 'tile',
										),
										'structure' => array(
											'title' => array(
												'options' => array(
													'ui_type' => 'tag',
													'tag' => 'h1',
													'attr' => '',
													'class' => 'm-b-10',
												),
												'structure' => array(
													'content' => '404 TITLE',
												),
											),
											'alert' => array(
												'options' => array(
													'ui_type' => 'tag',
													'tag' => 'p',
													'attr' => '',
													'class' => 'alert alert-danger',
													'enabled' => FALSE, 
												),
												'structure' => array(
													'content' => '404 alert',
												),
											),
											'content' => '404 content',
										),
									),
									'scripts' => array(
										'options' => array(
											'ui_type' => 'view',
											'location' => 'partials/'.Ui::$bs_tname.'/scripts_view',
											'data' => array(),
										),
									),
								),
							),
						);

						$this->base_init();

						break;
					
					default:
						# code...
						break;
				}

				break;

			case 'mvpr110':
                                  
				switch ($template) {
					case 'html':

						$this->options['class'] = array('no-js', );
						
						$this->structure = array(
							'head' => array(
								'options' => array(
									'ui_type' => 'tag',
									'tag' => 'head',
									'attr' => '',
								),
								'structure' => array(
									'head' => array(
										'options' => array(
											'ui_type' => 'view',
											'location' => 'partials/'.Ui::$bs_tname.'/head_view',
											'data' => array(
												'mvpr_css' => '',
											),
										),
									),
								),
							),
							'body' => array(
								'options' => array(
									'ui_type' => 'tag',
									'tag' => 'body',
									'attr' => '',
									'id' => '',
								),
								'structure' => array(
									'wrapper' => array(
										'options' => array(
											'ui_type' => 'tag',
											'tag' => 'div',
											'attr' => array(),
											'id' => 'wrapper',
											'class' => '',
										),
										'structure' => array(
											'header' => array(
												'options' => array(
													'ui_type' => 'view',
													'location' => 'partials/'.Ui::$bs_tname.'/topnav_view',
													'data' => array(),
												),
											),
											'mainnav' => array(
												'options' => array(
													'ui_type' => 'view',
													'location' => 'partials/'.Ui::$bs_tname.'/mainnav_view',
													'data' => array(),
												),
											),
											'content' => array(
												'options' => array(
													'ui_type' => 'tag',
													'tag' => 'div',
													'attr' => '',
													'id' => '',
													'class' => 'content',
												),
												'structure' => array(
													'container' => array(
														'options' => array(
															'ui_type' => 'tag',
															'tag' => 'div',
															'attr' => '',
															'id' => 'content',
															'class' => 'container',
														),
														'structure' => array(
														),
													),
												),
											),
										),
									),
									'footer' => array(
										'options' => array(
											'ui_type' => 'tag',
											'tag' => 'footer',
											'attr' => '',
											'id' => 'footer',
											'class' => 'footer',
										),
										'structure' => array(
											'topnav' => array(
												'options' => array(
													'ui_type' => 'view',
													'location' => 'partials/'.Ui::$bs_tname.'/footer_view',
													'data' => array(),
												),
											),
										),
									),
									'scripts' => array(
										'options' => array(
											'ui_type' => 'view',
											'location' => 'partials/'.Ui::$bs_tname.'/scripts_view',
											'data' => array(),
										),
									),
								),
							),
						);

						$this->base_init();

						break;

					case 'login':
                                               
						$this->options['class'] = array('no-js', );
						$this->structure = array(
							'head' => array(
								'options' => array(
									'ui_type' => 'tag',
									'tag' => 'head',
									'attr' => '',
								),
								'structure' => array(
									'head' => array(
										'options' => array(
											'ui_type' => 'view',
											'location' => 'partials/'.Ui::$bs_tname.'/head_view',
											'data' => array(
												'mvpr_css' => '',
											),
										),
									),
								),
							),
							'body' => array(
								'options' => array(
									'ui_type' => 'tag',
									'tag' => 'body',
									'attr' => '',
									'id' => '',
									'class' => 'account-bg'
								),
								'structure' => array(
									'header' => array(
										'options' => array(
											'ui_type' => 'view',
											'location' => 'partials/'.Ui::$bs_tname.'/topnav_view',
											'data' => array('hide_user_info' => TRUE, ),
										),
									),
									'account_wrapper' => array(
										'options' => array(
											'ui_type' => 'tag',
											'tag' => 'div',
											'attr' => array(),
											'id' => 'content',
											// 'class' => 'account-wrapper',
											'class' => '',
										),
										'structure' => array(
											'account_body' => array(
												'options' => array(
													'ui_type' => 'tag',
													'tag' => 'div',
													'attr' => '',
													'id' => '',
													'class' => '',
												),
												'structure' => array(
													'title' => array(
														
														'structure' => array(
															'content' => 'LOGIN TITLE',
														),
													),
													'content' => '',
												),
											),
											'footer' => array(
												'options' => array(
													'ui_type' => 'tag',
													'tag' => 'footer',
													'attr' => '',
													'id' => 'footer',
													'class' => 'account-footer',
												),
												'structure' => array(
													'topnav' => array(
														'options' => array(
															'ui_type' => 'view',
															'location' => 'partials/'.Ui::$bs_tname.'/footer_view',
															'data' => array(),
														),
													),
												),
											),
										),
									),
									'scripts' => array(
										'options' => array(
											'ui_type' => 'view',
											'location' => 'partials/'.Ui::$bs_tname.'/scripts_view',
											'data' => array(),
										),
									),
								),
							),
						);
						$this->base_init();
						break;
                                       
                                            case 'register':
                                                $this->options['class'] = array('no-js', );
						$this->structure = array(
							'head' => array(
								'options' => array(
									'ui_type' => 'tag',
									'tag' => 'head',
									'attr' => '',
								),
								'structure' => array(
									'head' => array(
										'options' => array(
											'ui_type' => 'view',
											'location' => 'partials/'.Ui::$bs_tname.'/head_view',
											'data' => array(
												'mvpr_css' => '',
											),
										),
									),
								),
							),
							'body' => array(
								'options' => array(
									'ui_type' => 'tag',
									'tag' => 'body',
									'attr' => '',
									'id' => '',
									'class' => 'account-bg'
								),
								'structure' => array(
									'header' => array(
										'options' => array(
											'ui_type' => 'view',
											'location' => 'partials/'.Ui::$bs_tname.'/topnav_view',
											'data' => array('hide_user_info' => TRUE, ),
										),
									),
									'account_wrapper' => array(
										'options' => array(
											'ui_type' => 'tag',
											'tag' => 'div',
											'attr' => array(),
											'id' => 'content',
											// 'class' => 'account-wrapper',
											'class' => 'container text-center p-t-20 p-m-20',
										),
										'structure' => array(
											'account_body' => array(
//												'options' => array(
//													'ui_type' => 'tag',
//													'tag' => 'div',
//													'attr' => '',
//													'id' => '',
//													'class' => 'account-body',
//												),
												'structure' => array(
													'title' => array(
														
														'structure' => array(
															'content' => 'LOGIN TITLE',
														),
													),
													'content' => '',
												),
											),
											'footer' => array(
												'options' => array(
													'ui_type' => 'tag',
													'tag' => 'footer',
													'attr' => '',
													'id' => 'footer',
													'class' => 'account-footer',
												),
												'structure' => array(
													'topnav' => array(
														'options' => array(
															'ui_type' => 'view',
															'location' => 'partials/'.Ui::$bs_tname.'/footer_view',
															'data' => array(),
														),
													),
												),
											),
										),
									),
									'scripts' => array(
										'options' => array(
											'ui_type' => 'view',
											'location' => 'partials/'.Ui::$bs_tname.'/scripts_view',
											'data' => array(),
										),
									),
								),
							),
						);

						$this->base_init();

						break;

					case '404':

						$this->options['class'] = array('no-js', );
						
						$this->structure = array(
							'head' => array(
								'options' => array(
									'ui_type' => 'tag',
									'tag' => 'head',
									'attr' => '',
								),
								'structure' => array(
									'head' => array(
										'options' => array(
											'ui_type' => 'view',
											'location' => 'partials/'.Ui::$bs_tname.'/head_view',
											'data' => array(
												'mvpr_css' => '',
											),
										),
									),
								),
							),
							'body' => array(
								'options' => array(
									'ui_type' => 'tag',
									'tag' => 'body',
									'attr' => '',
									'id' => '',
									'class' => 'account-bg'
								),
								'structure' => array(
									'header' => array(
										'options' => array(
											'ui_type' => 'view',
											'location' => 'partials/'.Ui::$bs_tname.'/topnav_view',
											'data' => array('hide_user_info' => TRUE, ),
										),
									),
									'account_wrapper' => array(
										'options' => array(
											'ui_type' => 'tag',
											'tag' => 'div',
											'attr' => array(),
											'id' => '',
											'class' => 'account-wrapper',
											'class' => 'container',
										),
										'structure' => array(
											'account_body' => array(
												'options' => array(
													'ui_type' => 'tag',
													'tag' => 'div',
													'attr' => '',
													'id' => '',
													'class' => 'account-body',
												),
												'structure' => array(
													'title' => array(
														'options' => array(
															'ui_type' => 'tag',
															'tag' => 'h3',
															'attr' => '',
															'class' => 'm-b-10',
														),
														'structure' => array(
															'content' => 'LOGIN TITLE',
														),
													),
													'content' => '',
												),
											),
											'footer' => array(
												'options' => array(
													'ui_type' => 'tag',
													'tag' => 'footer',
													'attr' => '',
													'id' => 'footer',
													'class' => 'account-footer',
												),
												'structure' => array(
													'topnav' => array(
														'options' => array(
															'ui_type' => 'view',
															'location' => 'partials/'.Ui::$bs_tname.'/footer_view',
															'data' => array(),
														),
													),
												),
											),
										),
									),
									'scripts' => array(
										'options' => array(
											'ui_type' => 'view',
											'location' => 'partials/'.Ui::$bs_tname.'/scripts_view',
											'data' => array(),
										),
									),
								),
							),
						);

						$this->base_init();

						break;
					
					default:
						# code...
						break;
				}
				break;
			
			default:
				# code...
				break;
		}

		// $_ci->config->load("ia24ui", TRUE, TRUE);

		// $this->options['attr']                                 = $_ci->config->item('page_html_prop', 'ia24ui');
		
		// $this->body->options['attr']                           = $_ci->config->item('page_body_prop', 'ia24ui');

		// $this->body->topnav_login->options['enabled']          = $_ci->config->item('login_header', 'ia24ui');
		// $this->body->topnav_register->options['enabled']       = $_ci->config->item('register_header', 'ia24ui');
		// $this->body->topnav->options['disabled']               = $_ci->config->item('no_main_header', 'ia24ui');
		
		// $this->body->main_panel->options['attr']               = $_ci->config->item('page_main_prop', 'ia24ui');
		
		// $this->body->main_panel->ribbon->options['disabled']   = $_ci->config->item('no_ribbon', 'ia24ui');
		// $this->body->main_panel->main_content->options['attr'] = $_ci->config->item('page_content_prop', 'ia24ui');
		
		// $this->body->sidenav->options['disabled']              = $_ci->config->item('no_sidenav', 'ia24ui');
		
		// $this->body->footer->options['disabled']               = $_ci->config->item('no_footer', 'ia24ui');

		return $this;
	}

	/**
	 * Function set_css
	 * 
	 * Loading configs from saui.php
	 */
	public function set_css($css_name, $css_theme = 'mvpr_css')
	{
		switch (Ui::$bs_tname) {
			case 'sa103':
				# code...
				break;

			case 'mvpr110':
				if (empty($this->head->head->options['data']) || !is_array($this->head->head->options['data']))
				{
					$this->head->head->options['data'] = array();
				}

				$this->head->head->options['data'][$css_theme] = $css_name;

				break;
			
			default:
				# code...
				break;
		}
		return $this;
	}

	/**
	 *
	 */
	public function set_active_url($url)
	{
		$this->body->scripts->options('data', array('active_url' => $url, ) );
		return $this;
	}

	/**
	 *
	 */
	public function &content($content = NULL)
	{
		switch (Ui::$bs_tname) {
			case 'sa103':
				if ($content === NULL)
				{
					return $this->body->main->content;
				}

				$this->body->main->content->structure = is_string($content) ? array('content' => $content, ) : $content;

				break;

			case 'mvpr110':
				switch ($this->template) {
					case 'html':
						if ($content === NULL)
						{
							return $this->body->wrapper->content->container;
						}

						$this->body->wrapper->content->container->structure = is_string($content) ? array('content' => $content, ) : $content;
						break;

					case 'login':
						if ($content === NULL)
						{
							return $this->body->account_wrapper->account_body->content;
						}

						$this->body->account_wrapper->account_body->content = $content;
						break;
                                       case 'register':
						if ($content === NULL)
						{
							return $this->body->account_wrapper->account_body->content;
						}

						$this->body->account_wrapper->account_body->content = $content;
						break;

					case '404':
						if ($content === NULL)
						{
							return $this->body->account_wrapper->account_body->content;
						}

						$this->body->account_wrapper->account_body->content = $content;
						break;
					
					default:
						if ($content === NULL)
						{
							return $this->body->wrapper->content->container;
						}

						$this->body->wrapper->content->container->structure = is_string($content) ? array('content' => $content, ) : $content;
						break;
				}

				break;
			
			default:
				# code...
				break;
		}
		return $this;
	}

	/**
	 *
	 */
	public function &page_title($content = NULL)
	{
		switch (Ui::$bs_tname) {
			case 'sa103':
				switch ($this->template) {
					case 'html':
						if ($content === NULL)
						{
							return $this->body->main->content->title;
						}

						$this->body->main->content->title->structure = is_string($content) ? array('content' => $content, ) : $content;
						break;

					case 'login':
						if ($content === NULL)
						{
							return $this->body->content->header->title;
						}

						$this->body->content->header->title->structure = is_string($content) ? array('content' => $content, ) : $content;
						break;

					case '404':
						if ($content === NULL)
						{
							return $this->body->content->title;
						}

						$this->body->content->title->structure = is_string($content) ? array('content' => $content, ) : $content;
						break;
					
					default:
						if ($content === NULL)
						{
							return $this->body->main->content->title;
						}

						$this->body->main->content->title->structure = is_string($content) ? array('content' => $content, ) : $content;
						break;
				}

				break;

			case 'mvpr110':
				switch ($this->template) {
					case 'html':
						if ($content === NULL)
						{
							return $this->body->wrapper->content->container;
						}

						$this->body->wrapper->content->container->structure = is_string($content) ? array('content' => $content, ) : $content;
						break;

					case 'login':
						if ($content === NULL)
						{
							return $this->body->account_wrapper->account_body->title;
						}

						$this->body->account_wrapper->account_body->title->structure = is_string($content) ? array('content' => $content, ) : $content;
						break;
                                                
                                       case 'register':
						if ($content === NULL)
						{
							return $this->body->account_wrapper->account_body->title;
						}

						$this->body->account_wrapper->account_body->title->structure = is_string($content) ? array('content' => $content, ) : $content;
						break;

					case '404':
						if ($content === NULL)
						{
							return $this->body->account_wrapper->account_body->title;
						}

						$this->body->account_wrapper->account_body->title->structure = is_string($content) ? array('content' => $content, ) : $content;
						break;
					
					default:
						if ($content === NULL)
						{
							return $this->body->wrapper->content->container;
						}

						$this->body->wrapper->content->container->structure = is_string($content) ? array('content' => $content, ) : $content;
						break;
				}

				break;
			
			default:
				# code...
				break;
		}
		return $this;
	}

	/**
	 * Function output
	 */
	public function output($echo = FALSE)
	{
		$output = '';

		switch (Ui::$bs_tname) {
			case 'sa103':
				if (!empty($this->options['doctype']))
				{
					$output = doctype($this->options['doctype']);
				}
				$output .= '<!--[if IE 9 ]><html class="ie9"><![endif]-->';

				if ($echo) echo $output;
				
				$output .= parent::output($echo);

				break;

			case 'mvpr110':
				
				$converted_attr = $this->convert_arr($this, $this->options);

				$this->options['ui_type'] = 'bare';

				$output .=
					doctype($this->options['doctype']).
					'<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->'.
					'<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->'.
					'<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->'.
					'<!--[if gt IE 8]><!--><html '.$converted_attr['attr'].'><!--<![endif]-->';

				if ($echo) echo $output;

				$output .= parent::output($echo);

				if ($echo) echo '</html>';

				$output .= '</html>';

				break;
			
			default:
				# code...
				break;
		}

		return $output;
	}

}

/* End of file Ui_html.php */
/* Location: ./system/libraries/Eui/drivers/Ui_html.php */