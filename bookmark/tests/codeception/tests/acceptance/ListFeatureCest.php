<?php

class ListFeatureCest
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
    public function removeBookFromListFromBookPage(AcceptanceTester $I)
    {
        # Setup
        $slug = 'the-great-gatsby';
        $I->amOnPage('/test/login-as/2');

        # Act
        $I->amOnPage('/books/'.$slug);
        $I->click('[test=' . $slug . '-remove-from-list-button]');

        # Assert
        $I->seeElement('[test=add-to-list-button]');
    }
    
    /**
     *
     */
    public function showsEmptyList(AcceptanceTester $I)
    {
        # Setup
        $I->amOnPage('/test/login-as/1');

        # Act
        $I->amOnPage('/list');
        $I->seeElement('[test=no-books-message]');
    }

    /**
     *
     */
    public function addsBookToList(AcceptanceTester $I)
    {
        # Setup
        $note = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
        $slug = 'the-great-gatsby';

        $I->amOnPage('/test/login-as/1');

        # Act
        $I->amOnPage('/books/'.$slug);
        $I->click('[test=add-to-list-button]');
        $I->fillField('[test=notes-textarea]', $note);
        $I->click('[test=add-to-list-button]');

        # Assert
        $I->see($note, '[test=' . $slug . '-notes-textarea]');
    }

    /**
     *
     */
    public function removesBookFromList(AcceptanceTester $I)
    {
        # Setup
        $slug = 'the-great-gatsby';

        # Logging in as Jill who has the-great-gatsby on list to start
        $I->amOnPage('/test/login-as/2');

        # Act
        $I->amOnPage('/books/'.$slug);
        $I->click('[test=' . $slug . '-remove-from-list-button]');

        # Assert
        $I->see('The book The Great Gatsby was removed from your list');
        $I->dontSeeElement('[test=' . $slug . '-remove-from-list-button]');
        $I->seeElement('[test=add-to-list-button]');
    }

    /**
     *
     */
    public function updateBookOnList(AcceptanceTester $I)
    {
        # Setup
        $slug = 'the-great-gatsby';
        $newNote = 'Some new note...';

        # Logging in as Jill who has the-great-gatsby on list to start
        $I->amOnPage('/test/login-as/2');
        
        # Act
        $I->amOnPage('/list');
        $I->fillField('[test="the-great-gatsby-notes-textarea"]', $newNote);
        $I->click('[test="the-great-gatsby-update-button"]');

        # Assert
        $I->see('Your note for The Great Gatsby was updated.');
        $I->see($newNote, '[test="the-great-gatsby-notes-textarea"]');
    }
}
