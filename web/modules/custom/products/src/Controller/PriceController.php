<?php

namespace Drupal\products\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\products\Entity\PriceInterface;

/**
 * Class PriceController.
 *
 *  Returns responses for Price routes.
 */
class PriceController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Price  revision.
   *
   * @param int $price_revision
   *   The Price  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($price_revision) {
    $price = $this->entityManager()->getStorage('price')->loadRevision($price_revision);
    $view_builder = $this->entityManager()->getViewBuilder('price');

    return $view_builder->view($price);
  }

  /**
   * Page title callback for a Price  revision.
   *
   * @param int $price_revision
   *   The Price  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($price_revision) {
    $price = $this->entityManager()->getStorage('price')->loadRevision($price_revision);
    return $this->t('Revision of %title from %date', ['%title' => $price->label(), '%date' => format_date($price->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Price .
   *
   * @param \Drupal\products\Entity\PriceInterface $price
   *   A Price  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(PriceInterface $price) {
    $account = $this->currentUser();
    $langcode = $price->language()->getId();
    $langname = $price->language()->getName();
    $languages = $price->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $price_storage = $this->entityManager()->getStorage('price');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $price->label()]) : $this->t('Revisions for %title', ['%title' => $price->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all price revisions") || $account->hasPermission('administer price entities')));
    $delete_permission = (($account->hasPermission("delete all price revisions") || $account->hasPermission('administer price entities')));

    $rows = [];

    $vids = $price_storage->revisionIds($price);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\products\PriceInterface $revision */
      $revision = $price_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $price->getRevisionId()) {
          $link = $this->l($date, new Url('entity.price.revision', ['price' => $price->id(), 'price_revision' => $vid]));
        }
        else {
          $link = $price->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => \Drupal::service('renderer')->renderPlain($username),
              'message' => ['#markup' => $revision->getRevisionLogMessage(), '#allowed_tags' => Xss::getHtmlTagList()],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.price.translation_revert', ['price' => $price->id(), 'price_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.price.revision_revert', ['price' => $price->id(), 'price_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.price.revision_delete', ['price' => $price->id(), 'price_revision' => $vid]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['price_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
