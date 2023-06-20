<?php

namespace App\Repository;

use App\Entity\Booking;
use App\Entity\Category;
use App\Entity\Voiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr;

/**
 * @extends ServiceEntityRepository<Voiture>
 *
 * @method Voiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voiture[]    findAll()
 * @method Voiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voiture::class);
    }

    public function add(Voiture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Voiture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Voiture[] Returns an array of Voiture objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Voiture
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


 /**

     * @param Category $category
 */
    public function findvoitbycat(Category $category)
    {
      //version QueryBuilder
        $queryBuilder=$this->createQueryBuilder('v');
        $queryBuilder->andWhere('v.category=:category')->andWhere('v.disponibility = 1');
        $queryBuilder->setParameter('category',$category);
        $query=$queryBuilder->getQuery();
        $result=$query->getResult();
        return $result;


    }

    /**
     *
     * recuperer les voitures en lien avec une recherche
     * @param  $D
     * @param $F
     * @return Voiture[]
     */
    public function findSearch($D,$F)
    {



        $qB=$this->createQueryBuilder('v')

            ->leftJoin(Booking::class,'booking',Expr\Join::WITH,'booking.voiture=v.id')
            ->andWhere('(booking.dateDebut <=:D  AND  booking.dateFin>=:D)
            or (booking.dateDebut<=:F AND booking.dateFin>=:F) ')
            ->orWhere('(booking.dateDebut >=:D  AND  booking.dateDebut<=:F)
            or (booking.dateFin >=:D  AND  booking.dateFin<=:F) ')

            ->setParameter('D',$D->format('y-m-d'))
            ->setParameter('F',$F->format('y-m-d'))
            ->andWhere('v.disponibility=1')
            ->distinct();


        return $qB->getQuery()->getResult();

    }

    /**
     * @param array $cars
     * @return Voiture[]
     *
     */
    public function findvoituresdispo( array $cars,$cat,$min,$max){

        $qb = $this->createQueryBuilder('v');
        $qb->add('where', $qb->expr()->notIN('v.id', ':value'))
            ->setParameter('value',$cars)
            ->andWhere('v.disponibility = 1');
        if($cat) {
            $qb->leftJoin('v.category', 'c')
                ->andWhere('c.id=:id')
                ->setParameter('id',$cat);
        }
        if($max){

            $qb=$qb
                ->andWhere('v.prix <= :max*100')
                ->setParameter('max', $max);
        }
        if($min){

            $qb=$qb
                ->andWhere('v.prix >= :min*100')
                ->setParameter('min', $min);
        }


        return $qb->getQuery()->getResult();
    }

    public function findvoitbycat2($cat,$min,$max)
    {$qB = $this->createQueryBuilder('c');
        $qB->andWhere('c.disponibility = 1');
        if($cat) {


            $qB->Join('c.category', 'v')
                ->andWhere('c.category=:id')
                ->setParameter('id', $cat);

        }
        if($max){

            $qB=$qB
                ->andWhere('c.prix <= :max*100')
                ->setParameter('max', $max);
        }
        if($min){

            $qB=$qB
                ->andWhere('c.prix >= :min*100')
                ->setParameter('min', $min);
        }
        return $qB->getQuery()->getResult();


    }
  //  public function searchvoinonreserver(){
    //    $qbn=$this->createQueryBuilder('v')
           // ->leftJoin(Booking::class,'booking',Expr\Join::WITH,'booking.voiture=v.id')
          //  ->andWhere(' booking.voiture IS  NULL');


       // return $qbn->getQuery()->getResult();
   // }

    /**
     * @return int
     *
     */
    public function countvoiture(){
        $querybuilder=$this->createQueryBuilder('v');
        $querybuilder  ->select('COUNT(v.id) as value');
        return $querybuilder->getQuery()->getOneOrNullResult();
    }

}
