<?php

class BookCreatePageCest
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
    public function addsANewBook(AcceptanceTester $I)
    {
        # Setup
        $I->amOnPage('/test/login-as/1');

        # Act
        $I->amOnPage('/books/create');
        $title = 'Test Book';
        $I->fillField('[test=title-input]', $title);
        $I->fillField('[test=slug-input]', 'test-book');
        $I->selectOption('[test=author-dropdown]', 1);
        $I->fillField('[test=published-year-input]', 2000);
        $I->fillField('[test=cover-url-input]', 'https://hes-bookmark.s3.amazonaws.com/cover-placeholder.png');
        $I->fillField('[test=purchase-url-input]', 'https://www.barnesandnoble.com/test-book');
        $I->fillField('[test=info-url-input]', 'https://en.wikipedia.org/wiki/test-book');
        $I->fillField('[test=description-textarea]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in pulvinar libero. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in pulvinar libero. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.');
        $I->click('[test=submit-button]');

        # Afferm
        $I->see('Your book ' . $title . ' was added');
        $I->amOnPage('/books/test-book');
        $I->see('Test Book');
    }

    /**
     *
     */
    public function showsValidation(AcceptanceTester $I)
    {
        # Setup
        $I->amOnPage('/test/login-as/1');

        # Act
        $I->amOnPage('/books/create');
        $I->click('[test=submit-button]');

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
        $I->amOnPage('/books/create');
        $I->fillField('[test=slug-input]', 'the-great-gatsby');
        $I->click('[test=submit-button]');

        # Assert
        $I->see('The Short URL has already been taken.', '[test=error-field-slug]');
    }
}
