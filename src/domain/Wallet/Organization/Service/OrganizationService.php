<?php


namespace Wallet\Wallet\Organization\Service;


use Wallet\Wallet\Organization\Entity\OrganizationEntityInterface;
use Wallet\Wallet\Organization\Repository\OrganizationRepositoryInterface;

class OrganizationService implements OrganizationServiceInterface
{

    /**
     * @var OrganizationRepositoryInterface
     */
    private $organizationRepository;

    /**
     * OrganizationService constructor.
     * @param OrganizationRepositoryInterface $organizationRepository
     */
    public function __construct(
        OrganizationRepositoryInterface $organizationRepository
    )
    {
        $this->organizationRepository = $organizationRepository;
    }


    /**
     * @inheritDoc
     */
    public function fromClientIdentifier(string $clientId): OrganizationEntityInterface
    {
        return $this
            ->organizationRepository
            ->fromClientIdentifier(
                $clientId
            );
    }
}
