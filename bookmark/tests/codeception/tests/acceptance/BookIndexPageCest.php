<?php

class BookIndexPageCest
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
    public function showsBooks(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/books');

        $I->click('[test=book-link-the-great-gatsby]');
        $I->see('The Great Gatsby');
    }

    /**
     *
     */
    public function showsNewBooks(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/books');

        # Assert there are 3 results
        $resultCount = count($I->grabMultiple('[test=new-book-link]'));
        $I->assertEquals(3, $resultCount);
    }
}
