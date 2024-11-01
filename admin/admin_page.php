<div class="wrap form-table">

    <h2>WP Best Practices Options</h2>

    <form method="post" action="options.php">
        <?php wp_nonce_field('update-options'); ?>
        <table>
            <tr valign="top">
                    <th scope="row"  class="field-name">Disable Compatibility Mode button on Internet Explorer browsers? <div class="recommended">(recommended) <a href="http://msdn.microsoft.com/en-us/library/jj676915%28v=vs.85%29.aspx">More info</a></div></th>
                    <td class="field-value">
                    <input name="wp_best_practices_disableCompatibilityView" type="radio" id="wp_best_practices_disableCompatibilityView_no" value="0" <?php echo $ejo_wp_best_practices->disableCompatibilityView_no_checked;?> /> No 
                    <input name="wp_best_practices_disableCompatibilityView" type="radio" id="wp_best_practices_disableCompatibilityView_yes" value="1" <?php echo $ejo_wp_best_practices->disableCompatibilityView_yes_checked;?> /> Yes </td>
            </tr>

            <tr valign="top">
                    <th scope="row"  class="field-name">Disable XML-RPC (ping-back) functionality? <div class="recommended">(recommended) <a href="http://blog.sucuri.net/2014/03/more-than-162000-wordpress-sites-used-for-distributed-denial-of-service-attack.html">More info</a></div></th>
                    <td class="field-value">
                    <input name="wp_best_practices_disableXMLRPC" type="radio" id="wp_best_practices_disableXMLRPC_no" value="0" <?php echo $ejo_wp_best_practices->disableXMLRPC_no_checked;?> /> No 
                    <input name="wp_best_practices_disableXMLRPC" type="radio" id="wp_best_practices_disableXMLRPC_yes" value="1" <?php echo $ejo_wp_best_practices->disableXMLRPC_yes_checked;?> /> Yes </td>
            </tr>

            <tr valign="top">
                    <th scope="row"  class="field-name">Disable File Editing? <div class="recommended">(Recommended) <a href="http://codex.wordpress.org/Hardening_WordPress#Disable_File_Editing">More info</a></div></th>
                    <td class="field-value">
                    <input name="wp_best_practices_disableFileEdit" type="radio" id="wp_best_practices_disableFileEdit_no" value="0" <?php echo $ejo_wp_best_practices->disableFileEdit_no_checked;?> /> No
                    <input name="wp_best_practices_disableFileEdit" type="radio" id="wp_best_practices_disableFileEdit_yes" value="1" <?php echo $ejo_wp_best_practices->disableFileEdit_yes_checked; ?> /> Yes </td>
            </tr>

            <tr valign="top">                    
                    <th scope="row"  class="field-name">Disable Generator Meta Tag? <div class="recommended">(Recommended) </div></th>
                    <td class="field-value">                    <input name="wp_best_practices_disableGeneratorMetaTag" type="radio" id="wp_best_practices_disableGeneratorMetaTag_no" value="0" <?php echo $ejo_wp_best_practices->disableGeneratorMetaTag_no_checked;?> /> No
                    <input name="wp_best_practices_disableGeneratorMetaTag" type="radio" id="wp_best_practices_generatorMetaTag_yes" value="1" <?php echo $ejo_wp_best_practices->disableGeneratorMetaTag_yes_checked; ?> /> Yes </td>
            </tr>

            <tr valign="top">
                    <th scope="row"  class="field-name">Allow this plugin to modify .htaccess file? <div class="recommended">(Recommended) <a href="http://codex.wordpress.org/Hardening_WordPress#Securing_wp-includes">More info</a> Please note that for changes to take effect, deactivation and activation is required. Default: yes </div></th>
                    <td class="field-value">                    <input name="wp_best_practices_enableHtaccessEntry" type="radio" id="wp_best_practices_enableHtaccessEntry_no" value="0" <?php echo $ejo_wp_best_practices->enableHtaccessEntry_no_checked; ?> /> No
                    <input name="wp_best_practices_enableHtaccessEntry" type="radio" id="wp_best_practices_enableHtaccessEntry_yes" value="1" <?php echo $ejo_wp_best_practices->enableHtaccessEntry_yes_checked; ?> /> Yes </td>
            </tr>

        </table>

        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="wp_best_practices_disableCompatibilityView, wp_best_practices_disableXMLRPC, wp_best_practices_disableFileEdit, wp_best_practices_disableGeneratorMetaTag, wp_best_practices_enableHtaccessEntry" /> 
            
        <p>
            <input class="button-primary" type="submit" value="<?php _e('Save Changes') ?>" />
        </p>
    </form>
</div>
