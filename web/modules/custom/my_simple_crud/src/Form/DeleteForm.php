<?php
namespace Drupal\my_simple_crud\Form;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Url;
use Drupal\my_simple_crud\StorageServiceInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DeleteForm extends ConfirmFormBase {

  private $id;

  /**
   * @var \Drupal\my_simple_crud\StorageServiceInterface
   */
  private $storageService;



  public function __construct(StorageServiceInterface $storageService, MessengerInterface $messenger) {
    $this->storageService = $storageService;
    $this->messenger = $messenger;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('my_simple_crud.storage'),
      $container->get('messenger')
    );
  }

  public function getFormId() {
    return 'delete_form';
  }

  public function getQuestion() {
    $result = $this->storageService->load($this->id);

    return t('Do you want to delete %id?', array('%id' => $result->name));
  }

  public function getCancelUrl() {
    return new Url('my_simple_crud.crud_controller_display');
  }

  public function getCancelText() {
    return $this->t('Cancel');
  }

  public function getConfirmText() {
    return $this->t('Yes');
  }

  public function getDescription() {
    return parent::getDescription();
  }


  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->storageService->delete($this->id);
    $this->messenger->addStatus('Rekord zostal usuniecty');
    return $form_state->setRedirect('my_simple_crud.crud_controller_display');
  }

  public function buildForm(array $form, FormStateInterface $form_state, $id = null) {
    $this->id = $id;
    return parent::buildForm($form,$form_state);
  }


}