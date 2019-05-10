<?php

namespace App\Controller\Dashboard;

use App\Entity\UserSettings;
use App\Services\Dashboard\ValidationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardUserSettingsController extends AbstractController
{

    /**
     * @Route("/dashboard/user/settings", name="dashboard-user-settings-post", methods={"POST"})
     */
    public function userDataPost(Request $request, ValidationService $validationService)
    {

        $requestData = $request->getContent();
        $requestBody = json_decode($requestData, true);

        $response = 'response';

        if ($requestBody['form_submitted'] && $this->isCsrfTokenValid('dashboard', $requestBody['csrf'])) {
            $response = $validationService->validatePayload($requestData, UserSettings::class, 'json');
        }

        return new JsonResponse($response);
    }


    /**
     * @Route("/dashboard/user/settings", name="dashboard-user-settings-get", methods={"GET"})
     */
    public function userGetData(){
        return new JsonResponse('true');
    }

}
