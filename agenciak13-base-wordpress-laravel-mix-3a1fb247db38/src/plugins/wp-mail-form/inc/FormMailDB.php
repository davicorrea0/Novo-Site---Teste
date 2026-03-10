<?php
/**
 * FormMail Database manager
 *
 */

Class FormMailDB
{
    /**
     * Return table rows
     * 
     * @return string
     */
    public function getFormMailsTable()
    {
        global $wpdb;
        $sql = 'SELECT * FROM '.$wpdb->prefix.'custom_formmail ORDER BY title';

        $results = $wpdb->get_results( $sql, OBJECT );

        $rows = '';
        foreach ($results as $form)
        {
            $rows .= "
                    <tr>
                        <td>
                            <a href=\"admin.php?page=new-mail-form&edit=true&id=".$form->id."\" class=\"upper\">
                                <strong>".$form->title."</strong>
                            </a>
                        </td>
                        <td>
                            <a href=\"admin.php?page=new-mail-form&edit=true&id=".$form->id."\" class=\"page-title-action\">
                                Editar
                            </a>
                            <a href=\"admin.php?page=mail-form&delete_formmail=true&form_id=".$form->id."\" class=\"page-title-action\" onclick=\"return confirm('Tem certeza que deseja excluir a marca ".$form->title."?')\">
                                Excluir
                            </a>
                        </td>
                    </tr>\n";
        }

        return $rows;
    }

    /**
     * Return table rows
     * 
     * @return string
     */
    public function getFormMailsFields()
    {
        global $wpdb;
        $sql = 'SELECT * FROM '.$wpdb->prefix.'custom_formmail ORDER BY title';

        $results = $wpdb->get_results( $sql, OBJECT );

        $fields = '';
        foreach ($results as $form)
        {
            $value   = implode(', ', json_decode($form->recipients, true));
            $fields .= "
                    <div class=\"form-group\">
                        <label>".$form->title."</label>
                        <input type=\"text\" name=\"mailformfields[".$form->id."]\" value=\"".$value."\" class=\"large\" required>
                    </div>\n";
        }

        return $fields;
    }

    /**
     * Return forms array
     *
     * @return array
     */
    public function getFormsArray()
    {
        global $wpdb;
        $sql = 'SELECT * FROM '.$wpdb->prefix.'custom_formmail ORDER BY title';

        $results = $wpdb->get_results( $sql, OBJECT );

        $forms = array();
        foreach ($results as $form)
        {
            $forms[$form->prefix] = array(
                'title'      => $form->title,
                'recipients' => json_decode($form->recipients, true),
                'template'   => $form->template,
                'feedback'   => $form->feedback
                );
        }

        return $forms;
    }

    /**
     * Return form object
     *
     * @return OBJECT
     */
    public static function getFormMail($id)
    {
        global $wpdb;
        $sql = 'SELECT * FROM '.$wpdb->prefix.'custom_formmail c WHERE c.id = \''.$id.'\'';
        return $wpdb->get_row( $sql, OBJECT );
    }
}