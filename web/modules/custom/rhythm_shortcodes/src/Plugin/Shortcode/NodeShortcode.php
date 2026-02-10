<?php

namespace Drupal\rhythm_shortcodes\Plugin\Shortcode;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Language\Language;
use Drupal\Core\Link;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Url;
use Drupal\node\Entity\Node;
use Drupal\shortcode\Plugin\ShortcodeBase;

/**
 * @Shortcode(
 *   id = "nd_node",
 *   title = @Translation("Node"),
 *   description = @Translation("Render node."),
 *   process_backend_callback = "nd_visualshortcodes_backend_nochilds",
 *   icon = "fa fa-file-o",
 * )
 */
class NodeShortcode extends ShortcodeBase implements ContainerFactoryPluginInterface {

  /**
   * The entity type manager service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $etm;

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager, RendererInterface $renderer) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $renderer);
    $this->etm = $entity_type_manager;
    $this->renderer = $renderer;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager'),
      $container->get('renderer'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function process(array $attrs, $text, $langcode = Language::LANGCODE_NOT_SPECIFIED) {
    $text = '';

    if (isset($attrs['admin_url']) && strpos($attrs['admin_url'], 'node/') !== FALSE) {
      $node_name = substr($attrs['admin_url'], strpos($attrs['admin_url'], 'node/') + 5);
      $parts = explode('/', $node_name);
      $node = Node::load($parts[0]);

      if (isset($node->nid) && $node->nid) {
        $build = $this->etm->getViewBuilder('node')->view($node);
        $output = $this->renderer->render($build);
        $attrs = _rhythm_shortcodes_shortcode_attributes($attrs);
        $text = $attrs ? "<div $attrs>$output</div>" : $output;
      }
    }

    return $text;
  }

  /**
   * {@inheritdoc}
   */
  public function settings(array $attrs, $text, $langcode = Language::LANGCODE_NOT_SPECIFIED) {
    $form = [];
    $form['admin_url'] = [
      '#title' => t('Node Title'),
      '#type' => 'textfield',
      '#autocomplete_route_name' => 'rhythm_shortcodes.ajax_node_autocomplete',
      '#default_value' => isset($attrs['admin_url']) ? $attrs['admin_url'] : '',
      '#attributes' => [
        'class' => ['form-control'],
      ],
    ];

    return $form;
  }
}
