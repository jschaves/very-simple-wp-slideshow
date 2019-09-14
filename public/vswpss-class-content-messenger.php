<?php
/**
 * Retrieves information from the database.
 *
 * @package Very_Simple_Wp_SlideShow
 */
 
/**
 * Retrieves information from the database.
 *
 * This requires the information being retrieved from the database should be
 * specified by an incoming key. If no key is specified or a value is not found
 * then an empty string will be returned.
 *
 * @package Very_Simple_Wp_SlideShow
 */

class VSWPSS_Content_Messenger {
	/**
	 * A reference to the class for retrieving our option values.
	 *
	 * @access private
	 * @var    deserializer_vswpss
	 */
	private $deserializer_vswpss;
	/**
	 * Initializes the class by setting a reference to the incoming deserializer_vswpss.
	 *
	 * @param deserializer_vswpss $deserializer_vswpss Retrieves a value from the database.
	 */
	public function __construct( $deserializer_vswpss ) {
		$this->deserializer_vswpss = $deserializer_vswpss;
	}
    /**
     * Adds a submenu for this plugin to the 'Tools' menu.
     */
    public function init() {
        add_filter( 'the_content', array( $this, 'filterSlideShow' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'very_simple_wp_slideshow_public_scripts' ) );
    }
	
	public function filterSlideShow( $content ) {
		if( preg_match_all( '/\[vswpslideshow ID=.* title=.*\]/', $content, $ouputs, PREG_OFFSET_CAPTURE ) ) {
			
			for( $a = 0; $a < count( $ouputs[0] ); $a++ ) {
				$explodeId =  explode('ID=', $ouputs[0][$a][0]);
				$explodeId =  explode(' ', $explodeId[1]);
				$filter[$a] = $ouputs[0][$a][0];
				$values[$a] = esc_attr( $this->deserializer_vswpss->get_filter( 'very_simple_wp_slideshow_' . $explodeId[0] ) );
			}
			for( $a = 0; $a < count( $values ); $a++ ) {
				if( !empty( $values[$a] ) ) { 
					$styleSlideShow = explode( ',', $values[$a] );
					$id = explode( '=', $styleSlideShow[0] );
					$title = explode( '=', $styleSlideShow[1] );
					$width = explode( '=', $styleSlideShow[2] );
					$height = explode( '=', $styleSlideShow[3] );
					$images = explode( '=', $styleSlideShow[4] );
					$color = explode( '=', $styleSlideShow[5] );
					$background = explode( '=', $styleSlideShow[6] );
					$text = explode( 'text=', $styleSlideShow[7] );
					$text_array = explode('vswpss', $text[1]);
					$color_array = explode('vswpss', $color[1]);
					$images_array = explode('vswpss', $images[1]);
					$background_array = explode('vswpss', $background[1]);
					$html[$a] .= '	<span title="' . $title[1] . '" class="vswpss-paint" style="width:' . $width[1] . '%;">';
					$html[$a] .= '		<span class="vswpss-slideshow-container" style="width:' . $width[1] . '%; height:' . $height[1] . 'px">';
					$vswpss_count = 1;
					$vswpss_total = count($images_array);
					for( $b = 0; $b < $vswpss_total; $b++ ) {
						$html[$a] .= '		<span class="vswpss-slides-' . $a . ' vswpss-fade" style="width:100%; height:' . $height[1] . 'px;">';
						$html[$a] .= '			<img title="' . strip_tags( $text_array[$b] ) . '" alt="' . strip_tags( $text_array[$b] ) . '" class="vswpss-img" src="' . $images_array[$b] . '" style="width:100%; height:' . $height[1] . 'px;" />';
						$html[$a] .= '			<span class="vswpss-text" style="display: flow-root;width:100%;color:' . $color_array[$b] . ';background-color:' . $background_array[$b] . ';opacity: 0.7;">' . htmlspecialchars_decode( $text_array[$b] ) . '</span>';
						$html[$a] .= '         	<span class="vswpss-numbertext" style="color:' . $color_array[$b] . ';background-color:' . $background_array[$b] . ';opacity: 0.7;">' . $vswpss_count . ' / ' . $vswpss_total . '</span>';
						$html[$a] .= '		</span>';
						$vswpss_count++;
					}
						$html[$a] .= '			<a style="text-decoration: none;" class="vswpss-prev vswpssnumberpre" vswpssnumber="-1" vswpssid="' . $a . '">❮</a>';
						$html[$a] .= '			<a style="text-decoration: none;" class="vswpss-next vswpssnumberpre" vswpssnumber="1" vswpssid="' . $a . '">❯</a>';
						$html[$a] .= '	<span class="vswpss-current-slide" style="text-align:center;display: block;">';
						
					$vswpss_count = 1;
					for( $b = 0; $b < $vswpss_total; $b++ ) {
						$html[$a] .= '		<span style="text-align:center;" class="vswpss-dot vswpss-dot-' . $a . ' vswpssnumber" vswpssnumber="' . $vswpss_count . '" vswpssid="' . $a . '"></span>';
						$vswpss_count++;
					}						

						$html[$a] .= '		</span>';
						$html[$a] .= '	</span>';
						$html[$a] .= '</span>';			
					$content = str_replace( $filter[$a], $html[$a], $content );
					$control++;
				} else {
					$content = str_replace( $filter[$a], '', $content );
				}
			}
			return $content;
		} else {
			return $content;
		}
	}
	
	/**
	 * Proper way to enqueue scripts and styles.
	 */
	public function very_simple_wp_slideshow_public_scripts() {
		wp_register_style( 'vswp-slideshow-css', plugin_dir_url( __FILE__ ) . 'css/style.css' );
		wp_enqueue_style( 'vswp-slideshow-css' );
		wp_enqueue_script( 'very-simple-wp-slideshow-scripts', plugin_dir_url( __FILE__ ) . 'js/script.js', array( 'jquery' ), '1.0.0', true );
	}
}