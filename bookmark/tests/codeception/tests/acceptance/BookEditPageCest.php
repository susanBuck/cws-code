<?php

class BookEditPageCest
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
    public function editsBook(AcceptanceTester $I)
    {
        $I->amOnPage('/test/login-as/1');

        $I->amOnPage('/books/the-great-gatsby/edit');
        $I->fillField('[test=title-input]', 'Some new title...');
        $I->click('[test=update-book-button]');
        $I->see('Some new title...');
    }

    /**
     *
     */
    public function showsValidation(AcceptanceTester $I)
    {
        # Setup
        $I->amOnPage('/test/login-as/1');

        # Act
        $I->amOnPage('/books/the-great-gatsby/edit');
        $I->fillField('[test=title-input]', '');
        $I->click('[test=update-book-button]');

        # Assert we see global error feedback
        $I->seeElement('[test=global-error-feedback]');

        # Assert we see at least one field valdiation
        $I->seeElement('[test=error-field-title]');
    }

    /**
     *
     */
    public function preventsDuplicateSlugs(AcceptanceTester $I)
    {
        # Setup
        $I->amOnPage('/test/login-as/1');

        # Act
        $I->amOnPage('/books/the-great-gatsby/edit');
        $I->fillField('[test=slug-input]', 'the-bell-jar');
        $I->click('[test=update-book-button]');

        # Assert
        $I->see('The Short URL has already been taken.', '[test=error-field-slug]');
    }
}
