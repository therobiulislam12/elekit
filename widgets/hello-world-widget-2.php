<?php
class Elementor_Hello_World_Widget_2 extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hello_world_widget_2';
    }

    public function get_title() {
        return esc_html__( 'Hello World 2', 'r_elekit' );
    }

    public function get_icon() {
        return 'eicon-code';
    }

    public function get_categories() {
        return ['basic'];
    }

    public function get_keywords() {
        return ['hello', 'world'];
    }

    protected function register_controls() {

        // Content Tab Start

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__( 'Title', 'r_elekit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => esc_html__( 'Title', 'r_elekit' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Hello world', 'r_elekit' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
			'image',
			[
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

        $this->end_controls_section();

        // Content Tab End

        // Style Tab Start

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Title', 'r_elekit' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Text Color', 'r_elekit' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hello-world' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab End

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['title'] ) ) {
            return;
        }
        ?>
		<p class="hello-world">
			<?php echo $settings['title']; ?>
		</p>
        <img src="<?php echo $settings['image']['url'] ?>" alt="<?php echo esc_attr($settings['image']) ?>">
		<?php
}

    protected function content_template() {
        ?>
		<#
		if ( '' === settings.title ) {
			return;
		}
		#>
		<p class="hello-world">
			{{ settings.title }}
		</p>
		<?php
}
}