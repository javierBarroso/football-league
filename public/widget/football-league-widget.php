<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

class Football_League_Widget extends Widget_Base
{

    private $fl_public;

    public function __construct($data = array(), $args = null)
    {
        $this->fl_public = new Football_League_Public();

        parent::__construct($data, $args);

        // wp_enqueue_style('jb-efl-css', plugin_dir_url(__FILE__) . '/css/efl_style.css');
        // wp_enqueue_script('jb-efl-js', plugin_dir_url(__FILE__) . '/js/efl_script.js');
    }

    public function get_name()
    {
        return 'football-league';
    }

    public function get_title()
    {
        return esc_html__('Footbal League', 'football-league');
    }

    public function get_icon()
    {
        return 'eicon-code';
    }

    public function get_custom_help_url()
    {
    }

    public function get_categories()
    {
        return ['jb-footbal-league'];
    }

    public function get_keywords()
    {
        return ['keyword', 'keyword'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__('Query', 'football-league'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'query_select',
            [
                'label' => esc_html( 'Query by', 'football-league' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'all' => 'All',
                    'league' => 'League',
                    'keyword' => 'Keyword'
                ],
                'default' => 'all'
            ]
        );

        $leagues = $this->fl_public->get_leagues();
        $leagues_options = [];
        foreach ($leagues as $league) {
            $leagues_options[$league->ID] = $league->name;
        }
        $this->add_control(
            'select_league',
            [
                'label' => esc_html( 'Select League', 'football-league' ),
                'type' => Controls_Manager::SELECT,
                'options' => $leagues_options,
                'condition' => [
                    'query_select' => 'league',
                ]
            ]
        );
        

        $this->end_controls_section();

        
        


        /**
         * Card Section
         */
        $this->start_controls_section(
            'card_section',
            [
                'label' => esc_html__('Card', 'football-league'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card-color',
            [
                'label' => esc_html('Background Color', 'football-league'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eflw-team-card' => 'background:{{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'border-color',
            [
                'label' => esc_html('Border Color', 'football-league'),
                'type' => Controls_Manager::COLOR,
                'default' => '#eee',
                'selectors' => [
                    '{{WRAPPER}} .eflw-team-card' => 'border-color:{{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'border-width',
            [
                'label' => esc_html('Border Width', 'football-league'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => ['px' => ['min' => 0, 'max' => 50]],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eflw-team-card' => 'border-width:{{SIZE}}{{UNIT}}',
                ]
            ]
        );
        $this->add_responsive_control(
            'border-radius',
            [
                'label' => esc_html('Border Radius', 'football-league'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => ['px' => ['min' => 0, 'max' => 200]],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eflw-team-card' => 'border-radius:{{SIZE}}{{UNIT}}',
                ]
            ]
        );
        $this->add_responsive_control(
            'card-shadow',
            [
                'label' => esc_html('Card Shadow', 'football-league'),
                'type' => Controls_Manager::SWITCHER ,
                'default' => 'yes',
                'label_on' => 'on',
                'label_off' => 'off',
            ]
        );
        
        $this->end_controls_section();

        /**
         * Content section
         */
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'football-league'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'header_style',
			[
				'label' => esc_html__( 'Team Name', 'football-league' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'team-name-color',
            [
                'label' => esc_html('Color', 'football-league'),
                'type' => Controls_Manager::COLOR,
                'default' => '#555',
                'selectors' => [
                    '{{WRAPPER}} .header h2' => 'color:{{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__('Typografy', 'football-league'),
                'name' => 'typography_team_name',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .header h2',
                'separator' => 'before',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => ['default' => ['size' => 1.2, 'unit' => 'em']],
                    'font_weight' => ['default' => 400],
                    'font_family' => ['default' => 'poppins']
                ],
            ]
        );

        $this->add_control(
			'nickname_style',
			[
				'label' => esc_html__( 'Team Nickname', 'football-league' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'team-nickname-color',
            [
                'label' => esc_html('Color', 'football-league'),
                'type' => Controls_Manager::COLOR,
                'default' => '#555',
                'selectors' => [
                    '{{WRAPPER}} .header span' => 'color:{{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__('Typografy', 'football-league'),
                'name' => 'typography_team_nickname',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .header span',
                'separator' => 'before',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => ['default' => ['size' => 1, 'unit' => 'em']],
                    'font_weight' => ['default' => 300],
                ],
            ]
        );

        $this->add_control(
			'league_label_style',
			[
				'label' => esc_html__( 'League Label', 'football-league' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'league-label-color',
            [
                'label' => esc_html('Color', 'football-league'),
                'type' => Controls_Manager::COLOR,
                'default' => '#555',
                'selectors' => [
                    '{{WRAPPER}} .footer h4' => 'color:{{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__('Typografy', 'football-league'),
                'name' => 'typography_league_label_nickname',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .footer h4',
                'separator' => 'before',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => ['default' => ['size' => 1, 'unit' => 'em']],
                    'font_weight' => ['default' => 300],
                ],
            ]
        );

        $this->add_control(
			'league_name_style',
			[
				'label' => esc_html__( 'League Name', 'football-league' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'league-name-color',
            [
                'label' => esc_html('Color', 'football-league'),
                'type' => Controls_Manager::COLOR,
                'default' => '#555',
                'selectors' => [
                    '{{WRAPPER}} .footer p' => 'color:{{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__('Typografy', 'football-league'),
                'name' => 'typography_league_name_nickname',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .footer p',
                'separator' => 'before',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => ['default' => ['size' => 1, 'unit' => 'em']],
                    'font_weight' => ['default' => 300],
                ],
            ]
        );

        

        $this->end_controls_section();

        /**
         * button section
         */
        
         $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__('Button', 'football-league'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'football-league' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Show more', 'football-league' ),
				'dynamic' => [
					'active' => true,
				],
                'selector'=>[
                    '{{WRAPPER}} .footer button.show-more' => 'content: {{VALUE}};',
                ]
			]
		);

        $this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'football-league' ),
				
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'football-league' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .footer button.show-more' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .footer button.show-more',
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'football-league' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer button.show-more' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .footer button.show-more',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'football-league' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .footer button.show-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_text_padding',
			[
				'label' => esc_html__( 'Text Padding', 'football-league' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .footer button.show-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'football-league' ),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'football-league' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer button.show-more:hover' => 'color: {{VALUE}};',
				],
			]
		);

		

		$this->add_control(
			'button_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'football-league' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer button.show-more:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'football-league' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer button.show-more:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_animation',
			[
				'label' => esc_html__( 'Animation', 'football-league' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {

        

        $settings = $this->get_settings_for_display();
        
        $teams = $this->fl_public->get_teams( $settings['query_select'], $settings['select_league'] );

        $leagues = $this->fl_public->get_leagues();

        $league_option = '';

        foreach ($leagues as $key => $league) {
            $league_option .= '<option value="' . $league->ID . '">' . $league->name . '</option>';
        }

        $html = '<div class="eflw-teamcards-query">
                    <div class="select-team-input">
                        <span>Show teams</span>


                        <input style="display:none;" id="settings-button-text" value="'.esc_attr($settings['button_text']).'"></input>
                        <input style="display:none;" id="settings-card-shadow" value="'.esc_attr($settings['card-shadow'] == 'yes' ? 'shadow' : '').'"></input>


                        <input checked class="show-by" type="radio" name="show-team-by" id="show-all" value="all">
                        <label for="show-all">All</label>
                        <input class="show-by" type="radio" name="show-team-by" id="show-by-league" value="league">
                        <label for="show-by-league">by League</label>
                        <input class="show-by" type="radio" name="show-team-by" id="show-by-keyword" value="keyword">
                        <label for="show-by-keyword">by Keyword</label>
                
                    </div>
                
                    <div class="selection-criteria" id="selection-criteria">
                        <div class="select-league" id="select-league" style="display:none;">
                            <select name="" id=""><option>All Leagues</option>
                                ' . $league_option . '
                            </select>
                        </div>
                        <input id="keywords-input" style="display:none;"><span id="keywords-input-info" style="display:none;">separate keywords with commas</span>
                    </div>
                </div>';
        $html .= '<section class="eflw-teamcards-container" id="eflw-teamcards-container">';

        foreach ($teams as $key => $team) {
            $html .= '<div class="eflw-team-card ' . esc_attr($settings['card-shadow'] == 'yes' ? 'shadow' : '') . '">
                        <div class="imgbox">
                            <img src="' . esc_attr( $team->logo ? $team->logo : FOOTBALL_LEAGUE_URL . 'admin/img/logo_placeholder.svg' ) . '" alt="" srcset="">
                        </div>
                        <div class="content">
                            <div class="header">
                                <h2>' . esc_html( $team->name ) . '</h2><span>' . esc_html( $team->nickname ) . '</span>
                            </div>
                            <div class="footer">
                                <h4>League</h4>
                                <p>' . esc_html( $this->fl_public->get_league($team->league_id)->name ) . '</p>
                                <button class="show-more" onclick="show_history(\'' . esc_html($team->name) . '\', \'' . esc_html($team->history) . '\')">' . esc_html( $settings['button_text'] ) . '</button>
                            </div>
                        </div>
                    </div>';
        }
        $html .= '</section>';

        $html .= '<div class="history-container" id="history-container">
                    <h3 id="team-name-history"></h3>
                    
                    <p id="team-history"></p>
                    <button onclick="close_history()" class="show-more">Close</button>
                    </div>';

        echo $html;
        
    }
}

//TODO: aling text verticaly

