<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Session;
use App\User;

class SessionTest extends TestCase
{

  use DatabaseMigrations;

  protected $session;

  public function setUp()
  {
    parent::setUp();
    $user = factory(App\User::class)->make();
    $user->save();
    $this->user = $user;
    Auth::login($user);
    $this->session = new Session();
    $this->session->user_id = Auth::user()->id;
    $this->session->session_id = \Session::getId();
  }

  public function testReturnsSessionId()
  {
    $sessionId1 = \Session::getId();
    $sessionId2 = $this->session->sessionId();
    $this->assertEquals($sessionId1, $sessionId2);
  }

  public function testReturnsUserId()
  {
    $userId1 = Auth::user()->id;
    $userId2 = $this->session->userId();
    $this->assertEquals($userId1, $userId2);
  }

  public function testSessionPersisted()
  {
    $sessionCount1 = count(Session::where('session_id', $this->session->session_id)->get());
    $this->session->persistSession();
    $sessionCount2 = count(Session::where('session_id', $this->session->session_id)->get());
    $this->assertEquals(0, $sessionCount1);
    $this->assertEquals(1, $sessionCount2);
  }

  public function testIdentifiesWhetherUserHasMultipleSessions()
  {
    $this->session->persistSession();
    $result1 = $this->session->userHasMultipleSessions() ? 'true' : 'false';
    $this->assertEquals('false', $result1);
    $session1 = Session::find(1);
    $session1->created_at = 0;
    $session1->save();
    $newSession = new Session;
    $newSession->user_id = Auth::user()->id;
    $newSession->session_id = '3592e35eda9ce48bb853e278326521a60f3f8bf1';
    $newSession->save();
    $result2 = $this->session->newestSessionByUser() ? 'true' : 'false';
    $this->assertEquals('true', $result2);
  }

  public function testReturnsCurrentSession()
  {
    $this->session->persistSession();
    $session = $this->session->thisSession();
    $this->assertEquals($session->session_id, $this->session->session_id);
  }

  public function testReturnsNewSessionCreatedAfterCurrentSession()
  {
    $this->session->persistSession();
    $result1 = $this->session->newestSessionByUser() ? 'true' : 'false';
    $this->assertEquals('false', $result1);
    $session1 = Session::find(1);
    $session1->created_at = 0;
    $session1->save();
    $newSession = new Session;
    $newSession->user_id = Auth::user()->id;
    $newSession->session_id = '3592e35eda9ce48bb853e278326521a60f3f8bf1';
    $newSession->save();
    $result2 = $this->session->newestSessionByUser() ? 'true' : 'false';
    $this->assertEquals('true', $result2);
  }
}
