<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Repositories\ContactRepository;
use App\Http\Requests\ContactListRequest;
use App\Interfaces\ContactRepositoryInterface;

class ContactController extends Controller
{
    /**
     * Cache the ContactRepository instance
     *
     * @var App\Repositories\ContactRepository $contactRepository
     * @return null
     */
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        return response()->json(
            [
                'data' => $this->contactRepository->getAllContacts()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactListRequest $request): JsonResponse
    {
        $validatedContactDetails = $request->validated();

        return response()->json(
            [
                'data' => $this->contactRepository->createContact($validatedContactDetails)
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $contactId): JsonResponse
    {
        if (is_numeric($contactId)) {
            return response()->json(
                [
                    'data' => $this->contactRepository->getContactById($contactId)
                ]
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ContactListRequest $request, $contactId): JsonResponse
    {
        if (is_numeric($contactId)) {
            $validatedContactDetails = $request->validated();

            return response()->json(
                [
                    'data' => $this->contactRepository->updateContactById($contactId, $validatedContactDetails)
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request): JsonResponse
    {
        $contactId = $request->route('id');

        if (is_numeric($contactId)) {
            $this->contactRepository->deleteContactById($contactId);

            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
    }
}
