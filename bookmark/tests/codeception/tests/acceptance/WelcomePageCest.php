<?php

class WelcomePageCest
{
    /**
     *
     */
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/test/refresh-database');
    }
    
    /**
     *
     */
    public function searchYieldsResults(AcceptanceTester $I)
    {
        # Setup
        $I->amOnPage('/test/login-as/1');

        # Act
        $I->amOnPage('/');
        $I->fillField('[test=search-input]', 'Harry Potter');
        $I->click('[test=search-button]');

        # Assert
        $I->see('Harry Potter and the Philosopher’s Stone');
        $resultCount = count($I->grabMultiple('[test=search-result-link]'));
        $I->assertEquals(3, $resultCount);
    }
}
