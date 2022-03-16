<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Profile;
use App\Interfaces\ContactRepositoryInterface;

class ContactRepository implements ContactRepositoryInterface
{
    /**
     * Get the list of all contacts
     *
     * @return Illuminate\Support\Collection
     */
    public function getAllContacts()
    {
        $userProfile = User::with('profile')->get();

        return $userProfile->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'address' => $user->profile->address,
                'phone' => $user->profile->phone,
                'fb_username' => $user->profile->fb_username
            ];
        });
    }

    /**
     * Get information of a contact
     *
     * @var String $contactId
     * @return Illuminate\Support\Collection
     */
    public function getContactById($contactId)
    {
        $user = User::findOrFail($contactId);

        return collect([
            'id' => $user->id,
            'name' => $user->name,
            'address' => $user->profile->address,
            'phone' => $user->profile->phone,
            'fb_username' => $user->profile->fb_username
        ]);
    }

    /**
     * Delete a contact
     *
     * @var String $contactId
     * @return null
     */
    public function deleteContactById($contactId)
    {
        User::destroy($contactId);
    }

    /**
     * Create a new contacct
     *
     * @var array $contactDetails
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function createContact(array $contactDetails)
    {
        $user = User::create([
            'name' => $contactDetails['name']
        ]);
        $profile = new Profile;
        $profile->address = $contactDetails['address'];
        $profile->phone = $contactDetails['phone'];
        $profile->fb_username = $contactDetails['fb_username'];

        $user->profile()->save($profile);

        return $user;
    }

    /**
     * Update a contact
     *
     * @var String $contactId
     * @var array $newContactDetails
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function updateContactById($contactId, array $newContactDetails)
    {
        $user = User::with('profile')->findOrFail($contactId);

        $user->update([
            'name' => $newContactDetails['name']
        ]);

        $user->profile->update([
            'address' => $newContactDetails['address'],
            'phone' => $newContactDetails['phone'],
            'fb_username' => $newContactDetails['fb_username']
        ]);

        return $user;
    }
}