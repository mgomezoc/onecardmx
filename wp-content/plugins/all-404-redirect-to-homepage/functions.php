<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly
function setup_redirects_table_and_migrate()
{
	global $wpdb;

	// Step 1: Create the redirects table
	if (!create_redirects_table()) {
		return;
	}

	// Step 2: Migrate data from the old `redirected_links` option
	migrate_redirected_links();
}
function p404_check_and_upgrade_database()
{
	// Check if upgrade is needed
	$email_update = get_option('P404_email_update', 0);

	// If upgrade not done yet (option = 0)
	if ($email_update == 0) {

		// Attempt the upgrade
		$upgrade_success = p404_handle_database_upgrade_secure();

		// Only mark as completed if upgrade was successful
		if ($upgrade_success) {
			update_option('P404_email_update', 1);
			error_log("P404 Plugin: Database upgrade completed successfully via plugins_loaded");
		} else {
			// Log failure but don't mark as completed - will retry on next load
			error_log("P404 Plugin: Database upgrade failed, will retry on next page load");
		}
	}
}
function p404_customizer_admin_inline_styles()
{
	// Check if we are in the Customizer page
	if (is_customize_preview()) {
?>
		<style>
			.accordion-section-title button.accordion-trigger {
				/* Add your desired styles for Customizer accordion button here */
				height: auto !important
			}
		</style>
	<?php
	}
}
add_action('customize_controls_print_styles', 'p404_customizer_admin_inline_styles');

// =============================================================================
// P404 DATABASE UPGRADE SYSTEM USING P404_email_update OPTION
// =============================================================================

// Hook for plugin activation



function p404_create_new_table_with_columns_secure($table_name)
{
	global $wpdb;

	try {
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            url TEXT NOT NULL,
            ip_address VARCHAR(45) NULL,
            referrer TEXT NULL,
            count INT(11) NOT NULL DEFAULT 1,
            last_redirected DATETIME NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY url_hash (url(191)),
            KEY idx_ip_address (ip_address),
            KEY idx_last_redirected (last_redirected),
            KEY idx_created_at (created_at)
        ) $charset_collate;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		// Clear any previous errors
		$wpdb->last_error = '';
		$result = dbDelta($sql);

		// Check for errors
		if ($wpdb->last_error) {
			error_log("P404 Plugin: Database error creating table - " . $wpdb->last_error);
			return false;
		}

		// Verify table was created successfully
		$table_exists = $wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $table_name));

		if ($table_exists != $table_name) {
			error_log("P404 Plugin: Table creation verification failed");
			return false;
		}

		error_log("P404 Plugin: New table created with all columns");
		return true;
	} catch (Exception $e) {
		error_log("P404 Plugin: Exception creating new table - " . $e->getMessage());
		return false;
	}
}
function create_redirects_table()
{
	global $wpdb;

	try {
		$table_name = $wpdb->prefix . 'redirects_404';

		// Check if upgrade was completed
		$email_update = get_option('P404_email_update', 0);

		if ($email_update == 0) {
			// Attempt the upgrade
			$upgrade_success = p404_handle_database_upgrade_secure();

			if ($upgrade_success) {
				update_option('P404_email_update', 1);
				error_log("P404 Plugin: Database upgrade completed successfully");
			} else {
				error_log("P404 Plugin: Database upgrade failed");
				return false;
			}
		}

		// Verify table exists
		$table_exists = $wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $table_name));

		if ($wpdb->last_error) {
			error_log('P404 Plugin: Database error checking table existence - ' . $wpdb->last_error);
			return false;
		}

		return ($table_exists == $table_name);
	} catch (Exception $e) {
		error_log('P404 Plugin: Exception in create_redirects_table - ' . $e->getMessage());
		return false;
	}
}
function migrate_redirected_links()
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'redirects_404';
	$option_name = 'options-404-redirect-group';
	$option_value = get_option($option_name);

	// Check if there are any links to migrate
	if (empty($option_value['redirected_links'])) {
		return;
	}

	$counter = 0; // Initialize counter
	foreach ($option_value['redirected_links'] as $redirect) {
		// Break the loop if 3000 records have been processed
		if ($counter >= 3000) {
			break;
		}

		$url = $redirect['link'];
		$date = date("Y-m-d H:i:s", strtotime($redirect['date']));

		// Check if the URL already exists in the table
		$existing = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE url = %s", $url));

		if ($existing) {
			// Update the count and last_redirected for existing URLs
			$wpdb->update(
				$table_name,
				[
					'count' => $existing->count + 1,
					'last_redirected' => $date
				],
				['id' => $existing->id]
			);
		} else {
			// Insert new URL records
			$wpdb->insert(
				$table_name,
				[
					'url' => $url,
					'count' => 1,
					'last_redirected' => $date
				]
			);
		}
		$counter++; // Increment counter
	}

	// Remove `redirected_links` from the options if all records were migrated
	if ($counter < count($option_value['redirected_links'])) {
	} else {
		unset($option_value['redirected_links']);
		update_option($option_name, $option_value);
	}
}

function p404_handle_database_upgrade_secure()
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'redirects_404';

	try {
		// Check if table exists with error handling
		$wpdb->last_error = '';
		$table_exists = $wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $table_name));

		if ($wpdb->last_error) {
			error_log('P404 Plugin: Database error checking table - ' . $wpdb->last_error);
			return false;
		}

		if ($table_exists == $table_name) {
			// Table exists, alter the columns
			$alter_success = p404_alter_existing_table_secure($table_name);
			if (!$alter_success) {
				return false;
			}
		} else {
			// Table doesn't exist, create new one with all columns
			$create_success = p404_create_new_table_with_columns_secure($table_name);
			if (!$create_success) {
				return false;
			}
		}

		return true; // Success

	} catch (Exception $e) {
		error_log("P404 Plugin: Database upgrade exception - " . $e->getMessage());
		return false;
	}
}

// FIXED: Enhanced table alteration with error handling
function p404_alter_existing_table_secure($table_name)
{
	global $wpdb;

	try {
		// Get existing columns with error handling
		$wpdb->last_error = '';
		$columns = $wpdb->get_results("DESCRIBE {$table_name}");

		if ($wpdb->last_error) {
			error_log("P404 Plugin: Failed to describe table structure - " . $wpdb->last_error);
			return false;
		}

		if ($columns === false || empty($columns)) {
			error_log("P404 Plugin: Unable to get table structure");
			return false;
		}

		$existing_columns = array();
		foreach ($columns as $column) {
			$existing_columns[] = $column->Field;
		}

		$changes_made = false;

		// Add IP column if it doesn't exist
		if (!in_array('ip_address', $existing_columns)) {
			$wpdb->last_error = '';
			$result = $wpdb->query("ALTER TABLE {$table_name} ADD COLUMN ip_address VARCHAR(45) NULL AFTER url");

			if ($result === false || $wpdb->last_error) {
				error_log("P404 Plugin: Failed to add ip_address column - " . $wpdb->last_error);
				return false;
			}

			error_log("P404 Plugin: Added ip_address column to existing table");
			$changes_made = true;
		}

		// Add Referrer column if it doesn't exist
		if (!in_array('referrer', $existing_columns)) {
			$wpdb->last_error = '';
			$result = $wpdb->query("ALTER TABLE {$table_name} ADD COLUMN referrer TEXT NULL AFTER ip_address");

			if ($result === false || $wpdb->last_error) {
				error_log("P404 Plugin: Failed to add referrer column - " . $wpdb->last_error);
				return false;
			}

			error_log("P404 Plugin: Added referrer column to existing table");
			$changes_made = true;
		}

		// Add indexes for better performance (these may fail if they already exist, that's OK)
		if ($changes_made) {
			// Suppress errors for index creation since they might already exist
			$wpdb->suppress_errors(true);
			$wpdb->query("ALTER TABLE {$table_name} ADD INDEX idx_ip_address (ip_address)");
			$wpdb->query("ALTER TABLE {$table_name} ADD INDEX idx_last_redirected (last_redirected)");
			$wpdb->query("ALTER TABLE {$table_name} ADD INDEX idx_url_hash (url(191))");
			$wpdb->suppress_errors(false);
		}

		error_log("P404 Plugin: Existing table altered successfully");
		return true;
	} catch (Exception $e) {
		error_log("P404 Plugin: Error altering existing table - " . $e->getMessage());
		return false;
	}
}
function p404_migrate_options()
{
	// Check if migration is already completed
	$migration_status = get_option('p404_migration_status2', '1'); // Default: 1 (not migrated)

	if ($migration_status === '1') {
		// Perform migration
		$options = get_option(OPTIONS404, array());

		if (!isset($options['p404_redirect_type'])) {
			$options['p404_redirect_type'] = '301'; // Default: Permanent Redirect
		}

		// Save the updated options
		update_option(OPTIONS404, $options);
		setup_redirects_table_and_migrate();
		// Update the migration status to `2` (migrated)
		update_option('p404_migration_status2', '2');
	}
}
add_action('plugins_loaded', 'p404_migrate_options');


function P404REDIRECT_HideMsg()
{
	add_option('P404REDIRECT_upgrade_msg', 'hidemsg');
}

function P404REDIRECT_HideAlert()
{

	update_option('P404_alert_msg', 'hidemsg');
}
add_action('admin_post_clear_redirects_log', 'clear_redirects_log_handler');

function clear_redirects_log_handler()
{
	// Verify the nonce for security
	if (!isset($_POST['clear_redirects_nonce']) || !wp_verify_nonce($_POST['clear_redirects_nonce'], 'clear_redirects_log')) {
		wp_die('Security check failed.');
	}

	global $wpdb;
	$table_name = $wpdb->prefix . 'redirects_404';

	// Clear the table data
	$wpdb->query("TRUNCATE TABLE $table_name");

	// Reset the `links` count in options
	$options = P404REDIRECT_get_my_options();
	$options['links'] = 0;
	P404REDIRECT_update_my_options($options);

	// Redirect back to the 404 URLs tab with a success message
	wp_redirect(admin_url('admin.php?page=all-404-redirect-to-homepage.php&mytab=404urls'));
	exit;
}

function sample_admin_notice__error()
{
	$class = 'notice notice-error';
	$links_count = P404REDIRECT_read_option_value('links', 0);


	if (get_option('P404_alert_msg') != 'hidemsg' && $links_count > 500) {

		$message = __('<h3>All 404 Redirect to Homepage</h3><b>Warning</b>, You have many broken links that hurt your site\'s rank in search engines, <a target="_blank" href="https://www.wp-buy.com/product/seo-redirection-premium-wordpress-plugin/#fix404links">UPGRADE</a> your plugin and empower your site\'s SEO.&nbsp; <span id="Hide404Alert" style="cursor:pointer" ><a href="javascript:void(0)"><strong> Dismiss</strong></a> this message</span> or check the plugin <a href="' . admin_url('admin.php?page=all-404-redirect-to-homepage.php') . '"><b>settings</b></a>.', 'sample-text-domain');

		printf('<div id="all404upgradeMsg" class="%1$s"><p>%2$s</p></div>', esc_attr($class), $message);


	?>
		<script type="text/javascript">
			jQuery(document).ready(function() {

				jQuery("#Hide404Alert").click(function() {
					jQuery.ajax({
						type: 'POST',
						url: '<?php echo admin_url(); ?>/admin-ajax.php',
						data: {
							action: 'P404REDIRECT_HideAlert'
						},
						success: function(data, textStatus, XMLHttpRequest) {

							jQuery("#all404upgradeMsg").hide();

						},
						error: function(MLHttpRequest, textStatus, errorThrown) {
							alert(errorThrown);
						}
					});
				});

			});
		</script>

	<?php
	}
}
add_action('admin_notices', 'sample_admin_notice__error');

function P404REDIRECT_after_plugin_row($plugin_file, $plugin_data, $status)
{
	if (get_option('P404REDIRECT_upgrade_msg') != 'hidemsg') {
		$class_name = isset($plugin_data['slug']) ? $plugin_data['slug'] : 'all-404-redirect-to-homepage'; // $plugin_data is an array retrived by default when you action this function after_plugin_row

		echo '<tr id="' . esc_attr($class_name) . '-plugin-update-tr" class="plugin-update-tr active">';
		echo '<td  colspan="6" class="plugin-update">';
		echo '<div id="' . esc_attr($class_name) . '-upgradeMsg" class="update-message" style="background:#FFF8E5; padding-left:10px; border-left:#FFB900 solid 4px" >';

		echo '<span style="color:red">Have many broken links?</span>.<br />keep track of 404 errors using our powerfull <a target="_blank" href="https://www.wp-buy.com/product/seo-redirection-premium-wordpress-plugin/">SEO Redirection Plugin</a> to show and fix all broken links & 404 errors that occur on your site. or ';

		echo '<span id="HideMe" style="cursor:pointer" ><a href="javascript:void(0)"><strong> Dismiss</strong></a> this message</span>';
		echo '</div>';
		echo '</td>';
		echo '</tr>';
	}
	?>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			var row = jQuery('#<?php echo esc_attr($class_name); ?>-plugin-update-tr').closest('tr').prev();
			jQuery(row).addClass('update');

			jQuery("#HideMe").click(function() {
				jQuery.ajax({
					type: 'POST',
					url: '<?php echo admin_url(); ?>/admin-ajax.php',
					data: {
						action: 'P404REDIRECT_HideMsg'
					},
					success: function(data, textStatus, XMLHttpRequest) {

						jQuery("#<?php echo esc_attr($class_name); ?>-upgradeMsg").hide();

					},
					error: function(MLHttpRequest, textStatus, errorThrown) {
						alert(errorThrown);
					}
				});
			});

		});
	</script>
<?php
}

function P404REDIRECT_get_current_URL()
{
	// Determine protocol securely
	$protocol = 'http://';
	if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
		$protocol = 'https://';
	} elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
		$protocol = 'https://';
	} elseif (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) {
		$protocol = 'https://';
	}

	// Sanitize host
	$host = isset($_SERVER['HTTP_HOST']) ? sanitize_text_field($_SERVER['HTTP_HOST']) : '';
	if (empty($host)) {
		return home_url(); // Fallback to WordPress home URL
	}

	// Validate host against allowed hosts
	$parsed_home = parse_url(home_url());
	if ($host !== $parsed_home['host']) {
		error_log('P404 Plugin: Suspicious host detected - ' . $host);
		return home_url(); // Security fallback
	}

	// Sanitize URI
	$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
	if (empty($uri)) {
		return $protocol . $host;
	}

	// Remove potentially dangerous characters and decode
	$uri = filter_var($uri, FILTER_SANITIZE_URL);
	$uri = esc_url_raw($uri);

	// Additional validation
	if (strlen($uri) > 2000) { // URLs shouldn't be this long
		error_log('P404 Plugin: Unusually long URI detected');
		return home_url();
	}

	return $protocol . $host . $uri;
}

//----------------------------------------------------
function P404REDIRECT_migrate_existing_options()
{
	// Fetch the current options
	$options = get_option(OPTIONS404, array());

	// Add new options if they are missing
	if (!isset($options['p404_logging_status'])) {
		$options['p404_logging_status'] = '1'; // Default: enabled
	}
	if (!isset($options['p404_logging_expiration_date'])) {
		$options['p404_logging_expiration_date'] = '1'; // Default: 1 month
	}
	if (!isset($options['p404_redirect_type'])) {
		$options['p404_redirect_type'] = '301'; // Default: Permanent Redirect
	}

	// Save the updated options back to the database
	update_option(OPTIONS404, $options);
}

function P404REDIRECT_init_my_options()
{
	add_option(OPTIONS404);

	// Initialize default options
	$options = array();
	$options['p404_redirect_to'] = site_url();
	$options['p404_status'] = '1';
	$options['img_p404_status'] = '2';
	$options['p404_execlude_media'] = '1';
	$options['links'] = 0;
	$options['install_date'] = date("Y-m-d h:i a");
	$options['p404_redirect_type'] = '301';


	update_option(OPTIONS404, $options);
}

//---------------------------------------------------- 

function P404REDIRECT_update_my_options($options)
{
	update_option(OPTIONS404, $options);
}

//---------------------------------------------------- 

function P404REDIRECT_get_my_options()
{
	$options = get_option(OPTIONS404);
	if (!$options) {
		P404REDIRECT_init_my_options();
		$options = get_option(OPTIONS404);
	}
	return $options;
}

/* read_option_value -------------------------------------------------  */
function P404REDIRECT_read_option_value($key, $default = '')
{
	$options = P404REDIRECT_get_my_options();
	if (array_key_exists($key, $options)) {
		return $options[$key];
	} else {
		P404REDIRECT_save_option_value($key, $default);
		return $default;
	}
}

/* save_option_value -------------------------------------------------  */
function P404REDIRECT_save_option_value($key, $value)
{
	$options = P404REDIRECT_get_my_options();
	$options[$key] = $value;
	P404REDIRECT_update_my_options($options);
}


function P404REDIRECT_add_redirected_link($link)
{
	global $wpdb;

	try {
		// Sanitize the URL
		$link = P404REDIRECT_get_current_URL();

		if (empty($link) || $link === home_url()) {
			return false; // Don't log homepage or empty URLs
		}

		// Increment the redirect count in options
		$links = P404REDIRECT_read_option_value('links', 0);
		P404REDIRECT_save_option_value('links', $links + 1);

		// Get visitor information securely
		$ip_address = p404_get_visitor_ip();
		$referrer = p404_get_referrer();

		// Define the table name
		$table_name = $wpdb->prefix . 'redirects_404';

		// Check if the exact same URL, IP, and referrer combination exists recently (within 1 hour)
		$wpdb->last_error = '';
		$recent_entry = $wpdb->get_row($wpdb->prepare("
            SELECT * FROM {$table_name} 
            WHERE url = %s 
            AND ip_address = %s 
            AND referrer = %s 
            AND last_redirected > %s
            ORDER BY last_redirected DESC 
            LIMIT 1
        ", $link, $ip_address, $referrer, date('Y-m-d H:i:s', strtotime('-1 hour'))));

		if ($wpdb->last_error) {
			error_log('P404 Plugin: Database error checking recent entry - ' . $wpdb->last_error);
			return false;
		}

		if ($recent_entry) {
			// Update existing recent entry
			$wpdb->last_error = '';
			$result = $wpdb->update(
				$table_name,
				array(
					'count' => $recent_entry->count + 1,
					'last_redirected' => current_time('mysql')
				),
				array('id' => $recent_entry->id),
				array('%d', '%s'),
				array('%d')
			);

			if ($wpdb->last_error) {
				error_log('P404 Plugin: Database error updating redirect count - ' . $wpdb->last_error);
				return false;
			}
		} else {
			// Insert new record
			$wpdb->last_error = '';
			$result = $wpdb->insert(
				$table_name,
				array(
					'url' => $link,
					'ip_address' => $ip_address,
					'referrer' => $referrer,
					'count' => 1,
					'last_redirected' => current_time('mysql')
				),
				array('%s', '%s', '%s', '%d', '%s')
			);

			if ($wpdb->last_error) {
				error_log('P404 Plugin: Database error inserting new redirect - ' . $wpdb->last_error);
				return false;
			}
		}

		return true;
	} catch (Exception $e) {
		error_log('P404 Plugin: Exception in add_redirected_link - ' . $e->getMessage());
		return false;
	}
}

function p404_get_visitor_ip()
{
	$ip_keys = array(
		'HTTP_CF_CONNECTING_IP',     // Cloudflare
		'HTTP_CLIENT_IP',            // Proxy
		'HTTP_X_FORWARDED_FOR',      // Load Balancer/Proxy
		'HTTP_X_FORWARDED',          // Proxy
		'HTTP_X_CLUSTER_CLIENT_IP',  // Cluster
		'HTTP_FORWARDED_FOR',        // Proxy
		'HTTP_FORWARDED',            // Proxy
		'HTTP_X_REAL_IP',            // Nginx
		'REMOTE_ADDR'                // Standard
	);

	foreach ($ip_keys as $key) {
		if (!empty($_SERVER[$key])) {
			$ip_list = explode(',', sanitize_text_field($_SERVER[$key]));

			foreach ($ip_list as $ip) {
				$ip = trim($ip);

				// Validate IP format
				if (!filter_var($ip, FILTER_VALIDATE_IP)) {
					continue;
				}

				// Skip private/reserved ranges for public IPs
				if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
					return $ip;
				}

				// For development/local environments, accept private IPs
				if (
					in_array($ip, array('127.0.0.1', '::1')) ||
					filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6)
				) {
					return $ip;
				}
			}
		}
	}

	// Fallback to REMOTE_ADDR with validation
	$remote_addr = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : 'unknown';
	if (filter_var($remote_addr, FILTER_VALIDATE_IP)) {
		return $remote_addr;
	}

	return 'unknown';
}


function p404_get_referrer()
{
	if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
		return 'Direct Access';
	}

	$referrer = sanitize_text_field($_SERVER['HTTP_REFERER']);

	// Validate URL format
	if (!filter_var($referrer, FILTER_VALIDATE_URL)) {
		return 'Invalid Referrer';
	}

	// Limit referrer length to prevent database issues
	if (strlen($referrer) > 500) {
		$referrer = substr($referrer, 0, 497) . '...';
	}

	// Optional: Filter out suspicious referrers
	$blocked_patterns = array(
		'javascript:',
		'data:',
		'vbscript:',
		'file:',
		'ftp:'
	);

	foreach ($blocked_patterns as $pattern) {
		if (stripos($referrer, $pattern) !== false) {
			return 'Blocked Referrer';
		}
	}

	return esc_url_raw($referrer);
}

//---------------------------------------------------- 
function P404REDIRECT_option_msg($msg)
{
	echo '<div id="message" class="updated"><p>' . esc_attr($msg) . '</p></div>';
}

//---------------------------------------------------- 
function P404REDIRECT_info_option_msg($msg)
{
	echo '<div id="message" class="updated"><p><div class="info_icon"></div> ' . esc_attr($msg) . '</p></div>';
}

//---------------------------------------------------- 
function P404REDIRECT_warning_option_msg($msg)
{
	echo '<div id="message" class="error"><p><div class="warning_icon"></div> ' . esc_attr($msg) . '</p></div>';
}

//---------------------------------------------------- 

function P404REDIRECT_success_option_msg($msg)
{
	echo '<div id="message" class="updated"><p><div class="success_icon"></div> ' . esc_attr($msg) . '</p></div>';
}

//---------------------------------------------------- 

function P404REDIRECT_failure_option_msg($msg)
{
	echo '<div id="message" class="error"><p><div class="failure_icon"></div> ' . esc_attr($msg) . '</p></div>';
}


//----------------------------------------------------
//** updated 2/2/2020
function P404REDIRECT_there_is_cache()
{
	$plugins = get_site_option('active_plugins');
	if (is_array($plugins)) {
		foreach ($plugins as $the_plugin) {
			if (stripos($the_plugin, 'cache') !== false) {
				return $the_plugin;
			}
		}
	}
	return '';
}
//-----------

// Initialize email scheduling when plugin is activated
function p404_setup_email_notifications()
{
	// Check if email notifications are enabled
	$email_enabled = P404REDIRECT_read_option_value('email_notifications_enabled', '2');

	if ($email_enabled == '1') {
		$frequency = P404REDIRECT_read_option_value('email_frequency', 'weekly');

		// Clear any existing schedules first
		p404_clear_email_schedules();

		// Calculate next run time based on frequency (NOT immediate)
		$next_run_time = p404_calculate_next_run_time($frequency);

		// Schedule the appropriate email based on frequency
		if ($frequency == 'daily' && !wp_next_scheduled('p404_daily_email_summary')) {
			wp_schedule_event($next_run_time, 'daily', 'p404_daily_email_summary');
		} elseif ($frequency == 'weekly' && !wp_next_scheduled('p404_weekly_email_summary')) {
			wp_schedule_event($next_run_time, 'weekly', 'p404_weekly_email_summary');
		} elseif ($frequency == 'monthly' && !wp_next_scheduled('p404_monthly_email_summary')) {
			wp_schedule_event($next_run_time, 'monthly', 'p404_monthly_email_summary');
		}

		// Log scheduling
	} else {
		// Clear any existing schedules if notifications are disabled
		p404_clear_email_schedules();
	}
}
function p404_calculate_next_run_time($frequency)
{
	switch ($frequency) {
		case 'daily':
			// Schedule for tomorrow at 9 AM
			$next_run = strtotime('tomorrow 9:00 AM');
			break;
		case 'weekly':
			// Schedule for next Monday at 9 AM
			$next_run = strtotime('next Monday 9:00 AM');
			break;
		case 'monthly':
			// Schedule for first day of next month at 9 AM
			$next_run = strtotime('first day of next month 9:00 AM');
			break;
		default:
			// Default to next day 9 AM
			$next_run = strtotime('tomorrow 9:00 AM');
	}

	return $next_run;
}

function p404_clear_email_schedules()
{
	wp_clear_scheduled_hook('p404_daily_email_summary');
	wp_clear_scheduled_hook('p404_weekly_email_summary');
	wp_clear_scheduled_hook('p404_monthly_email_summary');
}

// Hook the email functions
add_action('p404_daily_email_summary', 'p404_send_daily_email');
add_action('p404_weekly_email_summary', 'p404_send_weekly_email');
add_action('p404_monthly_email_summary', 'p404_send_monthly_email');

// Email sending functions
function p404_send_daily_email()
{
	p404_send_email_summary('daily');
}

function p404_send_weekly_email()
{
	p404_send_email_summary('weekly');
}

function p404_send_monthly_email()
{
	p404_send_email_summary('monthly');
}
// Main email sending function
function p404_send_email_summary($period)
{
	// Check if notifications are still enabled
	$email_enabled = P404REDIRECT_read_option_value('email_notifications_enabled', '2');
	if ($email_enabled != '1') {
		error_log("P404 Plugin: Email notifications disabled, skipping {$period} email");
		return;
	}

	// Prevent duplicate emails within same hour
	$last_sent_key = 'last_email_sent_' . $period;
	$last_sent = P404REDIRECT_read_option_value($last_sent_key, '');

	if (!empty($last_sent)) {
		$last_sent_time = strtotime($last_sent);
		$current_time = time();
		$time_diff = $current_time - $last_sent_time;

		// If email was sent within last hour, skip
		if ($time_diff < 3600) { // 3600 seconds = 1 hour
			error_log("P404 Plugin: {$period} email already sent recently (" . round($time_diff / 60) . " minutes ago), skipping");
			return;
		}
	}

	$notification_email = P404REDIRECT_read_option_value('notification_email', get_option('admin_email'));

	// Get comprehensive 404 statistics for the period
	$stats = p404_get_period_statistics($period);

	// Only send email if there are 404 errors
	if ($stats['total_errors'] == 0) {
		error_log("P404 Plugin: No 404 errors found for {$period} period, skipping email");
		return;
	}

	// Generate enhanced email content
	$subject = p404_get_email_subject($period, $stats['total_errors']);
	$message = p404_generate_email_content($period, $stats);

	// Enhanced email headers
	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
		'Reply-To: ' . get_option('admin_email')
	);

	// Update last sent time BEFORE sending (to prevent race conditions)
	P404REDIRECT_save_option_value($last_sent_key, current_time('mysql'));

	// Send email with error handling
	$sent = wp_mail($notification_email, $subject, $message, $headers);

	if ($sent) {
		// Log successful email send
		error_log("P404 Plugin: {$period} email summary sent successfully to {$notification_email}");
	} else {
		// Log failed email send and reset the timestamp
		error_log("P404 Plugin: Failed to send {$period} email summary to {$notification_email}");
		// Reset the timestamp since email failed
		P404REDIRECT_save_option_value($last_sent_key, $last_sent);
	}
}
// Get statistics for a specific period
function p404_get_period_statistics($period)
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'redirects_404';

	// Set date range based on period
	switch ($period) {
		case 'daily':
			$start_date = date('Y-m-d 00:00:00');
			$end_date = date('Y-m-d 23:59:59');
			$previous_start = date('Y-m-d 00:00:00', strtotime('-1 day'));
			$previous_end = date('Y-m-d 23:59:59', strtotime('-1 day'));
			break;
		case 'weekly':
			$start_date = date('Y-m-d 00:00:00', strtotime('-7 days'));
			$end_date = date('Y-m-d 23:59:59');
			$previous_start = date('Y-m-d 00:00:00', strtotime('-14 days'));
			$previous_end = date('Y-m-d 23:59:59', strtotime('-7 days'));
			break;
		case 'monthly':
			$start_date = date('Y-m-01 00:00:00');
			$end_date = date('Y-m-t 23:59:59');
			$previous_start = date('Y-m-01 00:00:00', strtotime('-1 month'));
			$previous_end = date('Y-m-t 23:59:59', strtotime('-1 month'));
			break;
		default:
			$start_date = date('Y-m-d 00:00:00', strtotime('-7 days'));
			$end_date = date('Y-m-d 23:59:59');
			$previous_start = date('Y-m-d 00:00:00', strtotime('-14 days'));
			$previous_end = date('Y-m-d 23:59:59', strtotime('-7 days'));
	}

	// Get total errors
	$total_errors = $wpdb->get_var($wpdb->prepare("
        SELECT SUM(count) 
        FROM {$table_name} 
        WHERE last_redirected BETWEEN %s AND %s
    ", $start_date, $end_date));

	// Get previous period errors for comparison
	$previous_errors = $wpdb->get_var($wpdb->prepare("
        SELECT SUM(count) 
        FROM {$table_name} 
        WHERE last_redirected BETWEEN %s AND %s
    ", $previous_start, $previous_end));

	// Get unique URLs
	$unique_urls = $wpdb->get_var($wpdb->prepare("
        SELECT COUNT(DISTINCT url) 
        FROM {$table_name} 
        WHERE last_redirected BETWEEN %s AND %s
    ", $start_date, $end_date));

	// Get unique IPs
	$unique_ips = $wpdb->get_var($wpdb->prepare("
        SELECT COUNT(DISTINCT ip_address) 
        FROM {$table_name} 
        WHERE last_redirected BETWEEN %s AND %s
        AND ip_address IS NOT NULL
        AND ip_address != 'unknown'
    ", $start_date, $end_date));

	// Get top 5 URLs
	$top_urls = $wpdb->get_results($wpdb->prepare("
        SELECT url, SUM(count) as hits
        FROM {$table_name} 
        WHERE last_redirected BETWEEN %s AND %s
        GROUP BY url 
        ORDER BY hits DESC 
        LIMIT 5
    ", $start_date, $end_date), ARRAY_A);

	// Get top referrers
	$top_referrers = $wpdb->get_results($wpdb->prepare("
        SELECT 
            CASE 
                WHEN referrer = 'Direct Access' THEN 'Direct Access'
                WHEN referrer LIKE '%%facebook.com%%' THEN 'Facebook'
                WHEN referrer LIKE '%%google.com%%' THEN 'Google'
                WHEN referrer LIKE '%%twitter.com%%' THEN 'Twitter'
                WHEN referrer LIKE '%%linkedin.com%%' THEN 'LinkedIn'
                ELSE SUBSTRING_INDEX(REPLACE(REPLACE(referrer, 'https://', ''), 'http://', ''), '/', 1)
            END as referrer_domain,
            SUM(count) as hits,
            COUNT(DISTINCT ip_address) as unique_visitors
        FROM {$table_name} 
        WHERE last_redirected BETWEEN %s AND %s
        AND referrer IS NOT NULL
        GROUP BY referrer_domain
        ORDER BY hits DESC 
        LIMIT 5
    ", $start_date, $end_date), ARRAY_A);

	// Get daily trend (last 7 days)
	$daily_trend = $wpdb->get_results($wpdb->prepare("
        SELECT 
            DATE(last_redirected) as date,
            SUM(count) as errors
        FROM {$table_name} 
        WHERE last_redirected BETWEEN %s AND %s
        GROUP BY DATE(last_redirected)
        ORDER BY date ASC
    ", date('Y-m-d 00:00:00', strtotime('-7 days')), date('Y-m-d 23:59:59')), ARRAY_A);

	// Get new vs recurring URLs
	$new_urls = $wpdb->get_var($wpdb->prepare("
        SELECT COUNT(DISTINCT url)
        FROM {$table_name} t1
        WHERE t1.last_redirected BETWEEN %s AND %s
        AND NOT EXISTS (
            SELECT 1 FROM {$table_name} t2 
            WHERE t2.url = t1.url 
            AND t2.last_redirected < %s
        )
    ", $start_date, $end_date, $start_date));

	// Calculate percentage change
	$percentage_change = 0;
	if ($previous_errors > 0) {
		$percentage_change = (($total_errors - $previous_errors) / $previous_errors) * 100;
	}

	return array(
		'period' => $period,
		'start_date' => $start_date,
		'end_date' => $end_date,
		'total_errors' => intval($total_errors),
		'previous_errors' => intval($previous_errors),
		'percentage_change' => round($percentage_change, 1),
		'unique_urls' => intval($unique_urls),
		'unique_ips' => intval($unique_ips),
		'new_urls' => intval($new_urls),
		'recurring_urls' => intval($unique_urls) - intval($new_urls),
		'top_urls' => $top_urls,
		'top_referrers' => $top_referrers,
		'daily_trend' => $daily_trend,
		'avg_errors_per_day' => $period == 'daily' ? intval($total_errors) : round(intval($total_errors) / 7, 1)
	);
}

// Generate email subject
function p404_get_email_subject($period, $error_count)
{
	$site_name = get_bloginfo('name');
	//$period_text = ucfirst(string: $period);

	$period_text = isset($period) ? ucfirst($period) : 'Weekly';




	return "404 Analytics Report - {$site_name} ({$period_text}: " . number_format($error_count) . " errors)";
}
// Generate email content
function p404_generate_email_content($period, $stats)
{
	$site_name = get_bloginfo('name');
	//$period_text = ucfirst($period);
	$period_text = isset($period) ? ucfirst($period) : 'Weekly';
	$date_range = p404_format_date_range($period, $stats['start_date'], $stats['end_date']);

	ob_start();
?>

	<div style="font-family: Arial, sans-serif; max-width: 700px; margin: 0 auto; background: #f5f5f5; padding: 20px;">
		<div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
			<!-- Header -->
			<div style="background: white; color: black; padding: 20px; text-align: center;">
				<h1 style="margin: 0; font-size: 24px; color: black; line-height: 1.3;">404 Error Analytics Report</h1>
				<p style="margin: 10px 0 0 0; color: black; font-size: 16px; word-break: break-word; line-height: 1.4;"><?php echo esc_html($site_name); ?></p>
				<p style="margin: 5px 0 0 0; color: black; font-size: 14px;">
					<?php echo esc_html($date_range); ?>
				</p>
			</div>

			<!-- Content -->
			<div style="padding: 20px;">
				<!-- Executive Summary -->
				<div style="background: #f8fafc; border-radius: 8px; padding: 20px; margin-bottom: 30px; border-left: 5px solid #6b7280; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
					<h2 style="color: #1e293b; margin-top: 0; font-size: 20px;">General Statistics</h2>

					<!-- Mobile-friendly stats grid -->
					<div style="width: 100%;">
						<div style="display: block; margin-bottom: 20px; text-align: center; padding: 15px; background: white; border-radius: 6px; border: 1px solid #e2e8f0;">
							<div style="font-size: 32px; font-weight: bold; color: <?php echo $stats['total_errors'] > 100 ? '#dc2626' : '#16a34a'; ?>; margin-bottom: 5px;">
								<?php echo number_format($stats['total_errors']); ?>
							</div>
							<div style="color: #64748b; font-size: 14px; margin-bottom: 5px;">Total 404 Errors</div>
							<?php if ($stats['percentage_change'] != 0): ?>
								<div style="color: <?php echo $stats['percentage_change'] > 0 ? '#dc2626' : '#16a34a'; ?>; font-size: 12px;">
									<?php echo $stats['percentage_change'] > 0 ? '↗' : '↘'; ?> <?php echo abs($stats['percentage_change']); ?>% vs previous <?php echo $period; ?>
								</div>
							<?php endif; ?>
						</div>

						<div style="display: block; margin-bottom: 20px; text-align: center; padding: 15px; background: white; border-radius: 6px; border: 1px solid #e2e8f0;">
							<div style="font-size: 24px; font-weight: bold; color: #4b5563; margin-bottom: 5px;">
								<?php echo number_format($stats['unique_urls']); ?>
							</div>
							<div style="color: #64748b; font-size: 14px;">Unique Broken URLs</div>
						</div>

						<div style="display: block; margin-bottom: 10px; text-align: center; padding: 15px; background: white; border-radius: 6px; border: 1px solid #e2e8f0;">
							<div style="font-size: 24px; font-weight: bold; color: #6b7280; margin-bottom: 5px;">
								<?php echo number_format($stats['unique_ips']); ?>
							</div>
							<div style="color: #64748b; font-size: 14px;">Unique Visitors</div>
						</div>
					</div>
				</div>

				<?php if (!empty($stats['daily_trend']) && count($stats['daily_trend']) > 1): ?>
					<!-- Trend Analysis -->
					<h2 style="color: #1e293b; margin-bottom: 15px;">7-Day Trend Analysis</h2>
					<div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow-x: auto;">
						<div style="min-width: 300px;">
							<table style="width: 100%; border-collapse: collapse; font-size: 14px;">
								<thead>
									<tr style="background: #f1f5f9;">
										<th style="padding: 8px; text-align: left; border-bottom: 2px solid #d1d5db; color: #374151;">Date</th>
										<th style="padding: 8px; text-align: center; border-bottom: 2px solid #d1d5db; color: #374151;">Errors</th>
										<th style="padding: 8px; text-align: center; border-bottom: 2px solid #d1d5db; color: #374151;">Trend</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$prev_errors = 0;
									foreach ($stats['daily_trend'] as $index => $day):
										$trend_indicator = '';
										if ($index > 0) {
											if ($day['errors'] > $prev_errors) {
												$trend_indicator = '<span style="color: #dc2626;">↗</span>';
											} elseif ($day['errors'] < $prev_errors) {
												$trend_indicator = '<span style="color: #16a34a;">↘</span>';
											} else {
												$trend_indicator = '<span style="color: #6b7280;">→</span>';
											}
										}
										$prev_errors = $day['errors'];
									?>
										<tr>
											<td style="padding: 6px 8px; border-bottom: 1px solid #f1f5f9; font-size: 12px;">
												<?php echo date('M j', strtotime($day['date'])); ?>
											</td>
											<td style="padding: 6px 8px; border-bottom: 1px solid #f1f5f9; text-align: center; font-weight: bold;">
												<?php echo number_format($day['errors']); ?>
											</td>
											<td style="padding: 6px 8px; border-bottom: 1px solid #f1f5f9; text-align: center;">
												<?php echo $trend_indicator; ?>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($stats['top_urls'])): ?>
					<!-- Top Broken URLs -->
					<h2 style="color: #1e293b; margin-bottom: 15px;">Most Frequent 404 URLs</h2>
					<div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow-x: auto;">
						<div style="min-width: 320px;">
							<table style="width: 100%; border-collapse: collapse; font-size: 13px;">
								<thead>
									<tr style="background: #f1f5f9;">
										<th style="padding: 8px; text-align: left; border-bottom: 2px solid #d1d5db; color: #374151;">URL</th>
										<th style="padding: 8px; text-align: center; border-bottom: 2px solid #d1d5db; width: 60px; color: #374151;">Hits</th>
										<th style="padding: 8px; text-align: center; border-bottom: 2px solid #d1d5db; width: 60px; color: #374151;">%</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($stats['top_urls'] as $url_data):
										$percentage = $stats['total_errors'] > 0 ? round(($url_data['hits'] / $stats['total_errors']) * 100, 1) : 0;
									?>
										<tr>
											<td style="padding: 8px; border-bottom: 1px solid #f1f5f9; font-family: monospace; font-size: 11px; word-break: break-all; max-width: 200px; overflow: hidden;">
												<a href="<?php echo esc_url($url_data['url']); ?>"
													style="color: #2563eb; text-decoration: underline; word-break: break-all;"
													target="_blank"
													rel="noopener noreferrer">
													<?php echo esc_html($url_data['url']); ?>
												</a>
											</td>
											<td style="padding: 8px; border-bottom: 1px solid #f1f5f9; text-align: center; font-weight: bold; color: #dc2626;">
												<?php echo number_format($url_data['hits']); ?>
											</td>
											<td style="padding: 8px; border-bottom: 1px solid #f1f5f9; text-align: center; font-weight: bold; color: #6b7280;">
												<?php echo $percentage; ?>%
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($stats['top_referrers'])): ?>
					<!-- Top Referrers -->
					<h2 style="color: #1e293b; margin-bottom: 15px;">Top Traffic Sources Causing 404s</h2>
					<div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow-x: auto;">
						<div style="min-width: 300px;">
							<table style="width: 100%; border-collapse: collapse; font-size: 13px;">
								<thead>
									<tr style="background: #f1f5f9;">
										<th style="padding: 8px; text-align: left; border-bottom: 2px solid #d1d5db; color: #374151;">Referrer</th>
										<th style="padding: 8px; text-align: center; border-bottom: 2px solid #d1d5db; width: 60px; color: #374151;">Hits</th>
										<th style="padding: 8px; text-align: center; border-bottom: 2px solid #d1d5db; width: 70px; color: #374151;">Visitors</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($stats['top_referrers'] as $referrer_data): ?>
										<tr>
											<td style="padding: 8px; border-bottom: 1px solid #f1f5f9; word-break: break-all; max-width: 150px; overflow: hidden;">
												<?php echo esc_html($referrer_data['referrer_domain']); ?>
											</td>
											<td style="padding: 8px; border-bottom: 1px solid #f1f5f9; text-align: center; font-weight: bold; color: #4b5563;">
												<?php echo number_format($referrer_data['hits']); ?>
											</td>
											<td style="padding: 8px; border-bottom: 1px solid #f1f5f9; text-align: center; font-weight: bold; color: #6b7280;">
												<?php echo number_format($referrer_data['unique_visitors']); ?>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				<?php endif; ?>

				<!-- URL Analysis -->
				<h2 style="color: #1e293b; margin-bottom: 15px;">URL Analysis</h2>
				<div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
					<div style="width: 100%;">
						<div style="display: block; margin-bottom: 15px; text-align: center; padding: 12px; background: white; border-radius: 6px; border: 1px solid #e2e8f0;">
							<div style="font-size: 24px; font-weight: bold; color: #dc2626; margin-bottom: 5px;">
								<?php echo number_format($stats['new_urls']); ?>
							</div>
							<div style="color: #64748b; font-size: 14px;">New Broken URLs</div>
						</div>

						<div style="display: block; margin-bottom: 15px; text-align: center; padding: 12px; background: white; border-radius: 6px; border: 1px solid #e2e8f0;">
							<div style="font-size: 24px; font-weight: bold; color: #f59e0b; margin-bottom: 5px;">
								<?php echo number_format($stats['recurring_urls']); ?>
							</div>
							<div style="color: #64748b; font-size: 14px;">Recurring Issues</div>
						</div>

						<div style="display: block; margin-bottom: 10px; text-align: center; padding: 12px; background: white; border-radius: 6px; border: 1px solid #e2e8f0;">
							<div style="font-size: 24px; font-weight: bold; color: #6b7280; margin-bottom: 5px;">
								<?php echo $stats['avg_errors_per_day']; ?>
							</div>
							<div style="color: #64748b; font-size: 14px;">Avg Errors/Day</div>
						</div>
					</div>
				</div>

				<!-- Enhanced Recommendations -->
				<h2 style="color: #1e293b; margin-bottom: 15px;">Priority Action Items</h2>
				<div style="background: #fefce8; border: 1px solid #fde047; border-radius: 8px; padding: 20px;">
					<?php
					$high_priority_urls = array_filter($stats['top_urls'], function ($url) use ($stats) {
						return $url['hits'] > ($stats['total_errors'] * 0.1); // URLs with >10% of total errors
					});
					?>

					<div style="margin-bottom: 20px;">
						<h3 style="color: #a16207; margin: 0 0 10px 0; font-size: 16px;">High Priority (Immediate Action Required)</h3>
						<ul style="margin: 0; padding-left: 20px; color: #a16207;">
							<?php if (count($high_priority_urls) > 0): ?>
								<li style="margin-bottom: 8px;"><strong>Fix high-impact URLs:</strong> <?php echo count($high_priority_urls); ?> URLs are causing <?php echo round((array_sum(array_column($high_priority_urls, 'hits')) / $stats['total_errors']) * 100, 1); ?>% of all errors</li>
							<?php endif; ?>

							<?php if ($stats['total_errors'] > 100): ?>
								<li style="margin-bottom: 8px;"><strong>Critical error volume:</strong> <?php echo number_format($stats['total_errors']); ?> errors detected - immediate investigation needed</li>
							<?php endif; ?>

							<?php if ($stats['percentage_change'] > 50): ?>
								<li style="margin-bottom: 8px;"><strong>Error spike detected:</strong> <?php echo $stats['percentage_change']; ?>% increase from previous period</li>
							<?php endif; ?>
						</ul>
					</div>

					<div style="margin-bottom: 20px;">
						<h3 style="color: #d97706; margin: 0 0 10px 0; font-size: 16px;">Medium Priority</h3>
						<ul style="margin: 0; padding-left: 20px; color: #d97706;">
							<li style="margin-bottom: 8px;">Review referrer sources - focus on <?php echo !empty($stats['top_referrers']) ? $stats['top_referrers'][0]['referrer_domain'] : 'top referrer'; ?> traffic</li>
							<li style="margin-bottom: 8px;">Set up redirects for <?php echo $stats['new_urls']; ?> new broken URLs</li>
							<li style="margin-bottom: 8px;">Monitor <?php echo $stats['unique_ips']; ?> unique visitors experiencing 404s</li>
							<?php if ($stats['recurring_urls'] > 5): ?>
								<li style="margin-bottom: 8px;">Address <?php echo $stats['recurring_urls']; ?> recurring broken URLs</li>
							<?php endif; ?>
						</ul>
					</div>

					<div>
						<h3 style="color: #16a34a; margin: 0 0 10px 0; font-size: 16px;">Maintenance Tasks</h3>
						<ul style="margin: 0; padding-left: 20px; color: #16a34a;">
							<li style="margin-bottom: 8px;">Update internal links to prevent future 404s</li>
							<li style="margin-bottom: 8px;">Contact external sites linking to broken URLs</li>
							<li style="margin-bottom: 8px;">Implement custom 404 page with search functionality</li>
							<li style="margin-bottom: 8px;">Regular weekly monitoring to catch issues early</li>
						</ul>
					</div>
				</div>

				<!-- Mobile-friendly buttons -->
				<div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 2px solid #e2e8f0;">
					<div style="margin-bottom: 10px;">
						<a href="<?php echo admin_url('admin.php?page=all-404-redirect-to-homepage.php&mytab=404urls'); ?>"
							style="background: #6b7280; color: white; padding: 10px 16px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block; box-shadow: 0 2px 4px rgba(107, 114, 128, 0.2); max-width: 180px; width: 100%; text-align: center; font-size: 14px; box-sizing: border-box;">
							View All 404 URLs
						</a>
					</div>
					<div>
						<a href="<?php echo admin_url('admin.php?page=all-404-redirect-to-homepage.php'); ?>"
							style="background: #9ca3af; color: white; padding: 10px 16px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block; box-shadow: 0 2px 4px rgba(156, 163, 175, 0.2); max-width: 180px; width: 100%; text-align: center; font-size: 14px; box-sizing: border-box;">
							Plugin Settings
						</a>
					</div>
				</div>

				<!-- Performance Insights -->
				<?php if ($stats['total_errors'] > 0): ?>
					<div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin-top: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
						<h3 style="color: #1e293b; margin: 0 0 15px 0; font-size: 16px;">Performance Impact Analysis</h3>
						<div style="color: #64748b; font-size: 14px; line-height: 1.6;">
							<p style="margin: 0 0 10px 0;">
								<strong>SEO Impact:</strong> 404 errors can negatively affect search engine rankings and user experience.
							</p>
							<p style="margin: 0 0 10px 0;">
								<strong>User Experience:</strong> <?php echo $stats['unique_ips']; ?> visitors encountered broken links, potentially leading to lost conversions.
							</p>
							<p style="margin: 0;">
								<strong>Server Load:</strong> Processing <?php echo number_format($stats['total_errors']); ?> 404 requests consumes server resources unnecessarily.
							</p>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<!-- Footer -->
			<div style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 20px; text-align: center; color: #64748b; font-size: 12px; border-top: 1px solid #e2e8f0;">
				<div style="margin-bottom: 10px;">
					<strong>404 Analytics Report</strong> - Generated by <a href="https://wordpress.org/plugins/all-404-redirect-to-homepage/" style="color: #6b7280; text-decoration: none;">All 404 Redirect to Homepage Plugin</a>
				</div>
				<div style="margin-bottom: 10px;">
					<?php echo esc_html(get_site_url()); ?>
				</div>
				<div style="opacity: 0.8; line-height: 1.4;">
					Report generated on <?php echo date('F j, Y \a\t g:i A'); ?><br>
					<a href="<?php echo admin_url('admin.php?page=all-404-redirect-to-homepage.php'); ?>" style="color: #6b7280;">Manage Email Settings</a>
				</div>
			</div>
		</div>
	</div>
<?php

	return ob_get_clean();
}

// Format date range for display
function p404_format_date_range($period, $start_date, $end_date)
{
	if ($period == 'daily') {
		return date('F j, Y', strtotime($start_date));
	} else {
		return date('F j', strtotime($start_date)) . ' - ' . date('F j, Y', strtotime($end_date));
	}
}

// Add custom cron schedules
add_filter('cron_schedules', 'p404_add_custom_cron_schedules');
function p404_add_custom_cron_schedules($schedules)
{
	$schedules['weekly'] = array(
		'interval' => 604800, // 7 days
		'display' => 'Weekly'
	);
	$schedules['monthly'] = array(
		'interval' => 2635200, // 30.5 days
		'display' => 'Monthly'
	);
	return $schedules;
}

/// Clean up scheduled events on plugin deactivation
register_deactivation_hook(__FILE__, 'p404_cleanup_email_schedules');
function p404_cleanup_email_schedules()
{
	p404_clear_email_schedules();
}
function p404_update_email_schedules()
{
	p404_setup_email_notifications();
}
function p404_send_test_email()
{
	if (!current_user_can('manage_options')) {
		return false;
	}

	// Temporarily bypass duplicate protection for test
	$stats = p404_get_period_statistics('weekly');
	if ($stats['total_errors'] == 0) {
		// Create fake stats for testing
		$stats['total_errors'] = 1;
		$stats['unique_urls'] = 1;
		$stats['unique_ips'] = 1;
		$stats['top_urls'] = array(array('url' => 'https://example.com/test', 'hits' => 1));
	}

	$subject = "TEST: " . p404_get_email_subject('weekly', $stats['total_errors']);
	$message = p404_generate_email_content('weekly', $stats);

	$admin_email = get_option('admin_email');
	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: ' . get_bloginfo('name') . ' <' . $admin_email . '>'
	);

	$sent = wp_mail($admin_email, $subject, $message, $headers);

	if ($sent) {
		error_log("P404 Plugin: Test email sent successfully to {$admin_email}");
	} else {
		error_log("P404 Plugin: Failed to send test email to {$admin_email}");
	}

	return $sent;
}
add_action('wp_ajax_delete_previous_404_image', 'handle_delete_previous_404_image');

function handle_delete_previous_404_image()
{
	// Check nonce for security
	if (!wp_verify_nonce($_POST['nonce'], 'delete_404_image_nonce')) {
		wp_die('Security check failed');
	}

	// Check user permissions
	if (!current_user_can('manage_options')) {
		wp_die('Insufficient permissions');
	}

	$image_id = intval($_POST['image_id']);
	$option_name = sanitize_text_field($_POST['option_name']);

	if ($image_id) {
		// Get current options
		$options = get_option('p404_redirect_options', array());

		// Clear the specific option if it matches the image being deleted
		if (isset($options[$option_name]) && $options[$option_name] == $image_id) {
			$options[$option_name] = '';
			update_option('p404_redirect_options', $options);
		}

		// Delete the attachment
		$deleted = wp_delete_attachment($image_id, true);

		if ($deleted) {
			wp_send_json_success('Image deleted successfully and option cleared');
		} else {
			wp_send_json_error('Failed to delete image');
		}
	} else {
		wp_send_json_error('Invalid image ID');
	}
}
add_action('wp_ajax_send_test_404_email', 'handle_send_test_404_email');

function handle_send_test_404_email()
{
	// Check nonce for security
	if (!wp_verify_nonce($_POST['nonce'], 'test_404_email_nonce')) {
		wp_send_json_error('Security check failed');
	}

	// Check user permissions
	if (!current_user_can('manage_options')) {
		wp_send_json_error('Insufficient permissions');
	}

	$email = sanitize_email($_POST['email']);
	if (!is_email($email)) {
		wp_send_json_error('Invalid email address');
	}

	// Check if we have enough redirects
	$total_redirects = P404REDIRECT_read_option_value('links', 0);
	if ($total_redirects < 5) {
		wp_send_json_error('Not enough redirect data available. Need at least 5 redirects to send test email.');
	}

	try {
		// Generate test email with actual data
		$test_stats = p404_generate_test_email_stats();
		$email_content = p404_generate_email_content('weekly', $test_stats);
		$subject = p404_get_email_subject('weekly', $test_stats['total_errors']);

		// Set up HTML email
		add_filter('wp_mail_content_type', 'p404_set_html_content_type');

		// Send the email
		$sent = wp_mail($email, $subject, $email_content);

		// Remove filter after sending
		remove_filter('wp_mail_content_type', 'p404_set_html_content_type');

		if ($sent) {
			wp_send_json_success('Test email sent successfully to ' . $email);
		} else {
			wp_send_json_error('Failed to send email. Please check your mail configuration.');
		}
	} catch (Exception $e) {
		wp_send_json_error('Error generating email: ' . $e->getMessage());
	}
}

// Function to set HTML content type for emails
function p404_set_html_content_type()
{
	return 'text/html';
}

// Function to generate test email statistics using real data
function p404_generate_test_email_stats()
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'redirects_404';

	// Get date ranges
	$end_date = date('Y-m-d');
	$start_date = date('Y-m-d', strtotime('-7 days'));
	$prev_start_date = date('Y-m-d', strtotime('-14 days'));
	$prev_end_date = date('Y-m-d', strtotime('-8 days'));

	// Get current period stats
	$current_period_errors = $wpdb->get_var($wpdb->prepare("
        SELECT SUM(count) 
        FROM {$table_name} 
        WHERE DATE(last_redirected) BETWEEN %s AND %s
    ", $start_date, $end_date)) ?: 0;

	// Get previous period stats for comparison
	$previous_period_errors = $wpdb->get_var($wpdb->prepare("
        SELECT SUM(count) 
        FROM {$table_name} 
        WHERE DATE(last_redirected) BETWEEN %s AND %s
    ", $prev_start_date, $prev_end_date)) ?: 0;

	// Calculate percentage change
	$percentage_change = 0;
	if ($previous_period_errors > 0) {
		$percentage_change = round((($current_period_errors - $previous_period_errors) / $previous_period_errors) * 100, 1);
	} elseif ($current_period_errors > 0) {
		$percentage_change = 100;
	}

	// Get unique URLs
	$unique_urls = $wpdb->get_var($wpdb->prepare("
        SELECT COUNT(DISTINCT url) 
        FROM {$table_name} 
        WHERE DATE(last_redirected) BETWEEN %s AND %s
    ", $start_date, $end_date)) ?: 0;

	// Get unique IPs
	$unique_ips = $wpdb->get_var($wpdb->prepare("
        SELECT COUNT(DISTINCT ip_address) 
        FROM {$table_name} 
        WHERE DATE(last_redirected) BETWEEN %s AND %s
        AND ip_address IS NOT NULL 
        AND ip_address != 'unknown'
    ", $start_date, $end_date)) ?: 0;

	// Get top URLs
	$top_urls = $wpdb->get_results($wpdb->prepare("
        SELECT url, SUM(count) as hits
        FROM {$table_name} 
        WHERE DATE(last_redirected) BETWEEN %s AND %s
        GROUP BY url 
        ORDER BY hits DESC 
        LIMIT 10
    ", $start_date, $end_date), ARRAY_A);

	// Format top URLs
	$formatted_top_urls = array();
	foreach ($top_urls as $url_data) {
		$formatted_top_urls[] = array(
			'url' => $url_data['url'],
			'hits' => intval($url_data['hits'])
		);
	}

	// Get top referrers (if referrer column exists)
	$referrer_column_exists = $wpdb->get_var("SHOW COLUMNS FROM {$table_name} LIKE 'referrer'");
	$top_referrers = array();

	if ($referrer_column_exists) {
		$referrer_data = $wpdb->get_results($wpdb->prepare("
            SELECT 
                CASE 
                    WHEN referrer IS NULL OR referrer = '' THEN 'Direct Access'
                    WHEN referrer LIKE '%google.%' THEN 'Google Search'
                    WHEN referrer LIKE '%bing.%' THEN 'Bing Search'
                    WHEN referrer LIKE '%facebook.%' THEN 'Facebook'
                    WHEN referrer LIKE '%twitter.%' THEN 'Twitter'
                    ELSE SUBSTRING_INDEX(SUBSTRING_INDEX(referrer, '/', 3), '/', -1)
                END as referrer_domain,
                SUM(count) as hits,
                COUNT(DISTINCT ip_address) as unique_visitors
            FROM {$table_name} 
            WHERE DATE(last_redirected) BETWEEN %s AND %s
            GROUP BY referrer_domain 
            ORDER BY hits DESC 
            LIMIT 5
        ", $start_date, $end_date), ARRAY_A);

		foreach ($referrer_data as $ref) {
			$top_referrers[] = array(
				'referrer_domain' => $ref['referrer_domain'],
				'hits' => intval($ref['hits']),
				'unique_visitors' => intval($ref['unique_visitors'])
			);
		}
	} else {
		// Fallback referrers for demo
		$top_referrers = array(
			array('referrer_domain' => 'Google Search', 'hits' => max(1, intval($current_period_errors * 0.4)), 'unique_visitors' => max(1, intval($unique_ips * 0.6))),
			array('referrer_domain' => 'Direct Access', 'hits' => max(1, intval($current_period_errors * 0.3)), 'unique_visitors' => max(1, intval($unique_ips * 0.4))),
			array('referrer_domain' => 'Other Sites', 'hits' => max(1, intval($current_period_errors * 0.2)), 'unique_visitors' => max(1, intval($unique_ips * 0.3)))
		);
	}

	// Get daily trend for the past 7 days
	$daily_trend = $wpdb->get_results($wpdb->prepare("
        SELECT 
            DATE(last_redirected) as date,
            SUM(count) as errors
        FROM {$table_name} 
        WHERE DATE(last_redirected) BETWEEN %s AND %s
        GROUP BY DATE(last_redirected)
        ORDER BY date ASC
    ", $start_date, $end_date), ARRAY_A);

	// Fill in missing days with 0 errors
	$formatted_daily_trend = array();
	for ($i = 6; $i >= 0; $i--) {
		$check_date = date('Y-m-d', strtotime("-{$i} days"));
		$found = false;
		foreach ($daily_trend as $day) {
			if ($day['date'] == $check_date) {
				$formatted_daily_trend[] = array(
					'date' => $check_date,
					'errors' => intval($day['errors'])
				);
				$found = true;
				break;
			}
		}
		if (!$found) {
			$formatted_daily_trend[] = array(
				'date' => $check_date,
				'errors' => 0
			);
		}
	}

	// Calculate new vs recurring URLs
	$total_unique_urls_ever = $wpdb->get_var("SELECT COUNT(DISTINCT url) FROM {$table_name}") ?: 0;
	$new_urls = max(0, $unique_urls - intval($total_unique_urls_ever * 0.3)); // Estimate
	$recurring_urls = $unique_urls - $new_urls;

	// Calculate average errors per day
	$avg_errors_per_day = $current_period_errors > 0 ? round($current_period_errors / 7, 1) : 0;

	return array(
		'total_errors' => $current_period_errors,
		'unique_urls' => $unique_urls,
		'unique_ips' => $unique_ips,
		'percentage_change' => $percentage_change,
		'top_urls' => $formatted_top_urls,
		'top_referrers' => $top_referrers,
		'daily_trend' => $formatted_daily_trend,
		'new_urls' => $new_urls,
		'recurring_urls' => $recurring_urls,
		'avg_errors_per_day' => $avg_errors_per_day,
		'start_date' => $start_date,
		'end_date' => $end_date
	);
}



// Function to schedule or send regular email reports (for future implementation)
function p404_schedule_email_reports()
{
	// This function can be used to set up WordPress cron jobs for automated emails
	$email_enabled = P404REDIRECT_read_option_value('email_notifications_enabled', '2');
	$email_frequency = P404REDIRECT_read_option_value('email_frequency', 'weekly');

	if ($email_enabled == '1') {
		// Schedule based on frequency
		if (!wp_next_scheduled('p404_send_scheduled_email')) {
			switch ($email_frequency) {
				case 'daily':
					wp_schedule_event(strtotime('tomorrow 9:00 AM'), 'daily', 'p404_send_scheduled_email');
					break;
				case 'weekly':
					wp_schedule_event(strtotime('next monday 9:00 AM'), 'weekly', 'p404_send_scheduled_email');
					break;
				case 'monthly':
					wp_schedule_event(strtotime('first day of next month 9:00 AM'), 'monthly', 'p404_send_scheduled_email');
					break;
			}
		}
	} else {
		// Unschedule if disabled
		wp_clear_scheduled_hook('p404_send_scheduled_email');
	}
}

// Hook for scheduled emails (add this to your main plugin file)
add_action('p404_send_scheduled_email', 'p404_send_automatic_email_report');

function p404_send_automatic_email_report()
{
	$email_enabled = P404REDIRECT_read_option_value('email_notifications_enabled', '2');
	if ($email_enabled != '1') return;

	$notification_email = P404REDIRECT_read_option_value('notification_email', get_option('admin_email'));
	$email_frequency = P404REDIRECT_read_option_value('email_frequency', 'weekly');

	// Generate stats based on frequency
	$stats = p404_generate_email_stats_for_period($email_frequency);

	// Only send if there are errors to report
	if ($stats['total_errors'] > 0) {
		$email_content = p404_generate_email_content($email_frequency, $stats);
		$subject = p404_get_email_subject($email_frequency, $stats['total_errors']);

		add_filter('wp_mail_content_type', 'p404_set_html_content_type');
		wp_mail($notification_email, $subject, $email_content);
		remove_filter('wp_mail_content_type', 'p404_set_html_content_type');
	}
}

function p404_generate_email_stats_for_period($period)
{
	// Similar to p404_generate_test_email_stats but with different date ranges based on period
	// Implementation would be similar but with dynamic date ranges
	switch ($period) {
		case 'daily':
			return p404_generate_test_email_stats(); // Use current implementation
		case 'weekly':
			return p404_generate_test_email_stats(); // Use current implementation  
		case 'monthly':
			// Implement monthly stats (30 days)
			return p404_generate_test_email_stats(); // For now, use current
		default:
			return p404_generate_test_email_stats();
	}
}
