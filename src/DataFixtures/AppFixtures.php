<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Client;
use App\Entity\Company;
use App\Entity\InsuranceCategory;
use App\Entity\InsurancePeriodInTheCompany;
use App\Entity\InsuranceType;
use App\Entity\InsuranceValue;
use App\Entity\Policy;
use App\Entity\User;
use App\Security\TokenGenerator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $faker;
    private const CATEGORIES = ['BASIC', 'SILVER', 'GOLD', 'PREMIUM'];
    private const TYPES = ['ADULT', 'SINGLE', 'FAMILY'];

    private const USERS = [
        [
            'username' => 'admin',
            'email' => 'piotr.wojewoda.php@gmail.com',
            'name' => 'Administrator',
            'password' => 'Admin123!@#',
            'roles' => [User::ROLE_SUPERADMIN],
            'enabled' => true
        ],
        [
            'username' => 'user',
            'email' => 'piotr.wojewoda.js@gmail.com',
            'name' => 'User',
            'password' => 'User123!@#',
            'roles' => [User::ROLE_USER],
            'enabled' => true
        ],
    ];

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    /**
     * @var TokenGenerator
     */
    private $tokenGenerator;


    public function loadUsers(ObjectManager $manager)
    {
        foreach (self::USERS as $key => $userElement){

            $user = new User();
            $user->setUsername($userElement['username']);
            $user->setEmail($userElement['email']);
            $user->setName($userElement['name']);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $userElement['password']));
            $user->setRoles($userElement['roles']);
            $user->setEnabled($userElement['enabled']);

            $this->addReference('user_' . $key, $user);
            $manager->persist($user);
        }
        $manager->flush();
    }



    public function __construct(UserPasswordEncoderInterface $passwordEncoder,TokenGenerator $tokenGenerator)
    {
        $this->faker = \Faker\Factory::create('pl_PL');
        $this->passwordEncoder = $passwordEncoder;
        $this->tokenGenerator = $tokenGenerator;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadCities($manager);
        $this->loadCompanies($manager);
        $this->loadClients($manager);
        $this->loadPolicies($manager);
        $this->loadInsuranceCategories($manager);
        $this->loadInsuranceTypes($manager);
        $this->loadValues($manager);
        $this->loadClientCompanyRelation($manager);
    }

    public function loadCities(ObjectManager $objectManager)
    {
        for ($i = 0; $i < 250; $i++) {
            $city = new City();
            $city->setName($this->faker->unique()->city);
            $objectManager->persist($city);
            $this->setReference("city_$i", $city);
        }
        $objectManager->flush();
    }

    public function loadCompanies(ObjectManager $objectManager)
    {

        for ($i = 0; $i < 1000; $i++) {
            $company = new Company();
            $company->setName($this->faker->unique()->company);
            $company->setEmail($this->faker->unique()->email);
            $company->setAddress($this->faker->streetAddress);
            $company->setCity($this->getReference("city_" . rand(0, 249)));
            $company->setDescription($this->faker->realText());
            $company->setLongName($this->faker->company . " " . $this->faker->company . " " . $this->faker->company);
            $company->setPhone($this->faker->unique()->phoneNumber);
            $company->setRegon($this->faker->unique()->regon);
            $company->setLatLen(['lat' => $this->faker->latitude, 'len' => $this->faker->longitude]);

            $objectManager->persist($company);
            $this->setReference("company_$i", $company);
        }
        $objectManager->flush();
    }

    public function loadClients(ObjectManager $objectManager)
    {
        for ($i = 0; $i < 5000; $i++) {
            $client = new Client();
            $client->setEmail($this->faker->unique()->email);
            $client->setBirthdate($this->faker->dateTimeBetween('-40 years', 'now'));
            $client->setFirstname($this->faker->firstName);
            $client->setLastname($this->faker->lastName);
            $client->setForeigner(false);
            $client->setIdnumber($this->faker->pesel);
            $client->setSex(rand(0, 1));

            $objectManager->persist($client);
            $this->setReference("client_$i", $client);
        }
        $objectManager->flush();
    }

    public function loadClientCompanyRelation(ObjectManager $objectManager)
    {
        $policyCounter = 1;
        $policyNumber = 0;
        for ($i = 0; $i < 5000; $i++) {
            $insurancePeriodInTheCompany = new InsurancePeriodInTheCompany();
            $insurancePeriodInTheCompany->setClient($this->getReference("client_$i"));
            $insurancePeriodInTheCompany->setCompany($this->getReference("company_" . $policyNumber));
            $insurancePeriodInTheCompany->setStartdate($this->faker->dateTimeBetween('-2 years', 'now'));
            $insurancePeriodInTheCompany->setEnddate($this->faker->dateTimeBetween('now', '+2 years'));
            $insurancePeriodInTheCompany->setPolicy($this->getReference("policy_$policyNumber"));
            $insurancePeriodInTheCompany->setValue($this->getReference("value_".rand(0,11)));
            if ($policyCounter > 4) {
                $policyNumber++;
                $policyCounter = 0;
            }
            $policyCounter++;
            $objectManager->persist($insurancePeriodInTheCompany);
        }
        $objectManager->flush();
    }

    public function loadPolicies(ObjectManager $objectManager)
    {
        $codes = ['RNB', 'FN', 'KB'];
        $period = ['month','quarter','year'];
        for ($i = 0; $i < 1000; $i++) {
            $policy = new Policy();

            $policy->setAuthor( $this->getReference("user_".rand(0,1)  ));
            $policy->setPublished($this->faker->dateTimeBetween('-2 years', 'now'));
            $policy->setStartdate($this->faker->dateTimeBetween('-2 years', 'now'));
            $policy->setEnddate($this->faker->dateTimeBetween('now', '+2 years'));
            $policy->setCode($codes[rand(0, 2)] . $this->faker->unique()->numberBetween(100000, 999999));
            $policy->setPeriod($period[rand(0,2)]);
            $objectManager->persist($policy);
            $this->setReference("policy_$i", $policy);
        }
        $objectManager->flush();
    }

    public function loadInsuranceCategories(ObjectManager $objectManager)
    {
        $categoryCounter = 0;
        foreach (self::CATEGORIES as $categoryValue) {
            $category = new InsuranceCategory();
            $category->setName($categoryValue);
            $objectManager->persist($category);
            $this->setReference("insuranceCategory_$categoryCounter", $category);
            $categoryCounter++;
        }
        $objectManager->flush();
    }

    public function loadInsuranceTypes(ObjectManager $objectManager)
    {
        $typeCounter = 0;
        foreach (self::TYPES as $typeValue) {
            $type = new InsuranceType();
            $type->setName($typeValue);
            $objectManager->persist($type);
            $this->setReference("type_$typeCounter", $type);
            $typeCounter++;
        }
        $objectManager->flush();
    }

    public function loadValues(ObjectManager $objectManager)
    {
        $counter = 0;
        foreach (self::CATEGORIES as $categoryKey => $category) {
            foreach (self::TYPES as $typeKey => $type) {
                $value = new InsuranceValue();
                $value->setValue($this->faker->unique()->numberBetween(10, 500));
                $value->setInsuranceCategory($this->getReference("insuranceCategory_$categoryKey"));
                $value->setInsuranceType($this->getReference("type_$typeKey"));
                $objectManager->persist($value);
                $this->setReference("value_$counter", $value);
                $counter++;
            }
        }
        $objectManager->flush();
    }


}
