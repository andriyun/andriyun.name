<?php

class TestCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $prefix = date('Y-m-d_H-i-s', strtotime('now')) . '_';
        $I->amOnPage('/');
        $I->see('Drush Site-Install');
        $I->makeScreenshot($prefix . 'front-page');
        $I->amOnPage('/user/login');
        $I->see('Log in');
        $I->submitForm('#user-login-form', [
            'name' => 'admin',
            'pass' => 'admin'
        ]);
        $I->see('Log out');
        $I->see('admin');
        $I->see('Member for');
        $I->makeScreenshot($prefix . 'user-page');

        $I->amOnPage('/node/add/article');
        $title = 'First node title';
        $I->fillField('title[0][value]', $title);
        $I->makeScreenshot($prefix . 'article-node-form');
        $I->click('Save');
        $I->see($title);
        $I->makeScreenshot($prefix . 'article-node-page');
    }
}
