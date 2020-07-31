<div class="wrap" id="dataconla_general_page">
    <h2>DataConLA Plugin Info</h2>
    <p>This is a plugin that migrated the features from the DataConLA theme.</p>

    <h3>Custom Post Types Registered</h3>
    <ul>
        <li>Organizers</li>
        <li>Speakers</li>
        <li>Sponsors</li>
        <li>Startup Showcase Judges</li>
        <li>Startup Showcase Finalists</li>
        <li>Past Attendees</li>
        <li>Panelists</li>
        <li>Volunteers</li>
    </ul>

    <h3>Custom Taxonomies Types Registered</h3>
    <ul>
        <li>Relevant Year</li>
        <li>Sponsor Tier</li>
        <li>Attended Year</li>
    </ul>

    <h3>WP Bakery Shortcode Registered</h3>
    <ul>
        <li>see custom post types above and more....</li>
    </ul>

    <h3>Magic Fields Plugin Replacement</h3>
    <p> Use <a href="https://wordpress.org/plugins/advanced-custom-fields/">Advanced Custom Fields plugin</a> and import pre-defined fields:</p>
    <ul>
        <?php
        foreach (list_files(plugin_dir_path(__FILE__) . 'acf_export') as $file) {
            $tmp = explode('/', $file);
            $filename = end($tmp);
            echo '<li><a download href="/wp-content/plugins/dataconla/acf_export/' . $filename . '">' . $filename . '</a></li>';
        }
        ?>
    </ul>

    <h3>Misc.</h3>
    <ul>
        <li>
            <a href="https://github.com/c1rabbit/wordpress_plugin_dataconla">GitHub Repo</a>
        <li>
    </ul>
</div>