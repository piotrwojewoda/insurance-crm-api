<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 05.01.19
 * Time: 15:22
 */

namespace App\Serializer;


use ApiPlatform\Core\Exception\RuntimeException;
use ApiPlatform\Core\Serializer\SerializerContextBuilderInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class UserContextBuilder implements SerializerContextBuilderInterface
{

    /**
     * @var SerializerContextBuilderInterface
     */
    private $decorated;
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    public function __construct(
        SerializerContextBuilderInterface $decorated,
        AuthorizationCheckerInterface $authorizationChecker
    )
    {
        $this->decorated = $decorated;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * Creates a serialization context from a Request.
     *
     * @param Request $request
     * @param bool $normalization
     * @param array|null $extractedAttributes
     * @return array
     */
    public function createFromRequest(Request $request, bool $normalization, array $extractedAttributes = null): array
    {
        $context = $this->decorated->createFromRequest($request, $normalization, $extractedAttributes);

        $resourceClass = $context['resource_class'] ?? null;

        if (
            User::class === $resourceClass &&
            isset($context['groups']) &&
            $normalization === true &&
            $this->authorizationChecker->isGranted(User::ROLE_ADMIN)
        ) {
            $context['groups'][] = 'get-admin';
        }

        return $context;
    }
}
