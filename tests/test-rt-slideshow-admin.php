<?php
/**
 * Contains test for Rt_Slideshow_Admin class
 *
 * @link       https://github.com/kirtangajjar
 * @since      1.0.0
 *
 * @package    Rt_Slideshow
 * @subpackage Rt_Slideshow/test
 */

 /**
  * The admin-specific test functionality of the plugin.
  *
  * @package    Rt_Slideshow
  * @subpackage Rt_Slideshow/test
  * @author     Kirtan Gajjar <kirtangajjar95@gmail.com>
  */
class PluginAdminTest extends WP_UnitTestCase {

	/**
	 * Stores current class instance
	 *
	 * @access   private
	 * @var      Rt_Slideshow_Admin $admin
	 */
	private $admin;

	/**
	 * Initialize the test and set its properties.
	 */
	function setUp() {

		require_once( 'admin/class-rt-slideshow-admin.php' );
		$this->admin = new Rt_Slideshow_Admin( 'rt-slideshow', '1.0.0' );

	}

	/**
	 * Test to check if plugin has been initializes.
	 */
	function test_plugin_initialization() {

		$this->assertFalse( null == $this->admin );

	}

	/**
	 * Test to validate validate_ints_in_array.
	 */
	function test_validate_ints_pass() {

		$method = self::getPrivateMethod( 'validate_ints_in_array' );

		$this->assertEquals(

			$method->invokeArgs(
				$this->admin, array( array( 1, 2, 3 ) )
			), true
		);

	}

	/**
	 * Gets private method of current class
	 *
	 * @param string $name Name of the method.
	 */
	protected static function getPrivateMethod( $name ) {

		$class = new ReflectionClass( 'Rt_Slideshow_Admin' );
		$method = $class->getMethod( $name );
		$method->setAccessible( true );
		return $method;

	}

}
