<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 20/11/2018
 * Time: 19:34
 */

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\node\Entity\Node;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Entity\Query\QueryFactory;
class QueryController extends ControllerBase {

  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * deprecated
   * @var \Drupal\Core\Entity\Query\QueryFactory
   */
  protected $queryFactory;

  /**
   * Constructs a new OpController object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   * @param \Drupal\Core\Entity\Query\QueryFactory $queryFactory
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager,
                              QueryFactory $queryFactory) {

    $this->entityTypeManager = $entityTypeManager;
    $this->queryFactory = $queryFactory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('entity.query')
    );
  }

  public function list()
  {
    // Query with entity_type.manager (The way to go)
    $query = $this->entityTypeManager->getStorage('node');
    $query_result = $query->getQuery()
      ->condition('status', 1)
      ->condition('type', 'page')
      ->execute();
    //dump($query_result);

    // Query 2 with entity.query (deprecated)
    $query2 = $this->queryFactory->get('node')
      ->condition('status', 1)
      ->condition('type', 'page')
      ->execute();
    //dump($query2);

    /**
     * @var $entityNode \Drupal\node\NodeInterface
     */
    $entityNode = $query->load(1);

    $entityNodes = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple([1]);
    //dump($entityNode->getTitle());
    //dump($entityNodes);

    $query3 = $this->entityTypeManager->getStorage('node')->loadByProperties(['type' => 'page']);

    //dump($query3);


    /** @var NodeType $type */
    $type = \Drupal::entityTypeManager()->getStorage('node_type')->load('article');

    $description = $type->getDescription();

    $description = $type->get('description');

    //dump($entityNode->getEntityType());
    dump($entityNode->getTitle());

    $node = Node::load(1);
    $title = $node->get('title');
    $value = $title->value;
    $titleDefinition = $title->getFieldDefinition();
    dump($value);
    //getEntityTypeId()
    //getEntityType()
    //getTypedData()
    $total = $title->count();
    $empty = $title->isEmpty();
    $exists = $title->offsetExists(1);
    $item = $title->get(0);
    $item2 = $title->offsetGet(0);

    $id = $titleDefinition->target_id;
    $data = $item->get('value');
    $value = $data->getValue();

    dump($value);

    $title = $node->get('title')->value;
    //$id = $node->get('field_referencing_some_entity')->target_id;
    //$entity = $node->get('field_referencing_some_entity')->entity;

    //$names = $node->get('field_names')->getValue();
    //$tags = $node->get('field_tags')->referencedEntities();
    dump($title);
    dump($id);
    //dump($entity);



    //update entity
    $node = Node::load(1);
    $node->set('title','MOj zmieniony tytul');
    $node->save();

    /** @var NodeType $type */
    $type = \Drupal::entityTypeManager()->getStorage('node_type')->load('article');
    $type->set('name', 'News');
    $type->save();
      //or
    //\Drupal::entityTypeManager()->getStorage('node')->save($node);

    //$node->get('title')->setValue('new title');
    dump($node->getTitle());
    //$values = $node->get('field_multiple')->getValue();
    //$values[] = ['value' => 'extra value'];
    //$node->set('field_multiple', $values);

    /**
     * Creating entity
     */
    $values = [
      'type' => 'article',
      'title' => 'My title'
    ];
    /** @var NodeInterface $node */
    $node = \Drupal::entityTypeManager()->getStorage('node')->create($values);
    $node->set('field_custom', 'some text');
    $node->save();


    /**
     * \Rendering content entities
     */

    if ($entityNode->getEntityTypeId()=='node') {
      echo 'tak to jest node';
    }

    dump($node); die();
    /** @var \Drupal\node\NodeViewBuilder $builder */
    $builder = \Drupal::entityTypeManager()->getViewBuilder('node');
    $build = $builder->view($node);

    die();



  }

  public function display()
  {
    $node = Node::load(1);
    $nodes = $this->entityTypeManager->getStorage('node')->loadByProperties(['type' => 'page']);
    $builder = $this->entityTypeManager->getViewBuilder('node');
    $build = $builder->view($node);
    //or render multiple
    //$builds = $builder->viewMultiple($nodes);
    $build['#theme'] = $build['#theme'] . '__my_suggestion';

    //dump($builds); die();


    //validacja

    $definition = DataDefinition::create('string');
    $definition->addConstraint('Length', ['max' => 20]);
    /** @var TypedDataInterface $data */
    $data = \Drupal::typedDataManager()->create($definition, 'my value that is too long');
    $violations = $data->validate();
    /** @var ConstraintViolationInterface $violation */
    foreach ($violations as $violation) {
      $message = $violation->getMessage();
      $value = $violation->getInvalidValue();
      $path = $violation->getPropertyPath();
    }
    echo $value; die();

    return $build;

  }
}