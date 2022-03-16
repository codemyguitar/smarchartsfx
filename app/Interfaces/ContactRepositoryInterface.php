<?php

namespace App\Interfaces;

interface ContactRepositoryInterface
{
    public function getAllContacts();
    public function getContactById($contactId);
    public function deleteContactById($contactId);
    public function createContact(array $contactDetails);
    public function updateContactById($contactId, array $newContactDetails);
}