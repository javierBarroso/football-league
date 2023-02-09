<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;

class Digital_Clock extends Widget_Base
{

    public function __construct($data = array(), $args = null)
    {
        parent::__construct($data, $args);

        wp_enqueue_style('wn-dclock-css', plugin_dir_url(__FILE__) . '/css/dClock_style.css');
        wp_enqueue_script('wn-dclock-js', plugin_dir_url(__FILE__) . '/js/dClock_script.js');
    }

    public function get_name()
    {
        return 'ele-dclock';
    }

    public function get_title()
    {
        return esc_html__('Digital Clock', 'ele-digital-clock');
    }

    public function get_icon()
    {
        return 'eicon-clock-o';
    }

    public function get_custom_help_url()
    {
    }

    public function get_categories()
    {
        return ['jbplugins'];
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
                'label' => esc_html__('Content', 'ele-digital-clock'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'head-text',
            [
                'label' => esc_html('Header Text', 'ele-digital-clock'),
                'type' => Controls_Manager::TEXT,
                'default' => 'your time is now',
                'dynamic' => [
                    'active' => true
                ]

            ]
        );
        $this->add_control(
            'hour-text',
            [
                'label' => esc_html('Hour Text', 'ele-digital-clock'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Hours',
                'dynamic' => [
                    'active' => true
                ]

            ]
        );
        $this->add_control(
            'minute-text',
            [
                'label' => esc_html('Minute Text', 'ele-digital-clock'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Minutes',
                'dynamic' => [
                    'active' => true
                ]

            ]
        );
        $this->add_control(
            'second-text',
            [
                'label' => esc_html('Second Text', 'ele-digital-clock'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Seconds',
                'dynamic' => [
                    'active' => true
                ]

            ]
        );

        $this->add_control(
            'alignment',
            [
                'label' => esc_html__('Alignment', 'ele-digital-clock'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('flex-start', 'ele-digital-clock'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'ele-digital-clock'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('flex-end', 'ele-digital-clock'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .wn-dclock-container' => 'justify-content: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'font_section',
            [
                'label' => esc_html__('Font', 'ele-digital-clock'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__('Header Font', 'ele-digital-clock'),
                'name' => 'typography_header',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .wn-dclock-container .wn-dclock h2',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => ['default' => ['size' => 25]],
                    'font_weight' => ['default' => 300],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__('AM PM Font', 'ele-digital-clock'),
                'name' => 'typography_anpm',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} #time .cell-cont .cell #am-tag',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => ['default' => ['size' => 14]],
                    'font_weight' => ['default' => 300],
                    'line-height' => ['default' => 1],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__('Clock Font', 'ele-digital-clock'),
                'name' => 'typography_clock',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY, 'size' => 25
                ],
                'selector' => '{{WRAPPER}} #time .cell-cont .cell',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => ['default' => ['size' => 65]],
                    'font_weight' => ['default' => 200],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__('Tags Font', 'ele-digital-clock'),
                'name' => 'typography_tag',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} #time .cell-cont .tag',
                'separator' => 'before',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => ['default' => ['size' => 14]],
                    'font_weight' => ['default' => 300],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'size_section',
            [
                'label' => esc_html__('Size', 'ele-digital-clock'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'clock-width',
            [
                'label' => esc_html('Clock Width', 'ele-digital-clock'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => ['px' => ['min' => 5, 'max' => 900]],
                'default' => [
                    'unit' => 'px',
                    'size' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} #time .cell-cont' => 'width:{{SIZE}}{{UNIT}}',
                ]
            ]
        );
        $this->add_responsive_control(
            'clock-height',
            [
                'label' => esc_html('Clock Height', 'ele-digital-clock'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => ['px' => ['min' => 0, 'max' => 100]],
                'default' => [
                    'unit' => 'px',
                    'size' => 14,
                ],
                'selectors' => [
                    '{{WRAPPER}} #time .cell-cont .cell' => 'padding:{{SIZE}}{{UNIT}} 0',
                ]
            ]
        );

        $this->add_responsive_control(
            'cell-height',
            [
                'label' => esc_html('Tag Height', 'ele-digital-clock'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => ['px' => ['min' => 0, 'max' => 50]],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} #time .cell-cont .tag' => 'padding:{{SIZE}}{{UNIT}} 0',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'color_section',
            [
                'label' => esc_html__('Color', 'ele-digital-clock'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'header-color',
            [
                'label' => esc_html('Header Color', 'ele-digital-clock'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .wn-dclock h2' => 'color:{{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'font-color',
            [
                'label' => esc_html('Font Color', 'ele-digital-clock'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} #time .cell-cont .tag' => 'color:{{VALUE}}',
                    '{{WRAPPER}} #time .cell-cont .cell' => 'color:{{VALUE}}',
                    '{{WRAPPER}} #time #hcont #hour #am-tag' => 'color:{{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'hour-background-color',
            [
                'label' => esc_html('Hour Background Color', 'ele-digital-clock'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2196f3',
                'selectors' => [
                    '{{WRAPPER}} #time #hcont' => 'background-color:{{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'minute-background-color',
            [
                'label' => esc_html('Minute Background Color', 'ele-digital-clock'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2196f3',
                'selectors' => [
                    '{{WRAPPER}} #time #mcont' => 'background-color:{{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'second-background-color',
            [
                'label' => esc_html('Second Background Color', 'ele-digital-clock'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff006a',
                'selectors' => [
                    '{{WRAPPER}} #time #scont' => 'background-color:{{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'hour-tag-background-color',
            [
                'label' => esc_html('Hour Tag Background Color', 'ele-digital-clock'),
                'type' => Controls_Manager::COLOR,
                'default' => '#127fd6',
                'selectors' => [
                    '{{WRAPPER}} #time #htag' => 'background-color:{{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'minute-tag-background-color',
            [
                'label' => esc_html('Minute Tag Background Color', 'ele-digital-clock'),
                'type' => Controls_Manager::COLOR,
                'default' => '#127fd6',
                'selectors' => [
                    '{{WRAPPER}} #time #mtag' => 'background-color:{{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'secund-tag-background-color',
            [
                'label' => esc_html('Second Tag Background Color', 'ele-digital-clock'),
                'type' => Controls_Manager::COLOR,
                'default' => '#cc0055',
                'selectors' => [
                    '{{WRAPPER}} #time #stag' => 'background-color:{{VALUE}}'
                ]
            ]
        );
        

        $this->end_controls_section();
    }

    protected function render()
    {

        $teams = new Football_League_Public();

        

        $settings = $this->get_settings_for_display();

        $html = '<section class="wn-dclock-container">
        <script>setInterval(digital_clock, 1000);</script>
        <div class="wn-dclock">
            <h2>' . esc_html($settings['head-text']) . '</h2>
            <div id="time">
                <div class="cell-cont" id="hcont">
                    <div class="cell" id="hour">00<span id="am-tag"></span></div>
                    <div class="tag" id="htag">' . esc_html($settings['hour-text']) . '</div>
                </div>
                <div class="cell-cont" id="mcont"><div class="cell" id="minute">00</div><div class="tag" id="mtag">' . esc_html($settings['minute-text']) . '</div></div>
                <div class="cell-cont" id="scont"><div class="cell" id="second">00</div><div class="tag" id="stag">' . esc_html($settings['second-text']) . '</div></div>
                
            </div>
        </div>
    </section>';

        echo $html;
    }
}

//TODO: aling text verticaly