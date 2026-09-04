<?php
/**
 *
 * @link       https://velocitydeveloper.com
 * @since      1.0.0
 *
 * @package    Custom_Plugin
 * @subpackage Custom_Plugin/includes
 */

if (!class_exists('Velocity_Spa_Post_Types')) {
class Velocity_Spa_Post_Types {
    public function __construct()
    {
        // Hook into the 'init' action
        add_action('init', [$this, 'register_post_types']);
        add_action('init', [$this, 'register_taxonomies']);
        add_action('add_meta_boxes', [$this, 'vd_custom_fields']);
        add_action('save_post', [$this, 'vd_save_layanan_field']);

    }

    /**
     * Register custom post types
     */
    public function register_post_types()
    {
        // Register Team Post Type
        register_post_type('team',[
                'labels' => [
                    'name' => 'Team',
                    'singular_name' => 'team',
                    'add_new' => 'Tambah Team Baru',
                    'add_new_item' => 'Tambah Team Baru',
                    'edit_item' => 'Edit Team',
                    'view_item' => 'Lihat Team',
                    'search_items' => 'Cari Team',
                    'not_found' => 'Tidak ditemukan',
                    'not_found_in_trash' => 'Tidak ada Team di kotak sampah'
                ],
                'public' => true,
                'menu_position' => 5,
                'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16"><path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/><path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492z"/></svg>'),
                'has_archive' => true,
                'show_in_rest' => true,
                'supports' => ['title', 'editor', 'thumbnail'],
                'taxonomies' => [],
        ]);

        // Register Layanan Post Type
        register_post_type('layanan',[
                'labels' => [
                    'name' => 'Layanan',
                    'singular_name' => 'layanan',
                    'add_new' => 'Tambah Layanan Baru',
                    'add_new_item' => 'Tambah Layanan Baru',
                    'edit_item' => 'Edit Layanan',
                    'view_item' => 'Lihat Layanan',
                    'search_items' => 'Cari Layanan',
                    'not_found' => 'Tidak ditemukan',
                    'not_found_in_trash' => 'Tidak ada Layanan di kotak sampah'
                ],
                'public' => true,
                'menu_position' => 5,
                'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-gear" viewBox="0 0 16 16"><path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708z"/><path d="M11.886 9.46c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.044c-.613-.181-.613-1.049 0-1.23l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/></svg>'),
                'has_archive' => true,
                'show_in_rest' => true,
                'supports' => ['title', 'editor', 'thumbnail'],
                'taxonomies' => ['kategori-layanan'],
        ]);
    }

    public function register_taxonomies() {
        register_taxonomy(
            'kategori-layanan',
            'layanan',
            [
                'label' => 'Kategori',
                'labels' => [
                    'name' => 'Kategori',
                    'singular_name' => 'Kategori',
                    'search_items' => 'Cari Kategori',
                    'all_items' => 'Semua Kategori',
                    'edit_item' => 'Edit Kategori',
                    'update_item' => 'Update Kategori',
                    'add_new_item' => 'Tambah Kategori',
                    'new_item_name' => 'Nama Kategori',
                    'menu_name' => 'Kategori',
                ],
                'show_ui' => true,
                'show_in_menu' => true,
                'show_in_nav_menus' => true,
                'show_in_rest' => true,
                'show_tagcloud' => true,
                'show_in_quick_edit' => true,
                'hierarchical' => true,
                'query_var' => true,
                'rewrite' => true,
                'show_admin_column' => true,
                'show_in_rest' => true,
            ]
        );
    }

    public function vd_custom_fields() {
        // Add custom fields to Team post type
        add_meta_box(
            'vd_layanan_field',
            'Detail Layanan',
            [$this, 'vd_layanan_field_callback'],
            'layanan', // Post Type
            'normal',
            'high'
        );
    }

    public function vd_layanan_field_callback($post) {
        // Get the current value of the custom field
        $fasilitas_layanan = get_post_meta($post->ID, 'fasilitas', true);
        $harga_layanan = get_post_meta($post->ID, 'harga', true);?>
        
        <div style="display: flex; align-items: center;">
            <div class="form-label" style="margin-bottom: 10px; padding-right:20px;">
                <label for="harga">Harga Layanan </label><br/>
                <small style="font-size: 11px;">(Harga dalam Rupiah)</small>
            </div>
            <div class="harga-container">
                <input type="number" name="harga" placeholder="250000" value="<?php echo esc_attr($harga_layanan); ?>" />
            </div>
        </div>

        <div class="form-label" style="margin-bottom: 10px;">
            <label for="fasilitas">Fasilitas Layanan </label>
        </div>
        <div id="fasilitas-container">
        <?php if (!empty($fasilitas_layanan)) : $no=0;
            foreach ($fasilitas_layanan as $fasilitas): $no++;
                echo '<div class="fasilitas-item">';
                    echo '<input type="text" name="fasilitas[]" placeholder="Masukkan Fasilitas" value="' . esc_attr($fasilitas) . '" />';
                    if($no!=1):
                        echo '<button type="button" class="remove-fasilitas"><span class="dashicons dashicons-trash"></span></button>';
                    endif;
                echo '</div>';
            endforeach;
            else:
                echo '<div class="fasilitas-item"><input type="text" name="fasilitas[]" placeholder="Masukkan Fasilitas" value="" /></div>';
            endif;?>
        </div>
        <div style="margin: 10px 0;">
            <button type="button" id="add-fasilitas">Tambah Fasilitas +</button>
        </div>
        
        <?php
        // Add nonce for security
        echo '<input type="hidden" name="vd_layanan_field_nonce" value="' . wp_create_nonce(__FILE__) . '" />';
    }

    public function vd_save_layanan_field($post_id) {
        // Check if this is an autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Check if this is a revision
        if (wp_is_post_revision($post_id)) {
            return;
        }

        // Check if this is the correct post type
        if (get_post_type($post_id) !== 'layanan') {
            return;
        }

        // Check if nonce is set
        if (!isset($_POST['vd_layanan_field_nonce'])) {
            return;
        }

        // Verify nonce
        if (!wp_verify_nonce($_POST['vd_layanan_field_nonce'], __FILE__)) {
            return;
        }

        // Check if user has permission to save
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Save the custom field
        if (isset($_POST['harga'])) {
            $harga_clean = intval($_POST['harga']);
            if ($harga_clean > 0) {
                update_post_meta($post_id, 'harga', $harga_clean);
            } else {
                // Delete meta if invalid harga
                delete_post_meta($post_id, 'harga');
            }
        }

        if (isset($_POST['fasilitas']) && is_array($_POST['fasilitas'])) {
            // Sanitize array of fasilitas
            $fasilitas_clean = array();
            foreach ($_POST['fasilitas'] as $fasilitas) {
                $clean_fasilitas = sanitize_text_field($fasilitas);
                if (!empty($clean_fasilitas)) {
                    $fasilitas_clean[] = $clean_fasilitas;
                }
            }
            update_post_meta($post_id, 'fasilitas', $fasilitas_clean);
        } else {
            // Delete meta if no fasilitas provided
            delete_post_meta($post_id, 'fasilitas');
        }
    }

}
}

// Inisialisasi class Custom_Post_Types_Register
if (class_exists('Velocity_Spa_Post_Types')) {
    $velocity_spa_post_types = new Velocity_Spa_Post_Types();
}
