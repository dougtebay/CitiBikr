<?php

use App\Session;

class SessionTest extends PHPUnit_Framework_TestCase
{

  protected $session;

  public function setUp()
  {
    parent::setUp();
    $this->session = new Session();
  }
}
