<?php

class BookShowPageCest
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
    public function showsBook(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');

        $I->amOnPage('/books/the-great-gatsby');
        $I->see('The Great Gatsby');
    }

    /**
     *
     */
    public function deletesBook(AcceptanceTester $I)
    {
        # Setup
        $slug = 'the-great-gatsby';
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/books/'.$slug);

        # Act
        $I->click('[test=delete-button]');
        $I->click('[test=confirm-delete-button]');

        # Assert
        $I->dontSeeElement('[test=book-link-' . $slug . ']');
    }

    /**
     *
     */
    public function bookNotFound(AcceptanceTester $I)
    {
        # Act
        $I->amOnPage('/test/login-as/1');
        $I->amOnPage('/books/slug-does-not-exist');

        # Assert
        $I->see('Book not found.');
        $I->seeElement('[test=all-books-heading]');
    }
}
