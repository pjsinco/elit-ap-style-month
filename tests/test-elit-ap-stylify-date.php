<?php

class Test_Elit_AP_Style_Date extends WP_UnitTestCase {

  private $test_months;
  private $test_dates;

  public function setUp() {
    parent::setUp();
    $this->test_months = array( 
      array(
      'full_month' => 'January',
      'ap_month' => 'Jan.',
      ),
      array(
      'full_month' => 'February',
      'ap_month' => 'Feb.',
      ),
      array(
      'full_month' => 'March',
      'ap_month' => 'March',
      ),
      array(
      'full_month' => 'April',
      'ap_month' => 'April',
      ),
      array(
      'full_month' => 'May',
      'ap_month' => 'May',
      ),
      array(
      'full_month' => 'June',
      'ap_month' => 'June',
      ),
      array(
      'full_month' => 'July',
      'ap_month' => 'July',
      ),
      array(
      'full_month' => 'August',
      'ap_month' => 'Aug.',
      ),
      array(
      'full_month' => 'September',
      'ap_month' => 'Sept.',
      ),
      array(
      'full_month' => 'October',
      'ap_month' => 'Oct.',
      ),
      array(
      'full_month' => 'November',
      'ap_month' => 'Nov.',
      ),
      array(
      'full_month' => 'December',
      'ap_month' => 'Dec.',
      ),
    );
 
    // post_date is in the same format that comes out of MySQL
    $this->test_dates_with_mysql_date = array(
      array(
        'post_date' => '2016-01-20 00:00:50',
        'day_of_week' => 'Wednesday',
        'day_of_month' => '20',
        'year' => '2016',
        'ap_month' => 'Jan.',
      ),
      array(
        'post_date' => '2015-02-21 01:10:41',
        'day_of_week' => 'Saturday',
        'day_of_month' => '21',
        'year' => '2015',
        'ap_month' => 'Feb.',
      ),
      array(
        'post_date' => '2014-03-22 02:20:32',
        'day_of_week' => 'Saturday',
        'day_of_month' => '22',
        'year' => '2014',
        'ap_month' => 'March',
      ),
      array(
        'post_date' => '2013-04-23 03:30:23',
        'day_of_week' => 'Tuesday',
        'day_of_month' => '23',
        'year' => '2013',
        'ap_month' => 'April',
      ),
      array(
        'post_date' => '2012-05-24 04:40:14',
        'day_of_week' => 'Thursday',
        'day_of_month' => '24',
        'year' => '2012',
        'ap_month' => 'May',
      ),
      array(
        'post_date' => '2011-06-26 05:50:05',
        'day_of_week' => 'Sunday',
        'day_of_month' => '26',
        'year' => '2011',
        'ap_month' => 'June',
      ),
      array(
        'post_date' => '2010-07-26 06:01:56',
        'day_of_week' => 'Monday',
        'day_of_month' => '26',
        'year' => '2010',
        'ap_month' => 'July',
      ),
      array(
        'post_date' => '1999-08-27 07:02:56',
        'day_of_week' => 'Friday',
        'day_of_month' => '27',
        'year' => '1999',
        'ap_month' => 'Aug.',
      ),
      array(
        'post_date' => '1998-09-28 08:03:56',
        'day_of_week' => 'Monday',
        'day_of_month' => '28',
        'year' => '1998',
        'ap_month' => 'Sept.',
      ),
      array(
        'post_date' => '1997-10-29 09:04:56',
        'day_of_week' => 'Wednesday',
        'day_of_month' => '29',
        'year' => '1997',
        'ap_month' => 'Oct.',
      ),
      array(
        'post_date' => '1996-11-30 10:05:56',
        'day_of_week' => 'Saturday',
        'day_of_month' => '30',
        'year' => '1996',
        'ap_month' => 'Nov.',
      ),
      array(
        'post_date' => '1995-12-31 11:06:56',
        'day_of_week' => 'Sunday',
        'day_of_month' => '31',
        'year' => '1995',
        'ap_month' => 'Dec.',
      ),
    );

    $this->test_dates = array(
      array(
        'original' => 'Monday, Jan. 23, 2015',
        'found_month' => 'Jan.',
        'ap_month' => 'Jan.',
        'expected' => 'Monday, Jan. 23, 2015',
      ),
      array(
        'original' => 'Tuesday, January 23, 2015',
        'found_month' => 'January',
        'ap_month' => 'Jan.',
        'expected' => 'Tuesday, Jan. 23, 2015',
      ),
      array(
        'original' => 'Wednesday, Feb. 23, 2015',
        'found_month' => 'Feb.',
        'ap_month' => 'Feb.',
        'expected' => 'Wednesday, Feb. 23, 2015',
      ),
      array(
        'original' => 'Thursday, February 23, 2015',
        'found_month' => 'February',
        'ap_month' => 'Feb.',
        'expected' => 'Thursday, Feb. 23, 2015',
      ),
      array(
        'original' => 'Friday, Mar. 23, 2015',
        'found_month' => 'Mar.',
        'ap_month' => 'March',
        'expected' => 'Friday, March 23, 2015',
      ),
      array(
        'original' => 'Saturday, March 23, 2015',
        'found_month' => 'March',
        'ap_month' => 'March',
        'expected' => 'Saturday, March 23, 2015',
      ),
      array(
        'original' => 'Sunday, Apr. 23, 2015',
        'found_month' => 'Apr.',
        'ap_month' => 'April',
        'expected' => 'Sunday, April 23, 2015',
      ),
      array(
        'original' => 'Sunday, April 23, 2015',
        'found_month' => 'April',
        'ap_month' => 'April',
        'expected' => 'Sunday, April 23, 2015',
      ),
      array(
        'original' => 'May 23, 2015',
        'found_month' => 'May',
        'ap_month' => 'May',
        'expected' => 'May 23, 2015',
      ),
      array(
        'original' => 'May. 23, 2015',
        'found_month' => 'May.',
        'ap_month' => 'May',
        'expected' => 'May 23, 2015',
      ),
      array(
        'original' => 'Tues., Jun. 23, 2015',
        'found_month' => 'Jun.',
        'ap_month' => 'June',
        'expected' => 'Tues., June 23, 2015',
      ),
      array(
        'original' => 'DragonDay, June 23, 2015',
        'found_month' => 'June',
        'ap_month' => 'June',
        'expected' => 'DragonDay, June 23, 2015',
      ),
      array(
        'original' => 'Jul. 23, 2015',
        'found_month' => 'Jul.',
        'ap_month' => 'July',
        'expected' => 'July 23, 2015',
      ),
      array(
        'original' => 'July 23, 2015',
        'found_month' => 'July',
        'ap_month' => 'July',
        'expected' => 'July 23, 2015',
      ),
      array(
        'original' => 'Wed., Aug. 23, 2015',
        'found_month' => 'Aug.',
        'ap_month' => 'Aug.',
        'expected' => 'Wed., Aug. 23, 2015',
      ),
      array(
        'original' => 'Monday, August 23, 2015',
        'found_month' => 'August',
        'ap_month' => 'Aug.',
        'expected' => 'Monday, Aug. 23, 2015',
      ),
      array(
        'original' => 'Monday, Sep. 23, 2015',
        'found_month' => 'Sep.',
        'ap_month' => 'Sept.',
        'expected' => 'Monday, Sept. 23, 2015',
      ),
      array(
        'original' => 'Monday, September 23, 2015',
        'found_month' => 'September',
        'ap_month' => 'Sept.',
        'expected' => 'Monday, Sept. 23, 2015',
      ),
      array(
        'original' => 'Monday, Oct. 23, 2015',
        'found_month' => 'Oct.',
        'ap_month' => 'Oct.',
        'expected' => 'Monday, Oct. 23, 2015',
      ),
      array(
        'original' => 'Monday, October 23, 2015',
        'found_month' => 'October',
        'ap_month' => 'Oct.',
        'expected' => 'Monday, Oct. 23, 2015',
      ),
      array(
        'original' => 'Monday, Nov. 23, 2015',
        'found_month' => 'Nov.',
        'ap_month' => 'Nov.',
        'expected' => 'Monday, Nov. 23, 2015',
      ),
      array(
        'original' => 'Monday, November 23, 2015',
        'found_month' => 'November',
        'ap_month' => 'Nov.',
        'expected' => 'Monday, Nov. 23, 2015',
      ),
      array(
        'original' => 'Monday, Dec. 23, 2015',
        'found_month' => 'Dec.',
        'ap_month' => 'Dec.',
        'expected' => 'Monday, Dec. 23, 2015',
      ),
      array(
        'original' => 'Monday, December 23, 2015',
        'found_month' => 'December',
        'ap_month' => 'Dec.',
        'expected' => 'Monday, Dec. 23, 2015',
      ),
    );
	}

  public function tearDown() {
    parent::tearDown();
    $this->test_months = null;
    $this->test_dates = null;
	}

  public function test_get_month_position_returns_month_position() {
    $formats_without_month = array(
      '',
      'c',
      'l jS \of F Y h:i:s A',
      'l \t\h\e jS',
      'F j, Y, g:i a',
      'j, n, Y',
      'H:i:s',
    );

    $formats_with_month = array(
      'm',
      'M',
      ' m  ',
      'Y-m-d H:i:s',
      'H:m:s \m \i\s\ \m\o\n\t\h',
      'D M j G:i:s T Y',
      'm.d.y',
      'h-i-s, j-m-y, it is w Day',
      'Ymd',
    );

    foreach ( $formats_with_month as $format ) {
      $pos = elit_has_month_format( $format );
      $this->assertTrue( is_numeric( $pos ) );
      $this->assertTrue( $pos !== False );
    }

    foreach ( $formats_without_month as $format ) {
      $pos = elit_has_month_format( $format );
      $this->assertTrue( empty( $pos ) );
      $this->assertFalse( is_numeric( $pos ) );
      $this->assertTrue( $pos === False );


    }
  }

  public function test_elit_month_info() {
    foreach ( $this->test_dates as $test_date ) {
      $actual = elit_month_info( $test_date['original'] );
      $expected = array(
        'found_month' => $test_date['found_month'],
        'ap_month' => $test_date['ap_month'],
      );
      $this->assertEquals( $expected, $actual );
    }
  }

  public function test_elit_replace_month() {
    foreach ( $this->test_dates as $test_date ) {
      $month_info = array(
        'found_month' => $test_date['found_month'],
        'ap_month' => $test_date['ap_month'],
      );
      $actual = elit_replace_month( $test_date['original'], $month_info );
      $expected = $test_date['expected'];
      $this->assertEquals( $expected, $actual );
    }
  }

} // eoc
