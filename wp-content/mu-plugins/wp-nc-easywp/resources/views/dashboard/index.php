<!--
 |
 | In $plugin you'll find an instance of Plugin class.
 | If you'd like can pass variable to this view, for example:
 |
 | return PluginClassName()->view( 'dashboard.index', [ 'var' => 'value' ] );
 |
-->

<div class="wpnceasywp wrap">
  <h1><?php echo $plugin->Name ?> ver.<?php echo $plugin->Version ?></h1>
  <h2>
    PHP ver.<?php echo phpversion() ?>
  </h2>

  <?php if (!empty($plugins)) : ?>

    <h2><?php _e('General information...', 'wp-nc-easywp') ?></h2>

    <h4><?php _e('Warning', 'wp-nc-easywp') ?></h4>

    <p>
      <?php echo _n('The following plugin will be disabled.', 'The following plugins will be disabled.', count($plugins), 'wp-nc-easywp') ?>
    </p>

    <ul>

      <?php foreach ($plugins as $file => $value) : ?>
        <li>
          <?php printf(__('%s will be disabled because: %s', 'wp-nc-easywp'), $value['data']['Name'], $value['info']['description']); ?>
        </li>
      <?php endforeach; ?>

    </ul>

    <hr />

  <?php endif; ?>

  <h2>Paths</h2>

  <p>__FILE__: <code><?php echo __FILE__ ?></code></p>
  <p>__DIR__: <code><?php echo __DIR__ ?></code></p>
  <p>ABSPATH: <code><?php echo ABSPATH ?></code></p>
  <p>WP_CONTENT_DIR: <code><?php echo WP_CONTENT_DIR ?></code></p>
  <p>WP_CONTENT_URL: <code><?php echo WP_CONTENT_URL ?></code></p>
  <p>WP_PLUGIN_DIR: <code><?php echo WP_PLUGIN_DIR ?></code></p>
  <p>WP_PLUGIN_URL: <code><?php echo WP_PLUGIN_URL ?></code></p>
  <p>WPMU_PLUGIN_DIR: <code><?php echo WPMU_PLUGIN_DIR ?></code></p>
  <p>WPMU_PLUGIN_URL: <code><?php echo WPMU_PLUGIN_URL ?></code></p>
  <p>plugin->basePath: <code><?php echo $plugin->getBasePath() ?></code></p>
  <p>plugin->baseUri: <code><?php echo $plugin->getBaseUri() ?></code></p>
  <p>plugin->js: <code><?php echo $plugin->js ?></code></p>
  <p>plugin->css: <code><?php echo $plugin->css ?></code></p>


  <hr/>

  <h2>Environment variables</h2>

  <p>JWT_TOKEN: <code><?php echo getenv("JWT_TOKEN") ?></code></p>
  <p>WEBSITE_WEBHOOK_URL: <code><?php echo getenv("WEBSITE_WEBHOOK_URL") ?></code></p>
  <p>EASYWP_READONLY: <code><?php echo getenv("EASYWP_READONLY") ?></code></p>

  <hr/>

  <h2>WordPress Readonly</h2>

  <code>in progress...</code>

  <hr/>

  <h2>Kubernetes</h2>

  <?php $info = \WPNCEasyWP\Http\Varnish\VarnishCache::info(); ?>

  <p>HOSTNAME: <code><?php echo $info['HOSTNAME'] ?></code></p>
  <p>Service: <code><?php echo $info['svc'] ?></code></p>
  <p>IPs: <code><?php echo $info['ips'] ?></code></p>

  <hr />

  <h2>Cache info</h2>

  <?php $varnish = WPNCEasyWP()->options->get('varnish') ?>

  <ul>
    <li>Varnish: <code><?php echo $varnish['enabled'] ? 'Enabled' : 'Disabled' ?></code></li>
    <li>Schema: <code><?php echo $varnish['schema'] ?></code></li>
    <li>default_purge_method: <code><?php echo $varnish['default_purge_method'] ?></code></li>
    <li>Last purge: <code><?php echo $varnish['last_purge'] ?></code></li>
  </ul>

  <hr />

  <h3>Last Purged URLs</h3>
  <pre>
<?php foreach ($varnish['last_purged_urls'] as $url) : ?>
<?php echo "{$url}\n" ?>
<?php endforeach; ?>
    </pre>

  <hr />

  <pre>
    <?php
    echo WPNCEasyWP()->options;
  ?>
    </pre>

</div>