<?php
    session_start();

    include '../autoload.php';

    use services\ConfigService;
    use services\DbService;
    use repositories\UserRepository;
    use repositories\ProductRepository;
    use repositories\ColorRepository;
    use repositories\BasketRepository;
    use services\HelperService;
    use container\Container;
    use services\ORMService;
    use constants\Constants;

    /** @var ConfigService $configService */
    $configService = new ConfigService();
    /** @var HelperService $helperService */
    $helperService = new HelperService();
    /** @var $container Container */
    $container = new Container();

    /** @var DbService $dbService */
    $dbService = new DbService($configService, $helperService);
    /** @var UserRepository $userRepository */
    $userRepository = new UserRepository($dbService, $helperService);
    /** @var $ormService ORMService */
    $ormService = new ORMService();
    /** @var $colorRepository ColorRepository */
    $colorRepository = new ColorRepository($dbService, $helperService, $ormService);
    /** @var $productRepository ProductRepository */
    $productRepository  = new ProductRepository($dbService, $helperService, $ormService, $colorRepository->getColors());
    /** @var  $basketRepository BasketRepository */
    $basketRepository = new BasketRepository($productRepository);

    $container->addService(Constants::CONFIG_SERVICE, $configService);
    $container->addService(Constants::HELPER_SERVICE, $helperService);
    $container->addService(Constants::DB_SERVICE, $dbService);
    $container->addService(Constants::USER_REPOSITORY_SERVICE, $userRepository);
    $container->addService(Constants::PRODUCT_REPOSITORY_SERVICE, $productRepository);
    $container->addService(Constants::ORM_SERVICE, $ormService);
    $container->addService(Constants::BASKET_REPOSITORY_SERVICE, $basketRepository);

    include '../router.php';