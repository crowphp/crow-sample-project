<?php
declare(strict_types=1);

namespace App\Benchmark\Infrastructure\Users;


use RuntimeException;
use Swoole\Database\PDOPool;
use App\Benchmark\Domain\Users\User;
use App\Benchmark\Domain\Users\UserRepository;
use App\Benchmark\Domain\Users\ValueObjects\Email;
use App\Benchmark\Domain\Users\ValueObjects\Name;
use App\Benchmark\Domain\Users\ValueObjects\UserId;
use App\Benchmark\Infrastructure\Database\PdoConnectionPool;
use App\Benchmark\Domain\Users\UsersCollection;

class UserRepositoryPDO implements UserRepository
{
    private PDOPool $pool;

    public function __construct(private PdoConnectionPool $connectionPool)
    {
        $this->pool = $this->connectionPool->getPool();
    }

    public function getUsers(): UsersCollection
    {
        $pdo = $this->pool->get();
        $statement = $pdo->prepare('SELECT * from Users limit 100');
        if (!$statement) {
            throw new RuntimeException('Prepare failed');
        }

        $result = $statement->execute();
        if (!$result) {
            throw new RuntimeException('Execute failed');
        }
        $result = $statement->fetchAll();

        $this->pool->put($pdo);

        return new UsersCollection(array_map(
            function ($item) {
                return new User(
                    new UserId((int)$item[UserId::USERID_LABEL]),
                    new Name($item[Name::FIRSTNAME_LABEL], $item[NAME::LASTNAME_LABEL]),
                    new Email($item[Email::EMAIL_LABEL])
                );
            },
            $result
        ));

    }
}